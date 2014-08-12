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

ショップ管理トップメニュー<br/>
<br/>
<a href = "../staff/staff_list.php">スタッフ管理</a><br/>
<br/>
<a href = "../product/product_list.php">商品管理</a><br/>
<br/>
<a href = "../staff_login/staff_logout.php">ログアウト</a><br/>

</body>
</html>