<?php

use Stonks\Router\Router;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(BASE_PATH);

/*
* App Controller
*/

$router->namespace('Source\Controllers\App');
$router->group(null);

// ------- Web -------
$router->get('/','Web:home','app.web.home');
$router->get('/register','Web:register','app.web.register');
$router->get('/map','Web:map','app.web.map');
$router->get('/logout','Web:logout','app.web.logout');

// ------- Request -------
$router->post('/login','Request:login','app.request.login');
$router->post('/register','Request:register','app.request.register');

/*
* Admin Controller
*/

$router->namespace('Source\Controllers\Admin');
$router->group('admin');

// ------- Web -------
$router->get('/','Web:home','admin.web.home');
$router->get('/informations','Web:informations','admin.web.informations');

// ------- Request -------
$router->post('/registerDay','Request:registerDay','admin.request.registerDay');

$router->dispatch();

if($router->error()){
	echo $router->error();
}
