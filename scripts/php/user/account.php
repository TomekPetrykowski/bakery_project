<?php 

    session_start();

	require_once '../db_connect.php';
	require_once '../functions.php';

	
    $table_name = 'clients';

    if (isset($_POST['submit'])){
        $valid_data = true;
        
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $mail_code = $_POST['mail_code'];

        $valid_data = validate_email($email, $valid_data);
        $valid_data = validate_mail_code($mail_code, $valid_data);

        mysqli_report(MYSQLI_REPORT_STRICT);

        try{  
            if ($valid_data == true){
                $query = "UPDATE $table_name SET email = '$email', name = '$name', second_name = '$last_name', address = '$address', city = '$city', mail_code = '$mail_code' WHERE id = '".$_SESSION['id']."';";

                if($connection -> query($query)){
                    $alert = '<p class="success">Pomyślnie zaktualizowano dane!</p>';
					$row = get_user_data($connection, $_SESSION['id']);

					$_SESSION['login'] = $row['login'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['last_name'] = $row['second_name'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['address'] = $row['address'];
					$_SESSION['city'] = $row['city'];
					$_SESSION['mail_code'] = $row['mail_code'];
                } else {
                    throw new Exception($connection -> error);
                }
            }
            $connection -> close();
        } catch (Exception $e){
           $alert = "<p class='error'>Błąd serwera, przepraszamy za niedogodności i prosimy o spróbowanie w innym terminie<br/>Błąd: ".$e."</p>";
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
						
						<div class="user-info">
							<h2 class="text-header">Ustawienia użytkownika <strong><u><?php echo $_SESSION['login']; ?></u></strong></h2>
							<hr class="separator" style="width: 100%; border: 1px solid var(--clr-darkish-black); opacity: 0.2;">
							<p class="text-header small">Dane konta</p>
						</div>
						<div class="user-form">
							<form action="" method="POST">
								<div class="input-wrapper">
									<label class="info" for="email">E-mail</label>
									<?php error_message_display('e_email'); ?>
									<input 
										type="email" 
										class="disabled input email" 
										name="email" 
										placeholder="*Email" 
										aria-label="Email"
										value="<?php echo $_SESSION['email']; ?>" 
										disabled 
									/>
								</div>
								<div class="input-wrapper">
									<label class="info" for="name">Imię</label>
									<input 
										type="text" 
										class="disabled input text" 
										name="name" 
										placeholder="*Imię" 
										aria-label="Imię"
										value="<?php echo $_SESSION['name']; ?>" 
										disabled 
									/>
								</div>
								<div class="input-wrapper">
									<label class="info" for="last_name">Nazwisko</label>
									<input 
										type="text" 
										class="disabled input text" 
										name="last_name" 
										placeholder="*Nazwisko"
										aria-label="Nazwisko" 
										value="<?php echo $_SESSION['last_name']; ?>" 
										disabled 
									/>
								</div>
								<div class="input-wrapper">
									<label class="info" for="address">Adres</label>
									<input 
										type="text" 
										class="disabled input text" 
										name="address" 
										placeholder="*Adres" 
										aria-label="Adres"
										value="<?php echo $_SESSION['address']; ?>" 
										disabled 
									/>
								</div>
								<div class="input-wrapper">
									<label class="info" for="email">Miasto / kod pocztowy</label>
									<?php error_message_display('e_mail_code'); ?>
									<div class="input-next-to-input">
										
										<input 
											type="text" 
											class="disabled input text" 
											name="city" 
											placeholder="*Miasto"
											aria-label="Miasto" 
											autocapitalize="on" 
											value="<?php echo $_SESSION['city']; ?>" 
											disabled 
										/>
										
										<input
											type="text" 
											class="disabled input text" 
											name="mail_code" 
											placeholder="*Kod pocztowy"
											aria-label="Kod pocztowy" 
											title="Format xx-xxx" 
											value="<?php echo $_SESSION['mail_code']; ?>" 
											disabled
										/>
									</div>
								</div>
								<div class="input-wrapper">
									<?php if(isset($alert)) {echo $alert; unset($alert); } ?>
									<div class="input-next-to-input">
										<button class="input main-btn" id="change-btn" onclick="toggleDisabled();" value="change">Zmień</button>
										<button class="input main-btn" id='cancel-btn' hidden disabled>Anuluj</button>
										<input
											class="input main-btn spaced-btn"
											id="hidden"
											type="submit"
											name="submit"
											value="Wyślij"
											hidden
											disabled
										/>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</main>
		<?php include '../essentials/footer.php' ?>
		<script src="../../js/disabled.js"></script>
	</body>
</html>
