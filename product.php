<?php
include_once "src/database.php";
include_once "class/ProductDAO.class.php";
include_once "functions.php";

if (!isset($_GET['sku'])) {
    header('Location: index.php');
    exit();
}

$conn = connect_db();
$product = new Product($conn);
// Pour déboguer : setcookie("product", "", time()-(60*60)); 

$sku = $_GET['sku'];
$name = $product->getColumnFromProduct($sku, "name");
$description = $product->getColumnFromProduct($sku, "description");
$price = floatval($product->getColumnFromProduct($sku, "price"));
$quantity = (int)$product->getColumnFromProduct($sku, "stock");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['email'])) {
    cookieProduct($sku, $name, $price, $_POST["quantity"]);

    header('Location: cart.php');
    exit();
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
        <?php
        //Pour déboguer
        /*if (isset($_COOKIE['product'])) {
            print_r(json_decode($_COOKIE['product'], true));
        }*/
        
        // À vérifier que le cookie de connection existe
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['email'])) {
            echo "<ul class=\"error-list\">
                        <li>Vous n'êtes pas connecté.</li>
                    </ul>";
        }
        ?>

        <section class="product-detail">
            <img class="image" src="img/<?php echo $sku; ?>.png" alt="<?php echo $name ?>">

            <h1 class="name"><?php echo $name ?></h1>
            <div class="description"><?php echo $description ?></div>
            <div class="price">
                <?php echo $price . " $ - " . $quantity . " restant(s)." ?>
            </div>

            <form method="post">
                <?php
                if ($quantity > 0) {
                    echo '<input class="quantity" name="quantity" type="number" value="1" min="1" max="' . $quantity . '">
                        <button>Ajouter au panier</button>';
                }
                ?>
            </form>
        </section>
    </main>

    <footer class="footer">
        Copyright @2025 La Baie Ourson Inc.
    </footer>
</body>

</html>
<?php $conn = null; ?>