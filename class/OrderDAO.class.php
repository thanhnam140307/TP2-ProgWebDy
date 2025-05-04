<?php
//Charly Paradis
declare(strict_types=1);

class OrderDAO {

    private $pdo;

    public function __construct($pdo) { 
		$this->pdo = $pdo; 
	} 

    public function addOrder(int $userID) : void {
        $request = $this->pdo->prepare('INSERT INTO `order` (user_id) VALUES(:userID)');
        $request->bindValue(':userID', $userID, PDO::PARAM_INT);
        $request->execute();
    }

    public function getOrder(int $userID) : int {
        $request = $this->pdo->prepare('SELECT id FROM `order` WHERE user_id = :userID and creation_date = NOW()');
        $request->bindValue(':userID', $userID, PDO::PARAM_INT);
        $request->execute();
        return $request->fetchColumn();
    }
}