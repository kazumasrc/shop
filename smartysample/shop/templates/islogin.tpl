{if $islogin == false}
ログインされていません！<br/>
<a href = "../staff_login/staff_login.html">ログイン画面へ</a>
{/if}

{if $islogin == true}
{$session_staff_name}さんログイン中<br/>
<br/>
{/if}
