<?php
//Par Thanh Nam Nguyen
declare(strict_types=1);

class Product {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    public function selectableProduct() : array {
        $completeList = $this->pdo->prepare('SELECT * FROM product'); 
        $completeList->execute();
        $productList = $completeList->fetchAll();
        $completeList->closeCursor();
        
        return $productList;
    }

    public function getColumnFromProduct(string $sku, string $column) : string {
        $request = $this->pdo->prepare("SELECT ".$column." FROM product WHERE sku = :Sku");
        $request->bindValue(':Sku', $sku, PDO::PARAM_STR);
        $request->execute();
        $column = $request->fetchColumn();
        $request->closeCursor();

        return (string)$column;
    }
}
