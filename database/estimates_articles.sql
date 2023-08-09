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
-- Struttura della tabella `estimates_articles`
--

CREATE TABLE `estimates_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estimate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `quantity` smallint(6) NOT NULL DEFAULT 0,
  `price_unity` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `estimates_articles`
--

INSERT INTO `estimates_articles` (`id`, `estimate_id`, `note`, `content`, `quantity`, `price_unity`) VALUES
(16, 10, 'ARTICOLO 1', 'Il articolo 1', 2, 20.00),
(17, 10, 'ssd', 'sdssd', 3, 10.00);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `estimates_articles`
--
ALTER TABLE `estimates_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimates_articles_estimate_id_index` (`estimate_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `estimates_articles`
--
ALTER TABLE `estimates_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `estimates_articles`
--
ALTER TABLE `estimates_articles`
  ADD CONSTRAINT `estimates_articles_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
