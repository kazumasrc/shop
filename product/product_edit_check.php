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

<?php
require_once '../common/config.php';
require_once '../common/common.php';

$post = sanitize($_POST);

$product_code = $post['code'];
$product_name = $post['name'];
$product_price = $post['price'];
$product_gazou_name_old = $post['gazou_name_old'];
$product_gazou = $_FILES['gazou'];

if($product_name=='')
{
	echo "商品名が入力されていません<br/>";
}
else
{
	echo "商品名：";
	echo $product_name;
	echo "<br/>";
}

if(preg_match('/^[0-9]+$/', $product_price) == 0)
{
	echo "価格は半角数字で入力してください！<br/>";
}
else
{
	echo "価格：";
	echo $product_price;
	echo "円<br/>";
}


if($product_gazou['size'] > 0)
{
	if($product_gazou['size'] > 1000000)
	{
		echo "画像が大きすぎます";
	}
	//ファイル名が半角かのチェック入れる
	else
	{
		move_uploaded_file($product_gazou['tmp_name'], './gazou/' .$product_gazou['name']);
		echo "<img src = \"./gazou/";
		echo $product_gazou['name']."\">";
		echo "<br/>";
	}
}

if($product_name==''||preg_match('/^[0-9]+$/', $product_price) == 0 || $product_gazou['size'] > 1000000)
{
	echo "<form>";
	echo "<input type=\"button\" onclick=\"history.back()\" value=\"戻る\">";
	echo "</form>";
}
else
{
	echo "上記の商品を登録します。<br/>";
	echo "<form method=\"post\" action=\"product_edit_done.php\">";
	echo "<input name=\"code\" type=\"hidden\" value=\"$product_code\">";
	echo "<input name=\"name\" type=\"hidden\" value=\"$product_name\">";
	echo "<input name=\"price\" type=\"hidden\" value=\"$product_price\">";
	echo "<input name=\"gazou_name_old\" type=\"hidden\" value=\"$product_gazou_name_old\">";
	echo "<input name=\"gazou_name\" type=\"hidden\" value=\"";
	echo $product_gazou['name']."\">";
	//画像未選択の際に画像を変更しない処理は未実装
	echo "<br/>";
	echo "<input type=\"button\" onclick=\"history.back()\" value=\"戻る\">";
	echo "<input type=\"submit\" value=\"OK\">";
	echo "</form>";
}
?>

</body>
</html>