{extends file='base_shop.tpl'}

{block name=title}
お客様情報入力確認
{/block}

{block name=body}

お名前<br/>
{if $errorname}
	<span style = "color:#FF0000">！入力されていません。！</span><br/>
{else}
	{$customer_name}<br/>
{/if}
<br/>

メールアドレス<br/>
{if $erroremail}
	<span style = "color:#FF0000">！正しく入力されていません。！</span><br/>
{else}
	{$customer_email}<br/>
{/if}
<br/>

郵便番号<br/>
{if $errorpostal}
	<span style = "color:#FF0000">！正しく入力されていません。！</span><br/>
{else}
	{$customer_postal1}-{$customer_postal2}<br/>
{/if}
<br/>

住所<br/>
{if $erroraddress}
	<span style = "color:#FF0000">！入力されていません。！</span><br/>
{else}
	{$customer_address}<br/>
{/if}
<br/>

電話番号<br/>
{if $errortel}
	<span style = "color:#FF0000">！正しく入力されていません。！</span><br/>
{else}
	{$customer_tel}<br/>
{/if}
<br/>


{if $error}
	<input type = "button" onclick = "history.back()" value = "戻る">
{else}
	<form method = "post" action = "shop_form_done.php">
	<input type = "hidden" name = "customer_name" value = "{$customer_name}">
	<input type = "hidden" name = "customer_email" value = "{$customer_email}">
	<input type = "hidden" name = "customer_postal1" value = "{$customer_postal1}">
	<input type = "hidden" name = "customer_postal2" value = "{$customer_postal2}">
	<input type = "hidden" name = "customer_address" value = "{$customer_address}">
	<input type = "hidden" name = "customer_tel" value = "{$customer_tel}">
	<input type = "button" onclick = "history.back()" value = "戻る">
	<input type = "submit" value = "OK"><br/>
	</form>
{/if}

{/block}
