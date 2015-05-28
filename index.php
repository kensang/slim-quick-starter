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



$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
 	echo 'hello world';	
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});


$app->run();
