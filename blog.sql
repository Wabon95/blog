-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 16 jan. 2021 à 00:01
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

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
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` int(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `slug`, `content`, `author`, `created_at`) VALUES
(1, 'Un autre titre', 'un-autre-titre', 'Un autre contenu', 1, '2020-10-06 09:29:37'),
(2, 'Un autre titre2', 'un-autre-titre2', 'Un autre contenu2', 1, '2020-10-06 09:30:04'),
(3, 'Un titre alacon', 'un-titre-alacon', 'un contenu a la con', 1, '2020-10-06 10:06:54'),
(4, 'Un tiiiiiitre', 'un-tiiiiiitre', 'Un contenuuuuuu', 1, '2020-10-06 10:07:11'),
(5, 'un tiiitre', 'un-tiiitre', 'un contenuuu', 1, '2020-10-06 10:14:47'),
(6, 'un tiiitre', 'un-tiiitre', 'un contenuuu', 1, '2020-10-06 10:17:19'),
(7, 'un tiiitre', 'un-tiiitre', 'un contenuuu', 1, '2020-10-06 10:18:40'),
(8, 'un tiiitre', 'un-tiiitre', 'un contenuuu', 1, '2020-10-06 10:19:09'),
(9, 'un tiiitre', 'un-tiiitre', 'un contenuuu', 1, '2020-10-06 10:20:11'),
(10, 'Un titre d\'article test apres l\'ajout des auteur', 'un-titre-d-article-test-apres-l-ajout-des-auteur', 'Contenuuuuu', 1, '2021-01-15 23:53:20');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `nickname`, `password`) VALUES
(1, 'dbonaglia95@protonmail.com', 'Wabon', '$2y$10$C8ynMLq.U8WSIdaOlF7Lue6H2Pcqt.jb19qfe7N0Jgqd8MvqSelXO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
