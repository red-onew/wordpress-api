<?php
header("Content-Type: text/xml");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

require_once "Smarty.class.php";

include "mysql.php";

$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->force_compile = 1;

$link = mysql_connect($dbhost , $dbuname , $dbpass);
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

mysql_set_charset('utf8');

$result = mysql_query('SELECT id,post_title FROM wp_posts where post_status="publish" and post_type="post" order by post_date desc');
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}
while( $row = mysql_fetch_assoc($result )) {
	$smarty->append( 'row', $row );
}

$close_flag = mysql_close($link);
$smarty->display('xml.tpl');

