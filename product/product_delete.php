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

	$product_code = $_GET['productcode'];

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT * FROM mst_product WHERE code = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $product_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$product_name = $rec['name'];
	$product_price = $rec['price'];
	$product_gazou_name = $rec['gazou'];
	$dbh = null;

	if($product_gazou_name == '')
	{
		$disp_gazou = '';
	}
	else
	{
		$disp_gazou = '<img src = "./gazou/' .$product_gazou_name. '">';
	}


}
catch(Exception $e)
{
	echo 'ただいまメンテナンス中です';
	exit();
}

?>

商品削除<br/>
<br/>
商品コード<br/>
<?php echo $product_code;?>
<br/>
<br/>
商品名<br/>
<?php echo $product_name;?><br/>
<?php echo $disp_gazou;?><br/>
この商品を削除してよろしいですか？<br/>
<br/>
<form method = "post" action = "product_delete_done.php">
<input type = "hidden" name = "code" value = "<?php echo $product_code;?>">
<input type = "hidden" name = "gazou_name" value = "<?php echo $product_gazou_name;?>">
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>