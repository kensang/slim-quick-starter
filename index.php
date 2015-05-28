<?php

/** 
 * require the file "config.php"; rename the file "config-sample.php" to "config.php" and fill in appropriate values
 */

// Redirect www.somedomain.com to somedomain.com, comment out the following lines if not applicable
if(substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
    header("HTTP/1.1 301 Moved Permanently"); 
    header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
    exit;
}



require 'vendor/autoload.php';

require 'config.php';


if(DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
else {
    error_reporting(0);
    ini_set("display_errors", 0);
}



/** 
 * Setup Idiorm (ORM)
 */
ORM::configure('mysql:host='.DB_HOST.';dbname='.DB_NAME);
ORM::configure('username', DB_USER);
ORM::configure('password', DB_PASSWORD);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
ORM::configure('logging', DB_LOG);


/** 
 * Setup Twig (Template Engine)
 */
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => DEBUG_MODE,
));





$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
 	echo 'hello world';	
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});


$app->run();
