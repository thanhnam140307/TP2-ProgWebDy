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

    
}
?>