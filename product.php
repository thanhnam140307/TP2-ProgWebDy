<?php
    include_once "src/database.php";
    include_once "class/ProductDAO.class.php";
    include_once "functions.php";

    if (!isset($_GET['sku'])){
        header('Location: index.php');
        exit();
    }

    $conn = connect_db();
    $product = new Product($conn);
    //setcookie("product", "", time()-(60*60)); 

    $sku = $_GET['sku'];
    $name = $product->getColumnFromProduct($sku, "name");
    $description = $product->getColumnFromProduct($sku, "description");
    $returnedPrice = $product->getColumnFromProduct($sku, "price");
    $price = floatval($returnedPrice);
    $quantity = (int)$product->getColumnFromProduct($sku, "stock");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['email']) && $_POST["quantity"] > 0) {
        //https://webrewrite.com/store-array-values-cookie/
        //https://www.w3schools.com/PHP/php_arrays_update.asp

        $tableProduct = [];
        $isPresent = false;

        if(isset($_COOKIE['product'])) {
            $tableProduct = json_decode($_COOKIE['product'], true);

            foreach ($tableProduct as &$product) {
                if ($product['sku'] == $sku) {
                    $product['quantity'] += (int)$_POST["quantity"];
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
                "quantity" => (int)$_POST["quantity"]
            );
        }
            
        setcookie("product", json_encode($tableProduct), time() + 60*60*24*30, null, null, false, true);

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
        if (isset($_COOKIE['product'])) {
            var_dump(json_decode($_COOKIE['product'], true));
        }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $isConnected = true;
                $isEnnoughStock = true;

                if (empty($_SESSION['email'])) 
                        $isConnected = false;

                if ($quantity == "0")
                    $isEnnoughStock = false;

                writeErrorsProduct($isConnected, $isEnnoughStock);
            }

           /* array(2) { 
                [0]=> array(2) { [0]=> array(1) { [0]=> array(4) { ["sku"]=> string(8) "AW632147" ["name"]=> string(11) "Tuque rouge" ["price"]=> float(5.99) ["quantity"]=> int(1) } }
                [1]=> array(4) { ["sku"]=> string(8) "AW678523" ["name"]=> string(15) "Mitaines grises" ["price"]=> float(14.99) ["quantity"]=> int(20) } } 
                [1]=> array(4) { ["sku"]=> string(8) "AW745821" ["name"]=> string(14) "Gants Nounours" ["price"]=> float(7.99) ["quantity"]=> int(40) } }*/
        ?>

        <section class="product-detail">
            <img class="image" src="img/<?php echo $sku; ?>.png" alt="Tuque rouge">

            <h1 class="name"><?php echo $name ?></h1>
            <div class="description"><?php echo $description ?></div>
            <div class="price">
                <?php echo $price . " $ - " . $quantity . " restant(s)." ?>
            </div>

            <form method="post">
                <input class="quantity" name="quantity" type="number"
                    value="<?php if ($quantity == "0") echo "0"; else echo "1" ?>"
                    min="<?php if ($quantity == "0") echo "0"; else echo "1" ?>" max="<?php echo $quantity ?>">
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