<?php 
    session_start();

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

		<title><?php echo $_SESSION['login']." - panel konta użytkownika"?></title>
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

                    </div>
                </div>
			</section>
		</main>
		<?php include '../essentials/footer.php' ?>
		<script src="../../js/disabled.js"></script>
	</body>
</html>
