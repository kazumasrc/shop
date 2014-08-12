<?php

try
{
	require_once '../common/config.php';
	require_once '../common/common.php';

	$staff_code = $_POST['code'];
	$staff_pass = $_POST['pass'];

	$staff_pass = md5($staff_pass);

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT name FROM mst_staff WHERE code = ? AND password = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_code;
	$data[] = $staff_pass;
	$stmt->execute($data);

	$dbh = null;

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rec == false)
	{
		echo "スタッフコードかパスワードが間違っています。<br/>";
		print "<a href = \"staff_login.html\">戻る</a>";
	}
	else
	{
		session_start();
		$_SESSION['login'] = 1;
		$_SESSION['staff_code'] = $staff_code;
		$_SESSION['staff_name'] = $rec['name'];
		header('Location: staff_top.php');
	}

}
catch(Exception $e)
{
	echo "ただいまメンテナンス中です";
	exit();
}


?>
