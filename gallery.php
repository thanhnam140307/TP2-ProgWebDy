<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Baie Ourson</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/gallery.css">
    <script src="public/highlight/highlight.min.js" defer></script>
    <link rel="stylesheet" href="public/highlight/atom-one-dark.min.css">
    <script src="js/gallery.js" defer></script>
</head>

<body>
    <header>
        <h1>Galerie de composants</h1>
    </header>
    <main>
        <section class="component">
            <h2 class="name">En-tête</h2>
            <div class="demo full-width">
                <div id="header">
                    <header class="header">
                        <a href="index.php">
                            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
                        </a>
                    </header>
                </div>
            </div>
            <pre class="code"><code data-for="header"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Barre de navigation</h2>
            <div class="demo border full-width">
                <div id="nav">
                    <nav class="nav">
                        <a class="active" href="index.php">Accueil</a>
                        <a href="support.php">Support</a>
                        <a href="about.php">À propos</a>
                    </nav>
                </div>
            </div>
            <pre class="code"><code data-for="nav"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Pied de page</h2>
            <div class="demo">
                <div id="footer">
                    <footer class="footer">
                        Copyright @2025 La Baie Ourson Inc.
                    </footer>
                </div>
            </div>
            <pre class="code"><code data-for="footer"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Typographie</h2>
            <div class="demo full-width">
                <div id="text" class="typography">
                    <h1>Titre 1</h2>
                        <h2>Titre 2</h2>
                        <h3>Titre 3</h2>
                            <h4>Titre 4</h2>
                                <div>Texte</div>
                </div>
            </div>
            <pre class="code"><code data-for="text"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Typographie</h2>
            <h3 class="variant">Variantes</h2>
                <div class="demo full-width">
                    <div id="text-variant" class="typography">
                        <h1 class="title">Titre 1</h2>
                    </div>
                </div>
                <pre class="code"><code data-for="text-variant"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Bouton</h2>
            <h3 class="variant">Style normal</h3>
            <div class="demo">
                <div id="button">
                    <a class="button" href="sign-up.php">Connexion</a>
                </div>
                <div id="button-2">
                    <button>Enregistrer</button>
                </div>
            </div>
            <pre class="code"><code data-for="button"></code></pre>
            <pre class="code"><code data-for="button-2"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Bouton</h2>
            <h3 class="variant">Style hyperlien</h3>
            <div class="demo">
                <div id="button-hyperlink">
                    <a class="button hyperlink" href="sign-up.php">Se déconnecter</a>
                </div>
                <div id="button-hyperlink-2">
                    <button class="hyperlink">Ajouter un utilisateur</button>
                </div>
            </div>
            <pre class="code"><code data-for="button-hyperlink"></code></pre>
            <pre class="code"><code data-for="button-hyperlink-2"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Formulaire</h2>
            <div class="demo full-width">
                <div id="form">
                    <form class="form" method="POST">
                        <label for="fullname">Nom complet :</label>
                        <input id="fullname" type="text" placeholder="Nom complet">

                        <label for="age">Age :</label>
                        <input id="age" type="number" value="20">

                        <button>Envoyer</button>
                    </form>
                </div>
            </div>
            <pre class="code"><code data-for="form"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Champs de formulaire</h2>
            <h3 class="variant">Style normal</h3>
            <div class="demo">
                <div id="input">
                    <input type="text" placeholder="Nom d'utilisateur">
                </div>
            </div>
            <pre class="code"><code data-for="input"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Liste d'erreurs</h2>
            <div class="demo">
                <div id="errors">
                    <ul class="error-list">
                        <li>Le nom d'utilisateur est obligatoire.</li>
                        <li>L'adresse de courriel est invalide.</li>
                    </ul>
                </div>
            </div>
            <pre class="code"><code data-for="errors"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Produit</h2>
            <h3 class="variant">Carte</h2>
                <div class="demo full-width">
                    <div id="products-grid">
                        <section class="product-grid">
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
                                <img class="image" src="img/CW154789.png" alt="Manteau d'hiver Ursidae">
                                <div class="name">Manteau d'hiver Ursidae</div>
                                <div class="price">209.99 $</div>
                            </a>
                        </section>
                    </div>
                </div>
                <pre class="code"><code data-for="products-grid"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Produit</h2>
            <h3 class="variant">Détails</h2>
                <div class="demo full-width">
                    <div id="product-detail">
                        <section class="product-detail">
                            <img class="image" src="img/AW632147.png" alt="Tuque rouge">

                            <h1 class="name">Tuque rouge</h1>
                            <div class="description" v="">Tuque rouge vif. Style décontracté et abordable.</div>
                            <div class="price">5.99 $ - 5 restants.</div>

                            <form method="post">
                                <input class="quantity" name="quantity" type="number" value="1" min="1">
                                <button>Ajouter au panier</button>
                            </form>
                        </section>
                    </div>
                </div>
                <pre class="code"><code data-for="product-detail"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Panier</h2>
            <h3 class="variant">Liste de produits</h2>
                <div class="demo full-width">
                    <div id="product-list">
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
                    </div>
                </div>
                <pre class="code"><code data-for="product-list"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Panier</h2>
            <h3 class="variant">Total et opérations</h2>
                <div class="demo full-width">
                    <div id="cart-detail">
                        <section class="cart-total">
                            Total : <strong>287.96 $</strong>
                        </section>
                        <form class="cart-checkout" method="post">
                            <button>Passer la commande</button>
                        </form>
                    </div>
                </div>
                <pre class="code"><code data-for="cart-detail"></code></pre>
        </section>

        <section class="component">
            <h2 class="name">Panier</h2>
            <h3 class="variant">Lorsque vide</h2>
                <div class="demo full-width">
                    <div id="cart-empty">
                        <section class="cart-empty">
                            <h2>Votre panier est vide.</h2>
                            <p>
                                Pour le remplir, consultez notre liste de produits.
                            </p>
                        </section>
                    </div>
                </div>
                <pre class="code"><code data-for="cart-empty"></code></pre>
        </section>

    </main>
</body>

</html>