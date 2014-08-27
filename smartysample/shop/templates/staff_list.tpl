{extends file='base.tpl'}

{block name=title}
スタッフ一覧
{/block}

{block name=body}
{if $islogin == true}
	スタッフ一覧<br/><br/>
	<form method = "post" action = "staff_branch.php">
	{for $i = 1 to $max}
		{if $i == 1}
			<input type = "radio" name = "staffcode" value = "{$code[$i-1]}" checked>
		{else if}
			<input type = "radio" name = "staffcode" value = "{$code[$i-1]}">
		{/if}
		{$name[$i-1]}<br/>
	{/for}
	<input type="submit" name="disp" value="参照">
	<input type="submit" name="add" value="追加">
	<input type="submit" name="edit" value="修正">
	<input type="submit" name="delete" value="削除">
	</form>
	<br/>
	<a href = "../staff_login/staff_top.php">トップメニューへ</a><br/>
{/if}

{/block}
