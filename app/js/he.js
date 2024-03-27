this.getRequestId = function () {
    const typedArray = new Uint8Array(10);
    const randomValues = window.crypto.getRandomValues(typedArray);
    return randomValues.join('');
};
$(document).ready(function () {
    $.ajax({
        url: 'https://api.guruhub.tech/vasmasta/he/auth',
        context: document.body,
        type: 'POST',
        success: function (data, status, xhr) {
            getScienlabToken(data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            console.log("Auth data " + errorMessage)
        }
    });

    function redirectCustomerRequest(scLab, response) {
        // console.log(scLab.redirectUrl);
        // console.log(scLab.consentUrl);
        // console.log(scLab.campaignId);
        $.ajax({
            // url: scLab.consentUrl,
            url: '/app/HEWebFlowClient.php',
            dataType: 'json',
            cors: false,
            contentType: 'application/json',
            data: JSON.stringify({
                msisdn: "",
                campaign_id: scLab.campaignId,
                source_ip: $('#ip').val(),
                requestid: this.getRequestId(),
                user_agent: window.navigator.userAgent,
                redirect_url: scLab.redirectUrl
            }),
            secure: true,
            type: 'POST',
            headers: {
                "Content-type": "application/json; charset=utf-8",
                "Accept": "application/json; charset=utf-8"
            },
            success: function (data, status, xhr) {
                if (data.ServiceResponse.ResponseHeader.ResponseCode === '204') {
                    console.log("Mobile number not found. Connect to safaricom network");
                    console.log("Your mobile number is = ");
                    // $("#test-videos").show();
                    // $("#mobile").text("127636472464");
                    // $("#mobile1").text("123434535");
                    redirectCustomerRequest(data);
                } else if (data.ServiceResponse.ResponseHeader.ResponseCode === '200') {
                    console.log("Mobile number found. Enjoy the service");
                    console.log("Your mobile number is = " + data.ServiceResponse.ResponseBody.Response.Msisdn);
                } else {
                    console.log("Contact admin at support@guruhub.tech");
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
                // $("#test-videos").show();
                // $("#show-videos").show(); //TODO: Remove
                // $("#mobile").text("127636472464");
            }
        });
    }

    function getScienlabToken(response) {
        if (response == null) {
            return;
        }
        // console.log(response.scLab.username);
        // console.log(response.scLab.password);
        // console.log(response.scLab.tokenUrl);
        $.ajax({
            //url: response.scLab.tokenUrl,
            url: '/app/HEWebFlowClient.php',
            dataType: 'json',
            cors: false,
            contentType: 'application/json',
            data: JSON.stringify({
                'username': response.scLab.username,
                'password': response.scLab.password,
                'grant_type': "client_credentials"
            }),
            //secure: true,
            type: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            success: function (data, status, xhr) {
                if (data.ServiceResponse.ResponseHeader.ResponseCode === '204') {
                    console.log("Mobile number not found. Connect to safaricom network");
                    console.log("Your mobile number is = ");
                    // $("#test-videos").show();
                    // $("#mobile").text("127636472464");
                    // $("#mobile1").text("123434535");
                    redirectCustomerRequest(response.scLab, data);
                } else if (data.ServiceResponse.ResponseHeader.ResponseCode === '200') {

                    console.log("Mobile number found. Enjoy the service");
                    console.log("Your mobile number is = ");
                } else {
                    console.log("Contact admin at support@guruhub.tech");
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
                // $("#test-videos").show();
                // $("#show-videos").show(); //TODO: Remove
                // $("#mobile").text("127636472464");
            }
        });
    }
});