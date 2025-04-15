<?php declare(strict_types=1);
//Par Thanh Nam Nguyen

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