<?php

require_once 'core.php';

// Obrada zahteva i izbor rute
$request = substr(Http::requestUri(), strlen(Config::PATH));
$routes = require_once 'routes.php';

$args;
$foundRoute = null;
foreach ($routes as $route)
{
	if (preg_match($route['Pattern'], $request, $args))
	{
		$foundRoute = $route;
		break;
	}
}
unset($args[0]);
$args = array_values($args);

// Sloj logike
$controller = 'app/controllers/'.$foundRoute['Controller'].'Controller.php';
if (!file_exists($controller))
{
	ob_clean();
	die('Greška na sloju logike - odgovarajući controller nije pronađen!');
}
require_once $controller;

$className = $foundRoute['Controller'].'Controller';
$worker = new $className;

// __pre funkcija
if (method_exists($worker, '__pre'))
{
	call_user_func([$worker, '__pre']);
}

// Poziv odgovarajuće funkcije
if (!method_exists($worker, $foundRoute['Method']))
{
	ob_clean();
	die('Greška na sloju logike - odgovarajuća funkcija nije pronađena!');
}
$methodName = $foundRoute['Method'];
call_user_func_array([$worker, $methodName], $args);

// Prosleđivanje podataka iz sloja logike u sloj prikaza
$DATA = $worker->getData();

// Sloj prikaza
$view = 'app/views/'.$foundRoute['Controller'].'/'.$foundRoute['Method'].'.php';
if (!file_exists($view))
{
	ob_clean();
	die('Greška na sloju prikaza - odgovarajući view nije pronađen!');
}
require_once $view;
