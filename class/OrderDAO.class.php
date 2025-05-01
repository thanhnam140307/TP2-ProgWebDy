<?php
declare(strict_types=1);

class Order {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    //Ajouter un achat
    public function addOrder(int $userId) : void {
        $request = $this->pdo->prepare('INSERT INTO `order` (user_id) VALUES(:userId)');
        $request->bindValue(':userId', $userId, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
    }

    //Obtenir l'achat
    public function getOrder(int $userId) : int {
        $request = $this->pdo->prepare("SELECT id FROM `order` WHERE user_id = :userId and creation_date = NOW()");
        $request->bindValue(':userId', $userId, PDO::PARAM_INT);
        $request->execute();
        $id = $request->fetchColumn();
        $request->closeCursor();

        return $id;
    }
}