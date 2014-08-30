{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>ショッピングカート - {block name=title}{/block}</title>
</head>
<body>
	{if $islogin == false}
	<div style = "background-color:#EEEEEE; margin:-10; padding:10px;">ようこそゲスト様
	<a href = "../member_login.html">会員ログイン</a>
	</div>
	<br/>
	{/if}

	{if $islogin == true}
	<div style = "background-color:#EEEEEE; margin:-10; padding:10px;">ようこそ{$session_member_name}様
	<a style = "text-align:right;" href = "../member_logout.php">ログアウト</a>
	</div>
	<br/>
	{/if}

	{block name=body}{/block}
</body>
</html>
