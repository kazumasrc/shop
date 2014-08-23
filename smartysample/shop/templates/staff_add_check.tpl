{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Smarty</title>
</head>
<body>

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
	<form method="post" action="staff_add_done.php">
	<input name="staff_name" type="hidden" value="{$staff_name}">
	<input name="staff_pass" type="hidden" value="{$staff_pass}">
	<br/>
	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="OK">
	</form>
{/if}

</body>
</html>
