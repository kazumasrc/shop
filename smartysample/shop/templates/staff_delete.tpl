{* Smarty*}
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Smarty</title>
</head>
<body>

スタッフ削除<br/>
<br/>
スタッフコード<br/>
{$staff_code}
<br/>
<br/>
スタッフ名<br/>
{$staff_name}<br/>
このスタッフを削除してよろしいですか？<br/>
<br/>
<form method = "post" action = "staff_delete_done.php">
<input type = "hidden" name = "code" value = "{$staff_code}">
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK">
</form>

</body>
</html>
