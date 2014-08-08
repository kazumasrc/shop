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
require_once '../common/config.php';
require_once '../common/common.php';

$post = sanitize($_POST);

$staff_code = $post['code'];
$staff_name = $post['name'];
$staff_pass = $post['pass'];
$staff_pass2 = $post['pass2'];

if($staff_name=='')
{
	print "スタッフ名が入力されていません<br/>";
}
else
{
	print "スタッフ名：";
	print $staff_name;
	print "<br/>";
}

if($staff_pass=='')
{
	print "パスワードが入力されていません<br/>";
}

if($staff_pass2!=$staff_pass)
{
	print "パスワードが一致しません<br/>";
}


if($staff_name==''||$staff_pass==''||$staff_pass2=='')
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	$staff_pass = md5($staff_pass);
	print '<form method="post" action="staff_edit_done.php">';
	print '<input name="staff_code" type="hidden" value="'.$staff_code.'">';
	print '<input name="staff_name" type="hidden" value="'.$staff_name.'">';
	print '<input name="staff_pass" type="hidden" value="'.$staff_pass.'">';
	print '<br/>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}
?>

</body>
</html>