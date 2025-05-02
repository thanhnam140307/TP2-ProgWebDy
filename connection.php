<?php
//Charly Paradis
include_once "src/database.php";
include_once "functions.php";
include_once "class/LogUserDTO.class.php";
include_once "class/ListException.class.php";
include_once "class/LogUserDAO.class.php";

$conn = connect_db();
$loginDAO = new LogUserDAO($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['email'] = trim(htmlspecialchars($_POST['email']));
    $_SESSION['password'] = trim(htmlspecialchars($_POST['password']));
    try {
        $login = new LogUserDTO($_SESSION['email'], $_SESSION['password']);
        if ($loginDAO->connect($login)) {
            setcookie("email", $_SESSION['email'], time() + 60 * 60 * 24 * 30);
            setcookie("password", $_SESSION['password'], time() + 60 * 60 * 24 * 30);
            header('Location: index.php');
            die();
        } else {
            $_POST['errors'][] = 'Mot de passe ou utilisateur incorrect.';
        }
    } catch (ListException $e) {
        $_POST['errors'] = $e->getMessages();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        <?php if (!isset($_COOKIE['email'])): ?>
            <a href="createAccount.php">Créer un compte</a>
            <a class="active" href="connection.php">Se connecter</a>
        <?php else : ?>
            <a href="">Se déconnecter</a>
        <?php endif; ?>
    </nav>

    <main>
        <div>
        <?php if(isset($_POST['errors'])) :?>
            <ul class="error-list">
            <?php foreach($_POST['errors'] as $error) :?>
                <li><?php echo $error;?></li>
            <?php endforeach;?>
            </ul>
        <?php endif;?>
        </div>
        <form class="form" method="POST">
            <h1 class="title">Connexion à mon compte Ourson</h1>
            <label for="email">Adresse de courrier :</label>
            <input id="email" name="email" type="email">
            <label for="password">Mot de passe :</label>
            <input id="password" name="password" type="password">
            <button>Se connecter</button>
        </form>
    </main>
</body>

</html>