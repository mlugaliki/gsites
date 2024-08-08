<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

$json = json_decode(file_get_contents('php://input'));
error_log(print_r($json, true));
error_log($json->customerEmail);
error_log($json->customerName);
error_log($json->customerInquiry);
//error_log($json->customerName .",".$json->customerEmail .",".$json->customerInquiry);


$curl = curl_init();
$message = "Customer name : ".$json->customerName ."<br/>Customer Email : ".$json->customerEmail ."<br/> Inquiry : ".$json->customerInquiry  ."</b></div>";
//echo $message;

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.zeptomail.com/v1.1/email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
"from": { "address": "noreply@guruhub.tech", "name": "Web Inquiries" },
"to": [{"email_address": {"address": "info@guruhub.tech","name": "support"}}],
"subject":"Test Email",
"htmlbody":"'.$message.'"}',
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "authorization: Zoho-enczapikey wSsVR61zrEHwCv0vnDSuI+ownFgDU1qgF0973lGm4if4S/HCoMcyw0PGBVSmFfZMRzE7QjIb8O5/mxZUhGEIjYt7zVkJCCiF9mqRe1U4J3x17qnvhDzNWGhelhWILYIMwQ1tk2diEs8l+g==",
        "cache-control: no-cache",
        "content-type: application/json",),));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$sendEmailSuccess = true;
if ($err) {
    $sendEmailSuccess = false;
    //error_log("cURL Error #:" . $err."\nMessage ".$message);
    echo $err;
}

header("HTTP/1.1 200 OK");
header("Status: 200 All rosy");
if($sendEmailSuccess) {
    echo '{"message":"Thank you for your email. Our customer service agent will be in touch with you shortly."}';
}
?>