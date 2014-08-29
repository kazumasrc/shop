<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset=UTF-8">
<title>テーブル定義</title>
</head>
<body>

<?php
try
{
	require_once '../common/config.php';
	require_once '../common/common.php';

	//mst_staffテーブル生成
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$sql = "CREATE TABLE IF NOT EXISTS mst_staff(code INT(11) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(15), password VARCHAR(15))";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	
	echo "mst_staff created";
	echo "<br/>";

	//mst_productテーブル生成
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$sql = "CREATE TABLE IF NOT EXISTS mst_product(code INT(11) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), price INT(11), picture VARCHAR(30))";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	
	echo "mst_product created";
	echo "<br/>";

	$dbh = null;

}
catch(Exception $e)
{
	echo "ただいまメンテナンス中です";
	exit();
}

?>

</body>
</html>