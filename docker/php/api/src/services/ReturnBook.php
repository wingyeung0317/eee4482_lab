<?php

namespace App\Services;

use \PDO;
use App\Db;
require_once __DIR__ . '/../Db.php';

function ReturnBook($request, $response, $args){
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
    $returned_by = $user_id;

    try {
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query("SELECT status, borrowed_by FROM books WHERE book_id = '$book_id'");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        // echo($result); //for debug only

        //lets do some checking
        if(count($result) > 0){ //the book exist
            if($result[0]['borrowed_by'] == $returned_by && $result[0]['status'] == 1){ 
                // begin the transaction 
                $conn->beginTransaction();

                // our SQL statements 
                $sql = "UPDATE books SET
                        status = '0',
                        borrowed_by = '-1'
                        WHERE book_id = '$book_id'";

                $conn->exec($sql);

                // commit the transaction 
                $result = $conn->commit(); 

                $response->getBody()->write(json_encode($result));
            }
            else{
                $response->getBody()->write("false");
            }
        }
        else{
            $response->getBody()->write("false");
        }

        // Close connection 
        $conn = null; 
        $db = null;

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
