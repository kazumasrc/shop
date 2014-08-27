{extends file='base.tpl'}

{block name=title}
商品参照
{/block}

{block name=body}
{if $islogin == true}
	商品情報参照<br/>
	<br/>
	商品コード<br/>
	{$product_code}
	<br/>
	<br/>
	商品名<br/>
	{$product_name}<br/>
	<br/>
	価格<br/>
	{$product_price}円<br/>
	{$disp_gazou}<br/>
	<br/>
	<form>
	<input type = "button" onclick = "history.back()" value = "戻る">
	</form>
{/if}

{/block}
