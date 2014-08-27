{extends file='base.tpl'}

{block name=title}
スタッフ修正完了
{/block}

{block name=body}
{if $islogin == true}
	修正しました。<br/>

	<a href="staff_list.php">戻る</a><br/>
{/if}

{/block}
