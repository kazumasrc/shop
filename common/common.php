<?php
function sanitize($before)
{
	foreach($before as $key=>$value)
	{
		$after[$key] = htmlspecialchars($value);
	}
	return $after;
}
function smarty_initialize()
{
	require_once('Smarty.class.php');

	$smarty = new Smarty();
	//$smarty->autoload_filters = array('pre' => array('pre'),'post' => array('post'));

	$smarty->template_dir = 'C:/smartysample/shop/templates/';
	$smarty->compile_dir  = 'C:/smartysample/shop/templates_c/';
	$smarty->config_dir   = 'C:/smartysample/shop/configs/';
	$smarty->cache_dir    = 'C:/smartysample/shop/cache/';

	return $smarty;
}
?>
