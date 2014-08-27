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
	$smarty->display('staff_delete_done.tpl');
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

	$staff_code=$_POST['code'];
	
	$sql = 'DELETE FROM mst_staff WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_code;
	$stmt->execute($data);

	$dbh = null;

	$smarty->display('staff_delete_done.tpl');

}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>