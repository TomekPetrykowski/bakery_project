<?php
	session_start();

	require_once "./db_connect.php";
	require_once "./functions.php";


    $table_name = 'clients';

    if (isset($_POST['reg_submit'])){
        $valid_data = true;
        
        $login = $_POST['login'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $mail_code = $_POST['mail_code'];

        $valid_data = validate_login($login, $valid_data);
        $valid_data = validate_email($email, $valid_data);
        $valid_data = validate_password($password1, $password2, $valid_data);
        $valid_data = validate_mail_code($mail_code, $valid_data);

        $password_hashed = password_hash($password1, PASSWORD_DEFAULT);

        $_SESSION['raw_login'] = $login;
        $_SESSION['raw_email'] = $email;
        $_SESSION['raw_password1'] = $password1;
        $_SESSION['raw_password2'] = $password2;
        $_SESSION['raw_name'] = $name;
        $_SESSION['raw_last_name'] = $last_name;
        $_SESSION['raw_address'] = $address;
        $_SESSION['raw_city'] = $city;
        $_SESSION['raw_mail_code'] = $mail_code;

        mysqli_report(MYSQLI_REPORT_STRICT);

        try{
            $result = $connection -> query("SELECT id FROM $table_name WHERE login = '$login' AND email = '$email';");

            if (!$result) throw new Exception($connection -> error);
            
            if ($result -> num_rows > 0){
                $valid_data = false;
                $_SESSION['e_login'] = "Istnieje już konto przypisane go tego adresu e-mail!";
            }
            
            $result = $connection -> query("SELECT id FROM $table_name WHERE login = '$login';");

            if (!$result) throw new Exception($connection -> error);
            
            if ($result -> num_rows > 0){
                $valid_data = false;
                $_SESSION['e_login'] = "Isnieje już taki login! Wybierz inny.";
            }
            
            if ($valid_data == true){
                $query = "INSERT INTO $table_name VALUES (NULL, '$login', '$password_hashed', '$email', '$name', '$last_name', '$address', '$city', '$mail_code');";

                if($connection -> query($query)){
                    $_SESSION['registration_success'] = true;
                    header("Location: welcome.php");
                } else {
                    throw new Exception($connection -> error);
                }
            }
            $connection -> close();
        } catch (Exception $e){
            echo "<p>Błąd serwera, przepraszamy za niedogodności i prosimy o rejestrację w terminie</p>"; 
            echo "<p>Błąd: ".$e."</p>";
        }
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
		<link rel="preconnect" href="https://fonts.gstatic.com" />
		<link
			href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap"
			rel="stylesheet"
		/>
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="../css/main.css" />
		<link rel="stylesheet" href="../css/login.css" />
		<link rel="stylesheet" href="../../assets/icons/css/fontello.css" />

		<title>Rejestracja - Rogaliki Twardowskiego</title>

	</head>
	<body>
		<?php include './essentials/main_navbar.php'; ?>
		<main>
			<div class="spacer"></div>
			<section class="reg-form">
				<div class="wrapper">
					<div class="login">
						<h1 class="text-header">Rejestracja</h1>
						<form action="" method="post">
							<div class="input-wrapper">
								<?php error_message_display('e_login'); ?>
								<input 
									type="text" 
									class="input text" 
									name="login" 
									placeholder="Login" 
									aria-label="Login" 
									value="<?php raw_data("login"); ?>" 
								/>
							</div>
							<div class="input-wrapper">
								<?php error_message_display('e_password1'); ?>
								<input
									type="password"
									class="input password"
									name="password1"
									placeholder="Hasło"
									aria-label="Hasło"
									value="<?php raw_data("password1"); ?>"
								/>
							</div>
							<div class="input-wrapper">
								<?php error_message_display('e_password2'); ?>
								<input
									type="password"
									class="input password"
									name="password2"
									placeholder="Powtórz hasło"
									aria-label="Powtórz hasło"
									value="<?php raw_data("password2"); ?>"
								/>
							</div>
							<div class="input-wrapper">
								<?php error_message_display('e_email'); ?>
								<input 
									type="email" 
									class="input email" 
									name="email" 
									placeholder="*Email" 
									aria-label="Email"
									value="<?php raw_data("email"); ?>" 
								/>
							</div>
							<div class="input-wrapper">
								<input 
									type="text" 
									class="input text" 
									name="name" 
									placeholder="*Imię" 
									aria-label="Imię"
									value="<?php raw_data("name"); ?>" 
								/>
							</div>
							<div class="input-wrapper">
								<input
									type="text"
									class="input text"
									name="last_name"
									placeholder="*Nazwisko"
									aria-label="Nazwisko"
									value="<?php raw_data("last_name"); ?>"
								/>
							</div>
							<div class="input-wrapper">
								<input 
									type="text" 
									class="input text" 
									name="address" 
									placeholder="*Adres" 
									aria-label="Adres"
									value="<?php raw_data("address"); ?>" 
								/>
							</div>
							<div class="input-wrapper">
								<?php error_message_display('e_mail_code'); ?>
								<div class="city-mail-code">
									<input
										type="text"
										class="input text"
										name="city"
										placeholder="*Miasto"
										aria-label="Miasto"
										autocapitalize="on"
										value="<?php raw_data("city"); ?>"
									/>
									
									<input
										type="text"
										class="input text"
										name="mail_code"
										placeholder="*Kod pocztowy"
										aria-label="Kod pocztowy"
										title="Format xx-xxx"
										value="<?php raw_data("mail_code"); ?>"
									/>
								</div>
							</div>
							<div class="input-wrapper">
								<input type="submit" class="input submit main-btn" name="reg_submit" value="Rejestracja" />
							</div>
						</form>
						<div class="asterisk">*Te pola nie są obowiązkowe</div>
						<div class="proposition">
							<p>Masz już konto?</p>
							<!-- do zmiany na php -->
							<a href="<?php if(!empty($login_url)) echo $login_url; ?>">Zaloguj się!</a>
						</div>
					</div>
				</div>
			</section>
		</main>
		<?php include './essentials/footer.php'; ?>
	</body>
</html>
