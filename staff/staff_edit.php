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

スタッフ修正<br/>
<br/>
スタッフコード<br/>
<?php echo $staff_code;?>
<br/>
<br/>
<form method = "post" action = "staff_edit_check.php">
<input type = "hidden" name = "code" value = "<?php echo $staff_code;?>">
スタッフ名<br/>
<input type = "text" name = "name" style = "width:200px" value = "<?php echo $staff_name;?>"><br/>
パスワードを入力してください。<br/>
<!--<input type = "password" name = "pass" style = "width:100px" value = "<?php echo $staff_pass;?>"><br/>-->
<input type = "password" name = "pass" style = "width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<!--<input type = "password" name = "pass2" style = "width:100px" value = "<?php echo $staff_pass;?>"><br/>-->
<input type = "password" name = "pass2" style = "width:100px"><br/>
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>