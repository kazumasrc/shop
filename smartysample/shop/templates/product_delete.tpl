{extends file='base.tpl'}

{block name=title}
商品削除
{/block}

{block name=body}
{if $islogin == true}
	商品削除<br/>
	<br/>
	商品コード<br/>
	{$product_code}
	<br/>
	<br/>
	商品名<br/>
	{$product_name}<br/>
	{$disp_gazou}<br/>
	この商品を削除してよろしいですか？<br/>
	<br/>
	<form method = "post" action = "product_delete_done.php">
	<input type = "hidden" name = "code" value = "{$product_code}">
	<input type = "hidden" name = "gazou_name" value = "{$product_gazou_name}">
	<input type = "button" onclick = "history.back()" value = "戻る">
	<input type = "submit" value = "OK">
	</form>
{/if}

{/block}
