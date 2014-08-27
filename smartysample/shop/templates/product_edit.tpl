{extends file='base.tpl'}

{block name=title}
商品修正
{/block}

{block name=body}
{if $islogin == true}
	商品修正<br/>
	<br/>
	商品コード<br/>
	{$product_code}
	<br/>
	<br/>
	<form method = "post" action = "product_edit_check.php" enctype="multipart/form-data">
	<input type = "hidden" name = "code" value = "{$product_code}">
	<input type = "hidden" name = "gazou_name_old" value = "{$product_gazou_name_old}">
	商品名<br/>
	<input type = "text" name = "name" style = "width:200px" value = "{$product_name}"><br/>
	価格<br/>
	<input type = "text" name = "price" style = "width:50px" value = "{$product_price}">円<br/>
	<br/>
	{$disp_gazou}
	<br/>
	画像を選んでください。<br/>
	<input type="file" name="gazou" style="width:400px"><br/>
	<input type = "button" onclick = "history.back()" value = "戻る">
	<input type = "submit" value = "OK">
	</form>
{/if}

{/block}
