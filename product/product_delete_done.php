<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	echo "ログインされていません。<br/>";
	echo "<a href = \"../staff_login/staff_login.html\">ログイン画面へ</a>";
	exit();
}
else
{
	echo $_SESSION['staff_name'];
	echo "さんログイン中<br/>";
	echo "<br/>";
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

	$product_code=$_POST['code'];
	$product_gazou_name=$_POST['gazou_name'];
	
	$sql = 'DELETE FROM mst_product WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_code;
	$stmt->execute($data);

	$dbh = null;
	if($product_gazou_name != '')
	{
		unlink('./gazou/' .$product_gazou_name);
	}

	echo "削除しました。<br/><br/>";

}
catch(Exception $e)
{
	echo "ただいまメンテナンス中です";
	exit();
}

?>

<a href="product_list.php">戻る</a>

</body>
</html>