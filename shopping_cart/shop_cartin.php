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

try
{
	$product_code = $_GET['productcode'];

	//すでに商品が入っているかどうかは「入っていない(false)」で初期化
	$ispicked = false;
	if(isset($_SESSION['cart']))
	{
		$cart = $_SESSION['cart'];
		$quantity = $_SESSION['quantity'];
		if(in_array($product_code, $cart))
		{
			$ispicked = true;
			$smarty->assign('ispicked',$ispicked);
			$smarty->display('shop_cartin.tpl');
			exit();
		}
	}
	$cart[] = $product_code;
	$quantity[] = 1;
	$_SESSION['cart'] = $cart;
	$_SESSION['quantity'] = $quantity;

	$smarty->assign('ispicked',$ispicked);
	$smarty->display('shop_cartin.tpl');
}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>