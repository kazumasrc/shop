{extends file='base_shop.tpl'}

{block name=title}
お客様情報入力
{/block}

{block name=body}

<form method = "post" action = "shop_form_check.php">
お名前<br/>
<input type = "text" name = "name" style = "width:200px"><br>
メールアドレス<br/>
<input type = "text" name = "email" style = "width:200px"><br>
郵便番号<br/>
<input type = "text" name = "postal1" style = "width:50px">-
<input type = "text" name = "postal2" style = "width:80px"><br>
住所<br/>
<input type = "text" name = "address" style = "width:400px"><br>
電話番号<br/>
<input type = "text" name = "tel" style = "width:150px"><br>
<input type = "button" onclick = "history.back()" value = "戻る">
<input type = "submit" value = "OK"><br/>
</form>

{/block}
