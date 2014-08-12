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
<title>商品管理</title>
</head>
<body>

商品追加追加<br/>
<br/>
<form method="post" action="product_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br/>
<input type="text" name="name" style="width:200px"><br/>
価格を入力してください。<br/>
<input type="text" name="price" style="width:50px">円<br/>
画像を選んでください。<br/>
<input type="file" name="gazou" style="width:400px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>