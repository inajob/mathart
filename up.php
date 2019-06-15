<?php
define("IMGUR_TOKEN", getenv("IMGUR_TOKEN"));

$raw = file_get_contents('php://input');
$POST_DATA = array(
    'image' => urldecode($raw),
    'type' => 'base64',
    'title' => '#mathart  http://web.inajob.tk/mathart/mathart.html' 
);
$curl=curl_init("https://api.imgur.com/3/image");
curl_setopt($curl,CURLOPT_POST, TRUE);
curl_setopt($curl,CURLOPT_POSTFIELDS, $POST_DATA);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);  // オレオレ証明書対策
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);  // 
curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
curl_setopt($curl,CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . IMGUR_TOKEN));
//curl_setopt($curl,CURLOPT_REFERER,        "REFERER");
//curl_setopt($curl,CURLOPT_USERAGENT,      "USER_AGENT"); 

$output= curl_exec($curl);
error_log($output);

header('Content-type: application/json; charset=UTF-8;');
echo $output;
?>
