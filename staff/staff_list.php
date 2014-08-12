<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false)
{
	echo "ログインされていません。<br/>";
	echo "<a href = \"../staff_login/staff_login.html\">ログイン画面へ</a>";
	exit();
}
else
{
	echo $_SESSION['staff_name'];
	echo "さんログイン中<br/>";
	echo "<br/>";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html; charset=UTF-8">
<title>スタッフ管理画面</title>
</head>
<body>

<?php
try
{
	require_once '../common/config.php';
	require_once '../common/common.php';

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT code, name FROM mst_staff WHERE 1';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;
	
	echo "スタッフ一覧<br/><br/>";

	echo "<form method = \"post\" action = \"staff_branch.php\">";
	while($rec = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<input type = \"radio\" name = \"staffcode\" value = \"";
		echo htmlspecialchars($rec['code']); 
		echo "\">";
		echo htmlspecialchars($rec['name']);
		echo "<br/>";
	}
	echo "<input type=\"submit\" name=\"disp\" value=\"参照\">";
	echo "<input type=\"submit\" name=\"add\" value=\"追加\">";
	echo "<input type=\"submit\" name=\"edit\" value=\"修正\">";
	echo "<input type=\"submit\" name=\"delete\" value=\"削除\">";
	echo "</form>";
	echo "<br/>";
	echo "<a href = \"../staff_login/staff_top.php\">トップメニューへ</a><br/>";

}
catch(Exception $e)
{
	echo "ただいまメンテナンス中です";
	exit();
}

?>


</body>
</html>