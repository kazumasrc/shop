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
<title>商品管理</title>
</head>
<body>

<?php
require_once '../common/config.php';
require_once '../common/common.php';

$post = sanitize($_POST);

$product_name = $post['name'];
$product_price = $post['price'];
$product_gazou = $_FILES['gazou'];


if($product_name=='')
{
	print "商品名が入力されていません<br/>";
}
else
{
	print "商品名：";
	print $product_name;
	print "<br/>";
}

if(preg_match('/^[0-9]+$/', $product_price) == 0)
{
	print '価格は半角数字で入力してください！<br/>';
}
else
{
	print "価格：";
	print $product_price;
	print "円<br/>";
}

if($product_gazou['size'] > 0)
{
	if($product_gazou['size'] > 1000000)
	{
		print '画像が大きすぎます';
	}
	//ファイル名が半角かのチェック入れる
	else
	{
		move_uploaded_file($product_gazou['tmp_name'], './gazou/' .$product_gazou['name']);
		print '<img src = "./gazou/' .$product_gazou['name'].'">';
		print '<br/>';
	}
}

if($product_name==''||preg_match('/^[0-9]+$/', $product_price) == 0 || $product_gazou['size'] > 1000000)
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の商品を登録します。<br/>';
	print '<form method="post" action="product_add_done.php">';
	print '<input name="name" type="hidden" value="'.$product_name.'">';
	print '<input name="price" type="hidden" value="'.$product_price.'">';
	print '<input name="gazou_name" type="hidden" value="'.$product_gazou['name'].'">';
	print '<br/>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}
?>

</body>
</html>