<?php
session_start();
session_regenerate_id(true);
require_once '../common/config.php';
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

if(isset($_SESSION['member_login']) == false)
{
	$islogin = false;

	$smarty->assign('islogin',$islogin);
}
else
{
	$islogin = true;
	$smarty->assign('session_member_name',$_SESSION['member_name']);
	$smarty->assign('islogin',$islogin);
}

$max = $_POST['max'];
//0=正常、1=入力に数字以外を使用、2=数量が範囲外
$errorcode = 0;

for($i = 0; $i < $max; $i++)
{
	if(preg_match('/^[0-9]+$/', $_POST['num' .$i]) == 0)
	{
		$errorcode = 1;
		$smarty->assign('errorcode',$errorcode);
		$smarty->display('shop_quantity_change.tpl');
		exit();
	}
	
	if($_POST['num' .$i] < 1 || $_POST['num' .$i] > 100)
	{
		$errorcode = 2;
		$smarty->assign('errorcode',$errorcode);
		$smarty->display('shop_quantity_change.tpl');
		exit();
	}
	
	$quantity[] = htmlspecialchars($_POST['num' .$i]);
}

$cart = $_SESSION['cart'];
for($i = $max; 0 <= $i; $i--)
{
	if(isset($_POST['delete'.$i]))
	{
		array_splice($cart,$i,1);
		array_splice($quantity,$i,1);
	}
}

$_SESSION['cart'] = $cart;
$_SESSION['quantity'] = $quantity;

header('Location:shop_cartlook.php');
?>