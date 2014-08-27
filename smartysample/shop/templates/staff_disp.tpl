{extends file='base.tpl'}

{block name=title}
スタッフ削除
{/block}

{block name=body}
{if $islogin == true}
	スタッフ情報参照<br/>
	<br/>
	スタッフコード<br/>
	{$staff_code}<br/>
	<br/>
	スタッフ名<br/>
	{$staff_name}<br/>
	<br/>
	<form>
	<input type = "button" onclick = "history.back()" value = "戻る">
	</form>
{/if}

{/block}
