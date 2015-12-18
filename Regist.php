<html>
<head>
<meta http-equiv="CONTENT-TYPE" CONTENT="text/html;CHARSET=UTF-8">
<title>Image</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost', 'w11187','11187','w11187');
if ($mysqli->connect_error) { //接続状況をチェック
    //SQL実行でエラーが出ていた場合
    die('Connect Error: ' . $mysqli->connect_error);
} else {
  //接続に成功した場合
  $mysqli->set_charset("utf8"); //文字コードをutf8に設定
}

$out_file = "./tmp/" . $_FILES['img-file']['name'];
echo $out_file."<br>";
$result = @move_uploaded_file($_FILES["img-file"]["tmp_name"], $out_file);
if ( $result === true ) {
  echo "アップロード成功<br>";
  
	$fd = fopen($out_file,"r");
	$img = bin2hex(fread($fd,filesize($out_file)));
	
	$sql = "insert into image (image) values ( '$img' )";
	
	$result = $mysqli->query($sql);
	if ($result == FALSE) {echo "insert error";die($mysqli-> error);}
	fclose($fd);
  
 }else {
  	echo "アップロード失敗<br>";
 }
 
 $sql = "select id, image from image";
 $result = $mysqli->query($sql);

if ($result ==FALSE) { //実行が成功したかをチェック
  //失敗した場合
  print "SQLを実行する際にエラーが発生しました";
  die($mysqli-> error);
} else {
	print("<table>");
    while ($row = $result->fetch_assoc()) {
	print("<tr><td>");
	$tmp = $row['id'];
	//print("<img src='./gazou.php?par=$tmp'>");
	print("<a href='gazou.php?par=$tmp'>" .$tmp."</a>");
	print("</td></tr>");
}
print("</table>");
    $result->close();
}
$mysqli->close();



?>
</body>
</html>
