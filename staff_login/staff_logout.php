<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true)
{
	setcookie(session_name(), '', time()-42000, '/');
}
@session_destroy();

require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

$smarty->display('staff_logout.tpl');
?>