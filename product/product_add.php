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

<?php
require_once '../common/config.php';
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

$smarty->display('product_add.tpl');
?>

</body>
</html>