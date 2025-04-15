<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <title>Panier</title>
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
        </a>
    </header>
    <nav class="nav">
        <a href="">Produit</a>
        <a class="active" href="cart.php">Panier</a>
        <?php if (true): ?>
            <a href="">Créer un compte</a>
            <a href="">Se connecter</a>
        <?php endif;
        if (false): ?>
            <a href="">Se déconnecter</a>
        <?php endif; ?>
    </nav>

    <body>

    </body>
    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>