-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Sie 2023, 19:48
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `my_budget_mvc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expense_category_assigned_to_user_id` int(11) NOT NULL,
  `payment_method_assigned_to_user_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date_of_expense` date NOT NULL,
  `expense_comment` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `expense_category_assigned_to_user_id`, `payment_method_assigned_to_user_id`, `amount`, `date_of_expense`, `expense_comment`) VALUES
(1, 9, 158, 0, '300.00', '2023-06-02', 'Paliwo'),
(2, 9, 163, 2, '600.00', '2023-06-12', 'Przedszkole'),
(3, 9, 166, 2, '500.00', '2023-06-05', 'Angielski'),
(4, 9, 166, 2, '500.00', '2023-06-05', 'Angielski'),
(5, 9, 158, 3, '300.00', '2023-06-26', 'Paliwo'),
(6, 9, 158, 3, '300.00', '2023-06-26', 'Paliwo'),
(7, 9, 158, 1, '300.00', '2023-07-03', 'Paliwo'),
(8, 9, 156, 3, '600.00', '2023-07-05', 'Zakupy w biedrze'),
(9, 9, 161, 3, '150.00', '2023-07-27', 'Buty'),
(10, 9, 164, 1, '50.00', '2023-07-27', 'Kino'),
(11, 9, 161, 3, '500.00', '2023-07-28', 'Shopping'),
(14, 9, 156, 1, '150.00', '2023-08-08', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_assigned_to_users`
--

CREATE TABLE `expenses_category_assigned_to_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_assigned_to_users`
--

INSERT INTO `expenses_category_assigned_to_users` (`id`, `user_id`, `category_name`) VALUES
(158, 9, 'Paliwo'),
(159, 9, 'Telekomunikacja'),
(160, 9, 'Opieka zdrowotna'),
(161, 9, 'Ubrania'),
(162, 9, 'Higiena'),
(163, 9, 'Dzieci'),
(164, 9, 'Rozrywka'),
(165, 9, 'Wycieczka'),
(166, 9, 'Szolenia'),
(167, 9, 'Hobby'),
(168, 9, 'Oszczędności'),
(169, 9, 'Kredyt'),
(170, 9, 'Rata'),
(171, 9, 'Darowizna'),
(174, 10, 'Transport'),
(175, 10, 'Telekomunikacja'),
(176, 10, 'Opieka zdrowotna'),
(177, 10, 'Ubrania'),
(178, 10, 'Higiena'),
(179, 10, 'Dzieci'),
(180, 10, 'Rozrywka'),
(181, 10, 'Wycieczka'),
(182, 10, 'Szolenia'),
(183, 10, 'Hobby'),
(184, 10, 'Oszczędności'),
(185, 10, 'Kredyt'),
(186, 10, 'Rata'),
(187, 10, 'Darowizna'),
(203, 9, 'Poduszka finansowa'),
(222, 12, 'Jedzenie'),
(223, 12, 'Mieszkanie'),
(224, 12, 'Transport'),
(225, 12, 'Telekomunikacja'),
(226, 12, 'Opieka zdrowotna'),
(227, 12, 'Ubrania'),
(228, 12, 'Higiena'),
(229, 12, 'Dzieci'),
(230, 12, 'Rozrywka'),
(231, 12, 'Wycieczka'),
(232, 12, 'Szolenia'),
(233, 12, 'Hobby'),
(234, 12, 'Oszczędności'),
(235, 12, 'Kredyt'),
(236, 12, 'Rata'),
(237, 12, 'Darowizna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_default`
--

CREATE TABLE `expenses_category_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_default`
--

INSERT INTO `expenses_category_default` (`id`, `name`) VALUES
(1, 'Jedzenie'),
(2, 'Mieszkanie'),
(3, 'Transport'),
(4, 'Telekomunikacja'),
(5, 'Opieka zdrowotna'),
(6, 'Ubrania'),
(7, 'Higiena'),
(8, 'Dzieci'),
(9, 'Rozrywka'),
(10, 'Wycieczka'),
(11, 'Szolenia'),
(12, 'Hobby'),
(13, 'Oszczędności'),
(14, 'Kredyt'),
(15, 'Rata'),
(16, 'Darowizna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `income_category_assigned_to_user_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date_of_income` date NOT NULL,
  `income_comment` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `income_category_assigned_to_user_id`, `amount`, `date_of_income`, `income_comment`) VALUES
(1, 3, 0, '1000.00', '2023-06-12', '500+'),
(2, 3, 1, '1000.00', '2023-06-15', '500+'),
(3, 3, 1, '2200.00', '2023-06-09', 'InduStone'),
(4, 3, 1, '1000.00', '2023-06-12', 'InduStone'),
(5, 3, 1, '350.00', '2023-06-01', 'Zakupy w biedrze'),
(6, 3, 1, '700.00', '2023-06-30', 'Wynajem mieszkania'),
(7, 3, 0, '3000.00', '2023-06-21', 'Zasiłek pielgęgancyjny'),
(8, 3, 0, '3000.00', '2023-06-21', 'Zasiłek pielgęgancyjny'),
(9, 3, 0, '3000.00', '2023-06-21', 'Zasiłek pielgęgancyjny'),
(10, 3, 0, '3000.00', '2023-06-28', 'InduStone'),
(11, 3, 0, '3000.00', '2023-06-28', 'InduStone'),
(12, 3, 0, '350.00', '2023-06-17', 'Paliwo'),
(13, 3, 0, '350.00', '2023-06-17', 'Paliwo'),
(14, 3, 0, '350.00', '2023-06-17', 'Paliwo'),
(15, 3, 0, '300.00', '2023-06-15', 'InduStone'),
(16, 3, 0, '300.00', '2023-06-15', 'InduStone'),
(17, 3, 0, '300.00', '2023-06-15', 'InduStone'),
(18, 3, 0, '300.00', '2023-06-15', 'InduStone'),
(19, 3, 0, '300.00', '2023-06-15', 'InduStone'),
(20, 3, 1, '3000.00', '2023-06-19', 'Zasiłek pielgęgancyjny'),
(21, 3, 1, '3000.00', '2023-06-19', 'Zasiłek pielgęgancyjny'),
(22, 3, 2, '2200.00', '2023-06-15', ''),
(23, 3, 4, '1200.00', '2023-06-10', 'Wynajem mieszkania'),
(24, 3, 4, '300.00', '2023-06-29', 'Ubrania'),
(25, 3, 3, '700.00', '2023-06-28', ''),
(26, 3, 3, '700.00', '2023-06-28', ''),
(27, 3, 3, '700.00', '2023-06-28', ''),
(28, 3, 2, '2200.00', '2023-06-19', ''),
(29, 3, 2, '2200.00', '2023-06-19', ''),
(30, 3, 2, '2200.00', '2023-06-19', ''),
(31, 3, 2, '2200.00', '2023-06-19', ''),
(32, 3, 2, '2200.00', '2023-06-19', ''),
(33, 3, 2, '2200.00', '2023-06-19', ''),
(34, 3, 2, '2200.00', '2023-06-19', ''),
(35, 3, 2, '2200.00', '2023-06-19', ''),
(36, 3, 2, '2200.00', '2023-06-19', ''),
(37, 3, 2, '2200.00', '2023-06-19', ''),
(38, 3, 2, '2200.00', '2023-06-19', ''),
(39, 3, 2, '2200.00', '2023-06-19', ''),
(40, 3, 2, '2200.00', '2023-06-19', ''),
(41, 3, 2, '2200.00', '2023-06-19', ''),
(42, 3, 2, '2200.00', '2023-06-19', ''),
(43, 9, 44, '1000.00', '2023-06-09', '500+'),
(44, 9, 43, '2200.00', '2023-06-05', 'Wypłata'),
(45, 9, 44, '2700.00', '2023-06-19', 'Zasiłek pielgęgancyjny'),
(46, 9, 0, '0.00', '0000-00-00', ''),
(47, 9, 0, '0.00', '0000-00-00', ''),
(48, 9, 44, '1000.00', '2023-07-12', '500+'),
(49, 9, 43, '2200.00', '2023-07-03', 'InduStone'),
(50, 9, 44, '2700.00', '2023-07-24', 'Zasiłek pielgęgancyjny'),
(51, 9, 43, '300.00', '2023-07-17', 'Liczydełko'),
(52, 9, 54, '300.00', '2023-08-10', ''),
(54, 9, 45, '350.00', '2023-08-24', ''),
(55, 9, 65, '2200.00', '2023-08-11', ''),
(56, 9, 66, '3000.00', '2023-08-11', ''),
(57, 9, 65, '3000.00', '2023-07-19', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_assigned_to_users`
--

CREATE TABLE `incomes_category_assigned_to_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_assigned_to_users`
--

INSERT INTO `incomes_category_assigned_to_users` (`id`, `user_id`, `category_name`) VALUES
(45, 9, 'Odsetki'),
(49, 10, 'Odsetki'),
(50, 10, 'Sprzedaż'),
(65, 9, 'Wynagrodzenie'),
(66, 9, 'Świadczenia'),
(67, 9, 'Sprzedaż na olx'),
(68, 12, 'Wynagrodzenia'),
(69, 12, 'Świadczenia'),
(70, 12, 'Odsetki'),
(71, 12, 'Sprzedaż');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_default`
--

CREATE TABLE `incomes_category_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_default`
--

INSERT INTO `incomes_category_default` (`id`, `name`) VALUES
(1, 'Wynagrodzenia'),
(2, 'Świadczenia'),
(3, 'Odsetki'),
(4, 'Sprzedaż');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_assigned_to_users`
--

CREATE TABLE `payment_methods_assigned_to_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_assigned_to_users`
--

INSERT INTO `payment_methods_assigned_to_users` (`id`, `user_id`, `name`) VALUES
(1, 9, 'Gotówka'),
(2, 9, 'Przelew'),
(3, 9, 'Karta kredytowa'),
(4, 10, 'Gotówka'),
(5, 10, 'Przelew'),
(6, 10, 'Karta kredytowa'),
(10, 12, 'Gotówka'),
(11, 12, 'Przelew'),
(12, 12, 'Karta kredytowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_default`
--

CREATE TABLE `payment_methods_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_default`
--

INSERT INTO `payment_methods_default` (`id`, `name`) VALUES
(1, 'Gotówka'),
(2, 'Przelew'),
(3, 'Karta kredytowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `remembered_logins`
--

CREATE TABLE `remembered_logins` (
  `token_hash` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `remembered_logins`
--

INSERT INTO `remembered_logins` (`token_hash`, `user_id`, `expires_at`) VALUES
('1206e6d61a2230e8939594fdb4ebbf57c43440669d24661191549fb88b22e3af', 9, '2023-09-27 18:54:01'),
('8eda8f906e2276f953629d8ffd08b9cb2df4a988f27880dac60468bf69e6af8d', 10, '2023-06-30 19:01:43'),
('c62e8abdb6fef7232c999550df4e8d9b22a9841c1a2319a5156be3a681f1cf3c', 9, '2023-06-30 18:58:54');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password_reset_hash` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `password_reset_expires_at` datetime DEFAULT NULL,
  `activation_hash` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`) VALUES
(9, 'Aneta', 'aneta.plaga@gmail.com', '$2y$10$/xgkoLF/BGxpawuymXVb2elssz/c4pjMpeQyPe0wOivjLhpQS89Cy', '2190c9706b5d30cdf4a07f16b4526a378fc3da99944329345545668a0ce20532', '2023-07-03 22:06:43', NULL, 1),
(12, 'Janek', 'jan@damaszke.pl', '$2y$10$4iBDqZcyRYcHizYGEya92eQ0DvoZx1Lc3U0voFfxY94usYDevfhNW', NULL, NULL, '7f72951f2551a50c47ee3af01775239c79b872b0e7bc730fb0d848e8ffff28c7', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses_category_assigned_to_users`
--
ALTER TABLE `expenses_category_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes_category_assigned_to_users`
--
ALTER TABLE `incomes_category_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_methods_assigned_to_users`
--
ALTER TABLE `payment_methods_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD PRIMARY KEY (`token_hash`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_hash` (`password_reset_hash`),
  ADD UNIQUE KEY `activation_hash` (`activation_hash`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_assigned_to_users`
--
ALTER TABLE `expenses_category_assigned_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_assigned_to_users`
--
ALTER TABLE `incomes_category_assigned_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_assigned_to_users`
--
ALTER TABLE `payment_methods_assigned_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
