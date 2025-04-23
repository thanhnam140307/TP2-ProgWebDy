<?php
    include_once "src\database.php";
    include_once "class\UserDTO.class.php";
    include_once "class\UserDAO.class.php";
    include_once "Mandat1.php";

    $conn = connect_db();
    $userDAO = new UserDAO($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userDTO = new UserDTO(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['confirmPassword']));
        validateAccount(false, false, $userDTO, $userDAO);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<!--Par Thanh Nam Nguyen-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
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
        <a class="active" href="createAccount.php">Créer un compte</a>
        <a href="connection.php">Se connecter</a>
    </nav>

    <main>
        <form class="form" method="POST">
            <h1 class="title">Créer mon compte Ourson</h1>

            <?php 
                writeErrors();
                insert($userDAO);
            ?>

            <label for="email">Adresse courrier :</label>
            <input id="email" type="text" name="email"
                value="<?php keepValidField('email', 'emailEmpty', 'validEmail'); ?>">

            <label for="password">Mot de passe :</label>
            <input id="password" type="password" name="password"
                value="<?php keepValidField('password', 'passwordEmpty', 'validPassword'); ?>">

            <label for="confirmPassword">Confirmation du mot de passe :</label>
            <input id="confirmPassword" type="password" name="confirmPassword"
                value="<?php keepValidField('confirmPassword', 'confirmPasswordEmpty', 'validConfirmPassword'); ?>">

            <button>Envoyer</button>
        </form>
    </main>
</body>

</html>
<?php $conn = null; ?>