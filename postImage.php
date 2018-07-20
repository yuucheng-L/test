<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);

//取得上傳圖片的url
$url = $_GET['url'];

//將圖片儲存到img資料夾
$uploaddir = 'img/';
file_put_contents($uploaddir.'temp.html', file_get_contents($url));

//將圖片名稱重新命名
$imgname = "Digitalent_" . date("Ymdhis");
rename($uploaddir.'temp.html', $uploaddir.$imgname.'.jpg');

//取得儲存圖片的路徑
$imageurl = 'http://18.207.173.106/api/img/'.$imgname.'.jpg';

//編碼並傳送JSON
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
