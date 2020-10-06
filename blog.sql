-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 06 oct. 2020 à 11:13
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `created_at`) VALUES
(8, 'Je suis le titre de l\'article', 'Je suis le contenu de l\'article', '2020-10-05 18:52:04'),
(9, 'Un autre titre', 'Un autre contenu', '2020-10-06 09:29:37'),
(10, 'Un autre titre2', 'Un autre contenu2', '2020-10-06 09:30:04'),
(11, 'Un titre alacon', 'un contenu a la con', '2020-10-06 10:06:54'),
(12, 'Un tiiiiiitre', 'Un contenuuuuuu', '2020-10-06 10:07:11'),
(13, 'un tiiitre', 'un contenuuu', '2020-10-06 10:14:47'),
(14, 'un tiiitre', 'un contenuuu', '2020-10-06 10:17:19'),
(15, 'un tiiitre', 'un contenuuu', '2020-10-06 10:18:40'),
(16, 'un tiiitre', 'un contenuuu', '2020-10-06 10:19:09'),
(17, 'un tiiitre', 'un contenuuu', '2020-10-06 10:20:11'),
(18, 'Un titre d\'un article rÃ©digÃ© depuis le site lui mÃªme', 'Le contenu de ce mÃªme article', '2020-10-06 10:43:28');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(6, 'dbonaglia95@protonmail.com', '$2y$10$YC61LXpV2q3cWEkKKQ8J9ezZLjwqO.xYvgfruF/3UGZqCQTbmb3E2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
