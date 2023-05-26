<?php

	session_start();

	require_once "db_connect.php";
	$table_name = 'clients';
	
	if (isset($_SESSION['is_logged_in'])) {
		header('Location: ./account.php');
		exit();
	}

	if (isset($_POST['login_submit'])) {

		$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
		$password = $_POST['password'];

		$query = sprintf("SELECT * FROM $table_name WHERE login = '%s';", mysqli_real_escape_string($connection, $login));

		if ($result = $connection -> query($query)) {
			if ($result -> num_rows > 0) {
				$row = $result -> fetch_assoc();
				
				if (password_verify($password, $row['password'])) {
					$_SESSION['is_logged_in'] = true;
					$_SESSION['id'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['last_name'] = $row['second_name'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['address'] = $row['address'];
					$_SESSION['city'] = $row['city'];
					$_SESSION['mail_code'] = $row['mail_code'];

					unset($_SESSION['error']);
					$result -> free_result();
					header('Location: ./user/account.php');

				} else {
					$_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
				}	
			} else {
				$_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
			}	
		}
	}
	$connection -> close();
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
		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap"
			rel="stylesheet"
		/>
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="../css/main.css" />
		<link rel="stylesheet" href="../css/login.css" />
		<link rel="stylesheet" href="../../assets/icons/css/fontello.css" />

		<title>Logowanie - Rogaliki Twardowskiego</title>
	</head>
	<body>
	<?php include './essentials/main_navbar.php'; ?>
		<main>
			<div class="spacer"></div>
			<section class="login-form">
				<div class="wrapper">
					<div class="login">
						<h1 class="text-header">Zaloguj się do witryny</h1>
						<form action="" method="post">
							<div class="input-wrapper">
								<input type="text" class="input text" name="login" placeholder="Login" />
							</div>
							<div class="input-wrapper">
								<input type="password" class="input password" name="password" placeholder="Hasło" />
							</div>
							<p class="error"><?php if(isset($_SESSION['error'])) echo $_SESSION['error']; ?></p>
							<div class="input-wrapper">
								<input type="submit" class="input submit main-btn" name="login_submit" value="Zaloguj się" />
							</div>
						</form>
						<div class="proposition">
							<p>Nie masz konta?</p>
							<a href="<?php if(!empty($registration_url)) echo $registration_url; ?>">Zajerestruj się!</a>
						</div>
					</div>
				</div>
			</section>
		</main>
		<?php include './essentials/footer.php'; ?>
	</body>
</html>
