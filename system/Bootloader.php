<?php

Class Bootloader {	
	public function __construct($config){
		// Require the LazyLoader Autoloader class
		require $config['paths']['basepath'] . 'LazyLoader.php';

		// Require and init the Error Class
		require $config['paths']['basepath'] . 'Error.php';

		// Require the Common class - a collection of functions
		require $config['paths']['basepath'] . 'Common.php';

		// Require the Uri class
		require $config['paths']['basepath'] . 'Uri.php';

		// Require the Database class
		require $config['paths']['basepath'] . 'Database.php';

		// Require the Controller class
		require $config['paths']['basepath'] . 'Controller.php';

		// Require the Model class
		require $config['paths']['basepath'] . 'Model.php';

		// Require the View / Template class
		require $config['paths']['basepath'] . 'View.php';

		// Require the Cache class
		require $config['paths']['basepath'] . 'Cache.php';
	}
}

$Amber      = new Bootloader($config);
$Error      = new Error;
$Common     = new Common;
$Database   = new Database;
$Uri        = new Uri;
$Controller = new Controller;
$Model      = new Model;
$View       = new View;
$Cache      = new Cache($Uri->uri['full_uri']);

















