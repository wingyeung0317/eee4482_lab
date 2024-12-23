<?php

namespace App\Services;

use \PDO;
use App\Db;
require_once __DIR__ . '/../Db.php';

function MyRecords($request, $response) {
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
    $sql = "SELECT * FROM books WHERE borrowed_by = '$user_id'";

    try {
        $db = new Db();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Close connection 
        $conn = null; 
        $db = null;
        $response->getBody()->write(json_encode($data));

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
