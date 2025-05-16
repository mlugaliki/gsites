$(document).ready(() => {
  validateRequest();
});

const validateRequest = async () => {
  try {
    const urlParams = new URLSearchParams(window.location.search);
    const params = {
      check: urlParams.get("check"),
      mtclick: urlParams.get("mtclick"),
      subscriptionName: urlParams.get("name"),
      clickId: urlParams.get("click_id"),
      sukiClickId: urlParams.get("clickId"),
      sourceId: urlParams.get("source_id"),
      mfId: urlParams.get("mfilter_id"),
      msisdn: urlParams.get("msisdn"),
      cgId: urlParams.get("cgId"),
    };

    const ip = await getUserIp();
    const credentials = await getCredentials();
    if (!credentials) {
      console.warn("Credentials not found");
      return;
    }

    const msisdn = params.msisdn || (await getPhoneNumber(credentials, params.check));
    if (!msisdn) {
      console.warn("Phone number not found");
      return;
    }

    const subscriptionData = await checkSubscription(msisdn, params.subscriptionName);
    const storageKey = `${msisdn}_${params.subscriptionName}`;
    
    if (!subscriptionData) {
      localStorage.removeItem(storageKey);
    } else {
      if (!localStorage.getItem(storageKey)) {
        localStorage.setItem(storageKey, "SUCCESS");
      }
      return;
    }

    const requestBody = {
      msisdn,
      sourceIp: ip,
      userAgent: navigator.userAgent,
      service: params.subscriptionName,
      cgId: params.cgId,
      sourceId: params.sourceId,
      mtClickId: params.mtclick,
      clickId: params.cgId === "1" ? params.sukiClickId : params.clickId,
    };

    const response = await fetch("https://api.guruhub.tech/vasmasta/he/request-cg", {
      method: "POST",
      headers: {
        "x-api-key": "9091",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestBody),
    });

    if (!response.ok) {
      throw new Error(`CG request failed with status ${response.status}`);
    }

    const data = await response.json();
    const cgUrl = data?.cg_url;
    if (cgUrl) {
      localStorage.setItem(storageKey, "SUCCESS");
      window.location.href = cgUrl;
    }
  } catch (error) {
    console.error("Error processing CG request:", error);
  }
};

const getPhoneNumber = async (credentials, check) => {
  if (!credentials || (check && check !== "0")) return null;

  try {
    const response = await fetch(credentials.verifyUrl, {
      method: "GET",
      headers: {
        "Accept-Language": "EN",
        "Content-Type": "application/json; charset=utf-8",
        Authorization: `Bearer ${credentials.token}`,
        "X-App": "he-partner",
        "X-MessageID": credentials.sessionId.toString(),
        "X-Source-System": "he-partner",
      },
    });

    if (!response.ok) {
      console.warn(`Phone number request failed with status ${response.status}`);
      return null;
    }

    const data = await response.json();
    return data?.ServiceResponse?.ResponseBody?.Response?.Msisdn || null;
  } catch (error) {
    console.error("Error fetching phone number:", error);
    return null;
  }
};

const getCredentials = async () => {
  try {
    const response = await fetch("https://api.guruhub.tech/vasmasta/he/auth", {
      method: "POST",
    });

    if (!response.ok) {
      throw new Error(`Credentials request failed with status ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error("Error fetching credentials:", error);
    return null;
  }
};

const getUserIp = async () => {
  try {
    const response = await fetch("https://api.ipify.org/?format=json");
    if (!response.ok) {
      throw new Error(`IP request failed with status ${response.status}`);
    }

    const data = await response.json();
    return data?.ip || null;
  } catch (error) {
    console.error("Error fetching user IP:", error);
    return null;
  }
};

const checkSubscription = async (msisdn, subscriptionName) => {
  try {
    const response = await fetch(`https://api.guruhub.tech/vasmasta/he/check-subscription/${msisdn}`, {
      method: "GET",
    });

    if (!response.ok) {
      throw new Error(`Subscription check failed with status ${response.status}`);
    }

    const { data } = await response.json();
    return data?.find((item) => item.serviceName === subscriptionName)?.serviceName || null;
  } catch (error) {
    console.error("Error checking subscription:", error);
    return null;
  }
};