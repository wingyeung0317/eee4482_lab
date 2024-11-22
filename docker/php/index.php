<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = Slim\Factory\AppFactory::create();

// add simple authentication
require_once __DIR__ . '/../src/auth.php';

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
$app->post('/users/register', 'App\Services\Register');
$app->get('/users/myrecords', 'App\Services\MyRecords');
$app->get('/books/borrow/{book_id}','App\Services\BorrowBook');
$app->get('/books/return/{book_id}', 'App\Services\ReturnBook');

// Run app
$app->run();
?>