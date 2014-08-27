{extends file='base.tpl'}

{block name=title}
スタッフ削除完了
{/block}

{block name=body}
{if $islogin == true}
	削除しました。<br/><br/>
	<a href="staff_list.php">戻る</a>
{/if}

{/block}
