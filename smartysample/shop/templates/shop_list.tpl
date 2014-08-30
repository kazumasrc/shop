{extends file='base_shop.tpl'}

{block name=title}
商品一覧
{/block}

{block name=body}

商品一覧<br/><br/>

{for $i = 0 to $max - 1}
	<a href="shop_product.php?productcode={$code[$i]}">
	{$name[$i]}---{$price[$i]}円</a>
	<br/>
{/for}
<br/>
<a href="shop_cartlook.php">カートの中身を見る</a><br/>

{/block}
