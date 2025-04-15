<?php declare(strict_types=1);
//Par Thanh Nam Nguyen
function selectListeComplet($conn) {
    $listeComplet = $conn->prepare('SELECT * FROM product'); 
    $listeComplet->execute();
    $listeProduit = $listeComplet->fetchAll();
    $listeComplet->closeCursor();
    
    return $listeProduit;
}

function afficherProduit($liste) {
    foreach($liste as $produits) {
        echo 
        '<a class="product" href="#">
            <img class="image" src="img/'.$produits['sku'].'.png" alt="'.$produits['name'].'">
            <div class="name">'.$produits['name'].'</div>
            <div class="price">'.$produits['price'].' $</div>
        </a>';
    }
}

?>