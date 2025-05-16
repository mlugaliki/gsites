$(document).ready(() => validateRequest());
getPhoneNumber = async function (data) {
  try {
    if (data != null) {
      const request = new Request(data.verifyUrl, {
        dataType: "json",
        cors: false,
        contentType: "application/json",
        secure: true,
        type: "GET",
        headers: {
          "Accept-Language": "EN",
          "Content-type": "application/json; charset=utf-8",
          Authorization: "Bearer " + data.token,
          "X-App": "he-partner",
          "X-MessageID": data.sessionId.toString(),
          "X-Source-System": "he-partner",
        },
      });

      const response = await fetch(request);
      if (response.ok) {
        const data = await response.json();
        console.log("Data " + data);
        const msisdn = data.ServiceResponse.ResponseBody.Response.Msisdn;
        return msisdn;
      }
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }
  return null;
};

getCredentials = async function () {
  try {
    const request = new Request("https://api.guruhub.tech/vasmasta/he/auth", {
      method: "POST",
    });

    const response = await fetch(request);
    if (response.ok) {
      const data = await response.text();
      console.log(data);
      return JSON.parse(data);
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }

  return null;
};

getUserIp = async function () {
  try {
    const url = "https://api.ipify.org/?format=json";
    const response = await fetch(url);
    if (response.ok) {
      const data = await response.json();
      console.log(data);
      return data?.ip;
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }

  return null;
};


const validateRequest = async () => {
  try {
    const ip = await getUserIp();
    if (!ip) throw new Error("Failed to retrieve IP");

    const credentials = await getCredentials();
    if (!credentials) throw new Error("Failed to authenticate");

    const msisdn = await getPhoneNumber(credentials);
    if (!msisdn) throw new Error("Failed to retrieve phone number");

    const response = await fetch("https://api.guruhub.tech/vasmasta/he/request-cg", {
      method: "POST",
      headers: {
        "x-api-key": "9091",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        msisdn,
        sourceIp: ip,
        userAgent: window.navigator.userAgent,
      }),
    });

    if (!response.ok) throw new Error(`HTTP ${response.status}`);
    const data = await response.json();

    if (data?.cg_url) {
      updateCgUrl(data.cg_url);
    } else {
      console.warn("No cg_url in response");
    }
  } catch (ex) {
    console.error("Validation failed: ", ex.message);
  }
};

const updateCgUrl = (cgUrl) => {
  const link = document.querySelector(".cgUrl");
  if (link && cgUrl) {
    link.href = cgUrl;
  } else {
    console.warn("Invalid cgUrl or no element with class 'cgUrl'");
  }
};
