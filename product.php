<?php
    include_once "src\database.php";
    include_once "class\DAO.class.php";
    include_once "Mandat1.php";

    $sku = $_GET['sku'];

    $conn = connect_db();
    $data = new Data($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<!--Par Thanh Nam Nguyen-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
        </a>
    </header>

    <nav class="nav">
        <a href="index.php">Produits</a>
        <a href="cart.php">Panier</a>
        <a href="createAccount.php">Créer un compte</a>
        <a href="connection.php">Se connecter</a>
    </nav>

    <main>
        <section class="product-detail">
        <img class="image" src="img/<?php echo $sku; ?>.png" alt="Tuque rouge">

            <h1 class="name">Tuque rouge</h1>
            <div class="description" v="">Tuque rouge vif. Style décontracté et abordable.</div>
            <div class="price">5.99 $ - 5 restants.</div>

            <form method="post">
                <input class="quantity" name="quantity" type="number" value="1" min="1">
                <button>Ajouter au panier</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>