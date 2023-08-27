-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 27 août 2023 à 19:52
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `video_center_prenom_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230703103504', '2023-07-03 10:38:43', 194),
('DoctrineMigrations\\Version20230703115550', '2023-07-03 11:58:15', 210),
('DoctrineMigrations\\Version20230708150244', '2023-07-08 15:04:04', 126),
('DoctrineMigrations\\Version20230822155512', '2023-08-23 11:17:00', 48),
('DoctrineMigrations\\Version20230823090722', '2023-08-23 11:17:00', 63),
('DoctrineMigrations\\Version20230826165102', '2023-08-26 18:52:46', 444),
('DoctrineMigrations\\Version20230826170618', '2023-08-26 19:09:32', 39),
('DoctrineMigrations\\Version20230827085444', '2023-08-27 10:56:30', 52);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  `is_verified` tinyint(1) NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`, `is_verified`, `image_name`, `image_size`) VALUES
(1, 'metuselandagijimana@gmail.com', '[]', '$2y$13$Yv18M7XuFk9GgtYHvjepQOEKCZUT0.o2Kiv4Lk5.kZ4Rv7F5FLo8m', 'NDAGIJIMANA', 'Metusela', '2023-08-25 00:09:00', '2023-08-25 00:09:00', 1, 'image3.jpg', NULL),
(2, 'nihorimberejeanine4@gmail.com', '[]', '$2y$13$Rb2dWSzbbF8aXU3y6Q7Kbew.uOJVefTXj8DoS.l8cbsmsLkdiSpPm', 'NIHORIMBERE', 'Jeanine', '2023-08-25 00:16:32', '2023-08-25 00:16:32', 1, 'image3.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int NOT NULL,
  `premium_video` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29AA6432A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id`, `title`, `video_link`, `description`, `created_at`, `updated_at`, `user_id`, `premium_video`) VALUES
(2, 'Umutaka', 'https://www.youtube.com/embed/wIhEAJ0NV5o', 'Album Vestine et Dorcas', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 2, 0),
(3, 'Tabita', 'https://www.youtube.com/embed/icGTeVtG1T8', 'Chorale teramisha de kiremba', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 1, 0),
(4, 'Bénédiction', 'https://www.youtube.com/embed/AF9_En5RCy8', 'L\'enfant:une  bénédiction', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 1, 0),
(5, 'Un vrai ami', 'https://www.youtube.com/embed/z6UgA9Njm5g', 'J\'ai trouvé en jésus l\'ami qui est toute chose', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 2, 0),
(6, 'Louange', 'https://www.youtube.com/embed/soBsCcShsgA', 'Dieu mélitte des louanges', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 1, 0),
(7, 'Je me rappelle', 'https://www.youtube.com/embed/MD3dNs6fJ3I', 'N\'ait jamais oublié de jésus', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 1, 0),
(8, 'Bon combat', 'https://www.youtube.com/embed/MtjUcCA5qJA', 'J\'ai combattu le bon combat', '2023-08-23 11:17:00', '2023-08-23 11:17:00', 2, 0),
(9, 'Préducation', 'https://www.youtube.com/embed/65VzcSAFb5M', 'Par pasteur Munezero', '2023-08-27 20:34:17', '2023-08-27 20:34:17', 1, 1),
(10, 'Evengelisation', 'https://www.youtube.com/embed/3OM8wW6VQkE&t=2659s', 'Par Pasteur Prosper', '2023-08-27 20:36:32', '2023-08-27 20:36:32', 1, 1),
(11, 'comedy', 'https://www.youtube.com/embed/XqfR4wP4f3g', 'Comédien Papa sava', '2023-08-27 20:39:25', '2023-08-27 20:39:25', 1, 1),
(12, 'Témoignage', 'https://www.youtube.com/embed/M6YD_3kxf6U', 'Témoignage de Théogene', '2023-08-27 20:43:23', '2023-08-27 20:43:23', 2, 1),
(13, 'Cantique', 'https://www.youtube.com/embed/4RjmtL7nmw0', 'Cantique  orginal', '2023-08-27 20:46:55', '2023-08-27 20:46:55', 2, 1),
(14, 'Mon ame', 'https://www.youtube.com/embed/ZYrL9ea1XUg', 'It Is Well with My Soul', '2023-08-27 20:49:23', '2023-08-27 20:49:23', 2, 1),
(15, 'La grandeur', 'https://www.youtube.com/embed/BllDD7zpHbg', 'How Great Thou Art', '2023-08-27 20:51:28', '2023-08-27 20:51:28', 2, 1),
(16, 'Adoration', 'https://www.youtube.com/embed/3ZtPFP3Yjnw', 'Choral Nyakabiga', '2023-08-27 20:55:24', '2023-08-27 20:55:24', 1, 0),
(18, 'SHALOM', 'https://www.youtube.com/embed/UWhViPQz2zI', 'URAVUGA BIKABA BY SHALOM', '2023-08-27 21:00:06', '2023-08-27 21:00:06', 2, 0),
(19, 'ELAYONO', 'https://www.youtube.com/embed/mAK9E4dewSg', 'IMIRIMO BY ELAYONO CHOIR', '2023-08-27 21:03:37', '2023-08-27 21:03:37', 2, 0),
(20, 'URATASHYE', 'https://www.youtube.com/embed/mpGiTgS4Pds', 'URATASHYE BY ELAYONO CHOI', '2023-08-27 21:06:01', '2023-08-27 21:06:01', 2, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `FK_29AA6432A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
