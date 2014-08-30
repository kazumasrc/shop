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
	$product_quantity = $quantity[$i];
	
	$mailtext .= $product_name." ";
	$mailtext .= $product_price."円 × ";
	$mailtext .= $product_quantity."個 ＝ ";
	$mailtext .= $product_price * $product_quantity."円";
	$mailtext .= "\n";
}
$dbh = null;

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


$smarty->assign('customer_name',htmlspecialchars($customer_name));
$smarty->assign('customer_email',htmlspecialchars($customer_email));
$smarty->assign('customer_postal1',htmlspecialchars($customer_postal1));
$smarty->assign('customer_postal2',htmlspecialchars($customer_postal2));
$smarty->assign('customer_address',htmlspecialchars($customer_address));
$smarty->assign('customer_tel',htmlspecialchars($customer_tel));

$smarty->display('shop_form_done.tpl');

?>