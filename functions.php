<?php
declare(strict_types=1);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Par Thanh Nam Nguyen
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

function insertUser($userDAO) {
    if (isset($_GET['submited']) && !$_GET['hasError'] && !$_GET['isPresent']) {
        $userDAO->insertUser($_SESSION['email'], $_SESSION['password']);
        setcookie("email", $_SESSION['email'], time() + 60 * 60 * 24 * 30);
        setcookie("password", $_SESSION['password'], time() + 60 * 60 * 24 * 30);
    }
}

function keepValidField($sessionName, $getEmpty, $getValid) {
    if (isset($_GET['submited'], $_SESSION[$sessionName]) && !$_GET[$getEmpty] && $_GET[$getValid]) 
        echo htmlspecialchars($_SESSION[$sessionName]);
}

function cookieProduct($sku, $name, $price, $quantity) {
    //https://webrewrite.com/store-array-values-cookie/
    //https://www.w3schools.com/PHP/php_arrays_update.asp

    $tableProduct = [];
    $isPresent = false;

    if (isset($_COOKIE['product'])) {
        $tableProduct = json_decode($_COOKIE['product'], true);

        foreach ($tableProduct as &$product) {
            if ($product['sku'] == $sku) {
                $product['quantity'] += (int)$quantity;
                $isPresent = true;
                break;
            }
        }
        unset($product);
    }

    if (!$isPresent || !isset($_COOKIE['product'])) {
        $tableProduct[] = array(
            "sku" => $sku,
            "name" => $name,
            "price" => $price,
            "quantity" => (int)$quantity
        );
    }

    setcookie("product", json_encode($tableProduct), time() + 60 * 60 * 24 * 30);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Charlie Paradie
