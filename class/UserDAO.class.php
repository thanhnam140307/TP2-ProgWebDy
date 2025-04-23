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
        $requete = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :Email");
        $requete->bindValue(':Email', $email, PDO::PARAM_STR);
        $requete->execute();
        $estPresent = $requete->fetchColumn() > 0;
        $requete->closeCursor();

        return $estPresent;
    }
}
