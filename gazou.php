<?php

$par = $_GET["par"];
echo $par;

$mysqli = new mysqli('localhost', 'w11187','11187','w11187');

if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
} else {
	$mysqli->set_charset("utf8");
}

$sql = "select image from image where id='$par'";
$result = $mysqli->query($sql);

if ($result ==FALSE) {
  print "SQLを実行する際にエラーが発生しました";
  die($mysqli-> error);
} else {
	$img = file_get_contents('./img.jpg');
	//mysql_result($result, 0)
	header("Content-type: image/jpeg");
	echo $img;
	
	$result->close();
}
$mysqli->close();
?>
