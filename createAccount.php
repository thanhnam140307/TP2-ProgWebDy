<?php
    include_once "class\UserDTO.class.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $error = false;
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
        
        $userDTO = new UserDTO($email, $password, $confirmPassword);

        $isEmailEmpty = $userDTO->isEmpty($email);
        $isPasswordEmpty = $userDTO->isEmpty($password);
        $isConfirmPasswordEmpty = $userDTO->isEmpty($confirmPassword);

        $isValideEmail = $userDTO->isEqualToRegex("email");
        $isValidePassword = $userDTO->isEqualToRegex("password");
        $isValideConfirmPassword = $userDTO->isConfirmPasswordCorrect();

        if ($isEmailEmpty || $isPasswordEmpty || $isConfirmPasswordEmpty || !$isValideEmail || !$isValidePassword || !$isValideConfirmPassword)
            $error = true;

        header('HTTP/1.1 303 See Other');
        header('Location: createAccount.php?error='.$error.'&emailEmpty=' .$isEmailEmpty.
        '&passwordEmpty=' .$isPasswordEmpty.
        '&confirmPasswordEmpty=' .$isConfirmPasswordEmpty.
        '&valideEmail=' .$isValideEmail.
        '&validePassword=' .$isValidePassword.
        '&valideConfirmPassword=' .$isValideConfirmPassword);
        
        exit();
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
                if (isset($_GET['error']) && $_GET['error']) {
                    echo "<ul class=\"error-list\">";
                        if ($_GET['emailEmpty']) echo "<li>L'adresse courrier est obligatoire.</li>";
                        if (!$_GET['valideEmail']) echo "<li>L'adresse courrier n'est pas valide.</li>";
                        if ($_GET['passwordEmpty']) echo "<li>Le mot de passe est obligatoire.</li>";                        
                        if (!$_GET['validePassword']) echo "<li>Le mot de passe doit avoir au moin 8 caractères.</li>";
                        if ($_GET['confirmPasswordEmpty']) echo "<li>La confirmation du mot de passe est obligatoire.</li>";
                        if (!$_GET['valideConfirmPassword']) echo "<li>La confirmation du mot de passe n'est pas égale au mot de passe.</li>";
                    echo "</ul>";
                };
            ?>

            <label for="email">Adresse courrier :</label>
            <input id="email" type="text" name="email">

            <label for="password">Mot de passe :</label>
            <input id="password" type="password" name="password">

            <label for="confirmPassword">Confirmation du mot de passe :</label>
            <input id="confirmPassword" type="password" name="confirmPassword">

            <button>Envoyer</button>
        </form>
    </main>
</body>

</html>