<?php
    include_once "src/database.php";
    include_once "class/OrderDAO.class.php";
    include_once "class/OrderItemDAO.class.php";
    include_once "class/ProductDAO.class.php";
    include_once "class/UserDAO.class.php";
    include_once "functions.php";

    if (isset($_GET['sku']))
        $sku = $_GET['sku'];

    else {
        header('Location: index.php');
        exit();
    }

    $conn = connect_db();
    $product = new Product($conn);

    $name = $product->getColumnFromProduct($sku, "name");
    $description = $product->getColumnFromProduct($sku, "description");
    $price = $product->getColumnFromProduct($sku, "price");
    $stock = $product->getColumnFromProduct($sku, "stock");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!empty($_SESSION['email']) && $_POST["quantity"] > 0) {

            $userDAO = new UserDAO($conn);
            $order = new Order($conn);
            $orderItem = new OrderItem($conn);

            $userId = $userDAO->getUserId($_SESSION['email']);
            $order->insertUserId($userId);
            $orderId = $order->getOrderId($userId); 
            $orderItem->insertOrderItem($orderId, $sku, $_POST["quantity"]);

            header('Location: 2437527_cart.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<!--Par Thanh Nam Nguyen-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
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
        <a href="createAccount.php">Créer un compte</a>
        <a href="connection.php">Se connecter</a>
    </nav>

    <main>
        <section class="product-detail">
            <img class="image" src="img/<?php echo $sku; ?>.png" alt="Tuque rouge">

            <h1 class="name"><?php echo $name ?></h1>
            <div class="description" v=""><?php echo $description ?></div>
            <div class="price">
                <?php echo $price . " $ - " . $stock . " restant(s)." ?>
            </div>

            <form method="post">
                <input class="quantity" name="quantity" type="number" value="<?php if ($stock == "0") echo "0"; else echo "1" ?>" min="<?php if ($stock == "0") echo "0"; else echo "1" ?>" max="<?php echo $stock ?>">
                <button>Ajouter au panier</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>