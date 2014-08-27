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
	$smarty->display('staff_edit_done.tpl');
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

	$staff_code=$_POST['staff_code'];
	$staff_name=$_POST['staff_name'];
	$staff_pass=$_POST['staff_pass'];

	$sql = 'UPDATE mst_staff SET name=?, password=? WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_name;
	$data[] = $staff_pass;
	$data[] = $staff_code;
	$stmt->execute($data);

	$dbh = null;

	$smarty->display('staff_edit_done.tpl');
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