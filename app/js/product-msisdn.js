function checkSubscription(msisdn, subscriptionName) {
    $.ajax({
        url: 'https://api.guruhub.tech/vasmasta/he/check-subscription/' + msisdn,
        dataType: 'json',
        cors: true,
        contentType: 'application/json',
        secure: true,
        type: 'GET',
        headers: {
            "x-api-key": "9091",
        }, success: function (data, status, xhr) {
            let jsonData = data.data;
            let subscribedService = null;
            for (let x = 0; x < jsonData.length; x++) {
                if (jsonData[x].serviceName === subscriptionName) {
                    subscribedService = subscriptionName;
                    break;
                }
            }
            if (subscribedService == null) {
                getUserIp(msisdn, subscriptionName);
            } else {
                let sessionId = localStorage.getItem(msisdn + "_" + subscriptionName);
                if (sessionId == null) {
                    localStorage.setItem(msisdn + "_" + subscriptionName, subscriptionName);
                } else {
                    window.location.href = "https://wap.guruhub.tech/app/product.php?name=" + subscriptionName + "&&msisdn=" + msisdn + "&&ipAddress=" + "127.0.0.1" + "&&check=1";
                }
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            console.log(errorMessage);
        }
    });
}

function getUserIp(msisdn, name) {
    $.ajax({
        url: 'https://www.cloudflare.com/cdn-cgi/trace',
        type: 'GET',
        success: function (data, status, xhr) {
            data = data.trim().split('\n');
            let ipData = data[2];
            let ipDataString = ipData.split("=");
            let ip = ipDataString[1];
            console.log("Mobile IP->" + ip + " => " + msisdn + " => " + name);
            window.location.href = "https://wap.guruhub.tech/app/flow2.php?name=" + name + "&&msisdn=" + msisdn + "&&ipAddress=" + ip;
        },
        error: function (jqXhr, textStatus, errorMessage) {
            console.log("Auth data " + errorMessage)
        }
    });
}

$(document).ready(function () {
    $.ajax({
        url: 'https://api.guruhub.tech/vasmasta/he/auth',
        context: document.body,
        type: 'POST',
        success: function (data, status, xhr) {
            callback(data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            console.log("Auth data " + errorMessage)
        }
    });

    function callback(response) {
        if (response == null) {
            return;
        }

        const urlParams = new URLSearchParams(window.location.search);
        const check = urlParams.get('check');
        if (check == null || check.equals("0")) {
            $.ajax({
                url: response.verifyUrl,
                dataType: 'json',
                cors: false,
                contentType: 'application/json',
                secure: true,
                type: 'GET',
                headers: {
                    "Accept-Language": "EN",
                    "Content-type": "application/json; charset=utf-8",
                    "Authorization": "Bearer " + response.token,
                    "X-App": "he-partner",
                    "X-MessageID": response.sessionId.toString(),
                    "X-Source-System": "he-partner"
                },
                success: function (data, status, xhr) {
                    if (data.ServiceResponse.ResponseHeader.ResponseCode === '204') {
                        console.log("Mobile number not found. Connect to safaricom network");
                        const urlParams = new URLSearchParams(window.location.search);
                        const myParam = urlParams.get('name');
                        checkSubscription("127636472464", myParam);
                    } else if (data.ServiceResponse.ResponseHeader.ResponseCode === '200') {
                        console.log("Mobile number found. Enjoy the service");
                        $(".sid").val(data.ServiceResponse.ResponseBody.Response.Msisdn);
                        const urlParams = new URLSearchParams(window.location.search);
                        const myParam = urlParams.get('name');
                        checkSubscription(data.ServiceResponse.ResponseBody.Response.Msisdn, myParam);
                    } else {
                        console.log("Contact admin at support@guruhub.tech");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        }
    }
});