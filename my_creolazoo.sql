-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 02, 2020 alle 12:08
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_creolazoo`
--
CREATE DATABASE IF NOT EXISTS `my_creolazoo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_creolazoo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `ID_Art` int(10) UNSIGNED NOT NULL,
  `Data_Art` date NOT NULL,
  `Ora_Art` time NOT NULL,
  `Autore_Art` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `ID_Att` int(10) UNSIGNED NOT NULL,
  `Nome_Att` varchar(45) NOT NULL,
  `Descrizione_Att` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
  `IDGr_C` int(10) UNSIGNED NOT NULL,
  `Nome_C` varchar(10) NOT NULL,
  `NomeIst_C` varchar(30) NOT NULL,
  `CittaIst_C` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `ID_Com` int(10) UNSIGNED NOT NULL,
  `IDArt_Com` int(10) UNSIGNED NOT NULL,
  `Data_Com` date NOT NULL,
  `Ora_Com` time NOT NULL,
  `Autore_Com` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppo`
--

CREATE TABLE `gruppo` (
  `ID_Gr` int(10) UNSIGNED NOT NULL,
  `NumPers_Gr` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `istituto`
--

CREATE TABLE `istituto` (
  `Nome_Ist` varchar(30) NOT NULL,
  `Citta_Ist` char(2) NOT NULL,
  `Indirizzo_Ist` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazione`
--

CREATE TABLE `partecipazione` (
  `IDGr_P` int(10) UNSIGNED NOT NULL,
  `IDAtt_P` int(10) UNSIGNED NOT NULL,
  `Data_P` date NOT NULL,
  `Ora_P` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ticket`
--

CREATE TABLE `ticket` (
  `ID_T` int(11) NOT NULL,
  `Nominativo_T` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Username_Ut` varchar(20) NOT NULL,
  `Password_Ut` varchar(20) NOT NULL,
  `Nome_Ut` varchar(20) NOT NULL,
  `Cognome_Ut` varchar(20) NOT NULL,
  `Mail_Ut` varchar(45) NOT NULL,
  `DataN_Ut` date NOT NULL,
  `Tipologia_Ut` enum('Amministratore','Utente','Accompagnatore') NOT NULL DEFAULT 'Utente'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Username_Ut`, `Password_Ut`, `Nome_Ut`, `Cognome_Ut`, `Mail_Ut`, `DataN_Ut`, `Tipologia_Ut`) VALUES
('admin', 'admin', 'Admin', 'Admin', 'admin@admin.zoo', '1997-11-30', 'Amministratore'),
('utente', 'utente', 'utente', 'utente', 'utente@utente.zoo', '1997-12-14', 'Utente'),
('prova', 'prova', 'prova', 'prova', 'prova@prova.zoo', '1991-01-01', 'Utente');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenteaccompagnatore`
--

CREATE TABLE `utenteaccompagnatore` (
  `UsernameUt_UA` varchar(20) NOT NULL,
  `IDGr_UA` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`ID_Art`),
  ADD UNIQUE KEY `ID_Art` (`ID_Art`),
  ADD KEY `Autore_Art` (`Autore_Art`);

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`ID_Att`);

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`IDGr_C`),
  ADD KEY `NomeIst_C` (`NomeIst_C`,`CittaIst_C`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`ID_Com`,`IDArt_Com`),
  ADD KEY `Autore_Com` (`Autore_Com`);

--
-- Indici per le tabelle `gruppo`
--
ALTER TABLE `gruppo`
  ADD PRIMARY KEY (`ID_Gr`);

--
-- Indici per le tabelle `istituto`
--
ALTER TABLE `istituto`
  ADD PRIMARY KEY (`Nome_Ist`,`Citta_Ist`);

--
-- Indici per le tabelle `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`IDAtt_P`,`IDGr_P`),
  ADD KEY `IDGr_P` (`IDGr_P`);

--
-- Indici per le tabelle `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID_T`),
  ADD KEY `Nominativo_T` (`Nominativo_T`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Username_Ut`),
  ADD UNIQUE KEY `Mail_Ut` (`Mail_Ut`);

--
-- Indici per le tabelle `utenteaccompagnatore`
--
ALTER TABLE `utenteaccompagnatore`
  ADD PRIMARY KEY (`UsernameUt_UA`),
  ADD KEY `IDGr_UA` (`IDGr_UA`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `ID_Art` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `ID_Att` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `ID_Com` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `gruppo`
--
ALTER TABLE `gruppo`
  MODIFY `ID_Gr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID_T` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
