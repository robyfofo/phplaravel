-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Lug 14, 2023 alle 09:43
-- Versione del server: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.1.2-1ubuntu2.13

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
-- Struttura della tabella `timecards`
--

CREATE TABLE `timecards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `dateins` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `worktime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `timecards`
--

INSERT INTO `timecards` (`id`, `user_id`, `project_id`, `content`, `dateins`, `starttime`, `endtime`, `worktime`) VALUES
(1, 1, 1, 'Lavorazione', '2023-07-07', '16:00:00', '17:00:00', '01:00:00'),
(2, 2, 2, 'Laravel', '2023-06-12', '15:00:00', '17:00:00', '02:00:00'),
(3, 1, 2, 'Prova', '2023-07-05', '16:00:00', '18:00:00', '02:00:00'),
(4, 1, 4, 'aaaaa', '2023-07-12', '09:00:00', '18:00:00', '01:00:00'),
(5, 1, 4, 'aaaaa', '2023-07-12', '09:00:00', '18:00:00', '01:00:00'),
(6, 1, 4, 'sss', '2023-07-16', '09:00:00', '18:00:00', '09:00:00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `timecards`
--
ALTER TABLE `timecards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timecards_user_id_index` (`user_id`),
  ADD KEY `timecards_project_id_index` (`project_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `timecards`
--
ALTER TABLE `timecards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `timecards`
--
ALTER TABLE `timecards`
  ADD CONSTRAINT `timecards_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `timecards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
