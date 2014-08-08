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

	$post = sanitize($_POST);

	$product_code=$post['code'];
	$product_gazou_name=$post['gazou_name'];
	
	$sql = 'DELETE FROM mst_product WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_code;
	$stmt->execute($data);

	$dbh = null;
	if($product_gazou_name != '')
	{
		unlink('./gazou/' .$product_gazou_name);
	}

	print '削除しました。<br/><br/>';

}
catch(Exception $e)
{
	print 'ただいまメンテナンス中です';
	exit();
}

?>

<a href="product_list.php">戻る</a>

</body>
</html>