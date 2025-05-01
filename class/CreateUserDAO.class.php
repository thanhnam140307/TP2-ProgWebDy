<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class UserDAO
{
    private $pdo;

    public function __construct($conn) {
        $this->pdo = $conn; 
    }

    public function insertUser(string $email, string $password) : void {
        $request = $this->pdo->prepare('INSERT INTO users(email, password) VALUES(:Email, :Password)');
        $password = $this->hashPassword($password);
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->bindValue(':Password', $password, PDO::PARAM_STR);
        $request->execute();
        $request->closeCursor();
    }

    //Hasher le mot de passe
    private function hashPassword(string $password) : string {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    //Vérifier si l'email est déjà présent
    public function isEmailPresent(string $email) : bool {
        $request = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :Email");
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->execute();
        $estPresent = $request->fetchColumn() > 0;
        $request->closeCursor();

        return $estPresent;
    }

    /*Obtenir L'id du user
    public function getUserId(string $email) : int {
        $request = $this->pdo->prepare("SELECT id FROM users WHERE email = :Email");
        $request->bindValue(':Email', $email, PDO::PARAM_STR);
        $request->execute();
        $id = $request->fetchColumn();
        $request->closeCursor();

        return $id;
    }*/
}
