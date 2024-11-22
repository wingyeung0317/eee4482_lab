<?php

namespace App\Services;

use \PDO;
use App\Db;
require_once __DIR__ . '/../Db.php';

function UpdateBook($request, $response, $args){
	$is_admin = false;
	if(isset($_SESSION["is_admin"])){
		if($_SESSION["is_admin"] == 1){
			$is_admin = true;
		}
	}

	if($is_admin == false){
		$response->getBody()->write("false");
		return $response
				->withHeader('content-type', 'application/json')
				->withStatus(200);
	}

	$book_id = $request->getAttribute('book_id');
	$data = $request->getParsedBody();
	$title = $data["title"];
	$authors = $data["authors"];
	$publishers = $data["publishers"];
	$date = $data["date"];
	$isbn = $data["isbn"];

	try {
		$db = new Db();
		$conn = $db->connect();

		// begin the transaction 
		$conn->beginTransaction();

		// our SQL statements         
		$sql = "UPDATE books SET 
				title = '$title',
				authors = '$authors',
				publishers = '$publishers',
				date = '$date',
				isbn = '$isbn'
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