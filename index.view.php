<?php
    include_once "src\database.php";
    include_once "Mandat1.php";

    $conn = connect_db();
    $nombreDeProduit = compterNombreDeProduit($conn);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Baie Ourson</title>
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
        </a>
    </header>

    <nav class="nav">
        <a class="active" href="index.php">Produits</a>
        <a href="support.php">Panier</a>
        <a href="about.php">Créer un compte</a>
        <a href="about.php">Se connecter</a>
    </nav>

    <main>
        <section class="product-grid">
            <a class="product" href="#">
                <img class="image" src="img/AW124876.png" alt="Foulard polaire">
                <div class="name">Foulard polaire</div>
                <div class="price">24.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/AW325698.png" alt="Foulard gris">
                <div class="name">Foulard gris</div>
                <div class="price">14.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/AW453271.png" alt="Sac à dos">
                <div class="name">Sac à dos</div>
                <div class="price">65.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/AW632147.png" alt="Tuque rouge">
                <div class="name">Tuque rouge</div>
                <div class="price">5.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/AW678523.png" alt="Mitaines grises">
                <div class="name">Mitaines grises</div>
                <div class="price">14.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/AW745821.png" alt="Gants Nounours">
                <div class="name">Gants Nounours</div>
                <div class="price">7.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/CW154789.png" alt="Manteau d'hiver Ursidae">
                <div class="name">Manteau d'hiver Ursidae</div>
                <div class="price">209.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/CW478512.png" alt="Chandails de laine">
                <div class="name">Chandails de laine</div>
                <div class="price">24.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/CW612457.png" alt="T-shirts noir">
                <div class="name">T-shirts noir</div>
                <div class="price">9.99 $</div>
            </a>
            <a class="product" href="#">
                <img class="image" src="img/CW612458.png" alt="T-shirts blanc">
                <div class="name">T-shirts blanc</div>
                <div class="price">9.99 $</div>
            </a>
        </section>
    </main>
    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>Modifier database.php et ajouts de Mandat1.php