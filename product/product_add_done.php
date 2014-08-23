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

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$product_name = $_POST['name'];
	$product_price = $_POST['price'];
	$product_gazou_name = $_POST['gazou_name'];


	$sql = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_name;
	$data[] = $product_price;
	$data[] = $product_gazou_name;
	$stmt->execute($data);

	$dbh = null;

	$smarty->assign('product_name',htmlspecialchars($product_name));
	$smarty->display('product_add_done.tpl');

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