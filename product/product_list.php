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
	$smarty->display('product_list.tpl');
	exit();
}
else
{
	$islogin = true;
	$smarty->assign('session_staff_name',$_SESSION['staff_name']);
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
		$code[$max] = $rec['code'];
		$name[$max] = $rec['name'];
		$price[$max] = $rec['price'];
		$max += 1;
	}

	/*
	$smarty->assign('code',htmlspecialchars($code));
	$smarty->assign('name',htmlspecialchars($name));
	$smarty->assign('price',htmlspecialchars($price));
	*/
	$smarty->assign('code',$code);
	$smarty->assign('name',$name);
	$smarty->assign('price',$price);
	$smarty->assign('max',$max);
	$smarty->display('product_list.tpl');
}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>