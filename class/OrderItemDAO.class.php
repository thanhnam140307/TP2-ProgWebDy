<?php
//Charly Paradis
declare(strict_types=1);

class OrderItemDAO {

    private $pdo;

    public function __construct($pdo) { 
		$this->pdo = $pdo; 
	} 

    public function addOrderItem(int $orderID, string $SKU, string $quantity) : void {
        $requete = $this->pdo->prepare('INSERT INTO order_item (order_id, product_sku, quantity) VALUES(:orderID, :SKU, :quantity)');
        $requete->bindValue(':orderID', $orderID, PDO::PARAM_INT);
        $requete->bindValue(':SKU', $SKU, PDO::PARAM_STR);
        $requete->bindValue(':quantity', (int)$quantity, PDO::PARAM_INT);
        $requete->execute();
    }
}