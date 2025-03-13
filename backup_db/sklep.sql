-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 31, 2024 at 07:58 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuly`
--

CREATE TABLE `artykuly` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `glowny_obraz` varchar(255) DEFAULT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_dodania` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artykuly`
--

INSERT INTO `artykuly` (`id`, `nazwa`, `opis`, `cena`, `slug`, `glowny_obraz`, `data_utworzenia`, `data_dodania`) VALUES
(1, 'Dior Sauvage Elixir 60ml edp', 'Dior Sauvage Elixir 60ml edp', 599.00, 'dior-sauvage-elixir-60ml-edp', '452916551_1509005316382358_8393214955710705190_n.jpg', '2024-07-30 14:26:39', '2024-07-31 13:36:14'),
(2, 'Nike Air Force 1', 'Nike Air Force 1', 549.00, 'nike-air-force-1', '41McuQ1wM4L._AC_.jpg', '2024-07-30 14:33:23', '2024-07-31 13:36:14'),
(3, 'Testowy produkt', 'Testowy produkt', 12.00, 'testowy-produkt', 'trends.jpg', '2024-07-30 14:36:40', '2024-07-31 13:36:14'),
(4, 'Blue de Chanel EDP', 'Blue de Chanel EDP', 98.99, 'blue-de-chanel-edp', 'p2.png', '2024-07-30 22:47:35', '2024-07-31 13:36:14'),
(5, 'Przykładowy produkt 1', 'Opis: Przykładowy produkt 1', 12.00, 'przyk-adowy-produkt-1', 'example.jpg', '2024-07-31 11:30:54', '2024-07-31 13:36:14'),
(6, 'Przykładowy produkt 2', 'Opis: Przykładowy produkt 2', 12.00, 'przyk-adowy-produkt-2', 'example.jpg', '2024-07-31 11:31:01', '2024-07-31 13:36:14'),
(7, 'Przykładowy produkt 3', 'Opis: Przykładowy produkt 3', 12.00, 'przyk-adowy-produkt-3', 'example.jpg', '2024-07-31 11:31:07', '2024-07-31 13:36:14'),
(8, 'Przykładowy produkt 4', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-4', 'example.jpg', '2024-07-31 11:31:12', '2024-07-31 13:36:14'),
(9, 'Przykładowy produkt 5', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-5', 'example.jpg', '2024-07-31 11:31:15', '2024-07-31 13:36:14'),
(10, 'Przykładowy produkt 6', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-6', 'example.jpg', '2024-07-31 11:31:18', '2024-07-31 13:36:14'),
(11, 'Przykładowy produkt 7', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-7', 'example.jpg', '2024-07-31 11:31:21', '2024-07-31 13:36:14'),
(12, 'Przykładowy produkt 8', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-8', 'example.jpg', '2024-07-31 11:31:24', '2024-07-31 13:36:14'),
(13, 'Przykładowy produkt 9', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-9', 'example.jpg', '2024-07-31 11:31:27', '2024-07-31 13:36:14'),
(14, 'Przykładowy produkt 10', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-10', 'example.jpg', '2024-07-31 11:31:30', '2024-07-31 13:36:14'),
(15, 'Przykładowy produkt 11', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-11', 'example.jpg', '2024-07-31 11:31:33', '2024-07-31 13:36:14'),
(16, 'Przykładowy produkt 12', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-12', 'example.jpg', '2024-07-31 11:31:35', '2024-07-31 13:36:14'),
(17, 'Przykładowy produkt 13', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-13', 'example.jpg', '2024-07-31 11:31:38', '2024-07-31 13:36:14'),
(18, 'Przykładowy produkt 14', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-14', 'example.jpg', '2024-07-31 11:31:41', '2024-07-31 13:36:14'),
(19, 'Przykładowy produkt 15', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-15', 'example.jpg', '2024-07-31 11:31:44', '2024-07-31 13:36:14'),
(20, 'Przykładowy produkt 16', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-16', 'example.jpg', '2024-07-31 11:31:49', '2024-07-31 13:36:14'),
(21, 'Przykładowy produkt 17', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-17', 'example.jpg', '2024-07-31 11:31:52', '2024-07-31 13:36:14'),
(22, 'Przykładowy produkt 18', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-18', 'example.jpg', '2024-07-31 11:31:55', '2024-07-31 13:36:14'),
(23, 'Przykładowy produkt 19', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-19', 'example.jpg', '2024-07-31 11:31:58', '2024-07-31 13:36:14'),
(24, 'Przykładowy produkt 20', 'Opis: Przykładowy produkt', 12.00, 'przyk-adowy-produkt-20', 'example.jpg', '2024-07-31 11:32:02', '2024-07-31 13:36:14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `artykul_id` int(11) NOT NULL,
  `komentarz` text NOT NULL,
  `ocena` int(11) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa_uzytkownika` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa_uzytkownika`, `haslo`, `email`, `data_utworzenia`) VALUES
(1, 'admin', '$2y$10$yshI0hnVXdDo60oORSWEruKv0vDaKjz6oCtFPNy84rZoxUk9Dnj36', 'ef3ko1@gmail.com', '2024-07-30 14:25:41');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `calkowita_cena` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_szczegoly`
--

CREATE TABLE `zamowienia_szczegoly` (
  `id` int(11) NOT NULL,
  `zamowienie_id` int(11) NOT NULL,
  `artykul_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_artykulow`
--

CREATE TABLE `zdjecia_artykulow` (
  `id` int(11) NOT NULL,
  `artykul_id` int(11) NOT NULL,
  `sciezka` varchar(255) NOT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artykuly`
--
ALTER TABLE `artykuly`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `artykul_id` (`artykul_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa_uzytkownika` (`nazwa_uzytkownika`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `zamowienia_szczegoly`
--
ALTER TABLE `zamowienia_szczegoly`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zamowienie_id` (`zamowienie_id`),
  ADD KEY `artykul_id` (`artykul_id`);

--
-- Indeksy dla tabeli `zdjecia_artykulow`
--
ALTER TABLE `zdjecia_artykulow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artykul_id` (`artykul_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artykuly`
--
ALTER TABLE `artykuly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zamowienia_szczegoly`
--
ALTER TABLE `zamowienia_szczegoly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zdjecia_artykulow`
--
ALTER TABLE `zdjecia_artykulow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `komentarze_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `komentarze_ibfk_2` FOREIGN KEY (`artykul_id`) REFERENCES `artykuly` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Constraints for table `zamowienia_szczegoly`
--
ALTER TABLE `zamowienia_szczegoly`
  ADD CONSTRAINT `zamowienia_szczegoly_ibfk_1` FOREIGN KEY (`zamowienie_id`) REFERENCES `zamowienia` (`id`),
  ADD CONSTRAINT `zamowienia_szczegoly_ibfk_2` FOREIGN KEY (`artykul_id`) REFERENCES `artykuly` (`id`);

--
-- Constraints for table `zdjecia_artykulow`
--
ALTER TABLE `zdjecia_artykulow`
  ADD CONSTRAINT `zdjecia_artykulow_ibfk_1` FOREIGN KEY (`artykul_id`) REFERENCES `artykuly` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
