<?php declare(strict_types=1);

function connect_db() : PDO {
    $dsn = "mysql:host=localhost;dbname=tp2";
    $user = "root";
    $pass = "";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );

    try {
        $conn = new PDO($dsn, $user, $pass, $options);
    } 
    
    catch (PDOException $e) {
        exit( "Erreur lors de la connexion à la BD: ".$e->getMessage());
    }

    return $conn;
}
?>