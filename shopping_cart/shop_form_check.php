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

$customer_name = $_POST['name'];
$customer_email = $_POST['email'];
$customer_postal1= $_POST['postal1'];
$customer_postal2= $_POST['postal2'];
$customer_address= $_POST['address'];
$customer_tel = $_POST['tel'];

$error = false;

//名前が入力されているか
$errorname = false;
if($customer_name == "")
{
	$error = true;
	$errorname = true;
}

//emailが正しく入力されているか
$erroremail = false;
if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $customer_email) == 0)
{
	$error = true;
	$erroremail = true;
}

//郵便番号が半角数字で入力されているか
$errorpostal = false;
if(preg_match('/^[0-9]+$/', $customer_postal1) == 0 || preg_match('/^[0-9]+$/', $customer_postal2) == 0)
{
	$error = true;
	$errorpostal = true;
}

//住所が入力されているか
$erroraddress = false;
if($customer_address == "")
{
	$error = true;
	$erroraddress = true;
}

//電話番号が正しく入力されているか
$errortel = false;
if(preg_match('/^\d{2,4}-?\d{2,4}-?\d{4,5}$/', $customer_tel) == 0)
{
	$error = true;
	$errortel = true;
}

$smarty->assign('customer_name',htmlspecialchars($customer_name));
$smarty->assign('customer_email',htmlspecialchars($customer_email));
$smarty->assign('customer_postal1',htmlspecialchars($customer_postal1));
$smarty->assign('customer_postal2',htmlspecialchars($customer_postal2));
$smarty->assign('customer_address',htmlspecialchars($customer_address));
$smarty->assign('customer_tel',htmlspecialchars($customer_tel));

$smarty->assign('error',$error);
$smarty->assign('errorname',$errorname);
$smarty->assign('erroremail',$erroremail);
$smarty->assign('errorpostal',$errorpostal);
$smarty->assign('erroraddress',$erroraddress);
$smarty->assign('errortel',$errortel);

$smarty->display('shop_form_check.tpl');

?>