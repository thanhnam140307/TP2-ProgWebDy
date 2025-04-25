<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <?php
    include_once "src/database.php";
    include_once "2435947_functions.php";
    include_once "class/2435947_UserDTO.class.php";
    include_once "class/2435947_UserDAO.class.php";

    $conn = connect_db();
    
    ?>
    <header class="header">
        <a href="index.php">
            <img class="brand" src="img/brand.svg" alt="La Baie Ourson">
        </a>
    </header>

    <nav class="nav">
        <a href="index.php">Produits</a>
        <a href="cart.php">Panier</a>
        <a href="createAccount.php">Créer un compte</a>
        <a class="active" href="connection.php">Se connecter</a>
    </nav>

    <main>
        <form class="form" method="POST">
            <h1 class="title">Connexion à mon compte Ourson</h1>
            <label for="email">Adresse de courrier :</label>
            <input id="email" type="email">
            <label for="password">Mot de passe :</label>
            <input id="password" type="password">
            <button>Se connecter</button>
        </form>
    </main>
</body>

</html>