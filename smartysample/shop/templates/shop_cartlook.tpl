{extends file='base_shop.tpl'}

{block name=title}
商品カート参照
{/block}

{block name=body}

{if $max != 0}
カートの中身<br/>
<table border = "1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>
{/if}

<form method = "post" action = "shop_quantity_change.php">

{for $i = 0 to $max - 1}
	<tr>
	<td>{$product_name[$i]}</td>
	<td>{$product_picture[$i]}</td>
	<td>{$product_price[$i]}円</td>
	<td><input type = "text" name = "num{$i}" value = "{$quantity[$i]}" style = "width:25px"></td>
	<td>{$product_price[$i] * $quantity[$i]}円</td>
	<td><input type = "checkbox" name = "delete{$i}"></td>
	<br/>
	</tr>
{/for}
</table>

{if $max == 0}
	カートに商品が入っていません。<br/>
{else}
	<input type = "hidden" name = "max" value = "{$max}">
	<input type = "submit" value = "数量変更"><br/>
{/if}


</form>
<br/>
<a href="shop_list.php">商品一覧に戻る</a><br/>
<br/>

{if $max != 0}
	<a href="shop_form.php">ご購入手続きへ進む</a><br>
{/if}
{/block}
