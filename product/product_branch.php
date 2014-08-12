<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	echo "ログインされていません。<br/>";
	echo "<a href = \"../staff_login/staff_login.html\">ログイン画面へ</a>";
	exit();
}

if(isset($_POST['disp']) == true)
{
	if(isset($_POST['productcode']) == false)
	{
		header('Location:product_ng.php');
	}
	$product_code = $_POST['productcode'];
	header('Location:product_disp.php?productcode='.$product_code);
}

if(isset($_POST['add']) == true)
{
	header('Location:product_add.php');
}

if(isset($_POST['edit']) == true)
{
	if(isset($_POST['productcode']) == false)
	{
		header('Location:product_ng.php');
	}
	$product_code = $_POST['productcode'];
	header('Location:product_edit.php?productcode='.$product_code);
}

if(isset($_POST['delete']) == true)
{
	if(isset($_POST['productcode']) == false)
	{
		header('Location:product_ng.php');
	}
	$product_code = $_POST['productcode'];
	header('Location:product_delete.php?productcode='.$product_code);
}

?>