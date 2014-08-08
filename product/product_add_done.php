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

	$product_name = $post['name'];
	$product_price = $post['price'];
	$product_gazou_name = $post['gazou_name'];


	$sql = 'INSERT INTO mst_product(name,price,gazou) VALUES(?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_name;
	$data[] = $product_price;
	$data[] = $product_gazou_name;
	$stmt->execute($data);

	$dbh = null;

	print $product_name;
	print 'を追加しました。<br/>';

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