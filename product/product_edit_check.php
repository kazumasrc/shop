<?php
session_start();
session_regenerate_id(true);
require_once '../common/config.php';
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

if(isset($_SESSION['login']) == false)
{
	$islogin = false;

	$smarty->assign('islogin',$islogin);
	$smarty->display('product_edit_check.tpl');
	exit();
}
else
{
	$islogin = true;
	$smarty->assign('session_staff_name',$_SESSION['staff_name']);
	$smarty->assign('islogin',$islogin);
}

$product_code = $_POST['code'];
$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_gazou_name_old = $_POST['gazou_name_old'];
$product_gazou = $_FILES['gazou'];

$error = false;
$error_name = false;
if($product_name=='')
{
	$error = true;
	$error_name = true;
}


$error_price = false;
if(preg_match('/^[0-9]+$/', $product_price) == 0)
{
	$error = true;
	$error_price = true;
}

$error_gazou_size_min = false;
$error_gazou_size_max = false;

if($product_gazou['size'] > 0)
{
	if($product_gazou['size'] > 1000000)
	{
		$error = true;
		$error_gazou_size_max = true;
	}
	//ファイル名が半角かのチェック入れたい
	else
	{
		$pic_extension = pathinfo($product_gazou['name'])['extension'];
		$pic_name = uniqid('', true).".".$pic_extension;
		echo $pic_name;
		move_uploaded_file($product_gazou['tmp_name'], './gazou/' .$pic_name);
	}
}
else
{
	$error_gazou_size_min = true;
}


$smarty->assign('product_name',htmlspecialchars($product_name));
$smarty->assign('product_price',htmlspecialchars($product_price));
$smarty->assign('product_gazou_name',htmlspecialchars($pic_name));
$smarty->assign('product_code',htmlspecialchars($product_code));
$smarty->assign('product_gazou_name_old',$product_gazou_name_old);

$smarty->assign('error',$error);
$smarty->assign('error_name',$error_name);
$smarty->assign('error_price',$error_price);
$smarty->assign('error_gazou_size_min',$error_gazou_size_min);
$smarty->assign('error_gazou_size_max',$error_gazou_size_max);


$smarty->display('product_edit_check.tpl');

?>