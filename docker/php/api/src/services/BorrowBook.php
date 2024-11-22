<?php

namespace App\Services;

use \PDO;
use App\Db;
require_once __DIR__ . '/../Db.php';

function BorrowBook( $request, $response, $args){
    $user_id = -1;
    if (isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }
    else{
        $response->getBody()->write("false");
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
    }

    $book_id = $request->getAttribute('book_id');
    $data = $request->getParsedBody();
    $borrowed_by = $user_id;

    try {
        $db = new Db();
        $conn = $db->connect();

        // begin the transaction 
        $conn->beginTransaction();

        // our SQL statements 
        $sql = "UPDATE books SET
                status = '1',
                borrowed_by = '$borrowed_by'
                WHERE book_id = '$book_id'";

        $conn->exec($sql);
        // echo($sql); //for debug only

        // commit the transaction 
        $result = $conn->commit(); 

        // Close connection 
        $conn = null; 
        $db = null;

        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
        "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));

        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(500);
    }
}

?>
