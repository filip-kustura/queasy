<?php 

// Provjeri je li postavljena varijabla rt; kopiraj ju u $route
if( isset( $_GET['rt'] ) )
	$route = $_GET['rt'];
else
	$route = 'index';

// Ako je $route == 'con/act', onda rastavi na $controllerName='con', $action='act'
$parts = explode( '/', $route );

$controllerName = $parts[0] . 'Controller';
$className = ucfirst($controllerName);
if( isset( $parts[1] ) )
	$action = $parts[1];
else
	$action = 'index';

// Provjeri je li postavljen poddirektorij subdir
if (isset($_GET['subdir']))
	$controllerName = $_GET['subdir'] . '/' . $controllerName;

// Controller $controllerName se nalazi poddirektoriju controller
$controllerFileName = 'controller/' . $controllerName . '.php';

// Includeaj tu datoteku
require_once $controllerFileName;

// Stvori pripadni kontroler
$con = new $className; 

// Pozovi odgovarajuću akciju
$con->$action();

?>
