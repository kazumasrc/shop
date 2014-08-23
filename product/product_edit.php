<?php
session_start();
session_regenerate_id(true);
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

if(isset($_SESSION['login']) == false)
{
	$islogin = false;

	$smarty->assign('islogin',$islogin);
	$smarty->display('islogin.tpl');
	exit();
}
else
{
	$islogin = true;
	$smarty->assign('session_staff_name',$_SESSION['staff_name']);
	$smarty->assign('islogin',$islogin);
	$smarty->display('islogin.tpl');
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
try
{
	require_once '../common/config.php';
	require_once '../common/common.php';
	require_once('Smarty.class.php');

	$smarty = smarty_initialize();

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
	$product_gazou_name_old = $rec['picture'];
	$dbh = null;

	if($product_gazou_name_old == '')
	{
		$disp_gazou = '';
	}
	else
	{
		$disp_gazou = '<img src = "./gazou/' .htmlspecialchars($product_gazou_name_old). '">';
	}
	
	$smarty->assign('product_code',htmlspecialchars($product_code));
	$smarty->assign('product_gazou_name_old',htmlspecialchars($product_gazou_name_old));
	$smarty->assign('product_name',htmlspecialchars($product_name));
	$smarty->assign('product_price',htmlspecialchars($product_price));
	$smarty->assign('disp_gazou',$disp_gazou);
	$smarty->display('product_edit.tpl');

}
catch(Exception $e)
{
	require_once '../common/config.php';
	require_once '../common/common.php';
	require_once('Smarty.class.php');

	$smarty = smarty_initialize();

	$smarty->display('maintenance.tpl');
	exit();
}

?>
</body>
</html>