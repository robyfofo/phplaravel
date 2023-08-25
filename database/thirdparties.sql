-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ago 25, 2023 alle 10:45
-- Versione del server: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.2.9

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
-- Struttura della tabella `thirdparties`
--

CREATE TABLE `thirdparties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city_alt` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `provincia_alt` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `ragione_sociale` varchar(255) DEFAULT NULL,
  `partita_iva` varchar(255) DEFAULT NULL,
  `codice_fiscale` varchar(255) DEFAULT NULL,
  `pec` varchar(255) DEFAULT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_nations_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_cities_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `thirdparties`
--

INSERT INTO `thirdparties` (`id`, `categories_id`, `name`, `surname`, `street`, `city_alt`, `zip_code`, `provincia_alt`, `email`, `telephone`, `mobile`, `ragione_sociale`, `partita_iva`, `codice_fiscale`, `pec`, `sid`, `active`, `created_at`, `updated_at`, `location_nations_id`, `location_province_id`, `location_cities_id`) VALUES
(5, NULL, 'Roberto', 'Mantovani', 'Hollywood Blv', 'Pasadina', '234567', 'California', 'roberto@domain.org', '123456789', NULL, 'Robyfofo srl', '1234567890', '1234567890', 'me@pec.robertomantovani.vr.it', '1234567', 1, NULL, '2023-08-24 13:08:48', 211, NULL, NULL),
(6, NULL, 'Mauro', 'Mantovani', 'Via Garofoli 302', NULL, '37057', NULL, 'mauro@domain.org', '+39045548841', '+39045548844', 'Mauro srl', '1234567890', '1234567890', 'mauro.pec@domain.org', '123456', 1, '2023-08-24 13:16:24', '2023-08-24 13:16:24', 116, 23, 6242);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `thirdparties`
--
ALTER TABLE `thirdparties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thirdparties_email_unique` (`email`),
  ADD KEY `thirdparties_categories_id_index` (`categories_id`),
  ADD KEY `thirdparties_location_nations_id_index` (`location_nations_id`),
  ADD KEY `thirdparties_location_province_id_index` (`location_province_id`),
  ADD KEY `thirdparties_location_cities_id_index` (`location_cities_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `thirdparties`
--
ALTER TABLE `thirdparties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `thirdparties`
--
ALTER TABLE `thirdparties`
  ADD CONSTRAINT `thirdparties_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `thirdparties_categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `thirdparties_location_cities_id_foreign` FOREIGN KEY (`location_cities_id`) REFERENCES `location_cities` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `thirdparties_location_nations_id_foreign` FOREIGN KEY (`location_nations_id`) REFERENCES `location_nations` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `thirdparties_location_province_id_foreign` FOREIGN KEY (`location_province_id`) REFERENCES `location_province` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
