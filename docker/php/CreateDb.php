<?php
    $servername = "localhost";
    $username = "root"; 
    $password = "netlab123"; 
    $dbname = "elibrary"; 
    try { 
        $conn = new PDO("mysql:host=$servername", $username, $password); 
        // set the PDO error mode to exception 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "CREATE DATABASE $dbname"; 
        // use exec() because no results are returned 
        $conn->exec($sql); 
        echo "Database has been created successfully<br>"; 
        // Close connection 
        $conn = null; 
    } catch(PDOException $e) { 
        echo $sql . "<br>" . $e->getMessage(); 
        // Close connection 
        $conn = null; 
    }
    $conn = null; 
?>