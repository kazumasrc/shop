<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()]) == true)
{
	setcookie(session_name(), '', time()-42000, '/');
}
@session_destroy();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset=UTF-8">
<title>スタッフ管理画面</title>
</head>
<body>

<?php
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

$smarty->display('staff_logout.tpl');
?>

</body>
</html>