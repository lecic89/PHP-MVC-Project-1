<?php

$routes = require_once 'routes.php';

$str = '';
$str .= PHP_EOL;
$str .= str_pad('', 5);
$str .= str_pad('Controller', 20);
$str .= str_pad('Method', 20);
$str .= str_pad('Pattern', 30);
$str .= PHP_EOL;

$str .= str_pad('', 5);
$str .= str_pad('', 20, '-');
$str .= str_pad('', 20, '-');
$str .= str_pad('', 30, '-');
$str .= PHP_EOL;

foreach ($routes as $route)
{
	$str .= PHP_EOL;
	$str .= str_pad('', 5);
	$str .= str_pad($route['Controller'], 20);
	$str .= str_pad($route['Method'], 20);
	$str .= str_pad($route['Pattern'], 25);
	$str .= PHP_EOL;
}

echo $str;
