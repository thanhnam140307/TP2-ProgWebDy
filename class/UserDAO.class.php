<?php
declare(strict_types=1);

class UserDAO
{
    private $pdo;

    //Par Thanh Nam Nguyen
    public function __construct($conn) {
        $this->pdo = $conn; 
    }

    //Par Thanh Nam Nguyen
    public function insertUser(string $email, string $password) : void {
        $request = $this->pdo->prepare('INSERT INTO users(email, password) VALUES(:Email, :Password)');
        $password = $this->hashPassword($password);
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->bindValue(':Password', $password, PDO::PARAM_STR);
        $request->execute();
        $request->closeCursor();
    }

    //Par Thanh Nam Nguyen
    private function hashPassword(string $password) : string {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    //Par Thanh Nam Nguyen
    public function isEmailPresent(string $email) : bool {
        $request = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :Email");
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->execute();
        $estPresent = $request->fetchColumn() > 0;
        $request->closeCursor();

        return $estPresent;
    }

    public function getUserId(string $email) : int {
        $request = $this->pdo->prepare("SELECT id FROM users WHERE email = :Email");
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->execute();
        $id = $request->fetchColumn();
        $request->closeCursor();

        return $id;
    }
}
