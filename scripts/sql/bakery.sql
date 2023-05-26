-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Kwi 2021, 06:05
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bakery`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `second_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `mail_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `clients`
--

INSERT INTO `clients` (`id`, `login`, `password`, `email`, `name`, `second_name`, `address`, `city`, `mail_code`) VALUES
(1, 'admin', '$2y$10$H1UYHmpohVRYxqkgNpTFyOx8ZJDHPL59SyVpKWe5YD2E3azFsP2MC', 'tomek.petrykowski@wp.pl', 'Stachu', 'Pietrucha', 'ul. Marka Pola 12', 'Poznań', '60-778');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `user_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `send_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `mails`
--

INSERT INTO `mails` (`id`, `user_name`, `user_email`, `message`, `send_date`) VALUES
(1, 'Tomek', 'tomek.petrykowski@wp.pl', 'testowa wiadomość', '2021-04-16 03:00:35'),
(2, 'Tomek', 'tomek.petrykowski@wp.pl', 'testowa wiadomość', '2021-04-16 03:00:46'),
(7, 'Stanisław', 'stasiu1963@wp.pl', 'Najlepsza piekarnia jaką znam! Polecam cieplutko i przesyłam pozdrowienia z Radomia! ', '2021-04-18 16:56:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Wysłana','Oczekiwanie na wysyłkę','Dostarczona') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `quantity`, `created_at`, `created_by`) VALUES
(1, 'Słodki rogalik poznański', '../../../assets/img/products/database/LuOD2qsMwd1G/slodki_rogalik.jpg', 'Najsłodszy i najlepszy w całym Poznaniu. Wyśmienita przekąska do kawy z przyjaciółmi i rodziną!', '4.15', 50, '2021-04-18 18:30:18', 1),
(2, 'Rogalik Twardowskiego', '../../../assets/img/products/database/ou0lv4vdzYIr/rogal_najwiekszy.jpg', 'Duży i pożywny rogal Twardowskiego - najlepsze na drugie śniadanie. Anegdotą związaną z nim jest to, że jest w kształcie księżyca , na którym być może po dziś dzień żyje legendarny Mistrz Twardowski. Od tego właśnie pochodzi nazwa naszej piekarni.', '3.50', 25, '2021-04-18 23:04:55', 1),
(3, 'Duża bułka', '../../../assets/img/products/database/QnYhCUDgEsyo/bulka_duza.jpg', 'Myślimy, że każdy nasz klient zdaje już sobie sprawę z wysokiej jakości naszych produktów, toteż nie będziemy się powtarzać – przekonajcie się na własnej skórze, a raczej na własnych kubkach smakowych. Nasze bułki nie są tylko duże z nazwy, jak wielokrotnie spotykamy się w sklepach spożywczych. Świetna receptura sprawia, że nasze bułki wspaniale wyrastają, czasem zadziwiając nas samych swoją niesamowitą, pulchną (ale nie sztucznie nadmuchaną niczym botoksem powietrzem, jak to również bywa w nisko jakościowych pieczywach) strukturą.', '2.45', 14, '2021-04-18 23:11:24', 1),
(4, 'Chleb razowy', '../../../assets/img/products/database/TDmBT3Wh8AU6/chleb_ciemny.jpg', 'Ukrojenie równej, idealnie zbalansowanej pajdy chleba cię przerasta? Spokojnie, czasem nawet najwięksi mistrzowie drżą gdy staną przed tym zadaniem. W trosce o twoje nerwy, palce i czas wprowadziliśmy opcję zakupu chleba już skrojonego. Idealny wybór dla osób wiecznie zabieganych i perfekcjonistów, którzy pragną aby wraz z wspaniałym smakiem szła także estetyka!', '3.50', 13, '2021-04-19 03:35:39', 1),
(5, 'Chleb krojony', '../../../assets/img/products/database/jAxjB7hnaZKc/chleb_krojony_tostowy.jpg', 'Ukrojenie równej, idealnie zbalansowanej pajdy chleba cię przerasta? Spokojnie, czasem nawet najwięksi mistrzowie drżą gdy staną przed tym zadaniem. W trosce o twoje nerwy, palce i czas wprowadziliśmy opcję zakupu chleba już skrojonego. Idealny wybór dla osób wiecznie zabieganych i perfekcjonistów, którzy pragną aby wraz z wspaniałym smakiem szła także estetyka!', '1.99', 25, '2021-04-19 03:36:30', 1),
(6, 'Kajzerka', '../../../assets/img/products/database/8Hdm21MgkE6e/kajzerka.jpg', 'Wykonana z mąki pszennej, drożdży i... shhh, to tajemnica naszego zakładu! Możemy jednak uchylić wam rąbka tajemnicy i zdradzić, że nie przebieramy w środkach i staraniach, aby uczynić ten podstawowy wypiek jakościowym i zachwycającym!\r\n', '1.50', 30, '2021-04-19 03:37:05', 1),
(7, 'Bochen chleba', '../../../assets/img/products/database/0a7jUkt4N877/long-loaf-bread-22826883.jpg', 'Najlepszy chleb chleb z najlepszej poznańskiej piekarnii! A to wszystko dzięki naszemu zaprzyjaźnionemu klientowi Zbigniewowi Habadzibadło bo to on właśnie podesłał nam swój genialny przepis na chleb staropolskiej, można powiedzieć nawet, że średniowiecznej, receptury.', '2.00', 45, '2021-04-19 03:37:43', 1),
(8, 'Bagietka', '../../../assets/img/products/database/aKDTYID6tZnm/bagieta.jpg', 'Iście francuska i iście idealna na drugie śniadanie - polecamy serdecznie!', '2.50', 20, '2021-04-19 03:43:25', 1),
(9, 'Kruche rogaliki', '../../../assets/img/products/database/rNiQd4ID8XQp/rogalik.jpg', 'Słodkie i kruche - idealne na popołudniowe posiedzenie przy kawie. Zapraszamy na nie do naszej piekarni gdzie znajdziesz pyszne słodkości jak i przytulny kącik do wypicia kawy.', '0.49', 70, '2021-04-19 03:46:47', 1),
(10, 'Croissant', '../../../assets/img/products/database/U70vJe7hic7r/Croissant_whole.jpg', 'Uwielbiane przez wszystkich ciasto francuskie w kształcie rogalika. I nie musisz jechać do Krakowa żeby go zjeść!', '0.99', 49, '2021-04-19 03:47:43', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `clients` (`id`);

--
-- Ograniczenia dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
