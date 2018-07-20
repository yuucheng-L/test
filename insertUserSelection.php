<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);


//取得使用者id和回答
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

//將每一題的答案插入到資料表中
$sql= "INSERT INTO `digitalent_chatbot`(`HashCode`,`FB_ID`,`SelectionAnswer`) VALUES ('$HashCode','$FB_ID','$Selection')";
$conn->query($sql);
$conn->close();

echo "Success";
?>