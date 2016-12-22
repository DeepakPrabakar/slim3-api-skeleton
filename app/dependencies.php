<?php

// DIC configuration
$container =  $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// Silalahi Logger
$container['logger'] = function($c) {
	$logger = $c->get('settings')['logger'];
  return new Silalahi\Slim\Logger($logger);
};

// Database connection
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
        $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;

};

$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {

	$error = [
		'Resultcode' => 1,      
		'Message' => $exception->getMessage(),
		'Data' => '{}',      
		'StatusCode' => $exception->getCode(),
		'File' => $exception->getFile(),
		'Line' => $exception->getLine(),
    ];

    $c->get('logger')->error($error['Message'].' | '.$error['File'].' | line: '.$error['Line']);
	$c->get('db')->rollBack();

    return $c->get('response')->withStatus(500)
             ->withHeader('Content-Type', 'application/json')
             ->write(json_encode($error));

    };
};


$container['phpErrorHandler'] = function ($c) {
    return function ($request, $response, $error) use ($c) {
        return $c['response']
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!!!!!!!!!!!!');
    };
};


$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page Not Found');
    };
};

$container['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $c['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'text/html')
            ->write('Method must be one of: ' . implode(', ', $methods));
    };
};

// -----------------------------------------------------------------------------
// Controllers
// -----------------------------------------------------------------------------

$container['CustomerDetails'] = function($c){
	return new \App\Controllers\CustomerDetails($c->get('logger'),$c['db']);
};

$container['OrderDetails'] = function($c){
    return new \App\Controllers\OrderDetails($c->get('logger'),$c['db']);
};

?>