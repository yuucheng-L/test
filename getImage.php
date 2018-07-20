<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);

//取得電腦IP
$ip = file_get_contents('https://api.ipify.org');
$ip = '18.208.214.78';

//要傳送的圖片
$imgname = "Digitalent.jpg";
$imgname = "dog.jpg";

//取得要傳送圖片的路徑
$imageurl = "http://$ip/api/img/$imgname";

echo setURL($imageurl);

//Chatfuel傳送圖片的格式
//https://blog.chatfuel.com/help/facebook-messenger/plugins/json-plugin/
function setURL($url) {
  $payload -> url = $url;
  $obj = (object) [
  'type' => 'image',
  'payload' => $payload,
];
$attachment -> attachment = $obj;
$json -> messages = array($attachment);
return json_encode($json);
}


?>
