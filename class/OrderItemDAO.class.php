<?php
declare(strict_types=1);

class OrderItem {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    public function addOrderItem(int $orderId, string $SKU, string $quantity) : void {
        $requete = $this->pdo->prepare('INSERT INTO order_item (order_id, product_sku, quantity) VALUES(:orderId, :SKU, :quantity)');
        $requete->bindValue(':orderId', $orderId, PDO::PARAM_INT);
        $requete->bindValue(':SKU', $SKU, PDO::PARAM_STR);
        $requete->bindValue(':quantity', (int)$quantity, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }
}