<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = Slim\Factory\AppFactory::create();

// add simple authentication
require_once __DIR__ . '/../src/auth.php';
$app->add($checkLoggedInMiddleware);

//handle json format
$app->addBodyParsingMiddleware();

// Add Slim routing middleware
$app->addRoutingMiddleware();

// Set the base path to run the app in a subdirectory.
// This path is used in urlFor().
$app->add(new Selective\BasePath\BasePathMiddleware($app));

$app->addErrorMiddleware(true, true, true);
// Define app routes here

// Define app routes here
$app->get('/', function ($request, $response) {
    $response->getBody()->write('Hello, World!');
    return $response;
})->setName('root'); //<<<set root

//require all php files in /../src/services
foreach (glob(__DIR__ . '/../src/services/*.php') as $filename) {
// var_dump($filename); // for debug only
require_once($filename); 
}
$app->get('/books/all', 'App\Services\GetAllBooks');
$app->post('/books/add', 'App\Services\AddBook');
$app->put('/books/update/{book_id}', 'App\Services\UpdateBook');
$app->delete('/books/delete/{book_id}', 'App\Services\DeleteBook');
$app->post('/users/login', 'App\Services\Login')->setName('login');
$app->get('/users/logout', 'App\Services\Logout');

// Run app
$app->run();
?>