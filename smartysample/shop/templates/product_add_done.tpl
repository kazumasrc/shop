{extends file='base.tpl'}

{block name=title}
商品追加完了
{/block}

{block name=body}
{if $islogin == true}
	{$product_name}を追加しました。<br/>
	<a href="product_list.php">戻る</a><br/>
{/if}

{/block}
