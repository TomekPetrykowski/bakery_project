<?php 
	session_start();

	require_once './db_connect.php';
	require_once './functions.php';

    $table_name = "mails";

    if(isset($_POST['submit'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

		$valid_data = true;
		$valid_data = validate_email($email, $valid_data);
		$valid_data = validate_is_empty('err_name', $name, $valid_data);
		$valid_data = validate_is_empty('err_email', $email, $valid_data);
		$valid_data = validate_is_empty('err_message', $message, $valid_data);
		
        $_SESSION['raw_name'] = $name;
        $_SESSION['raw_email'] = $email;
		$_SESSION['raw_message'] = $message;

		try {
			if ($connection -> connect_errno != 0){
		    	throw new Exception($connection -> error);
			} else {
				if ($valid_data == true) {
					$date = date('Y-m-d H:i:s');
					$query = "INSERT INTO $table_name VALUES (NULL, '$name', '$email', '$message', '$date');";
					
					unset($_SESSION['raw_name']);
					unset($_SESSION['raw_email']);
					unset($_SESSION['raw_message']);

					if ($connection -> query($query)) {
						$alert = "<p class='success'>Pomyślnie wysłano!</p>";
					} else {
						throw new Exception($connection -> error);		
					}
				}
			}
		} catch (Exception $e) {
			$alert = "<p class='error'>Błąd wysyłania. Spróbuj ponownie później.<br/>$e</p>";
		}      
        $connection -> close();
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
		<link rel="stylesheet" href="../css/contact.css" />
		<link rel="stylesheet" href="../../assets/icons/css/fontello.css" />

		<title>Rogaliki Twardowskiego</title>
	</head>
	<body>
		<?php include 'essentials/main_navbar.php' ?>
		<main>
			<div class="spacer"></div>
			<section class="contact">
				<div class="text-title">
					<h2 class="text-header">Bądźmy w kontakcie!</h2>
					<p class="text-paragraph">
						Jesteśmy firmą która zawsze na pierwszym miejscu stawia klienta. Jeśli masz do nas jakąś sprawę użyj
						jednej z opcji kontaktu poniżej.<br />Na pewno się odezwiemy!
					</p>
				</div>
				<div class="contact-wrapper">
					<div class="contact-info">
						<div class="contact-data">
							<h2 class="text-header left">Dane kontaktowe</h2>
							<p>Adres: <strong>ul. Marka Pola 12, Poznań</strong></p>
							<p>Telefon: <strong>696 969 696</strong></p>
							<p>E-mail: <strong>rogaliki.twardowskiego@gmail.com</strong></p>
						</div>
						<div class="contact-form">
							<p class="text-paragraph">Napisz do nas wiadomość!</p>
							<form action="" method="post">
								<div class="input-wrapper">
									<?php error_message_display('err_name'); ?>
									<input class="input" type="text" name="name" placeholder="Imię" aria-label="Imię" value="<?php raw_data("name"); ?>" />
								</div>
								<div class="input-wrapper">
									<?php error_message_display('err_email'); ?>
									<input class="input" type="email" name="email" placeholder="Email" aria-label="Email" value="<?php raw_data("email"); ?>" />
								</div>
								<div class="input-wrapper">
									<?php error_message_display('err_message'); ?>
									<textarea
										name="message"
										id="textarea-message"
										class="input textarea"
										placeholder="Napisz wiadomość"
										aria-label="Napisz wiadomość"
										value="<?php raw_data("message"); ?>"
									></textarea>
								</div>
								<?php if (isset($alert)) {echo $alert; unset($alert);} ?>
								<div class="input-wrapper">
									<input type="submit" name="submit" value="Wyślij" class="input main-btn" />
								</div>
							</form>
						</div>
					</div>
					<div class="map">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1966.9626624428772!2d18.696408052115775!3d52.88240131928293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471cb41e2ff98797%3A0x37a84eca9fd13a47!2zWmVzcMOzxYIgU3prw7PFgiBOciAx!5e0!3m2!1spl!2spl!4v1618497533297!5m2!1spl!2spl"
							allowfullscreen=""
							loading="lazy"
						></iframe>
					</div>
				</div>
			</section>
		</main>
		<?php include './essentials/footer.php'; ?>
	</body>
</html>
