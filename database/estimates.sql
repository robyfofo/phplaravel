-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ago 03, 2023 alle 10:21
-- Versione del server: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplaravel`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `estimates`
--

CREATE TABLE `estimates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thirdparty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dateins` date DEFAULT NULL,
  `datesca` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `alt_thirdparty` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `estimates`
--

INSERT INTO `estimates` (`id`, `user_id`, `thirdparty_id`, `dateins`, `datesca`, `note`, `content`, `alt_thirdparty`, `active`, `created_at`, `updated_at`) VALUES
(10, 2, 1, '2023-07-02', '2023-07-31', 'Note preventivo 1', 'Contenuto preventivo', 'Altro indirizzo aaa', 1, '2023-07-27 12:42:27', '2023-07-27 13:03:24');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimates_user_id_index` (`user_id`),
  ADD KEY `estimates_thirdparty_id_index` (`thirdparty_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `estimates`
--
ALTER TABLE `estimates`
  ADD CONSTRAINT `estimates_thirdparty_id_foreign` FOREIGN KEY (`thirdparty_id`) REFERENCES `thirdparties` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `estimates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
