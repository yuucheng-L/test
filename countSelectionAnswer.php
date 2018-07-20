<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);


//取得使用者id
$FB_ID = $_GET['id']; 
$Selection = $_GET['selection'];

//資料庫資訊
$servername = 'localhost';
$username = 'digitalent';
$password = 'digitalent2018';
$dbname = 'digitalent';


//建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

//取得user最新的hashcode
$sql="SELECT HashCode FROM `digitalent_result` WHERE `FB_ID` = '$FB_ID' ORDER BY id DESC limit 1";
		$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$HashCode=$row["HashCode"];
} else {
    echo "no results";
}

//取得user選項總數
$sql="SELECT COUNT(SelectionAnswer) FROM `digitalent_chatbot` WHERE `HashCode` = '$HashCode' AND SelectionAnswer = '$Selection'";
		$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $Count =$row["COUNT(SelectionAnswer)"];
} else {
    echo "no results";
}

//將算完的總數包成 Chatfuel JSON 格式
//https://blog.chatfuel.com/help/facebook-messenger/plugins/json-plugin/

/*{
 "messages": [
   {"text": "Welcome to our store!"},
   {"text": "How can I help you?"}
 ]
}*/
echo  sendText($Selection,$Count);

function sendText($selection,$text) {
    $objs[] -> text = "選項".$selection."有".$text."個";
    //再包Messages
    $json -> messages = $objs;
    //編碼JSON
    return json_encode($json);
  }

?>