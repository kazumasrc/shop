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
<title>スタッフ管理画面</title>
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
	print 'ただいまメンテナンス中です';
	exit();
}

?>

商品情報参照<br/>
<br/>
商品コード<br/>
<?php print $product_code;?>
<br/>
<br/>
商品名<br/>
<?php print $product_name;?><br/>
<br/>
価格<br/>
<?php print $product_price;?>円<br/>
<?php print $disp_gazou;?><br/>
<br/>
<form>
<input type = "button" onclick = "history.back()" value = "戻る">
</form>

</body>
</html>