{extends file='base.tpl'}

{block name=title}
管理画面トップ
{/block}

{block name=body}
{if $islogin == true}
	<h1>ショップ管理トップメニュー</h1>
	<br/>
	<div style = "background-color:#88FFFF; width:200px; border-color:#000000;border-width:1px; border-style:solid; text-align:center; padding:10px;">
	<a href = "../staff/staff_list.php">スタッフ管理</a><br/>
	<br/>
	<a href = "../product/product_list.php">商品管理</a><br/>
	<br/>
	<a href = "../staff_login/staff_logout.php">ログアウト</a><br/>
	<br/>
	<a href = "../order/order_download.php">注文ダウンロード</a><br/>
	<br/>
	</div>
{/if}

{/block}
