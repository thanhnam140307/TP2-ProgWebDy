<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class Product {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    //Sélectionner les produits 
    public function selectableProduct() : array {
        $completeList = $this->pdo->prepare('SELECT * FROM product'); 
        $completeList->execute();
        $productList = $completeList->fetchAll();
        $completeList->closeCursor();
        
        return $productList;
    }

    //Obtenir un colonne spécifique
    public function getColumnFromProduct(string $sku, string $column) : string {
        $request = $this->pdo->prepare("SELECT ".$column." FROM product WHERE sku = :Sku");
        $request->bindValue(':Sku', $sku, PDO::PARAM_STR);
        $request->execute();
        $column = $request->fetchColumn();
        $request->closeCursor();

        return (string)$column;
    }

    // Par Charly :
    // Mettre à jour l'inventaire
    public function updateInventory(string $SKU, int $quantity) {
        $request = $this->pdo->prepare("UPDATE product SET stock = stock - :quantity WHERE sku = :SKU");
        $request->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $request->bindValue(':SKU', $SKU, PDO::PARAM_STR);
        $request->execute();
        $request->closeCursor();
    }
}
