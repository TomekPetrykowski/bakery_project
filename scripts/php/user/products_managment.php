<?php 
    session_start();

	require_once '../db_connect.php';
	require_once '../functions.php';

	$table_name = 'products';
	$user_id = $_SESSION['id'];
	$query = "SELECT * FROM $table_name WHERE created_by = '$user_id';";

	try {
		if ($result = $connection -> query($query)){
			if ($result -> num_rows == 0) {
				$response['type'] = 'info';
				$response['message'] = "Nie dodałeś jeszcze żadnych produktów";
			} else {
				$user_products = $result -> fetch_all(MYSQLI_ASSOC);
			}
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
    $index_url = '../../../index.php';
    $products_url = '../products.php';
    $contact_url = '../contact.php';
    $search_url = '../search.php';
    $login_url = '../login.php';
    $registration_url = '../registration.php';
    $account_url = './account.php';
    $basket_url = '../basket.php';
    $logout_url = '../logout.php';
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
		<link rel="stylesheet" href="../../css/main.css" />
		<link rel="stylesheet" href="../../css/user.css" />
		<link rel="stylesheet" href="../../../assets/icons/css/fontello.css" />

		<title><?php echo $_SESSION['login']?> - panel konta użytkownika</title>
	</head>
	<body>
		<?php include '../essentials/main_navbar.php' ?>
		<main>
			<div class="spacer"></div>
			<section class="user-main">
				<div class="wrapper">
					<div class="user-nav">
						<nav class="nav-sidebar">
							<h2 class="text-header small">Menu</h2>
							<hr class="separator menu-sep">
							<ul>
								<li>
									<a href="<?php if(!empty($account_url)) echo $account_url; ?>" class="side-links">Ustawienia konta</a>
								</li>
								<hr class="separator menu-sep">
								<li><a href="./orders.php" class="side-links">Zamówienia</a></li>
								<hr class="separator menu-sep">
								<li><a href="./products_managment.php" class="side-links">Zarządzanie produktami</a></li>
								<hr class="separator menu-sep">
								<li>
									<a href="<?php if(!empty($logout_url)) echo $logout_url; ?>" class="side-links">Wyloguj się</a>
								</li>
							</ul>
						</nav>
					</div>
					<div class="user-main-content">
						<div class="user-info">
							<h2 class="text-header right">Zarządzanie produktami</h2>
							<hr class="separator menu-sep" style="width: 100%; margin: 1em 0;">
						</div>
						<div class="user-info">
							<h2 class="text-header right small">Dodawanie nowego pieczywa</h2>
							<div class="input-wrapper">
								<a href="./create_product.php" class="main-btn" style="display: inline-block;">Dodaj produkt</a>
							</div>
							<hr class="separator menu-sep" style="width: 100%; margin-bottom: 1em;">
						</div>
						<div class="user-info">
							<h2 class="text-header right small">Produkty dodane przez Ciebie</h2>
							<p class="text-paragraph"><?php if(isset($response['info'])) { echo $response['info']; unset($response['info']); } ?></p>
						</div>
						<div class="user-products">
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
										<img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" class="product-img" />
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
									<div class="buttons">
										<a href="./update_product.php?id=<?php echo $product['id'] ?>" class="main-btn">Edytuj</a>
										<a href="./delete_product.php?id=<?php echo $product['id'] ?>" class="main-btn">Usuń</a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
                    </div>
                </div>
			</section>
		</main>
		<?php include '../essentials/footer.php' ?>
		<script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.min.js"></script>
	</body>
</html>
