-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 jun 2022 om 14:33
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `toernooi`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aanmelding`
--

CREATE TABLE `aanmelding` (
  `aanmeldingID` int(11) NOT NULL,
  `speler_ID` int(11) NOT NULL,
  `toernooi_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `aanmelding`
--

INSERT INTO `aanmelding` (`aanmeldingID`, `speler_ID`, `toernooi_ID`) VALUES
(7, 1, 6),
(11, 6, 6),
(14, 1, 1),
(15, 8, 8),
(16, 3, 8),
(19, 8, 1),
(29, 1, 10),
(30, 11, 10),
(31, 2, 10),
(32, 3, 10),
(33, 9, 8),
(34, 1, 2),
(35, 2, 2),
(36, 3, 2),
(38, 11, 1),
(39, 7, 1),
(40, 13, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scholen`
--

CREATE TABLE `scholen` (
  `schoolID` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `scholen`
--

INSERT INTO `scholen` (`schoolID`, `naam`) VALUES
(1, 'ROC Van Amsterdam'),
(2, 'ROC Van Rotterdam'),
(3, 'ROC Van Den Haag'),
(7, 'School uit spanje');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `spelers`
--

CREATE TABLE `spelers` (
  `spelerID` int(11) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(20) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `school_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `spelers`
--

INSERT INTO `spelers` (`spelerID`, `voornaam`, `tussenvoegsel`, `achternaam`, `school_ID`) VALUES
(1, 'Walid', '-', 'tanouyat', 1),
(2, 'John', '', 'Doe', 3),
(3, 'Jane', '', 'doe', 2),
(6, 'kleine ', '-', 'speler', 2),
(7, 'kleinere', '-', 'speler', 2),
(8, 'laptop', '', '002', 3),
(9, 'mark', 'andre', 'ter stegen', 2),
(11, 'sameer', '', 'bagheloe', 1),
(13, 'Rafael', '', 'Nadal', 1),
(14, 'voornaam', 'tussenvoegsel', 'Achternaam', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toernooien`
--

CREATE TABLE `toernooien` (
  `toernooiID` int(11) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `toernooien`
--

INSERT INTO `toernooien` (`toernooiID`, `omschrijving`, `datum`) VALUES
(1, 'Het Grote Leuke Tennis Toernooi', '2022-06-22'),
(2, 'Het Kleine Tennis Toernooi', '2022-06-24'),
(6, 'Torneo', '2022-06-20'),
(8, 'Gesloten toernooi', '2022-06-20'),
(10, 'Winter Toernooi 2018', '2018-12-31');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wedstrijd`
--

CREATE TABLE `wedstrijd` (
  `wedstrijdID` int(11) NOT NULL,
  `toernooi_ID` int(11) NOT NULL,
  `ronde` int(11) NOT NULL,
  `speler1ID` int(11) NOT NULL,
  `speler2ID` int(11) NOT NULL,
  `score1` int(11) NOT NULL,
  `score2` int(11) NOT NULL,
  `winnaarID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `wedstrijd`
--

INSERT INTO `wedstrijd` (`wedstrijdID`, `toernooi_ID`, `ronde`, `speler1ID`, `speler2ID`, `score1`, `score2`, `winnaarID`) VALUES
(3, 6, 1, 6, 3, 6, 2, 6),
(9, 8, 1, 8, 3, 3, 2, 8),
(16, 6, 1, 1, 6, 5, 3, 1),
(17, 6, 1, 1, 6, 5, 3, 1),
(34, 10, 1, 11, 1, 3, 22, 1),
(35, 10, 1, 2, 3, 12, 6, 2),
(36, 10, 2, 2, 1, 1, 24, 1),
(38, 8, 1, 9, 13, 1, 20, 13),
(39, 8, 2, 8, 13, 1, 33, 13);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `aanmelding`
--
ALTER TABLE `aanmelding`
  ADD PRIMARY KEY (`aanmeldingID`),
  ADD KEY `spelerid` (`speler_ID`),
  ADD KEY `toernooiid` (`toernooi_ID`);

--
-- Indexen voor tabel `scholen`
--
ALTER TABLE `scholen`
  ADD PRIMARY KEY (`schoolID`);

--
-- Indexen voor tabel `spelers`
--
ALTER TABLE `spelers`
  ADD PRIMARY KEY (`spelerID`),
  ADD KEY `schoolid` (`school_ID`);

--
-- Indexen voor tabel `toernooien`
--
ALTER TABLE `toernooien`
  ADD PRIMARY KEY (`toernooiID`);

--
-- Indexen voor tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD PRIMARY KEY (`wedstrijdID`),
  ADD KEY `speler1id` (`speler1ID`),
  ADD KEY `speler2id` (`speler2ID`),
  ADD KEY `toernooi` (`toernooi_ID`),
  ADD KEY `winnaarid` (`winnaarID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `aanmelding`
--
ALTER TABLE `aanmelding`
  MODIFY `aanmeldingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT voor een tabel `scholen`
--
ALTER TABLE `scholen`
  MODIFY `schoolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `spelers`
--
ALTER TABLE `spelers`
  MODIFY `spelerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `toernooien`
--
ALTER TABLE `toernooien`
  MODIFY `toernooiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  MODIFY `wedstrijdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `aanmelding`
--
ALTER TABLE `aanmelding`
  ADD CONSTRAINT `spelerid` FOREIGN KEY (`speler_ID`) REFERENCES `spelers` (`spelerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `toernooiid` FOREIGN KEY (`toernooi_ID`) REFERENCES `toernooien` (`toernooiID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `spelers`
--
ALTER TABLE `spelers`
  ADD CONSTRAINT `schoolid` FOREIGN KEY (`school_ID`) REFERENCES `scholen` (`schoolID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `wedstrijd`
--
ALTER TABLE `wedstrijd`
  ADD CONSTRAINT `speler1id` FOREIGN KEY (`speler1ID`) REFERENCES `spelers` (`spelerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `speler2id` FOREIGN KEY (`speler2ID`) REFERENCES `spelers` (`spelerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `toernooi` FOREIGN KEY (`toernooi_ID`) REFERENCES `toernooien` (`toernooiID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `winnaarid` FOREIGN KEY (`winnaarID`) REFERENCES `spelers` (`spelerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
