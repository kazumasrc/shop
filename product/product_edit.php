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
	$product_gazou_name_old = $rec['gazou'];
	$dbh = null;

	if($product_gazou_name_old == '')
	{
		$disp_gazou = '';
	}
	else
	{
		$disp_gazou = '<img src = "./gazou/' .$product_gazou_name_old. '">';
	}

}
catch(Exception $e)
{
	print 'ただいまメンテナンス中です';
	exit();
}

?>

商品修正<br/>
<br/>
商品コード<br/>
<?php print $product_code;?>
<br/>
<br/>
<form method = "post" action = "product_edit_check.php" enctype="multipart/form-data">
<input type = "hidden" name = "code" value = "<?php print $product_code;?>">
<input type = "hidden" name = "gazou_name_old" value = "<?php print $product_gazou_name_old;?>">
商品名<br/>
<input type = "text" name = "name" style = "width:200px" value = "<?php print $product_name;?>"><br/>
価格<br/>
<input type = "text" name = "price" style = "width:50px" value = "<?php print $product_price;?>">円<br/>
<br/>
<?php print $disp_gazou; ?>
<br/>
画像を選んでください。<br/>
<input type="file" name="gazou" style="width:400px"><br/>
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>