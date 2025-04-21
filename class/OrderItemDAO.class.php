<?php
declare(strict_types=1);

class OrderItem {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    //Par Thanh Nam Nguyen
    public function insertOrderItem(string $orderId, string $sku, string $quantity) : void {
        $requete = $this->pdo->prepare('INSERT INTO order_item (order_id, product_sku, quantity) VALUES(:OrderId, :Sku, :Quantity)');
        $requete->bindValue(':OrderId', (int)$orderId, PDO::PARAM_INT);
        $requete->bindValue(':Sku', $sku, PDO::PARAM_STR);
        $requete->bindValue(':Quantity', (int)$quantity, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }
}
?>