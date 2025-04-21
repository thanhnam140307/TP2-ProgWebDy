<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class Order {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    public function insertUserId(string $userId) : void {
        $requete = $this->pdo->prepare('INSERT INTO `order` (user_id) VALUES(:UserId)');
        $requete->bindValue(':UserId', (int)$userId, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public function getOrderID() : string {
        $request = $this->pdo->prepare("SELECT id FROM order");
        $request->execute();
        $id = $request->fetchColumn();
        $request->closeCursor();

        return (string)$id;
    }
}
?>