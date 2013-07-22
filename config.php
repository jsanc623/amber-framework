<?php


/**
 * Configuration options for base options
 * 
 * ------------------------------------------------------------------------
 * Configuration Name        Default       Other          Other        
 * ------------------------------------------------------------------------
 * $config['base_url']      [/]
 * $config['uri_protocol']  [REQUEST_URI]                       
 * ------------------------------------------------------------------------ 
 */
$config['base_url']     = "";
$config['uri_protocol'] = "REQUEST_URI";


/**
 * Configuration options for error reporting and environment
 * 
 * ------------------------------------------------------------------------
 * Configuration Name        Default       Other          Other        
 * ------------------------------------------------------------------------
 * $config['enviroment']     [production]  [development]               
 * $config['error_handler']  [default]     [php]          [custom[]]   
 * ------------------------------------------------------------------------
 */
$config['environment']           = "development";
$config['error_handler']         = "default";

/**
 * Configuration options for directory
 * 
 * -------------------------------------------------------------------------
 * Configuration Name        Default        Other          Other        
 * ----------------------------------------- -------------------------------
 * $config['applications']   [applications] [custom]
 * $config['systemdir']      [system]                       
 * -------------------------------------------------------------------------
 */
$config['application_directory'] = 'applications';
$config['system_directory'] = 'system';
$config['cache_directory'] = 'cache';

/**
 * Configuration options for database
 * NOTE: You can define multiple connections here
 * 
 * -------------------------------------------------------------------------
 * Configuration Name                         Default   Other   Other     
 * -------------------------------------------------------------------------
 * $config['databases']['name']['dsn']        []
 * $config['databases']['name']['hostname']   [localhost]
 * $config['databases']['name']['username']   [root]
 * $config['databases']['name']['password']   []
 * $config['databases']['name']['database']   []
 * $config['databases']['name']['dbdriver']   [mysqli]  [mysql] [mysqli]
 * $config['databases']['name']['tbprefix']   []
 * $config['databases']['name']['pconnect']   [true]    [false]
 * $config['databases']['name']['db_debug']   [true]    [false]
 * $config['databases']['name']['cache_on']   [false]   [true]
 * $config['databases']['name']['cachedir']   [/var/mysql/user/]
 * $config['databases']['name']['char_set']   [utf8]
 * $config['databases']['name']['dbcollat']   [utf8_general_ci]
 * $config['databases']['name']['autoinit']   [true]   [false]
 */
$config['databases']['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => '',
	'dbdriver' => 'mysqli',
	'tbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'autoinit' => TRUE
);
