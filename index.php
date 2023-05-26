<?php 
	session_start();

?>

<?php
    $index_url = './index.php';
    $products_url = './scripts/php/products.php';
    $contact_url = './scripts/php/contact.php';
    $search_url = './scripts/php/search.php';
    $login_url = './scripts/php/login.php';
    $registration_url = './scripts/php/registration.php';
    $account_url = './scripts/php/user/account.php';
    $basket_url = './scripts/php/basket.php';
    $logout_url = './scripts/php/logout.php';
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
		<link rel="stylesheet" href="scripts/css/main.css" />
		<link rel="stylesheet" href="scripts/css/index.css" />
		<link rel="stylesheet" href="./assets/icons/css/fontello.css" />
		<!-- <script src="./scripts/js/scroll.js"></script> -->

		<title>Rogaliki Twardowskiego</title>
	</head>
	<body>
		<?php include './scripts/php/essentials/main_navbar.php'; ?>
		<main>
			<div class="spacer"></div>
			<section class="slider">
				<div class="slide current">
					<div class="content">
						<h1 class="text-header">Najlepsza jakość</h1>
						<p class="text-paragraph">
							Podstawą naszego pieczywa są starannie wyselekcjonowane przez naszych piekarzy składniki, w trosce o
							jak najlepsze doznania smakowe i zdrowie naszych klientów. Dzięki doskonałej bazie i wyjątkowym
							formułom nasze produkty zyskują ogromne zainteresowanie i stałych klientów — spróbuj, a
							najprawdopodobniej staniesz się jednym z nich.
						</p>
					</div>
				</div>
				<div class="slide">
					<div class="content">
						<h1 class="text-header">Najszybsza dostawa</h1>
						<p class="text-paragraph">
							Szukasz gorących bułeczek w swojej okolicy? Jeśli tak, to dobrze trafiłeś, ponieważ nasza piekarnia
							oferuje dowóz na terenie całego miasta. Obiecujemy szybką dostawę zamówienia, nie narażając twoich
							kubków smakowych na długie oczekiwanie na zamówione pieczywo!
						</p>
					</div>
				</div>
				<div class="slide">
					<div class="content">
						<h1 class="text-header">Najświeższe produkty</h1>
						<p class="text-paragraph">
							Nasza piekarnia zaopatrzona jest w rozbudowane zaplecze, umożliwiające produkcję na miejscu. Oznacza
							to, że nasi klienci otrzymują zawsze świeże wypieki. W ciągu dnia wielokrotnie możesz spotkać się z
							ciepłym, prosto z pieca pieczywem – nie tylko w momencie otwarcia sklepu. Ponadto, umożliwia nam to
							ciągłe uzupełnianie braków, toteż nawet jeśli nie znajdziesz u nas czegoś, czego szukałeś, to
							wystarczy, że wrócisz o innej porze – super, prawda?
						</p>
					</div>
				</div>
				<div class="slide">
					<div class="content">
						<h1 class="text-header">Najlepsza atmosfera</h1>
						<p class="text-paragraph">
							Szukasz klimatycznego miejsca, w którym będziesz mógł pozwolić sobie na chwilę relaksu? Gorąco
							zapraszamy do nas, gdzie oferujemy specjalnie wydzieloną, przytulną przestrzeń dla naszych klientów. W
							towarzystwie naszych wypieków i ciepłej herbaty będziesz mógł oddać się chwili odpoczynku i czystej
							przyjemności. Raj na ziemi i niebo w gębie!
						</p>
					</div>
				</div>
			</section>
			<div class="buttons">
				<button id="prev"><i class="icon-left-open"></i></button>
				<button id="next"><i class="icon-right-open"></i></button>
			</div>

			<section class="products">
				<div class="text">
					<h2 class="text-header">Poznaj nasze produkty</h2>
					<p class="text-paragraph">
						W naszej piekarni wypiekamy pieczywo najwyższej jakości.<br />
						Poniżej znajdziesz kilka z naszych produktów.
					</p>
				</div>
				<div class="products-container">
					<div class="product">
						<div class="product-img-wrapper">
							<img src="./assets/img/products/html/bulka_duza.jpg" alt="Duża buła" class="product-img" />
						</div>
						<div class="product-content-wrapper">
							<h2 class="product-title">Duża bułka</h2>
							<p class="product-desc" data-simplebar>
								Myślimy, że każdy nasz klient zdaje już sobie sprawę z wysokiej jakości naszych produktów, toteż nie będziemy się powtarzać – przekonajcie się na własnej skórze, a raczej na własnych kubkach smakowych. Nasze bułki nie są tylko duże z nazwy, jak wielokrotnie spotykamy się w sklepach spożywczych. Świetna receptura sprawia, że nasze bułki wspaniale wyrastają, czasem zadziwiając nas samych swoją niesamowitą, pulchną (ale nie sztucznie nadmuchaną niczym botoksem powietrzem, jak to również bywa w nisko jakościowych pieczywach) strukturą.
							</p>
						</div>
						<div class="see-more">
							<a href="./scripts/php/products.php" class="see-more-btn">Zobacz więcej</a>
						</div>
					</div>
					<div class="product">
						<div class="product-img-wrapper">
							<img src="./assets/img/products/html/chleb_ciemny.jpg" alt="Chleb ciemny" class="product-img" />
						</div>
						<div class="product-content-wrapper">
							<h2 class="product-title">Chleb razowy</h2>
							<p class="product-desc" data-simplebar>
								No cóż, mamy wielką nadzieję, że starczy na więcej niż razowe posiedzenie, jednak nic nie obiecujemy! W końcu nic nie poradzimy na tak cudowny smak naszych wypieków, który może doprowadzić do spałaszowania całego pieczywa w trymiga... Wysokiej jakości składniki, takie jak (oczywiście) mąka razowa oraz dodatki takie jak nasiona słonecznika czy ziarna siemienia lnianego, których nie szczędzimy, dbając o walory zdrowotne naszych produktów. Jeżeli szukasz wspierającego twoje zdrowie pieczywa, dostarczającego twojemu organizmowi to, co dla niego najlepsze, to zajrzałeś pod odpowiedni adres. Częstuj się!
							</p>
						</div>
						<div class="see-more">
							<a href="./scripts/php/products.php" class="see-more-btn">Zobacz więcej</a>
						</div>
					</div>
					<div class="product">
						<div class="product-img-wrapper">
							<img src="./assets/img/products/html/chleb_krojony_tostowy.jpg" alt="Chleb krojony" class="product-img" />
						</div>
						<div class="product-content-wrapper">
							<h2 class="product-title">Chleb krojony</h2>
							<p class="product-desc" data-simplebar>
								Ukrojenie równej, idealnie zbalansowanej pajdy chleba cię przerasta? Spokojnie, czasem nawet najwięksi mistrzowie drżą gdy staną przed tym zadaniem. W trosce o twoje nerwy, palce i czas wprowadziliśmy opcję zakupu chleba już skrojonego. Idealny wybór dla osób wiecznie zabieganych i perfekcjonistów, którzy pragną aby wraz z wspaniałym smakiem szła także estetyka!
							</p>
						</div>
						<div class="see-more">
							<a href="./scripts/php/products.php" class="see-more-btn">Zobacz więcej</a>
						</div>
					</div>
					<div class="product">
						<div class="product-img-wrapper">
							<img src="./assets/img/products/html/kajzerka.jpg" alt="Kajzerka" class="product-img" />
						</div>
						<div class="product-content-wrapper">
							<h2 class="product-title">Kajzerka</h2>
							<p class="product-desc" data-simplebar>
								Wykonana z mąki pszennej, drożdży i... shhh, to tajemnica naszego zakładu! Możemy jednak uchylić
								wam rąbka tajemnicy i zdradzić, że nie przebieramy w środkach i staraniach, aby uczynić ten
								podstawowy wypiek jakościowym i zachwycającym!
							</p>
						</div>
						<div class="see-more">
							<a href="./scripts/php/products.php" class="see-more-btn">Zobacz więcej</a>
						</div>
					</div>
				</div>
				<a href="./scripts/php/products.php" class="main-btn all-products-btn">Wszystkie produkty</a>
			</section>
			<section class="about-us"></section>
			<section class="contact"></section>
		</main>
		<?php include "./scripts/php/essentials/footer.php" ?>
		<script src="./scripts/js/slider.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.min.js"></script>
	</body>
</html>
