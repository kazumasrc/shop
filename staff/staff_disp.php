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

	$staff_code = $_GET['staffcode'];

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT * FROM mst_staff WHERE code = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$staff_name = $rec['name'];
	$staff_pass = $rec['password'];
	$dbh = null;

}
catch(Exception $e)
{
	print 'ただいまメンテナンス中です';
	exit();
}

?>

スタッフ情報参照<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code;?>
<br/>
<br/>
スタッフ名<br/>
<?php print $staff_name;?><br/>
<br/>
<form>
<input type = "button" onclick = "history.back()" value = "戻る">
</form>

</body>
</html>