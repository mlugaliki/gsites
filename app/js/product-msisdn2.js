$(document).ready(function () {
    validateRequest();
});

// get User IP
validateRequest = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const check = urlParams.get('check');
    const mtclick = urlParams.get('mtclick');
    const videoName = urlParams.get('name');
    const clickId = urlParams.get('click_id');
    const sukiClickId = urlParams.get('clickId');
    const sourceId = urlParams.get('source_id');

    const ip = getUserIp();
    const credentails = getCredentials();
    if (credentails != null) {
        // Get customers phone number
        const msisdn = getPhoneNumber(credentails);
        if (msisdn != null) {
            // check if the phone number is already subscribed
            const subscriptionData = checkSubscription(msisdn);
            if (subscriptionData != null) {
                // redirect to the service.
                const savedCookie = localStorage.getItem(msisdn + "_" + subscriptionName);
                if (savedCookie == null) {
                    localStorage.setItem(msisdn + "_" + subscriptionName, "SUCCESS");
                }
            } else {
                // go to ScienLab
                try {
                    const url = "https://wap.guruhub.tech/app/flow2.php?name=" + videoName + "&&msisdn=" + msisdn + "&&ipAddress=" + ip;
                    const response = fetch(url);
                    const data = response.json();
                    const jsonData = JSON.parse(data);
                    if (jsonData != null && jsonData.hasOwnProperty("responseCode") && jsonData['responseCode'].equals("200")) {
                        const cgUrl = jsonData['cg_url'];
                        if (cgUrl != null) {
                            localStorage.setItem(msisdn + "start", "PENDING");
                            window.location.href = cgUrl;
                        }
                    }

                    saveCampaign(msisdn, mtclick, videoName, clickId, sukiClickId, sourceId)
                } catch (ex) {
                    console.log("Auth data " + ex);
                }
            }
        }
    }
}


getPhoneNumber = function (data) {
    try {
        if (data != null) {
            if (check == null || check.equals("0")) {
                const request = new Request(data.verifyUrl, {
                    method: "GET",
                    headers: {
                        "Accept-Language": "EN",
                        "Content-type": "application/json; charset=utf-8",
                        "Authorization": "Bearer " + data.token,
                        "X-App": "he-partner",
                        "X-MessageID": data.sessionId.toString(),
                        "X-Source-System": "he-partner"
                    },
                });

                const response = fetch(request);
                const data = response.json();
                console.log("Data " + data);
                if (response.ok) {
                    const msisdn = data.ServiceResponse.ResponseBody.Response.Msisdn;
                    return msisdn;
                }

                return null;
            }
        }
    } catch (ex) {
        console.log("Auth data " + ex);
    }
}

getCredentials = function () {
    try {
        const request = new Request("https://api.guruhub.tech/vasmasta/he/auth", {
            method: "POST",
        });

        const response1 = fetch(request);
        const data = response1.json();
        console.log("Data " + data);
        return data;
    } catch (ex) {
        console.log("Auth data " + ex);
    }

    return null;
}

getUserIp = function () {
    try {
        const url = "https://www.cloudflare.com/cdn-cgi/trace";
        let response = fetch(url);
        let data = response.json();
        data = data.trim().split('\n');
        let ipData = data[2];
        let ipDataString = ipData.split("=");
        let ip = ipDataString[1];
        console.log("Mobile IP->" + ip + " => " + msisdn + " => " + name);
        return ip;
    } catch (ex) {
        console.log("Auth data " + ex);
    }

    return null;
}


checkSubscription = function (msisdn) {
    try {
        const url = "https://api.guruhub.tech/vasmasta/he/check-subscription/" + msisdn
        const request = new Request(url, {
            method: "POST",
        });

        const response = fetch(request);
        const data = response.json();
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
    } catch (ex) {
        console.log("Auth data " + ex);
    }

    return null;
}


saveCampaign = function (msisdn, mtclick, videoName, clickId, sukiClickId, sourceId) {
    try {
        const url = "https://api.guruhub.tech/vasmasta/he/campaigns"
        const request = new Request(url, {
            method: "POST",
            headers: {
                "x-api-key": "9091",
            },
            data: JSON.stringify(
                {
                    "service": videoName,
                    "clickId": clickId == null ? sukiClickId : clickId,
                    "msisdn": msisdn,
                    "sourceId": sourceId,
                    "mtclick": mtclick
                }),
        });

        const response = fetch(request);
        if (response.ok) {
            console.log("successful");
        } else {
            console.log(response.statusText);
        }
    } catch (ex) {
        console.log("Auth data " + ex);
    }

}