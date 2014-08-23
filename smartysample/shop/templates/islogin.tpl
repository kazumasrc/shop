{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Smarty</title>
</head>
<body>

{if $islogin == false}
ログインされていません！<br/>
<a href = "../staff_login/staff_login.html">ログイン画面へ</a>
{/if}

{if $islogin == true}
{$session_staff_name}さんログイン中<br/>
<br/>

{/if}

</body>
</html>
