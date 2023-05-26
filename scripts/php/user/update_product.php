<?php 
    
    session_start();

    require_once '../db_connect.php';
    require_once '../functions.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = null;
    }

    if (!$id) {
        header('Location: ./products_managment.php');
        exit;
    }

    $table_name = 'products';

    $result = $connection -> query("SELECT * FROM $table_name WHERE id = '$id';");
    $row = $result -> fetch_assoc();
    $product_name = $row['name'];
    $product_desc = $row['description'];
    $product_price = $row['price'];
    $product_quantity = $row['quantity'];

     if (isset($_POST['submit'])) {
        $valid_data = true;

        $product_name = $_POST['name'];
        $product_desc = $_POST['product_desc'];
        $product_quantity = $_POST['product_quantity'];
        $product_price = $_POST['product_price'];
        $product_file = $_FILES['product_img'];


        $image = validate_img_file($product_file, $valid_data);
        $valid_data = validate_is_empty('e_product_name', $product_name, $valid_data);
        $valid_data = validate_is_empty('e_product_desc', $product_desc, $valid_data);
        $valid_data = $image['valid'];
        $image_path = $image['path'];

        if($valid_data) {
            $query = "UPDATE $table_name SET name = '$product_name', image = '$image_path', description = '$product_desc', price = '$product_price', quantity = '$product_quantity' WHERE id = '$id';";

            try {
                if ($connection -> query($query)){
                    $alert = '<p class="success">Pomyślnie zaktualizowano!</p>';
                    
                    $result = $connection -> query("SELECT * FROM $table_name WHERE id = '$id';");
                    $row = $result -> fetch_assoc();
                    $product_name = $row['name'];
                    $product_desc = $row['description'];
                    $product_price = $row['price'];
                    $product_quantity = $row['quantity'];
                } else {
                    throw new Exception($connection -> error);
                }
            } catch (Exception $e) {
                $alert = '<p class="error">Wystąpił błąd: '.$e.'</p>';
            }
        }
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
							<h2 class="text-header">Aktualizowanie produktu o nazwie: <?php echo $product_name ?></h2>
							<hr class="separator" style="width: 100%; border: 1px solid var(--clr-darkish-black); opacity: 0.2;">
							<p class="text-paragraph">Uzupełnij wszystkie pola!</p>
						</div>
						<div class="user-form">
							<form action="" method="POST" enctype="multipart/form-data">
                                <div class="input-wrapper">
                                    <label class="info" for="name">Nazwa produktu</label>
                                     <?php error_message_display('e_product_name'); ?>
                                    <input 
                                        type="text" 
                                        class="input text" 
                                        name="name" 
                                        placeholder="Nazwa produktu" 
                                        aria-label="Nazwa produktu"
                                        value="<?php echo $product_name; ?>"
                                    />
                                </div>
								<div class="input-wrapper">
									<label class="info" for="product_desc">Opis produktu</label>
                                    <?php error_message_display('e_product_desc'); ?>
									<textarea 
										class="input textarea" 
										name="product_desc" 
										placeholder="Opis produktu"
										aria-label="Opis produktu" 
                                        
                                    ><?php echo $product_desc; ?></textarea>
								</div>
								<div class="input-wrapper">
                                    <div class="input-next-to-input">
                                        <div class="product-input-wrapper">
                                            <label class="info" for="product-quantity">Ilość</label>
                                            <input 
                                                type="number" 
                                                class="input number" 
                                                name="product_quantity" 
                                                placeholder="Ilość"
                                                aria-label="Ilość"
                                                value="<?php echo $product_quantity ?>"
                                            />
                                        </div>
                                                                    
                                        <div class="product-input-wrapper">
                                            <label class="info" for="product_prize">Cena (zł)</label>
                                            <input 
                                                type="number" 
                                                class="input number" 
                                                name="product_price" 
                                                placeholder="Cena" 
                                                aria-label="Cena"
                                                step="0.01"
                                                value="<?php echo $product_price ?>"
                                            />   
                                        </div>
                                    
                                    </div>
								</div>
								<div class="input-wrapper">
									<label class="info" for="product_img">Dodaj zdjęcie</label>
									<?php error_message_display('e_file'); ?>
                                    <input 
                                        type="file" 
                                        class="input file" 
                                        name="product_img" 
                                        placeholder="Dodaj zdjęcie"
                                        aria-label="Dodaj zdjęcie"
                                        value="Dodaj" 
                                    />
                                </div>
								<div class="input-wrapper">
									<?php if(isset($alert)) {echo $alert; unset($alert); } ?>
									<input
                                        class="input main-btn"
                                        type="submit"
                                        name="submit"
                                        value="Aktualizuj produkt"
                                    />
								</div>
							</form>
						</div>
                    </div>
                </div>
			</section>
		</main>
		<?php include '../essentials/footer.php' ?>
	</body>
</html>
