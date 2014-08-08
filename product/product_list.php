<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	print 'ログインされていません。<br/>';
	print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br/>';
	print '<br/>';
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
	
	print '商品一覧<br/><br/>';

	print '<form method = "post" action = "product_branch.php">';
	while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		print '<input type = "radio" name = "productcode" value = "' .$rec['code']. '">';
		print $rec['name'].'---';
		print $rec['price'].'円';
		print '<br/>';
	}
	print '<input type="submit" name="disp" value="参照">';
	print '<input type="submit" name="add" value="追加">';
	print '<input type="submit" name="edit" value="修正">';
	print '<input type="submit" name="delete" value="削除">';
	print '</form>';
	print '<br/>';
	print '<a href = "../staff_login/staff_top.php">トップメニューへ</a><br/>';

}
catch(Exception $e)
{
	print 'ただいまメンテナンス中です';
	exit();
}

?>


</body>
</html>