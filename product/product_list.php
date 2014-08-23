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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset=UTF-8">
<title>商品管理</title>
</head>
<body>

<?php
try
{
	require_once '../common/config.php';
	require_once '../common/common.php';

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT code, name, price FROM mst_product WHERE 1';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;
	
	echo "商品一覧<br/><br/>";

	echo "<form method = \"post\" action = \"product_branch.php\">";
	while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<input type = \"radio\" name = \"productcode\" value = \"";
		echo htmlspecialchars($rec['code'])."\">";
		echo htmlspecialchars($rec['name'])."---";
		echo htmlspecialchars($rec['price'])."円";
		echo "<br/>";
	}
	echo "<input type=\"submit\" name=\"disp\" value=\"参照\">";
	echo "<input type=\"submit\" name=\"add\" value=\"追加\">";
	echo "<input type=\"submit\" name=\"edit\" value=\"修正\">";
	echo "<input type=\"submit\" name=\"delete\" value=\"削除\">";
	echo "</form>";
	echo "<br/>";
	echo "<a href = \"../staff_login/staff_top.php\">トップメニューへ</a><br/>";

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


</body>
</html>