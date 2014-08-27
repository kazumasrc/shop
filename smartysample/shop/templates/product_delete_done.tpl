{extends file='base.tpl'}

{block name=title}
商品削除完了
{/block}

{block name=body}
{if $islogin == true}
	削除しました。<br/><br/>
	<a href="product_list.php">戻る</a>
{/if}

{/block}
