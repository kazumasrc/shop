{extends file='base_shop.tpl'}

{block name=title}
商品カート参照
{/block}

{block name=body}

{if $errorcode == 1}
	数量の入力に誤りがあります。<br/>
{else if $errorcode == 2}
	数量は１～９９の範囲で入力してください。<br/>
{/if}

<br/>
<a href="shop_cartlook.php">カートに戻る</a>

{/block}
