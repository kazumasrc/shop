<?php
session_start();
session_regenerate_id(true);
require_once '../common/config.php';
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

if(isset($_SESSION['login']) == false)
{
	$islogin = false;

	$smarty->assign('islogin',$islogin);
	$smarty->display('staff_list.tpl');
	exit();
}
else
{
	$islogin = true;
	$smarty->assign('session_staff_name',$_SESSION['staff_name']);
	$smarty->assign('islogin',$islogin);
}

try
{
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$year = $_POST['year'];
	$month = str_pad($_POST['month'], 2, "0", STR_PAD_LEFT);
	$day = str_pad($_POST['day'], 2, "0", STR_PAD_LEFT);
	$sql = '
	SELECT 
		sale.code,
		sale.date,
		sale.code_customer,
		sale.name AS sale_name,
		sale.email,
		sale.postal1,
		sale.postal2,
		sale.address,
		sale.tel,
		sale_detail.code_product,
		mst_product.name AS mst_product_name,
		sale_detail.price,
		sale_detail.quantity
	FROM 
		sale, sale_detail, mst_product
	WHERE 
		sale.code = sale_detail.code_sale 
		AND sale_detail.code_product = mst_product.code
		AND substr(sale.date,1,4) = ?
		AND substr(sale.date,6,2) = ?
		AND substr(sale.date,9,2) = ?
	';
	$stmt = $dbh->prepare($sql);
	$data = array();
	$data[] = $year;
	$data[] = str_pad($month, 2, "0", STR_PAD_LEFT);
	$data[] = $day;
	$stmt->execute($data);

	$dbh = null;

	$csvtext = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
	$csvtext .= "\n";

	while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$csvtext .= $rec['code'];
		$csvtext .= ',';
		$csvtext .= $rec['date'];
		$csvtext .= ',';
		$csvtext .= $rec['code_customer'];
		$csvtext .= ',';
		$csvtext .= $rec['sale_name'];
		$csvtext .= ',';
		$csvtext .= $rec['email'];
		$csvtext .= ',';
		$csvtext .= $rec['postal1'].'-'.$rec['postal2'];
		$csvtext .= ',';
		$csvtext .= $rec['address'];
		$csvtext .= ',';
		$csvtext .= $rec['tel'];
		$csvtext .= ',';
		$csvtext .= $rec['code_product'];
		$csvtext .= ',';
		$csvtext .= $rec['mst_product_name'];
		$csvtext .= ',';
		$csvtext .= $rec['price'];
		$csvtext .= ',';
		$csvtext .= $rec['quantity'];
		$csvtext .= "\n";
	}

	//echo nl2br($csvtext);

	//
	$filename = './list/'.$year.$month.$day.'.csv';
	$file = fopen($filename, 'w');
	$csvtext = mb_convert_encoding($csvtext, 'SJIS', 'UTF-8');
	fputs($file, $csvtext);
	fclose($file);

	//$smarty->assign('max',$max);
	$smarty->display('order_download_done.tpl');
}
catch(Exception $e)
{
	$smarty->display('maintenance.tpl');
	exit();
}

?>