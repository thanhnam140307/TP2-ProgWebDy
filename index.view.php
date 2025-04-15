<?php
    include_once "src\database.php";
    include_once "Mandat1.php";

    $conn = connect_db();
?>

<!DOCTYPE html>
<html lang="fr">
<!--Par Thanh Nam Nguyen-->
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
            <?php afficherProduit(selectListeComplet($conn)); ?>
        </section>
    </main>
    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>