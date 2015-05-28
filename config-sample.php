<?php

/**
 * Configuration that are required to be changed each time a project is initially setup
 */

if(stristr($_SERVER['SERVER_NAME'],'mydomain.com') ) {
	// Production Site
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'mydb');
	define('DB_USER', 'myusername');
	define('DB_PASSWORD', 'mypassword');
	define('BASE_URL', 'http://mydomain.com/');
	define('ADMIN_CONSOLE_URI', 'admin/');
	define('DEFAULT_TIME_ZONE', 'UTC');
	define('DEBUG_MODE', false);
	define('DB_LOG', false);
}
else {
	// Development Site
	define('DB_HOST', '127.0.0.1:3306');
	define('DB_NAME', 'mydb');
	define('DB_USER', 'myusername');
	define('DB_PASSWORD', 'mypassword');
	define('BASE_URL', 'http://127.0.0.1:8080/myprojectfolder/');
	define('ADMIN_CONSOLE_URI', 'admin/');
	define('DEFAULT_TIME_ZONE', 'UTC');
	define('DEBUG_MODE', true);
	define('DB_LOG', false);
}







/**
 * Constants that don't need to be changed
 */

define('ADMIN_CONSOLE_BASE_URL', BASE_URL.ADMIN_CONSOLE_URI); 