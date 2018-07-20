<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);

//取得電腦IP
$ip = file_get_contents('https://api.ipify.org');

//取得上傳圖片的url
$url = $_GET['url'];
$mode = $_GET['mode'];

//將圖片儲存到img資料夾
$uploaddir = 'InputImg/';
file_put_contents($uploaddir.'temp.html', file_get_contents($url));

//將圖片名稱重新命名
$imgname = "Digitalent_" . date("Ymdhis");
rename($uploaddir.'temp.html', $uploaddir.$imgname.'.jpg');

//要辨識的圖片位置
$inputImg = $imgname.'.jpg';

//執行Anaconda的Python程式
$python = "C:\\ProgramData\\Anaconda3\\python.exe";

//導入要執行的Python程式碼
$pyscript = "UploadImage.py";

//執行外部呼叫程式
$result = shell_exec("$python $pyscript $inputImg");

//json解碼
$object = json_decode($result);

//從json取得imgurl
switch ($mode) {
    case '情緒辨識':
        $imgurl = $object->classfu_img;
        break;
    case '骨架辨識':
        $imgurl = $object->humanpose_img;
        break;
    case '特徵點辨識':
        $imgurl = $object->face_recognition_img;
        break;
}

//等待1秒
sleep(1);

//將圖片儲存到img資料夾
$uploaddir = 'OutputImg/';
file_put_contents($uploaddir.'temp.html', file_get_contents($imgurl));

//將圖片名稱重新命名
$imgname = "OutputImg_" . date("Ymdhis");
rename($uploaddir.'temp.html', $uploaddir.$imgname.'.jpg');
$outimgurl = "http://$ip/api/OutputImg/".$imgname.".jpg";

echo sendImage($outimgurl);


//Chatfuel傳送圖片的格式
//https://blog.chatfuel.com/help/facebook-messenger/plugins/json-plugin/
function sendImage($url) {
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