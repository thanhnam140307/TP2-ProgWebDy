<?php
    include_once "src/database.php";
    include_once "class/2435947_ProductDAO.class.php";
    include_once "2435947_functions.php";

    $conn = connect_db();
    $product = new Product($conn);
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
        <a href="2435947_index.php">
            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
        </a>
    </header>

    <nav class="nav">
        <a class="active" href="2435947_index.php">Produits</a>
        <a href="2437527_cart.php">Panier</a>
        <a href="2435947_createAccount.php">Créer un compte</a>
        <a href="2437527_connection.php">Se connecter</a>
    </nav>

    <main>
        <section class="product-grid">
            <?php showProducts($product->selectableProduct()); ?>
        </section>
    </main>

    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>