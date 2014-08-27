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
	$smarty->display('staff_disp.tpl');
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
	$staff_code = $_GET['staffcode'];

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT * FROM mst_staff WHERE code = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $staff_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$staff_name = $rec['name'];
	$staff_pass = $rec['password'];
	$dbh = null;

	$smarty->assign('staff_code',htmlspecialchars($staff_code));
	$smarty->assign('staff_name',htmlspecialchars($staff_name));
	$smarty->display('staff_disp.tpl');

}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>