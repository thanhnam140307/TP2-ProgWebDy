<?php declare(strict_types=1);

function connect_db() : PDO {
    // TODO : Il vous faudra modifier le nom de la base de données et les identifiants.
    return new PDO("mysql:host=localhost;dbname=tp2", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
}