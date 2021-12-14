-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 13 oct. 2021 à 11:19
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_webproject`
--
DROP DATABASE IF EXISTS db_webproject;
CREATE DATABASE IF NOT EXISTS `db_webproject` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_webproject`;

-- --------------------------------------------------------

--
-- Structure de la table `t_author`
--

CREATE TABLE `t_author` (
  `idAuthor` tinyint(1) UNSIGNED NOT NULL,
  `autLastName` varchar(50) NOT NULL,
  `autFirstName` varchar(50) NOT NULL,
  `autBirthDate` date DEFAULT NULL,
  `autDeathDate` date DEFAULT NULL,
  `autNationality` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_author`
--

INSERT INTO `t_author` (`idAuthor`, `autLastName`, `autFirstName`, `autBirthDate`, `autDeathDate`, `autNationality`) VALUES
(1, 'Herbert', 'Frank Patrick', '1920-10-08', '1986-02-11', 'American'),
(2, 'Vargas', 'Fred', '1957-06-07', NULL, 'French'),
(3, 'Gaiman', 'Neil', '1960-11-10', NULL, 'English'),
(4, 'Stine', 'Robert Lawrence', '1943-10-08', NULL, 'American'),
(5, 'Smith', 'Patti', '1946-12-30', NULL, 'American');

-- --------------------------------------------------------

--
-- Structure de la table `t_book`
--

CREATE TABLE `t_book` (
  `idBook` tinyint(1) UNSIGNED NOT NULL,
  `booTitle` varchar(50) NOT NULL,
  `idCategory` tinyint(1) UNSIGNED NOT NULL,
  `idAuthor` tinyint(1) UNSIGNED NOT NULL,
  `idPublisher` tinyint(1) UNSIGNED NOT NULL,
  `booPublishingYear` year(4) NOT NULL,
  `booSummary` text NOT NULL,
  `booTeaser` text DEFAULT NULL,
  `booNumberOfPages` int(10) UNSIGNED NOT NULL,
  `booCover` varchar(100) DEFAULT NULL,
  `booReviewAverage` tinyint(3) UNSIGNED DEFAULT NULL,
  `booLanguage` varchar(50) DEFAULT NULL,
  `idUser` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_book`
--

INSERT INTO `t_book` (`idBook`, `booTitle`, `idCategory`, `idAuthor`, `idPublisher`, `booPublishingYear`, `booSummary`, `booTeaser`, `booNumberOfPages`, `booCover`, `booReviewAverage`, `booLanguage`, `idUser`) VALUES
(1, 'Dune', 1, 1, 1, 1965, 'Dune is set in the distant future amidst a feudal interstellar society in which various noble houses control planetary fiefs. It tells the story of young Paul Atreides, whose family accepts the stewardship of the planet Arrakis. While the planet is an inhospitable and sparsely populated desert wasteland, it is the only source of melange, or \"the spice,\" a drug that extends life and enhances mental abilities. Melange is also necessary for space navigation, which requires a kind of multidimensional awareness and foresight that only the drug provides. As melange can only be produced on Arrakis, control of the planet is thus a coveted and dangerous undertaking. The story explores the multilayered interactions of politics, religion, ecology, technology, and human emotion, as the factions of the empire confront each other in a struggle for the control of Arrakis and its spice.', 'I must not fear. Fear is the mind-killer. Fear is the little-death that brings total obliteration. I will face my fear. I will permit it to pass over me and through me. And when it has gone past I will turn the inner eye to see its path. Where the fear has gone there will be nothing. Only I will remain.', 412, 'Dune.jpg', NULL, 'English', 1),
(2, 'Have mercy on us all (Pars vite et reviens tard)', 2, 2, 2, 2001, 'Joss, a middle-aged former Breton sailor, begins to succeed in reviving the old family trade of town crier in modern-day Paris. Business is good, since people gladly pay five francs to hear their rants and nonsensical messages in parks and squares; every so often, ominous cryptic messages announcing the return of the plague will also be part of the day\'s requested cries.\r\n\r\nAt the same time, chief inspector Adamsberg is surprised as a distressed woman describes that all her apartment building\'s doors, except one, have been marked with a large inverted \"4\" in black ink with the inscription \"CLT.\" This graffiti continues to turn up throughout the city, and residents of apartments with unmarked doors are turning up dead, showing signs of rat-flea bites and blackened flesh.\r\n\r\nInspector Adamsberg must lead an investigation that takes him through a juxtaposition of 15th-century Europe and modern-day France...or does he?', '', 346, 'HaveMercyOnUsAll.jpg', NULL, 'French', 1),
(3, 'Norse Mythology', 3, 3, 3, 2017, 'In Norse Mythology, Gaiman stays true to the myths in envisioning the major Norse pantheon: Odin, the highest of the high, wise, daring, and cunning; Thor, Odin\'s son, incredibly strong yet not the wisest of gods; and Loki - son of a giant - blood brother to Odin and a trickster and unsurpassable manipulator.', '', 304, 'NorseMythology.jpg', 2, 'English', 1),
(4, 'Goosebumps : Welcome to dead house', 4, 4, 4, 1992, 'The book follows Amanda and Josh Benson, who move with their parents into a creepy old house located in the strange town of Dark Falls where people are unlike any they have known before.', '', 128, 'WelcomeToDeadHouse.jpg', 3, 'English', 1),
(5, 'Just Kids', 5, 5, 5, 2010, 'Just Kids tells of the bond between two people forged during an innocent time that changed both of their lives. When they met, they were young naïve children. Over time, they grew up into successful adults who together helped shape an entire artistic era.', '', 278, 'JustKids.jpg', 5, 'English', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` tinyint(1) UNSIGNED NOT NULL,
  `catName` varchar(50) NOT NULL,
  `catDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`, `catDescription`) VALUES
(1, 'Science Fiction', 'Science fiction (sometimes shortened to sci-fi or SF) is a genre of speculative fiction that typically deals with imaginative and futuristic concepts such as advanced science and technology, space exploration, time travel, parallel universes, and extraterrestrial life. It has been called the \"literature of ideas\", and it often explores the potential consequences of scientific, social, and technological innovations.'),
(2, 'Crime Fiction', 'Crime fiction, detective story, murder mystery, mystery novel, and police novel are terms used to describe narratives that centre on criminal acts and especially on the investigation, either by an amateur or a professional detective, of a serious crime, generally a murder.'),
(3, 'Fantasy', 'Fantasy is a genre of speculative fiction set in a fictional universe, often inspired by real world myth and folklore. Its roots are in oral traditions, which then became fantasy literature and drama. Fantasy is distinguished from the genres of science fiction and horror by the respective absence of scientific or macabre themes, though these genres overlap. In popular culture, the fantasy genre predominantly features settings of a medieval nature. In its broadest sense, however, fantasy consists of works by many writers, artists, filmmakers, and musicians from ancient myths and legends to many recent and popular works.'),
(4, 'Horror', 'Horror is a genre of speculative fiction which is intended to frighten, scare, or disgust. Literary historian J. A. Cuddon defined the horror story as \"a piece of fiction in prose of variable length... which shocks, or even frightens the reader, or perhaps induces a feeling of repulsion or loathing\". Horror intends to create an eerie and frightening atmosphere for the reader.'),
(5, 'Memoir', 'A memoir is any nonfiction narrative writing based in the author\'s personal memories. The assertions made in the work are thus understood to be factual. While memoir has historically been defined as a subcategory of biography or autobiography since the late 20th century, the genre is differentiated in form, presenting a narrowed focus.');

-- --------------------------------------------------------

--
-- Structure de la table `t_commentary`
--

CREATE TABLE `t_commentary` (
  `idCommentary` tinyint(1) UNSIGNED NOT NULL,
  `comText` text NOT NULL,
  `comDate` date NOT NULL,
  `idReview` tinyint(1) UNSIGNED NOT NULL,
  `idUser` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_publisher`
--

CREATE TABLE `t_publisher` (
  `idPublisher` tinyint(1) UNSIGNED NOT NULL,
  `pubName` varchar(50) NOT NULL,
  `pubCreationDate` year(4) DEFAULT NULL,
  `pubCountry` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_publisher`
--

INSERT INTO `t_publisher` (`idPublisher`, `pubName`, `pubCreationDate`, `pubCountry`) VALUES
(1, 'Chilton Company', 1904, 'United States of America'),
(2, 'Editions Viviane Hamy', 1989, 'France'),
(3, 'Bloomsbury Publishing', 1986, 'England'),
(4, 'Scholastic Corporation', 1920, 'United States of America'),
(5, 'Ecco Press', 1971, 'United States of America');

-- --------------------------------------------------------

--
-- Structure de la table `t_review`
--

CREATE TABLE `t_review` (
  `idReview` tinyint(1) UNSIGNED NOT NULL,
  `revScore` tinyint(3) UNSIGNED NOT NULL,
  `idBook` tinyint(1) UNSIGNED NOT NULL,
  `idUser` tinyint(1) UNSIGNED NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` tinyint(1) UNSIGNED NOT NULL,
  `useName` varchar(50) NOT NULL,
  `usePassword` varchar(60) NOT NULL,
  `useRights` int(5) NOT NULL DEFAULT '0',
  `useEntryDate` date DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `useName`, `usePassword`, `useRights`, `useEntryDate`) VALUES
(1, 'alazax', '$2y$10$LC8jv.hDfyZ9/9ejJZUVGO./XqHNnUMSIelLrZtmQt6slSmTTztgW', 0,'2021-12-10'),
(2, 'jobot', '$2y$10$LC8jv.hDfyZ9/9ejJZUVGO./XqHNnUMSIelLrZtmQt6slSmTTztgW', 1, '2021-12-10'),
(3, 'stary', '$2y$10$LC8jv.hDfyZ9/9ejJZUVGO./XqHNnUMSIelLrZtmQt6slSmTTztgW', 0, '2021-12-10'),
(4, 'risa', '$2y$10$LC8jv.hDfyZ9/9ejJZUVGO./XqHNnUMSIelLrZtmQt6slSmTTztgW', 0, '2021-12-10'),
(9, 'admin', '$2y$10$LC8jv.hDfyZ9/9ejJZUVGO./XqHNnUMSIelLrZtmQt6slSmTTztgW', 1, '2021-12-10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_author`
--
ALTER TABLE `t_author`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Index pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `fkCategory` (`idCategory`),
  ADD KEY `fkAuthor` (`idAuthor`),
  ADD KEY `fkPublisher` (`idPublisher`),
  ADD KEY `fkBookAddedBy` (`idUser`);

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_commentary`
--
ALTER TABLE `t_commentary`
  ADD PRIMARY KEY (`idCommentary`),
  ADD KEY `fkReview` (`idReview`),
  ADD KEY `fkUser` (`idUser`);

--
-- Index pour la table `t_publisher`
--
ALTER TABLE `t_publisher`
  ADD PRIMARY KEY (`idPublisher`);

--
-- Index pour la table `t_review`
--
ALTER TABLE `t_review`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `fkBook` (`idBook`),
  ADD KEY `fkUser` (`idUser`);


--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_author`
--
ALTER TABLE `t_author`
  MODIFY `idAuthor` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_commentary`
--
ALTER TABLE `t_commentary`
  MODIFY `idCommentary` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_publisher`
--
ALTER TABLE `t_publisher`
  MODIFY `idPublisher` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_review`
--
ALTER TABLE `t_review`
  MODIFY `idReview` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD CONSTRAINT `fkAuthor` FOREIGN KEY (`idAuthor`) REFERENCES `t_author` (`idAuthor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkBookAddedBy` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkCategory` FOREIGN KEY (`idCategory`) REFERENCES `t_category` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkPublisher` FOREIGN KEY (`idPublisher`) REFERENCES `t_publisher` (`idPublisher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_commentary`
--
ALTER TABLE `t_commentary`
  ADD CONSTRAINT `fkReview` FOREIGN KEY (`idReview`) REFERENCES `t_review` (`idReview`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_review`
--
ALTER TABLE `t_review`
  ADD CONSTRAINT `fkBook` FOREIGN KEY (`idBook`) REFERENCES `t_book` (`idBook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUserReview` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
