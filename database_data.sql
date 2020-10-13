--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `nickname`, `password`) VALUES
(0, 'dbonaglia95@protonmail.com', 'Wabon', '$2y$10$C8ynMLq.U8WSIdaOlF7Lue6H2Pcqt.jb19qfe7N0Jgqd8MvqSelXO');
COMMIT;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `slug`, `content`, `created_at`) VALUES
(8, 'Je suis le titre de l\'article', 'je-suis-le-titre-de-l-article', 'Je suis le contenu de l\'article', '2020-10-05 18:52:04'),
(9, 'Un autre titre', 'un-autre-titre', 'Un autre contenu', '2020-10-06 09:29:37'),
(10, 'Un autre titre2', 'un-autre-titre2', 'Un autre contenu2', '2020-10-06 09:30:04'),
(11, 'Un titre alacon', 'un-titre-alacon', 'un contenu a la con', '2020-10-06 10:06:54'),
(12, 'Un tiiiiiitre', 'un-tiiiiiitre', 'Un contenuuuuuu', '2020-10-06 10:07:11'),
(13, 'un tiiitre', 'un-tiiitre', 'un contenuuu', '2020-10-06 10:14:47'),
(14, 'un tiiitre', 'un-tiiitre', 'un contenuuu', '2020-10-06 10:17:19'),
(15, 'un tiiitre', 'un-tiiitre', 'un contenuuu', '2020-10-06 10:18:40'),
(16, 'un tiiitre', 'un-tiiitre', 'un contenuuu', '2020-10-06 10:19:09'),
(17, 'un tiiitre', 'un-tiiitre', 'un contenuuu', '2020-10-06 10:20:11'),
(18, 'Un titre d\'un article rÃ©digÃ© depuis le site lui mÃªme', 'un-titre-d-un-article-rÃ©digÃ©-depuis-le-site-lui-mÃªme', 'Le contenu de ce mÃªme article', '2020-10-06 10:43:28');