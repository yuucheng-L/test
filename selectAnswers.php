<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);

//資料庫資訊
$servername = 'localhost';
$username = 'digitalent';
$password = 'digitalent2018';
$dbname = 'digitalent';

//建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

//取得題目
$sql="SELECT Answer FROM `digitalent_answer` WHERE Class='food' ORDER BY RAND() limit 1";
    $result = $conn->query($sql);
    
if ($result->num_rows > 0) {
  $answers = array();

  while($answer = mysqli_fetch_assoc($result)) {  
    $answers[] = $answer['Answer'];  
  }

} else {
    echo "no results";
}


//將算完的總數包成 Chatfuel JSON 格式
/*{
 "messages": [
   {"text": "Welcome to our store!"},
   {"text": "How can I help you?"}
 ]
}*/

//先包內層
foreach ($answers as $value) { 
  $objs[] -> text = $value;
}

//再包外層
$json -> messages = $objs;

//編碼JSON
echo json_encode($json);


?>




