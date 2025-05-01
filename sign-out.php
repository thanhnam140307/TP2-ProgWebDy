<?php
//Par Thanh Nam Nguyen

if (isset($_COOKIE['email'], $_COOKIE['password'])) {
    setcookie("email", "", time() - (60 * 60));
    setcookie("password", "", time() - (60 * 60));

    header('Location: index.php');
    exit();
}
