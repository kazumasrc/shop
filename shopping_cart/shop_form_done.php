<?php
session_start();
session_regenerate_id(true);
require_once '../common/config.php';
require_once '../common/common.php';
require_once('Smarty.class.php');

$smarty = smarty_initialize();

if(isset($_SESSION['member_login']) == false)
{
	$islogin = false;

	$smarty->assign('islogin',$islogin);
}
else
{
	$islogin = true;
	$smarty->assign('session_member_name',$_SESSION['member_name']);
	$smarty->assign('islogin',$islogin);
}



$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_postal1= $_POST['customer_postal1'];
$customer_postal2= $_POST['customer_postal2'];
$customer_address= $_POST['customer_address'];
$customer_tel = $_POST['customer_tel'];

$mailtext = "";
$mailtext .= htmlspecialchars($customer_name)."様\n";
$mailtext .= "\n";
$mailtext .= "このたびはご注文ありがとうございました。\n";
$mailtext .= "\n";
$mailtext .= "ご注文商品\n";
$mailtext .= "--------------------\n";

$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$cart = $_SESSION['cart'];
$max = count($cart);
$quantity = $_SESSION['quantity'];
for($i = 0; $i < $max; $i++)
{
	$sql = 'SELECT name, price FROM mst_product WHERE code = ?';
	$stmt = $dbh->prepare($sql);
	$data[0] = $cart[$i];
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$product_name = $rec['name'];
	$product_price = $rec['price'];
	//DB登録用に格納
	$sale_price[] = $product_price;
	$product_quantity = $quantity[$i];
	
	$mailtext .= $product_name." ";
	$mailtext .= $product_price."円 × ";
	$mailtext .= $product_quantity."個 ＝ ";
	$mailtext .= $product_price * $product_quantity."円";
	$mailtext .= "\n";
}
//$dbh = null;

$mailtext .= "送料は無料です。\n";
$mailtext .= "--------------------\n";
$mailtext .= "\n";
$mailtext .= "代金は以下の口座にお振込みください。\n";
$mailtext .= "○○銀行　△△支店　普通口座*******\n";
$mailtext .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
$mailtext .= "\n";
$mailtext .= "□□□□□□□□□□□□□□□□\n";
$mailtext .= "署名文入ります。\n";
$mailtext .= "署名文入ります。\n";
$mailtext .= "署名文入ります。\n";
$mailtext .= "署名文入ります。\n";
$mailtext .= "□□□□□□□□□□□□□□□□\n";
$mailtext .= "";
$mailtext .= "";

//デバッグ用表示テスト
//echo nl2br($mailtext);

//↓メール送信（toお客様）
//件名
$mail_sub = "ご注文ありがとうございます。";
//本文
$mail_body = html_entity_decode($mailtext,ENT_QUOTES,"UTF-8");
//送信元
$mail_head = 'From:hogehoge@hoge.com';
mb_language('Japanese');
mb_internal_encoding("UTF-8");
mb_send_mail($customer_email,$mail_sub,$mail_body,$mail_head);
//↑メール送信（toお客様）

//↓メール送信（to管理）
//件名
$mail_sub = "お客様からご注文がありました。";
//本文
$mail_body = html_entity_decode($mailtext,ENT_QUOTES,"UTF-8");
//送信元
$mail_head = 'From:'.$customer_email;
mb_language('Japanese');
mb_internal_encoding("UTF-8");
mb_send_mail('hogehoge@hoge.com',$mail_sub,$mail_body,$mail_head);
//↑メール送信（to管理）

//テーブルにロックをかける
$sql = 'LOCK TABLES sale, sale_detail WRITE';
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$sql = 'INSERT INTO sale(code_customer,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
$stmt = $dbh->prepare($sql);
$data = array();
$data[] = 0;
$data[] = $customer_name;
$data[] = $customer_email;
$data[] = $customer_postal1;
$data[] = $customer_postal2;
$data[] = $customer_address;
$data[] = $customer_tel;
$stmt->execute($data);


$sql = 'SELECT LAST_INSERT_ID()';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$lastcode = $rec['LAST_INSERT_ID()'];

for($i = 0; $i < $max; $i++)
{
	$sql = 'INSERT INTO sale_detail(code_sale,code_product,price,quantity) VALUES(?,?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data = array();
	$data[] = $lastcode;
	$data[] = $cart[$i];
	$data[] = $sale_price[$i];
	$data[] = $quantity[$i];
	$stmt->execute($data);
}

//テーブルのロックを解除する
$sql = 'UNLOCK TABLES';
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$dbh = null;

$smarty->assign('customer_name',htmlspecialchars($customer_name));
$smarty->assign('customer_email',htmlspecialchars($customer_email));
$smarty->assign('customer_postal1',htmlspecialchars($customer_postal1));
$smarty->assign('customer_postal2',htmlspecialchars($customer_postal2));
$smarty->assign('customer_address',htmlspecialchars($customer_address));
$smarty->assign('customer_tel',htmlspecialchars($customer_tel));

$smarty->display('shop_form_done.tpl');

?>