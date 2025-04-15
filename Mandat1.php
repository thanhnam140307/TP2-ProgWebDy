<?php declare(strict_types=1);

function compterNombreDeProduit($conn) {
    $requete = $conn->prepare('SELECT COUNT(*) FROM product'); 
    $requete->execute();

    return $requete->fetchColumn();
}

function recupererDonne($conn, $champs){
    $requete = $conn->prepare('SELECT' .$champs. 'FROM product'); 

}

function afficherProduit() {
    echo 
    '
    <a class="product" href="#">
        <img class="image" src="img/AW124876.png" alt="Foulard polaire">
        <div class="name">Foulard polaire</div>
        <div class="price">24.99 $</div>
    </a>
    ';
}

?>