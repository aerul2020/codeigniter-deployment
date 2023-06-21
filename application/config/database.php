<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	// 'dsn'	=> 'mysql://phgs4f6wf2kwf99izjdj:pscale_pw_n5DdsTFpgMafx2nGBF18kBD2n4IN0XP8FbJ9hinaJZ9@aws.connect.psdb.cloud/absensi?ssl={"rejectUnauthorized":true}&sslcert=cacert.pem',

	//HOSTNAME
	// 'hostname' => 'aws.connect.psdb.cloud',
	'hostname' => "localhost",

	//USERNAME DATABASE
	'username' => "root",
	// Read/Write
	// 'username' => 'myrzlerpomvshe3vy1y8'
	// Admin
	// 'username' => 'phgs4f6wf2kwf99izjdj',

	//PASSWORD DATABASE
	'password' => "",
	// Read/Write
	// 'password' => 'pscale_pw_iYIzHK6u5ijeF0MaZsFBRGFACvVNXQkEsReJ0xv42qC'
	// Admin
	// 'password' => 'pscale_pw_n5DdsTFpgMafx2nGBF18kBD2n4IN0XP8FbJ9hinaJZ9',

	//NAMA DATABASE
	'database' => "absensi",

	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
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
