<?php
declare(strict_types=1);
include_once "LogUserDTO.class.php";

class LogUserDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    private function get(LogUserDTO $user) : array {
        $reponse = $this->pdo->prepare('SELECT * FROM users WHERE email = :email;');
        $reponse->bindValue(':email', $user->getEmail(), PDO::PARAM_INT);
        $reponse->execute();
        return $reponse->fetchAll();
    }

    public function getUserIDByEmail($email) : int {
        $reponse = $this->pdo->prepare('SELECT ID FROM users WHERE email = :email;');
        $reponse->bindValue(':email', $email, PDO::PARAM_INT);
        $reponse->execute();
        return intval($reponse->fetchColumn());
    }

    public function connect(LogUserDTO $user) : bool {
        $values = $this->get($user);
        foreach($values as $row) {
            return password_verify($user->getPassword(), $row['password']);
        }
        return false;
    }
}
