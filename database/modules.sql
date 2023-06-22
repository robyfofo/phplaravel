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
-- Struttura della tabella `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `code_menu` text COLLATE utf8mb4_unicode_ci,
  `ordering` mediumint NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `modules`
--

INSERT INTO `modules` (`id`, `name`, `label`, `alias`, `content`, `code_menu`, `ordering`, `active`, `created_at`, `updated_at`) VALUES
(1, 'modules', 'Moduli', 'modules', 'Il Modulo che gestisce i moduli', '{\"name\":\"%NAME%\",\"icon\":\"<i class=\\\"menu-icon tf-icons bx bx-cog\\\"><\\/i>\",\"label\":\"%LABEL%\"}', 3, 1, '2023-06-19 06:25:09', '2023-06-20 05:43:14'),
(2, 'projects', 'Progetti', 'projects', 'Il modulo che gestisce i progetti', '{\"name\":\"%NAME%\",\"icon\":\"<i class=\\\"menu-icon tf-icons bx bx-pyramid\\\"><\\/i>\",\"label\":\"%LABEL%\"}', 2, 1, '2023-06-19 06:25:49', '2023-06-20 05:46:08'),
(3, 'users', 'Utenti', 'users', 'Il modulo che gestisce gli utenti', '{\"name\":\"%NAME%\",\"icon\":\"<i class=\\\"menu-icon tf-icons bx bx-user\\\"><\\/i>\",\"label\":\"%LABEL%\"}', 1, 1, '2023-06-21 05:52:08', '2023-06-21 05:54:15');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
