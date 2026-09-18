<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// Robust Environment variable retriever
function get_env_val($key, $default) {
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') return $_ENV[$key];
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') return $_SERVER[$key];
    $val = getenv($key);
    if ($val !== false && $val !== '') return $val;
    return $default;
}

// Fallback to Live Clever Cloud MySQL Database
$db_host = get_env_val('MYSQL_HOST', 'bsxy5i1rcm0shnblmbod-mysql.services.clever-cloud.com');
$db_user = get_env_val('MYSQL_USER', 'ufet9steolrjpkus');
$db_pass = get_env_val('MYSQL_PASSWORD', 'a2fSxd3z6rJDyxiXmw9c');
$db_name = get_env_val('MYSQL_DATABASE', 'bsxy5i1rcm0shnblmbod');

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $db_host,
	'username' => $db_user,
	'password' => $db_pass,
	'database' => $db_name,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
