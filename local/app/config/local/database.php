<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

//    $_ENV ARRAY IS TAKEN FROM .env.local.php file placed at root where the routes file is places

	'connections' => array(
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      =>  $_ENV['HOST'],
			'database'  =>  $_ENV['DATABASE'],
			'username'  =>  $_ENV['USERNAME'],
			'password'  =>  $_ENV['PASSWORD'],
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		

	),

);
