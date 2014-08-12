<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	echo "ログインされていません。<br/>";
	echo "<a href = \"../staff_login/staff_login.html\">ログイン画面へ</a>";
	exit();
}
else
{
	echo $_SESSION['staff_name'];
	echo "さんログイン中<br/>";
	echo "<br/>";
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
	echo "ただいまメンテナンス中です";
	exit();
}

?>

スタッフ削除<br/>
<br/>
スタッフコード<br/>
<?php echo $staff_code;?>
<br/>
<br/>
スタッフ名<br/>
<?php echo $staff_name;?><br/>
このスタッフを削除してよろしいですか？<br/>
<form method = "post" action = "staff_delete_done.php">
<input type = "hidden" name = "code" value = "<?php echo $staff_code;?>">
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>