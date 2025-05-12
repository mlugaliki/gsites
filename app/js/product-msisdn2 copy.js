// Use an IIFE to encapsulate the code and avoid global scope pollution
(async () => {
  // Wait for the DOM to be fully loaded
  document.addEventListener("DOMContentLoaded", async () => {
    const validator = new SubscriptionValidator();
    await validator.validateRequest();
  });

  /**
   * Class to handle subscription validation and redirection.
   */
  class SubscriptionValidator {
    constructor() {
      this.apiKey = "9091"; // Move to environment variable or backend in production
      this.baseApiUrl = "https://api.guruhub.tech/vasmasta/he";
      this.altApiUrl = "http://wap1.guruhub.tech/app/flow2.php";
    }

    /**
     * Main function to validate the request and redirect the user.
     */
    async validateRequest() {
      try {
        const params = this.extractUrlParams();
        const ip = await this.getUserIp();
        if (!ip) throw new Error("Failed to retrieve user IP");

        const credentials = await this.getCredentials();
        if (!credentials) throw new Error("Failed to retrieve credentials");

        const msisdn = await this.getPhoneNumber(credentials, params.check);
        if (!msisdn) throw new Error("Failed to retrieve phone number");

        const isSubscribed = await this.checkSubscription(
          msisdn,
          params.subscriptionName
        );
        if (isSubscribed) {
          this.handleSubscription(msisdn, params.subscriptionName);
          return;
        }

        const provider = "SUKI"; // This could be dynamic
        const redirectUrl = await this.processProvider(provider, {
          ...params,
          msisdn,
          ip,
        });
        if (redirectUrl) {
          localStorage.setItem(`${msisdn}_start`, "PENDING");
          window.location.href = redirectUrl;
        } else {
          throw new Error("Failed to get redirect URL");
        }
      } catch (error) {
        this.logError("Validation failed", error);
      }
    }

    /**
     * Extracts parameters from the URL query string.
     * @returns {object} The extracted parameters
     */
    extractUrlParams() {
      const urlParams = new URLSearchParams(window.location.search);
      return {
        check: urlParams.get("check"),
        mtclick: urlParams.get("mtclick"),
        subscriptionName: urlParams.get("name"),
        clickId: urlParams.get("click_id") || urlParams.get("clickId"), // Simplify clickId logic
        sourceId: urlParams.get("source_id"),
      };
    }

    /**
     * Handles the case where the user is already subscribed.
     * @param {string} msisdn - The phone number
     * @param {string} subscriptionName - The subscription name
     */
    handleSubscription(msisdn, subscriptionName) {
      const key = `${msisdn}_${subscriptionName}`;
      if (!localStorage.getItem(key)) {
        localStorage.setItem(key, "SUCCESS");
      }
    }

    /**
     * Retrieves the user's IP address from Cloudflare.
     * @returns {Promise<string>} The IP address
     */
    async getUserIp() {
      const data = await this.makeRequest({
        url: "https://www.cloudflare.com/cdn-cgi/trace",
        options: { method: "GET" },
      });
      const ipLine = data
        .trim()
        .split("\n")
        .find((line) => line.startsWith("ip="));
      if (!ipLine) throw new Error("IP not found in response");
      return ipLine.split("=")[1];
    }

    /**
     * Retrieves authentication credentials.
     * @returns {Promise<object>} The credentials
     */
    async getCredentials() {
      const data = await this.makeRequest({
        url: `${this.baseApiUrl}/auth`,
        options: { method: "POST" },
      });
      return typeof data === "string" ? JSON.parse(data) : data;
    }

    /**
     * Retrieves the user's phone number.
     * @param {object} credentials - The authentication credentials
     * @param {string|null} check - The check parameter
     * @returns {Promise<string>} The phone number
     */
    async getPhoneNumber(credentials, check) {
      if (!credentials || (check && check !== "0"))
        throw new Error("Invalid credentials or check parameter");

      const data = await this.makeRequest({
        url: credentials.verifyUrl,
        options: {
          method: "GET",
          mode: "no-cors", // or 'no-cors', 'same-origin'
          credentials: "omit", // or 'same-origin', 'include'
         // integrity: "sha384-hash-value", // Subresource Integrity hash
          //redirect: "follow", // or 'error', 'manual'
          //referrer: "client", // or a URL
          //cache: "default", // or 'no-store', 'reload', 'no-cache', 'force-cache', 'only-if-cached'
          headers: {
            "Accept-Language": "EN",
            "Content-Type": "application/json; charset=utf-8",
            Authorization: `Bearer ${credentials.token}`,
            "X-App": "he-partner",
            "X-MessageID": String(credentials.sessionId),
            "X-Source-System": "he-partner",
            'X-Requested-With': 'XMLHttpRequest',
          },
        },
      });
      const msisdn = data?.ServiceResponse?.ResponseBody?.Response?.Msisdn;
      if (!msisdn) throw new Error("Phone number not found in response");
      return msisdn;
    }

    /**
     * Checks if the user is subscribed to a service.
     * @param {string} msisdn - The phone number
     * @param {string} subscriptionName - The subscription name
     * @returns {Promise<boolean>} True if subscribed, false otherwise
     */
    async checkSubscription(msisdn, subscriptionName) {
      const data = await this.makeRequest({
        url: `${this.baseApiUrl}/check-subscription/${msisdn}`,
        options: { method: "GET" },
      });
      const subscriptions = data?.data || [];
      return !!subscriptions.find(
        (sub) => sub.serviceName === subscriptionName
      );
    }

    /**
     * Saves campaign data.
     * @param {object} params - The campaign parameters
     * @returns {Promise<void>}
     */
    async saveCampaign(params) {
      await this.makeRequest({
        url: `${this.baseApiUrl}/campaigns`,
        options: {
          method: "POST",
          headers: this.getApiHeaders(),
          body: JSON.stringify({
            service: params.subscriptionName,
            clickId: params.clickId,
            msisdn: params.msisdn,
            sourceId: params.sourceId,
            mtclick: params.mtclick,
          }),
        },
      });
    }

    /**
     * Processes the provider logic and returns a redirect URL.
     * @param {string} provider - The provider name
     * @param {object} params - The request parameters
     * @returns {Promise<string|null>} The redirect URL or null on failure
     */
    async processProvider(provider, params) {
      if (provider === "SUKI") {
        const data = await this.makeRequest({
          url: `${this.baseApiUrl}/request-cg`,
          options: {
            method: "POST",
            headers: this.getApiHeaders(),
            body: JSON.stringify({
              service: params.subscriptionName,
              clickId: params.clickId,
              msisdn: params.msisdn,
              sourceId: params.sourceId,
              mtclick: params.mtclick,
            }),
          },
        });

        if (data?.cg_url) {
          await this.saveCampaign(params);
          return data.cg_url;
        }
      } else {
        const url = `${this.altApiUrl}?name=${params.subscriptionName}&msisdn=${params.msisdn}&ipAddress=${params.ip}`;
        const data = await this.makeRequest({
          url,
          options: { method: "GET" },
        });

        if (data?.responseCode === 200 && data.cg_url) {
          await this.saveCampaign(params);
          return data.cg_url;
        }
      }
      return null;
    }

    /**
     * Returns headers for API requests.
     * @returns {object} The headers
     */
    getApiHeaders() {
      return {
        "x-api-key": this.apiKey, // Move to backend in production
        "Content-Type": "application/json",
      };
    }

    /**
     * Utility function to make HTTP requests.
     * @param {object} config - The request configuration
     * @returns {Promise<object|string>} The response data
     */
    async makeRequest({ url, options }) {
      try {
        const response = await fetch(url, options);
        if (!response.ok) throw new Error(`HTTP error: ${response.status}`);

        const contentType = response.headers.get("content-type");
        if (contentType?.includes("application/json")) {
          return await response.json();
        }
        return await response.text();
      } catch (error) {
        this.logError(`Request to ${url} failed`, error);
        throw error; // Rethrow to ensure the caller handles the error
      }
    }

    /**
     * Logs errors in a consistent format.
     * @param {string} message - The error message
     * @param {Error} error - The error object
     */
    logError(message, error) {
      console.error(`${message}: ${error.message}`);
    }
  }
})();
