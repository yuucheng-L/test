<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);

//執行Anaconda的Python程式
$python = "C:\\ProgramData\\Anaconda3\\python.exe";

//導入要執行的Python程式碼
$pyscript = "get_weather_data.py";

//執行外部呼叫程式

$result = shell_exec("$python $pyscript");
/*{
 "messages": [
   {"text": "Welcome to our store!"},
   {"text": "How can I help you?"}
 ]
}*/
echo sendText($result);

//Chatfuel傳送文字的格式
//https://blog.chatfuel.com/help/facebook-messenger/plugins/json-plugin/
function sendText($text) {
    $objs[] -> text = $text;
    //再包Messages
    $json -> messages = $objs;
    //編碼JSON
    return json_encode($json);
  }
?>