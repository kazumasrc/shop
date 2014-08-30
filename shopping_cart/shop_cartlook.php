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
	$max = 0;
	//$cartを追加→削除して空にした場合、isset($_SESSION['cart'])がtrueになってしまうため、countのチェックを追加
	if(isset($_SESSION['cart']) && count($_SESSION['cart']) != 0)
	{
		$cart = $_SESSION['cart'];
		$max = count($cart);
		$quantity = $_SESSION['quantity'];

		$dbh = new PDO($dsn,$user,$password);
		$dbh->query('SET NAMES utf8');

		foreach($cart as $key => $val)
		{
			$sql = 'SELECT * FROM mst_product WHERE code = ?';
			$stmt = $dbh->prepare($sql);
			$data[0] = $val;
			$stmt->execute($data);

			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$product_name[] = $rec['name'];
			$product_price[] = $rec['price'];
			if($rec['picture'] == '')
			{
				$product_picture[] = '';
			}
			else
			{
				$product_picture[] = '<img src = "../product/gazou/' .htmlspecialchars($rec['picture']). '">';
			}
		}
		$dbh = null;

		$smarty->assign('product_code',$cart);
		$smarty->assign('product_name',$product_name);
		$smarty->assign('product_price',$product_price);
		$smarty->assign('product_picture',$product_picture);
		$smarty->assign('quantity',$quantity);
	}
	
	$smarty->assign('max',$max);
	$smarty->display('shop_cartlook.tpl');

}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>