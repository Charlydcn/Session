-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour session
CREATE DATABASE IF NOT EXISTS `session` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `session`;

-- Listage de la structure de table session. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.categorie : ~4 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'Bureautique'),
	(2, 'Développement front-end'),
	(3, 'Développement back-end'),
	(4, 'Infographie');

-- Listage de la structure de table session. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table session.doctrine_migration_versions : ~1 rows (environ)

-- Listage de la structure de table session. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.formation : ~4 rows (environ)
INSERT INTO `formation` (`id`, `intitule`) VALUES
	(1, 'Développeur web et web mobile'),
	(2, 'Concepteur Développeur d\'Applications'),
	(3, 'Concepteur Design UI'),
	(4, 'Découverte numérique');

-- Listage de la structure de table session. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table session. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `intitule` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_jours` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C242628BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.module : ~15 rows (environ)
INSERT INTO `module` (`id`, `categorie_id`, `intitule`, `nb_jours`) VALUES
	(1, 2, 'Maquettage d\'applications', 5),
	(2, 2, 'Réalisation d\'interfaces utilisateur web statiques et adaptables', 20),
	(3, 2, 'Développement d\'interfaces utilisateur web dynamiques', 15),
	(4, 3, 'Création de base de donnée', 5),
	(5, 3, 'Développement de composants d\'accès aux données', 20),
	(6, 3, 'Développement de la partie back-end d\'une application web ou web mobile', 5),
	(7, 3, 'Préparation et exécution de plans de tests d\'une application', 10),
	(8, 3, 'Préparation et exécution du déploiement d\'une application', 15),
	(9, 3, 'RGPD', 2),
	(10, 4, 'Réalisation d\'illustrations, graphismes, et visuels', 10),
	(11, 4, 'Conception d\'interfaces graphiques et prototypage', 20),
	(12, 4, 'Création de supports de communication', 10),
	(13, 1, 'Word', 10),
	(14, 1, 'Excel', 10),
	(15, 1, 'Outlook', 10);

-- Listage de la structure de table session. module_session
CREATE TABLE IF NOT EXISTS `module_session` (
  `module_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`module_id`,`session_id`),
  KEY `IDX_7B3FEBCDAFC2B591` (`module_id`),
  KEY `IDX_7B3FEBCD613FECDF` (`session_id`),
  CONSTRAINT `FK_7B3FEBCD613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7B3FEBCDAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.module_session : ~44 rows (environ)
INSERT INTO `module_session` (`module_id`, `session_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4),
	(3, 1),
	(3, 2),
	(3, 3),
	(3, 4),
	(4, 1),
	(4, 2),
	(4, 3),
	(4, 4),
	(5, 1),
	(5, 2),
	(5, 3),
	(5, 4),
	(6, 1),
	(6, 2),
	(6, 3),
	(6, 4),
	(7, 3),
	(7, 4),
	(8, 3),
	(8, 4),
	(9, 1),
	(9, 2),
	(9, 3),
	(9, 4),
	(10, 5),
	(10, 6),
	(11, 5),
	(11, 6),
	(12, 5),
	(12, 6),
	(13, 7),
	(13, 8),
	(14, 7),
	(14, 8),
	(15, 7),
	(15, 8);

-- Listage de la structure de table session. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nb_places` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.session : ~0 rows (environ)
INSERT INTO `session` (`id`, `nb_places`, `date_debut`, `date_fin`) VALUES
	(1, 25, '2023-02-20 08:30:00', '2023-05-12 17:00:00'),
	(2, 25, '2023-07-10 08:30:00', '2023-12-22 17:00:00'),
	(3, 20, '2024-01-20 08:30:00', '2024-07-29 17:00:00'),
	(4, 20, '2024-09-02 08:30:00', '2025-04-11 17:00:00'),
	(5, 35, '2023-01-10 08:30:00', '2023-03-01 17:00:00'),
	(6, 35, '2023-05-20 08:30:00', '2023-08-13 17:00:00'),
	(7, 40, '2023-02-12 08:30:00', '2023-07-09 17:00:00'),
	(8, 40, '2023-09-05 08:30:00', '2023-12-22 17:00:00');

-- Listage de la structure de table session. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courriel` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.stagiaire : ~0 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `courriel`, `date_naissance`, `ville`, `telephone`, `sexe`) VALUES
	(1, 'Ducounau', 'Charly', 'Charly.ducournau@outlook.fr', '2001-08-28 06:30:00', 'Strasbourg', '0629750614', 'Homme'),
	(2, 'Doe', 'John', 'john.doe@mail.fr', '2000-01-01 01:01:01', 'Colmar', '0601100110', ''),
	(3, 'Fussler', 'Grégory', 'gregory.fussler@outlook.fr', '2001-11-26 05:50:14', 'Strasbourg', '0655948532', ''),
	(4, 'Urena', 'Ema', 'ema.urena@outlook.fr', '2001-06-26 00:01:30', 'Mulhouse', '0654765981', 'Femme');

-- Listage de la structure de table session. stagiaire_session
CREATE TABLE IF NOT EXISTS `stagiaire_session` (
  `stagiaire_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`session_id`),
  KEY `IDX_D32D02D4BBA93DD6` (`stagiaire_id`),
  KEY `IDX_D32D02D4613FECDF` (`session_id`),
  CONSTRAINT `FK_D32D02D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D32D02D4BBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.stagiaire_session : ~0 rows (environ)
INSERT INTO `stagiaire_session` (`stagiaire_id`, `session_id`) VALUES
	(1, 1),
	(1, 4),
	(2, 2),
	(2, 8),
	(3, 1),
	(3, 3),
	(4, 6);

-- Listage de la structure de table session. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.user : ~1 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`) VALUES
	(1, 'charly@test.fr', '["ROLE_ADMIN"]', '$2y$13$ucElr7RJdjOZ/5oEbI4e4ePHlsSQhrfv9eYidAmbXPTnXH05SRaJy', 'charly');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
