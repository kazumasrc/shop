{extends file='base.tpl'}

{block name=title}
管理画面注文ダウンロード完了
{/block}

{block name=body}
{if $islogin == true}
	ダウンロードしました。<br/>
	<form>
	<input type = "button" onclick = "history.back()" value = "戻る">
	</form>
{/if}

{/block}
