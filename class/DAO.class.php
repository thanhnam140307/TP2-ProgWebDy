<?php
declare(strict_types=1);

class Data {

    private $pdo;

    public function __construct($conn) { 
		$this->pdo = $conn; 
	} 

    public function selectCompleteList() : array{
        $completeList = $this->pdo->prepare('SELECT * FROM product'); 
        $completeList->execute();
        $productList = $completeList->fetchAll();
        $completeList->closeCursor();
        
        return $productList;
    }

    public function getColumn(string $sku, string $attribute) : string {
        $request = $this->pdo->prepare("SELECT ".$attribute." FROM product WHERE sku = :Sku");
        $request->bindValue(':Sku', $sku, PDO::PARAM_STR);
        $request->execute();
        $column = $request->fetchColumn();
        $request->closeCursor();

        return (string)$column;
    }
}
?>