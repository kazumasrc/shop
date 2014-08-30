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

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT * FROM mst_product WHERE code = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$product_name = $rec['name'];
	$product_price = $rec['price'];
	$product_gazou_name = $rec['picture'];
	$dbh = null;

	if($product_gazou_name == '')
	{
		$disp_gazou = '';
	}
	else
	{
		$disp_gazou = '<img src = "../product/gazou/' .htmlspecialchars($product_gazou_name). '">';
	}

	$smarty->assign('product_code',htmlspecialchars($product_code));
	$smarty->assign('product_name',htmlspecialchars($product_name));
	$smarty->assign('product_price',htmlspecialchars($product_price));
	$smarty->assign('disp_gazou',$disp_gazou);
	$smarty->display('shop_product.tpl');

}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>