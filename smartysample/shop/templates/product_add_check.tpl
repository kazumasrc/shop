{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Smarty</title>
</head>
<body>

{if $error_name == true}
	商品名が入力されていません<br/>
{/if}

{if $error_name == false}
	商品名：{$product_name}<br/>
{/if}


{if $error_price == true}
	価格は半角数字で入力してください！<br/>
{/if}

{if $error_price == false}
	価格：{$product_price}円<br/>
{/if}

{if $error_gazou_size_max == false}
	{if $error_gazou_size_max == true}
		画像が大きすぎます
	{/if}

	{if $error_gazou_size_max == true}
		<img src = "./gazou/{$product_gazou_name}">
		<br/>
	{/if}
{/if}


{if $error == true}
	<form>
	<input type="button" onclick="history.back()" value="戻る">
	</form>
{/if}

{if $error == false}
	上記の商品を登録します。<br/>
	<form method="post" action="product_add_done.php">
	<input name="name" type="hidden" value="{$product_name}">
	<input name="price" type="hidden" value="{$product_price}">
	<input name="gazou_name" type="hidden" value="{$product_gazou_name}">

	<br/>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="OK">
	</form>
{/if}

</body>
</html>
