{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Smarty</title>
</head>
<body>

スタッフ修正<br/>
<br/>
スタッフコード<br/>
{$staff_code}
<br/>
<br/>
<form method = "post" action = "staff_edit_check.php">
<input type = "hidden" name = "code" value = "{$staff_code}">
スタッフ名<br/>
<input type = "text" name = "name" style = "width:200px" value = "{$staff_name}"><br/>
パスワードを入力してください。<br/>
<input type = "password" name = "pass" style = "width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<input type = "password" name = "pass2" style = "width:100px"><br/>
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>
