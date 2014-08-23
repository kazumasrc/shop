<?php
function smarty_initialize()
{
	require_once('Smarty.class.php');

	$smarty = new Smarty();
	$smarty_dir = dirname(dirname(__FILE__)).'/smartysample/shop/';

	$smarty->template_dir = $smarty_dir. 'templates/';
	$smarty->compile_dir  = $smarty_dir. 'templates_c/';
	$smarty->config_dir   = $smarty_dir. 'configs/';
	$smarty->cache_dir    = $smarty_dir. 'cache/';

	return $smarty;
}
?>