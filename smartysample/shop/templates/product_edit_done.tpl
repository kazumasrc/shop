{extends file='base.tpl'}

{block name=title}
商品修正完了
{/block}

{block name=body}
{if $islogin == true}
	修正しました。<br/>

	<a href="product_list.php">戻る</a><br/>
{/if}

{/block}
