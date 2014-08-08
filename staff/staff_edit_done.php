<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	print 'ログインされていません。<br/>';
	print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br/>';
	print '<br/>';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset=UTF-8">
<title>スタッフ管理画面</title>
</head>
<body>

<?php
try
{
	require_once '../common/config.php';
	require_once '../common/common.php';

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$post = sanitize($_POST);
	$staff_code=$post['staff_code'];
	$staff_name=$post['staff_name'];
	$staff_pass=$post['staff_pass'];

	$sql = 'UPDATE mst_staff SET name=?, password=? WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_name;
	$data[] = $staff_pass;
	$data[] = $staff_code;
	$stmt->execute($data);

	$dbh = null;
	print '修正しました。<br/><br/>';

}
catch(Exception $e)
{
	print 'ただいまメンテナンス中です';
	exit();
}

?>

<a href="staff_list.php">戻る</a>

</body>
</html>