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
require_once '../common/config.php';
require_once '../common/common.php';

$staff_code = $_POST['code'];
$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];
$staff_pass2 = $_POST['pass2'];

if($staff_name=='')
{
	echo "スタッフ名が入力されていません<br/>";
}
else
{
	echo "スタッフ名：";
	echo $staff_name;
	echo "<br/>";
}

if($staff_pass=='')
{
	echo "パスワードが入力されていません<br/>";
}

if($staff_pass2!=$staff_pass)
{
	echo "パスワードが一致しません<br/>";
}


if($staff_name==''||$staff_pass==''||$staff_pass2=='')
{
	echo "<form>";
	echo "<input type=\"button\" onclick=\"history.back()\" value=\"戻る\">";
	echo "</form>";
}
else
{
	$staff_pass = md5($staff_pass);
	echo "<form method=\"post\" action=\"staff_edit_done.php\">";
	echo "<input name=\"staff_code\" type=\"hidden\" value=\"$staff_code\">";
	echo "<input name=\"staff_name\" type=\"hidden\" value=\"$staff_name\">";
	echo "<input name=\"staff_pass\" type=\"hidden\" value=\"$staff_pass\">";
	echo "<br/>";
	echo "<input type=\"button\" onclick=\"history.back()\" value=\"戻る\">";
	echo "<input type=\"submit\" value=\"OK\">";
	echo "</form>";
}
?>

</body>
</html>