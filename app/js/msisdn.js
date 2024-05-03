$(document).ready(function () {
    $("#show-videos").hide();
    $("#test-videos").hide();
    $('.subscribe').prop('disabled', true);
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
                //"x-correlation-conversationid": response.sessionId.toString(),
                "X-MessageID": response.sessionId.toString(),
                //"X-DeviceId": response.sessionId.toString(),
                //"X-DeviceToken": response.sessionId.toString(),
                //"X-Version": response.sessionId.toString(),
                "X-Source-System": "he-partner"
            },
            success: function (data, status, xhr) {
                if (data.ServiceResponse.ResponseHeader.ResponseCode === '204') {
                    console.log("Mobile number not found. Connect to safaricom network");
                    $(".saf-error").text("Mobile number not found. Connect to safaricom network");
                } else if (data.ServiceResponse.ResponseHeader.ResponseCode === '200') {
                    console.log("Mobile number found. Enjoy the service");
                    $("#sid").val(data.ServiceResponse.ResponseBody.Response.Msisdn);
                    $('.subscribe').prop('disabled', false);
                } else {
                    console.log("Contact admin at support@guruhub.tech");
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
                console.log("Mobile number not found. Connect to safaricom network");
                $(".saf-error").text("Mobile number not found. Connect to safaricom network");
            }
        });
    }
});