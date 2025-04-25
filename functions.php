<?php
//Par Thanh Nam Nguyen

declare(strict_types=1);
session_start();

function showProducts($list) {
    foreach ($list as $product) {
        echo
        '<a class="product" href="product.php?sku=' . $product['sku'] . '">
            <img class="image" src="img/' . $product['sku'] . '.png" alt="' . $product['name'] . '">
            <div class="name">' . $product['name'] . '</div>
            <div class="price">' . $product['price'] . ' $</div>
        </a>';
    }
}

function validateAccount($hasError, $isPresent, $userDTO, $userDAO) {
    $email = $userDTO->getEmail();
    $password = $userDTO->getPassword();
    $confirmPassword = $userDTO->getConfirmPassword();

    //Valider
    $isEmailEmpty = $userDTO->isEmpty($email);
    $isPasswordEmpty = $userDTO->isEmpty($password);
    $isConfirmPasswordEmpty = $userDTO->isEmpty($confirmPassword);

    $isValidEmail = $userDTO->isEqualToRegex("email");
    $isValidPassword = $userDTO->isEqualToRegex("password");
    $isValidConfirmPassword = $userDTO->isConfirmPasswordCorrect();

    //Valider s'il y a une erreur
    if ($isEmailEmpty || $isPasswordEmpty || $isConfirmPasswordEmpty || !$isValidEmail || !$isValidPassword || !$isValidConfirmPassword)
        $hasError = true;

    if ($userDAO->isEmailPresent($email))
        $isPresent = true;
    
    //Créer les sessions
    createSession($email, $password, $confirmPassword);
    
    //PRG
    navigateToCreateAccount($hasError, $isPresent, $isEmailEmpty, $isPasswordEmpty, $isConfirmPasswordEmpty, $isValidEmail, $isValidPassword, $isValidConfirmPassword);
}

function createSession($email, $password, $confirmPassword) {
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['confirmPassword'] = $confirmPassword;
}

function navigateToCreateAccount($hasError, $isPresent, $isEmailEmpty, $isPasswordEmpty, $isConfirmPasswordEmpty, $isValidEmail, $isValidPassword, $isValidConfirmPassword) {
    header('HTTP/1.1 303 See Other');
    header(
        'Location: createAccount.php?submited&isPresent=' . $isPresent . 
        '&hasError=' . $hasError . 
        '&emailEmpty=' . $isEmailEmpty .
        '&passwordEmpty=' . $isPasswordEmpty .
        '&confirmPasswordEmpty=' . $isConfirmPasswordEmpty .
        '&validEmail=' . $isValidEmail .
        '&validPassword=' . $isValidPassword .
        '&validConfirmPassword=' . $isValidConfirmPassword
    );

    exit();
}

function writeErrorsCreateUser() {
    if (isset($_GET['submited'])) {

        if ($_GET['hasError']) {
            echo "<ul class=\"error-list\">";
                if ($_GET['emailEmpty']) echo "<li>L'adresse courrier est obligatoire.</li>";
                if (!$_GET['validEmail']) echo "<li>L'adresse courrier n'est pas valide.</li>";
                if ($_GET['passwordEmpty']) echo "<li>Le mot de passe est obligatoire.</li>";                        
                if (!$_GET['validPassword']) echo "<li>Le mot de passe doit avoir au moin 8 caractères.</li>";
                if ($_GET['confirmPasswordEmpty']) echo "<li>La confirmation du mot de passe est obligatoire.</li>";
                if (!$_GET['confirmPasswordEmpty'] && !$_GET['validConfirmPassword'] && !$_GET['passwordEmpty'] && $_GET['validPassword']) echo "<li>La confirmation du mot de passe n'est pas égale au mot de passe.</li>";
            echo "</ul>";
        }

        if ($_GET['isPresent'] && !$_GET['hasError']) {
            echo 
            "<ul class=\"error-list\">
                <li>Le courrier est déjà présent.</li>
            </ul>";
        }
    }
}

function writeErrorsProduct($isConnected, $isEnnoughStock) {
    if (!$isConnected || !$isEnnoughStock) {
        echo "<ul class=\"error-list\">";
            if (!$isConnected) echo "<li>Vous n'êtes pas connecté.</li>";
            if (!$isEnnoughStock) echo "<li>Il n'y a plus de stock restant.</li>";
        echo "</ul>";
    }
}

function insertUser($userDAO) {
    if (isset($_GET['submited']) && !$_GET['hasError'] && !$_GET['isPresent'])
        $userDAO->insertUser($_SESSION['email'], $_SESSION['password']);
}

function keepValidField($sessionName, $getEmpty, $getValid) {
    if (isset($_GET['submited'], $_SESSION[$sessionName]) && !$_GET[$getEmpty] && $_GET[$getValid]) 
        echo htmlspecialchars($_SESSION[$sessionName]);
}
?>
