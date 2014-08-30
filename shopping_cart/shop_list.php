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
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT code, name, price FROM mst_product WHERE 1';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;

	$max = 0;
	while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$code[$max] = htmlspecialchars($rec['code']);
		$name[$max] = htmlspecialchars($rec['name']);
		$price[$max] = htmlspecialchars($rec['price']);
		$max += 1;
	}
	$smarty->assign('code',$code);
	$smarty->assign('name',$name);
	$smarty->assign('price',$price);
	$smarty->assign('max',$max);
	$smarty->display('shop_list.tpl');
}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>