-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2023 alle 20:37
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `viewer` text NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`viewer`, `text`, `time`) VALUES
('giaqqqq', 'bello', '2023-05-29 16:38:15'),
('melone', 'Mai visto niente del genere', '2023-05-29 07:16:09'),
('test', 'Ei, io sono un test', '2023-05-29 18:31:20');

-- --------------------------------------------------------

--
-- Struttura della tabella `spettacoli`
--

CREATE TABLE `spettacoli` (
  `Id` int(11) NOT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `spettacoli`
--

INSERT INTO `spettacoli` (`Id`, `Data`) VALUES
(1, '2023-04-23'),
(8, '2023-05-26');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `password`, `email`) VALUES
('giaqqqq', '$2y$10$hC9yMHDo5KagR01sBuO.V.2e03y1l5.fmwUTvRIl1bHBd7rpDAhkS', 'giulio.giaquinta7@gmail.com'),
('melo', '$2y$10$T80gMzR1Y5OCh9oP5xVYy.RZyFHIQd8BKhtIuL7g7ziGj3uGYMOfW', 'meluccio@gmail.com'),
('melone', '$2y$10$vCBuY/MDK6osy4oWjjKpoef0YYado1VTAy8si8LP/hRE6.7.xYa2K', 'melo77@gmail.com'),
('test', '$2y$10$ZTWpUO83ti9dyaPEoGdzduTNtESC/RLnC7tNF2S3FoIWdnOlamxqa', 'test1@gmail.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`viewer`(10),`text`(100));

--
-- Indici per le tabelle `spettacoli`
--
ALTER TABLE `spettacoli`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Data` (`Data`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`(12)),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `spettacoli`
--
ALTER TABLE `spettacoli`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
