<?php
/**
 * Amber PHP Framework
 * v[1.0.0];
 *
 * An open source application development framework for PHP 5.4.0 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under:
 * 
 * The MIT License (MIT)
 * 
 * Copyright (c) 2013 Gremlin Soft, LLC
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * 
 * @package		Gremlin Soft, LLC
 * @author		Gremlin Soft, LLC > Gremlins DevTeam
 * @copyright	Copyright (c) 2013, Gremlin Soft, LLC.
 * @license		http://opensource.org/licenses/MIT MIT License
 */

require("config.php");


/**
 * Error reporting
 */
switch ($config['environment']) {
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'production':
		error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
		ini_set('display_errors', 0);
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1);
}


/*
 *  Resolve the system path for increased reliability
 */
if (($_temp = realpath($config['system_directory'])) !== FALSE){
	$config['system_directory'] = $_temp . '/';
}

// Is the system path correct?
if ( ! is_dir($config['system_directory'])){
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3);
}


/*
 *  Now that we know the path, set the main path constants
 */
// Path to this file
$config['paths']['self'] = pathinfo(__FILE__, PATHINFO_BASENAME);

// Path to the system folder
$config['paths']['basepath'] = str_replace('\\', '/', $config['system_directory']);

// Path to the front controller (this file)
$config['paths']['selfpath'] = str_replace($config['paths']['basepath'], '', __FILE__);

// The path to the "application" folder
if (is_dir($config['application_directory'])){
	if (($_temp = realpath($config['application_directory'])) !== FALSE){
		$config['application_directory'] = $_temp;
	}

	$config['paths']['apppath'] = $config['application_directory'] . '/';
} else {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the the config and correct this.';
	exit(3);
}

/*
 * Load the Bootloader
 */
require $config['paths']['basepath'] . 'Bootloader.php';