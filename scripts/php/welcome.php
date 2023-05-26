<?php 
    session_start();

    if(!isset($_SESSION['registration_success'])){
        header("Location: ../../index.html");
        exit();
    } else {
        unset($_SESSION['registration_success']);
        session_unset();
        session_destroy();
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
<html lang="en">
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

    <title>Pomyślna rejestracja - Rogaliki Twardowskiego</title>
</head>
<body>
    <?php include './essentials/main_navbar.php'; ?>
    <main>
        <div class="spacer"></div>
        <section class="welcome-page">
            <div class="wrapper">
                <div class="login">
                    <h1 class="text-header">Pomyślna rejestracja</h1>
                    <p class="text-paragraph">Dziękujemy za utworzenie konta w naszej piekarnii! Jesteśmy wdzięczni za Twoje zaufanie. Czy chciałbyś się teraz zalogować?</p>
                    <div class="btn-container">
                        <a href="<?php if(!empty($login_url)) echo $login_url; ?>" class="main-btn">Zaloguj się</a>
                        <a href="<?php if(!empty($index_url)) echo $index_url; ?>" class="main-btn">Strona główna</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>