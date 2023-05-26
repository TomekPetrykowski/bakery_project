<?php 
    session_start();

	require_once 'db_connect.php';
	require_once 'functions.php';
    require_once 'search.php';

	$table_name = 'products';

    if (isset($_SESSION['is_logged_in'])) {
        $user_id = $_SESSION['id'];
    }

	$query = "SELECT * FROM $table_name;";
    $price_to = '';
    $price_from = '';
    
    if (isset($_SESSION['search_clause'])) {
        $search_clause = $_SESSION['search_clause'];
        unset($_SESSION['search_clause']);
        $_GET['szukaj'] = $search_clause;
    }

    if (isset($_POST['filter_submit'])) {
        
        if (!isset($_POST['price_from']) || empty($_POST['price_from'])){
            $price_from = '0';
        } else {
            $price_from = $_POST['price_from'];
        }

        if (!isset($_POST['price_to']) || empty($_POST['price_to'])) {
            $price_to = '99999999999';
        } else {
            $price_to = $_POST['price_to'];
        }

        $query = "SELECT * FROM $table_name WHERE price <= '$price_to' AND price >= '$price_from';";
    }

    if (!empty($search_clause)) {
        $query = "SELECT * FROM $table_name WHERE name LIKE '%$search_clause%';";
    }

	try {
		if ($result = $connection -> query($query)){
			if ($result -> num_rows == 0) {
				$response['type'] = 'info';
				$response['message'] = "Brak wyników";
			} 
				$user_products = $result -> fetch_all(MYSQLI_ASSOC);
		} else {
			throw new Exception($connection -> error);
		}
	} catch (Exception $e) {
		$response["type"] = 'error';
		$response['message'] = "Błąd połączenia z bazą danych. Spróbuj ponownie później";
		$response['exception'] = $e;
	}
?>

<?php
    $index_url = '../../index.php';
    $products_url = './products.php';
    $contact_url = './contact.php';
    $search_url = './search.php';
    $login_url = './login.php';
    $registration_url = './registration.php';
    $account_url = './user/account.php';
    $basket_url = './basket.php';
    $logout_url = './logout.php';
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.css"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap"
			rel="stylesheet"
		/>
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="../css/main.css" />
		<link rel="stylesheet" href="../css/products.css" />
		<link rel="stylesheet" href="../../assets/icons/css/fontello.css" />

		<title>Rejestracja - Rogaliki Twardowskiego</title>

	</head>
	<body>
		<?php include './essentials/main_navbar.php'; ?>
		<main>
			<div class="spacer"></div>
            <section class="content">
                <div class="text">
                    <h2 class="text-header">Produkty naszej piekarni</h2>
                    <?php if (isset($search_clause) && !empty($search_clause)): ?>
                        <h2 class="text-header small">Wyniki wyszukiwania dla: <?php echo $search_clause; ?></h2>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <div class="filter">
                        <div class="text">
                            <h2 class="text-header small">Filtrowanie</h2>
                        </div>
                        <hr class="menu-sep">   
                        <form method="POST">
                            <p class="text-paragraph">Cena:</p>
                            <div class="input-wrapper">
                                <div class="input-next-to-input">
                                    <input class="input" type="number" name="price_from" placeholder="od" step="0.01">
                                    <input class="input" type="number" name="price_to" placeholder="do" step="0.01">
                                </div>
                            </div>
                            <div class="input-wrapper">
                                <input type="submit" name="filter_submit" value="Filtruj" class="main-btn input">
                            </div>
                        </form>
                    </div>
                    <div class="products">
                        <?php if (isset($response)): ?>
                            <h2 class="text-header small"><?php echo $response['message']; ?></h2>
                        <?php endif; ?>
                        <?php foreach($user_products as $product): ?>
                            <?php 
                                if ($product['quantity'] > 0) {
                                    $status = "Pozostało";
                                } else {
                                    $status = "Tymczasowo niedostępny";
                                }
                                
                            ?>
                            
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="<?php echo substr($product['image'], 3);  ?>" alt="<?php echo $product['name'] ?>" class="product-img" />
                                </div>
                                <div class="product-content-wrapper">
                                    <h2 class="product-title"><?php echo $product['name'] ?></h2>
                                    <div class="product-desc" data-simplebar>
                                        <?php echo $product['description'] ?>
                                    </div>
                                    <p class="available"><?php echo $status." "; if ($product['quantity'] != 0) { echo $product['quantity']; } ?></p>
                                    <div class="price">
                                        <span></span>
                                        <h2 class="text-header small"><?php echo $product['price']." zł"; ?></h2>
                                    </div>
                                </div>
                                <?php if(isset($_SESSION['is_logged_in'])): ?>
                                <form class="buttons" method="POST" style="<?php if ($product['quantity'] <= 0) echo 'display:none;'; ?>">
                                    <input type="number" name="product_quantity" placeholder="ilość" class="input" value="1" max="<?php echo $product['quantity']; ?>"/>
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type='submit' name="product_submit" value="Kup" class="main-btn" />
                                </form>
                                <?php else: ?>
                                    <div class="buttons">
                                        <h2 class="text-header small">Zaloguj się aby kupić!</h2>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php 
                            unset($user_products);
                            unset($search_clause);
                            unset($price_from);
                            unset($price_to); 
                        ?>
                    </div>
                </div>
            </section>
        </main>
		<?php include "./essentials/footer.php" ?>
		<script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.min.js"></script>
	</body>
</html>