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

    <main>
        <?php if (true): ?>
            <section class="cart-empty">
                <h2>Votre panier est vide.</h2>
                <p>Pour le remplir, consultez notre liste de produits.</p>
            </section>
        <?php endif;
        if (false): ?>
            <section class="product-list">
                <div class="product">
                    <img class="image" src="img/AW453271.png" alt="Sac à dos">

                    <div class="name">Sac à dos</div>
                    <div class="price">65.99 $</div>
                    <div class="quantity">Quantité : 1</div>

                    <button class="hyperlink">Supprimer</button>
                </div>

                <div class="product">
                    <img class="image" src="img/AW632147.png" alt="Tuque rouge">

                    <div class="name">Tuque rouge</div>
                    <div class="price">5.99 $</div>
                    <div class="quantity">Quantité : 2</div>

                    <button class="hyperlink">Supprimer</button>
                </div>

                <div class="product">
                    <img class="image" src="img/CW154789.png" alt="Manteau d'hiver Ursidae">

                    <div class="name">Manteau d'hiver Ursidae</div>
                    <div class="price">209.99 $</div>
                    <div class="quantity">Quantité : 1</div>

                    <button class="hyperlink">Supprimer</button>
                </div>
            </section>
            <section class="cart-total">
                Total : <strong>287.96 $</strong>
            </section>
            <form class="cart-checkout" method="post">
                <button>Passer la commande</button>
            </form>
        <?php endif; ?>
    </main>
    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>