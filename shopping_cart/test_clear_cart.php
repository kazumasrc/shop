<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(), '', time()-42000, '/');
}
@session_destroy();

require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

$smarty->display('test_clear_cart.tpl');
?>