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
	$smarty->display('staff_add_check.tpl');
	exit();
}
else
{
	$islogin = true;
	$smarty->assign('session_staff_name',$_SESSION['staff_name']);
	$smarty->assign('islogin',$islogin);
}

$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];
$staff_pass2=$_POST['pass2'];

$error = false;
$error_name = false;
if($staff_name=='')
{
	$error = true;
	$error_name = true;
}

$error_pass1 = false;
if($staff_pass=='')
{
	$error = true;
	$error_pass1 = true;
}

$error_pass2 = false;
if($staff_pass2!=$staff_pass)
{
	$error = true;
	$error_pass2 = true;
}


if($error == false)
{
	$staff_pass=md5($staff_pass);
}

$smarty->assign('staff_name',htmlspecialchars($staff_name));
$smarty->assign('staff_pass',htmlspecialchars($staff_pass));
$smarty->assign('staff_pass2',htmlspecialchars($staff_pass2));

$smarty->assign('error',$error);
$smarty->assign('error_name',$error_name);
$smarty->assign('error_pass1',$error_pass1);
$smarty->assign('error_pass2',$error_pass2);

$smarty->display('staff_add_check.tpl');
?>

</body>
</html>