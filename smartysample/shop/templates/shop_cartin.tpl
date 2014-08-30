{extends file='base_shop.tpl'}

{block name=title}
商品参照
{/block}

{block name=body}

<br/>
<br/>
{if $ispicked}
	その商品はすでにカートに入っています。<br/>
{else}
	カートに追加しました。<br/>
{/if}
<br/>
<a href="shop_list.php">商品一覧に戻る</a>


{/block}
