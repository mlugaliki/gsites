<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.zeptomail.com/v1.1/email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
"from": { "address": "noreply@guruhub.tech"},
"to": [{"email_address": {"address": "support@guruhub.tech","name": "support"}}],
"subject":"Test Email",
"htmlbody":"<div><b> Test email sent successfully. </b></div>",
}',
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "authorization: Zoho-enczapikey wSsVR61zrEHwCv0vnDSuI+ownFgDU1qgF0973lGm4if4S/HCoMcyw0PGBVSmFfZMRzE7QjIb8O5/mxZUhGEIjYt7zVkJCCiF9mqRe1U4J3x17qnvhDzNWGhelhWILYIMwQ1tk2diEs8l+g==",
        "cache-control: no-cache",
        "content-type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
?>