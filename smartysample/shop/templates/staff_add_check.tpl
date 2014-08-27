{extends file='base.tpl'}

{block name=title}
スタッフ追加確認
{/block}
{block name=body}

{if $islogin == true}
	{if $error_name == true}
		スタッフ名が入力されていません<br/>
	{/if}

	{if $error_name == false}
		スタッフ名：{$staff_name}<br/>
	{/if}


	{if $error_pass1 == true}
		パスワードが入力されていません<br/>
	{/if}

	{if $error_pass2 == true}
		パスワードが一致しません<br/>
	{/if}


	{if $error == true}
		<form>
		<input type="button" onclick="history.back()" value="戻る">
		</form>
	{/if}

	{if $error == false}
		追加します
		<form method="post" action="staff_add_done.php">
		<input name="staff_name" type="hidden" value="{$staff_name}">
		<input name="staff_pass" type="hidden" value="{$staff_pass}">
		<br/>
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
		</form>
	{/if}
{/if}

{/block}
