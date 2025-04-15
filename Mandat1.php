<?php declare(strict_types=1);
//Par Thanh Nam Nguyen
function selectCompleteList($conn) {
    $completeList = $conn->prepare('SELECT * FROM product'); 
    $completeList->execute();
    $productList = $completeList->fetchAll();
    $completeList->closeCursor();
    
    return $productList;
}

function showProducts($list) {
    foreach($list as $product) {
        echo 
        '<a class="product" href="#">
            <img class="image" src="img/'.$product['sku'].'.png" alt="'.$product['name'].'">
            <div class="name">'.$product['name'].'</div>
            <div class="price">'.$product['price'].' $</div>
        </a>';
    }
}

?>