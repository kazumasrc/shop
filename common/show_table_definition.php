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

	foreach($table as $key_t => $value_t)
	{
		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');
		$sql = 'SHOW FIELDS FROM '.$value_t;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$dbh = null;
		echo "【table_name】：".$value_t;
		echo "<br/>";

		$i = 0;
		$flg = false;
		while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			/*
			foreach($rec as $key => $value)
			{
				print $key;
				print "\t：";
				print $value;
				print '<br/>';
			}
			print 'next<br/><br/>';
			*/
			print_r($rec);
			echo "<br/>";
		}
		echo "<br/>";
	}

}
catch(Exception $e)
{
	echo "ただいまメンテナンス中です";
	exit();
}

?>

</body>
</html>