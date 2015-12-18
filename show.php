 <html>
<head>
<meta http-equiv="CONTENT-TYPE" CONTENT="text/html;CHARSET=UTF-8">
<title>Show Image</title>
</head>
<body>
<?php
$mysqli = new mysqli('localhost', 'w11187','11187','w11187');
//$con = mysql_connect('localhost', 'root', 'root');
if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
} else {
  $mysqli->set_charset("utf8");
}

 $sql = "select id, image from image";
 $result = $mysqli->query($sql);
 
if ($result ==FALSE) {
  print "SQLを実行する際にエラーが発生しました";
  die($mysqli-> error);
} else {

	print("<table>");
	while ($row = $result->fetch_assoc()) {
		print("<tr>");
		$tmp = $row['id'];
		print("<td width=40mm align=center><a href='gazou.php?par=$tmp'>" .$tmp."</a></td>");
		print("</tr>");
	}
	print("</table>");
	
	$result->close();
}

$mysqli->close();
?>
</body>
</html>
