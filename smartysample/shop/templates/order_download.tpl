{extends file='base.tpl'}

{block name=title}
管理画面トップ
{/block}

{block name=body}
{if $islogin == true}
	ダウンロードしたい注文日を選んでください。<br/>
	<form method = "post" action = "order_download_done.php">
	<select name = "year">
		<option value = "2012">2012</option>
		<option value = "2013">2013</option>
		<option value = "2014">2014</option>
		<option value = "2015">2015</option>
	</select>
	年
	<select name = "month">
		{for $i = 1 to 12}
			<option value = "{$i}">{$i}</option>
		{/for}
	</select>
	月
	<select name = "day">
		{for $i = 1 to 31}
			<option value = "{$i}">{$i}</option>
		{/for}
	</select>
	日<br/>

	<input type = "submit" value = "ダウンロードへ">
{/if}

{/block}
