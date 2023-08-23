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

-- Listage des données de la table session.categorie : ~0 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'Bureautique'),
	(2, 'Développement front-end'),
	(3, 'Développement back-end'),
	(4, 'Infographie');

-- Listage des données de la table session.doctrine_migration_versions : ~1 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230823092458', '2023-08-23 09:25:08', 426);

-- Listage des données de la table session.formation : ~0 rows (environ)
INSERT INTO `formation` (`id`, `intitule`) VALUES
	(1, 'Développeur web et web mobile'),
	(2, 'Concepteur Développeur d\'Applications'),
	(3, 'Concepteur Design UI'),
	(4, 'Découverte numérique');

-- Listage des données de la table session.messenger_messages : ~0 rows (environ)

-- Listage des données de la table session.module : ~0 rows (environ)
INSERT INTO `module` (`id`, `categorie_id`, `intitule`) VALUES
	(1, 2, 'Maquettage d\'applications'),
	(2, 2, 'Réalisation d\'interfaces utilisateur web statiques et adaptables'),
	(3, 2, 'Développement d\'interfaces utilisateur web dynamiques'),
	(4, 3, 'Création de base de donnée'),
	(5, 3, 'Développement de composants d\'accès aux données'),
	(6, 3, 'Développement de la partie back-end d\'une application web ou web mobile'),
	(7, 3, 'Préparation et exécution de plans de tests d\'une application'),
	(8, 3, 'Préparation et exécution du déploiement d\'une application'),
	(9, 3, 'RGPD'),
	(10, 4, 'Réalisation d\'illustrations, graphismes, et visuels'),
	(11, 4, 'Conception d\'interfaces graphiques et prototypage'),
	(12, 4, 'Création de supports de communication'),
	(13, 1, 'Word'),
	(14, 1, 'Excel'),
	(15, 1, 'Outlook');

-- Listage des données de la table session.programme : ~44 rows (environ)
INSERT INTO `programme` (`id`, `session_id`, `module_id`, `nb_jours`) VALUES
	(1, 1, 1, 5),
	(2, 2, 1, 5),
	(3, 3, 1, 5),
	(4, 4, 1, 5),
	(5, 1, 2, 20),
	(6, 2, 2, 20),
	(7, 3, 2, 20),
	(8, 4, 2, 20),
	(9, 1, 3, 15),
	(10, 2, 3, 15),
	(11, 3, 3, 15),
	(12, 4, 3, 15),
	(13, 1, 4, 5),
	(14, 2, 4, 5),
	(15, 3, 4, 5),
	(16, 4, 4, 5),
	(17, 1, 5, 20),
	(18, 2, 5, 10),
	(19, 3, 5, 10),
	(20, 4, 5, 10),
	(21, 1, 6, 5),
	(22, 2, 6, 5),
	(23, 3, 6, 5),
	(24, 4, 6, 5),
	(25, 3, 7, 10),
	(26, 4, 7, 10),
	(27, 3, 8, 10),
	(28, 4, 8, 10),
	(29, 1, 9, 15),
	(30, 2, 9, 10),
	(31, 3, 9, 10),
	(32, 4, 9, 10),
	(33, 5, 10, 10),
	(34, 6, 10, 10),
	(35, 5, 11, 10),
	(36, 6, 11, 10),
	(37, 5, 12, 10),
	(38, 6, 12, 10),
	(39, 7, 13, 10),
	(40, 8, 13, 10),
	(41, 7, 14, 10),
	(42, 8, 14, 10),
	(43, 7, 15, 10),
	(44, 8, 15, 10);

-- Listage des données de la table session.session : ~8 rows (environ)
INSERT INTO `session` (`id`, `formation_id`, `nb_places`, `date_debut`, `date_fin`) VALUES
	(1, 1, 25, '2023-02-20 08:30:00', '2023-05-12 17:00:00'),
	(2, 1, 25, '2023-07-10 08:30:00', '2023-12-22 17:00:00'),
	(3, 2, 20, '2024-01-20 08:30:00', '2024-07-29 17:00:00'),
	(4, 2, 20, '2024-09-02 08:30:00', '2025-04-11 17:00:00'),
	(5, 3, 35, '2023-01-10 08:30:00', '2023-03-01 17:00:00'),
	(6, 3, 35, '2023-05-20 08:30:00', '2023-08-13 17:00:00'),
	(7, 4, 40, '2023-02-12 08:30:00', '2023-07-09 17:00:00'),
	(8, 4, 40, '2023-09-05 08:30:00', '2023-12-22 17:00:00');

-- Listage des données de la table session.session_stagiaire : ~10 rows (environ)
INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
	(1, 1),
	(1, 3),
	(3, 1),
	(3, 3),
	(4, 1),
	(4, 2),
	(5, 4),
	(6, 4),
	(7, 2),
	(8, 2);

-- Listage des données de la table session.stagiaire : ~4 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `courriel`, `date_naissance`, `ville`, `telephone`, `sexe`) VALUES
	(1, 'Ducounau', 'Charly', 'Charly.ducournau@outlook.fr', '2001-08-28 06:30:00', 'Strasbourg', '0629750614', 'Homme'),
	(2, 'Doe', 'John', 'john.doe@mail.fr', NULL, 'Colmar', '0611111111', NULL),
	(3, 'Fussler', 'Grégory', 'gregory.fussler@outlook.fr', '2001-11-26 05:50:14', 'Strasbourg', '0655948532', ''),
	(4, 'Urena', 'Ema', 'ema.urena@outlook.fr', '2001-06-26 00:01:30', 'Mulhouse', '0654765981', 'Femme');

-- Listage des données de la table session.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`) VALUES
	(1, 'charly@test.fr', '[]', '$2y$13$S3NZiBDtIE/Fwll9XrrHPOoelXmNzUqhk7XZI8hj8D9ZO/sEbwCEC', 'charly');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
