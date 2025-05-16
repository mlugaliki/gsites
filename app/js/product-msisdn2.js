$(document).ready(function () {
  validateRequest();
});

// get User IP
validateRequest = async function () {
  const urlParams = new URLSearchParams(window.location.search);
  const check = urlParams.get("check");
  const mtclick = urlParams.get("mtclick");
  const subscriptionName = urlParams.get("name");
  const clickId = urlParams.get("click_id");
  const sukiClickId = urlParams.get("clickId");
  const sourceId = urlParams.get("source_id");

  const ip = await getUserIp();
  const credentails = await getCredentials();
  if (credentails != null) {
    // Get customers phone number
    const msisdn = await getPhoneNumber(credentails, check);
    if (msisdn != null) {
      // check if the phone number is already subscribed
      const subscriptionData = await checkSubscription(
        msisdn,
        subscriptionName
      );

      const savedCookie = localStorage.getItem(msisdn + "_" + subscriptionName);
      if (subscriptionData != null || (savedCookie != null && savedCookie === "SUCCESS")) {
        // redirect to the service.
        if (savedCookie == null) {
          localStorage.setItem(msisdn + "_" + subscriptionName, "SUCCESS");
        }
      } else {
        const provider = "SUKI";
        if (provider != null && provider === "SUKI") {
          // go to SUKI
          try {
            const url = "https://api.guruhub.tech/vasmasta/he/request-cg";
            const request = new Request(url, {
              method: "POST",
              //cors: false,
              //mode: "no-cors",
              headers: {
                "x-api-key": "9091",
                "Content-Type": "application/json",
              },
              body: JSON.stringify({
                msisdn: msisdn,
                sourceIp: ip,
                userAgent: window.navigator.userAgent,
              }),
            });

            const response = await fetch(request);
            if (response.ok) {
              const data = await response.json();
              console.log(data);
              if (data.cg_url != null) {
                console.log("URL => " + data.cg_url);
                await saveCampaign(
                  msisdn,
                  mtclick,
                  subscriptionName,
                  clickId,
                  sukiClickId,
                  sourceId
                );

                const cgUrl = data["cg_url"];
                if (cgUrl != null) {
                  localStorage.setItem(msisdn + "_" + subscriptionName, "SUCCESS");
                  window.location.href = cgUrl;
                }
              }
            }
          } catch (ex) {
            console.log("Auth data " + ex);
          }
        } else {
          // go to ScienLab
          try {
            const url =
              "https://wap.guruhub.tech/app/flow2.php?name=" +
              subscriptionName +
              "&&msisdn=" +
              msisdn +
              "&&ipAddress=" +
              ip;
            const response = await fetch(url);
            if (response.ok) {
              const data = await response.json();
              const jsonData = data; //JSON.parse(data);
              console.log(jsonData);
              console.log("Respsonse code => " + jsonData.responseCode);
              console.log("URL => " + jsonData.cg_url);
              console.log("Message => " + jsonData.message);
              if (jsonData != null && jsonData.responseCode === 200) {
                await saveCampaign(
                  msisdn,
                  mtclick,
                  subscriptionName,
                  clickId,
                  sukiClickId,
                  sourceId
                );
                const cgUrl = jsonData["cg_url"];
                if (cgUrl != null) {
                  localStorage.setItem(msisdn + "start", "PENDING");
                  window.location.href = cgUrl;
                }
              }
            }
          } catch (ex) {
            console.log("Auth data " + ex);
          }
        }
      }
    }
  }
};

getPhoneNumber = async function (data, check) {
  try {
    if (data != null) {
      if (check == null || check.equals("0")) {
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
        } else {
          console.log("Test " + response.data);
          console.log("Data -> " + response.statusText);
          console.log("Error -> " + response.error);
        }

        return "325653268354";
      }
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }
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

checkSubscription = async function (msisdn, subscriptionName) {
  try {
    const url =
      "https://api.guruhub.tech/vasmasta/he/check-subscription/" + msisdn;
    const request = new Request(url, {
      method: "GET",
    });

    const response = await fetch(request);
    if (response.ok) {
      const data = await response.json();
      console.log("Subscription data " + data);
      const jsonData = data.data;
      let subscribedService = null;
      for (let x = 0; x < jsonData.length; x++) {
        if (jsonData[x].serviceName === subscriptionName) {
          subscribedService = subscriptionName;
          break;
        }
      }

      return subscribedService;
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }

  return null;
};

saveCampaign = async function (
  msisdn,
  mtclick,
  subscriptionName,
  clickId,
  sukiClickId,
  sourceId
) {
  try {
    const url = "https://api.guruhub.tech/vasmasta/he/campaigns";
    const request = new Request(url, {
      method: "POST",
      // cors: false,
      // mode: "no-cors",
      headers: {
        "x-api-key": "9091",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        service: subscriptionName,
        clickId: clickId == null ? sukiClickId : clickId,
        msisdn: msisdn,
        sourceId: sourceId,
        mtclick: mtclick,
      }),
    });

    const response = await fetch(request);
    if (response.ok) {
      console.log("successful");
    } else {
      console.log(response.statusText);
    }
  } catch (ex) {
    console.log("Auth data " + ex);
  }
};