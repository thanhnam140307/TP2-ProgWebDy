<?php
//Charly Paradis

include_once "src/database.php";
include_once "functions.php";
include_once "class/ListException.class.php";
include_once "class/ProductDAO.class.php";
include_once "class/LogUserDAO.class.php";
include_once "class/OrderDAO.class.php";
include_once "class/OrderItemDAO.class.php";

$conn = connect_db();

$productDAO = new Product($conn);
$userDAO = new LogUserDAO($conn);
$orderDAO = new OrderDAO($conn);
$orderItemDAO = new OrderItemDAO($conn);

if ($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['remove'])) {
    cookieProductRemove($_POST['remove']);
    $_SERVER['REQUEST_METHOD'] = 'GET';
    header('Location: cart.php');
    die();
} else if ($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['ship'])) {
    if (!isset($_COOKIE['email'])) {
        header('Location: connection.php');
        die();
    } else {
        foreach(json_decode($_COOKIE['product'], true) as $product) {
            $stock = $productDAO->getColumnFromProduct($product['sku'], 'stock');
            if ($product['quantity'] > intval($stock)) {
                $_POST['errors'][] = $product['name'] . ' demandé (' . $product['quantity'] . '), mais stock insuffisant (' . $stock . ').';
            }
        }
        if (!isset($_POST['errors'])) {
            $orderDAO->addOrder($userDAO->getUserIDByEmail($_COOKIE['email']));
            $orderID = $orderDAO->getOrder($userDAO->getUserIDByEmail($_COOKIE['email']));
            foreach(json_decode($_COOKIE['product'], true) as $product) {
                $orderItemDAO->addOrderItem($orderID, $product['sku'], $product['quantity']);
                $productDAO->updateInventory($product['sku'], $product['quantity']);
            }
            setcookie("product", "", time() - 3600);
            header('Location: cart.php');
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

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
        <a href="index.php">Produits</a>
        <a href="cart.php">Panier</a>
        <?php if (!isset($_COOKIE['email'])): ?>
            <a href="createAccount.php">Créer un compte</a>
            <a class="active" href="connection.php">Se connecter</a>
        <?php else: ?>
            <a href="sign-out.php">Se déconnecter</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php if(isset($_POST['errors'])) :?>
            <ul class="error-list">
            <?php foreach($_POST['errors'] as $error) :?>
                <li><?php echo $error;?></li>
            <?php endforeach;?>
            </ul>
        <?php endif;?>
        <?php if (!isset($_COOKIE['product'])): ?>
            <section class="cart-empty">
                <h2>Votre panier est vide.</h2>
                <p>Pour le remplir, consultez notre liste de produits.</p>
            </section>
        <?php else: ?>
            <section class="product-list">
                <?php foreach (json_decode($_COOKIE['product'], true) as $product): ?>
                    <div class="product">
                        <img class="image" src="img/<?php echo $product['sku']; ?>.png" alt="Sac à dos">

                        <div class="name"><?php echo $product['name']; ?></div>
                        <div class="price"><?php echo $product['price']; ?> $</div>
                        <div class="quantity">Quantité : <?php echo $product['quantity']; ?></div>
                        <form method="post">
                            <button class="hyperlink" name="remove" value="<?php echo $product['sku']; ?>">Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </section>
            <section class="cart-total">
                <?php
                $total = 0;
                foreach (json_decode($_COOKIE['product'], true) as $product) {
                    $total += $product['price'] * $product['quantity'];
                }
                echo 'Total : <strong>' . $total . ' $</strong>';
                ?>
            </section>
            <form class="cart-checkout" method="post">
                <button name="ship" value="1">Passer la commande</button>
            </form>
        <?php endif; ?>
    </main>
    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>