{extends file='base_shop.tpl'}

{block name=title}
お客様情報登録完了
{/block}

{block name=body}

{$customer_name}様<br/>
ご注文ありがとうございました。<br/>

{$customer_email}にメールを送信しましたのでご確認ください。<br/>

商品は以下の住所に発送させていただきます。<br/>
〒{$customer_postal1}-{$customer_postal2}<br/>
{$customer_address}<br/>
{$customer_tel}<br/>


<br/>
<a href="shop_list.php">商品一覧に戻る</a><br/>

{/block}
