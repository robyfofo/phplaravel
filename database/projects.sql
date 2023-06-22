-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 22, 2023 alle 09:03
-- Versione del server: 8.0.33-0ubuntu0.22.04.2
-- Versione PHP: 8.1.2-1ubuntu2.11

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
-- Struttura della tabella `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` mediumint NOT NULL DEFAULT '0',
  `completato` mediumint NOT NULL DEFAULT '0',
  `costo_orario` double(8,2) DEFAULT NULL,
  `ordering` mediumint NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `projects`
--

INSERT INTO `projects` (`id`, `title`, `content`, `status`, `completato`, `costo_orario`, `ordering`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Progetto 1', 'aaa', 1, 1, NULL, 2, 1, '2023-06-20 11:06:21', '2023-06-20 12:16:21'),
(2, 'Progetto 2', 'wwewe', 2, 10, NULL, 3, 1, '2023-06-20 11:06:48', '2023-06-20 11:06:48'),
(3, 'sdsd', 'dsdsd', 1, 1, NULL, 1, 1, '2023-06-20 12:14:00', '2023-06-20 12:14:00'),
(5, 'qwqw', 'qwqw', 1, 45, NULL, 4, 1, '2023-06-20 12:23:37', '2023-06-20 12:29:11');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
