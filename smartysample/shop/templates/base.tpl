{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>shop - {block name=title}{/block}</title>
</head>
<body>
	{if $islogin == false}
	ログインされていません！<br/>
	<a href = "../staff_login/staff_login.html">ログイン画面へ</a>
	{/if}

	{if $islogin == true}
	<div style = "background-color:#EEEEEE; margin:-10; padding:10px;">{$session_staff_name}さんログイン中
	<a style = "text-align:right;" href = "../staff_login/staff_logout.php">ログアウト</a>
	</div>
	<br/>
	{/if}

	{block name=body}{/block}
</body>
</html>
