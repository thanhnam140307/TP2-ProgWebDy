<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class Order {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    public function insertUserId(int $userId) : void {
        $request = $this->pdo->prepare('INSERT INTO `order` (user_id) VALUES(:UserId)');
        $request->bindValue(':UserId', $userId, PDO::PARAM_INT);
        $request->execute();
        $request->closeCursor();
    }

    public function getOrderId(int $userId) : int {
        $request = $this->pdo->prepare("SELECT id FROM `order` WHERE user_id = :UserId and creation_date = NOW()");
        $request->bindValue(':UserId', $userId, PDO::PARAM_INT);
        $request->execute();
        $id = $request->fetchColumn();
        $request->closeCursor();

        return $id;
    }
}
?>