<?php
//只回報錯誤移除警告資訊
error_reporting(E_ERROR | E_PARSE);


//取得使用者id和回答
$FB_ID = $_GET['id'];

//取得時間
date_default_timezone_set("Asia/Taipei");
$Time = date("Y-m-d H:i:s");

//產生雜湊碼
$HashCode=hash('md5',$FB_ID.$Time);

//資料庫資訊
$servername = 'localhost';
$username = 'digitalent';
$password = 'digitalent2018';
$dbname = 'digitalent';

//建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

//插入HashCode和FB_ID資料
$sql= "INSERT INTO `digitalent_result`(`HashCode`,`FB_ID`) VALUES ('$HashCode','$FB_ID')";
$result = $conn->query($sql);
$conn->close();

echo("Success");
?>