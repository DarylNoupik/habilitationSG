-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 18 avr. 2023 à 07:19
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `habilitation-db`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actions_application_id_foreign` (`application_id`),
  KEY `actions_nom_index` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Amplitude', 'Application de corps banking', '2023-04-11 08:13:34', '2023-04-11 08:13:34'),
(2, 'OCRE', 'Application', '2023-04-10 08:14:38', '2023-04-11 08:14:38'),
(3, 'Jira', 'ticketing', '2023-04-13 13:01:49', '2023-04-13 13:01:49'),
(4, 'Outlook', 'Messagerie', '2023-04-13 13:03:42', '2023-04-13 13:03:42'),
(5, 'Genero', 'Genero', '2023-04-13 13:05:36', '2023-04-13 13:05:36'),
(6, 'Omega', 'Omega', '2023-04-13 13:06:53', '2023-04-13 13:06:53');

-- --------------------------------------------------------

--
-- Structure de la table `application_fonction`
--

DROP TABLE IF EXISTS `application_fonction`;
CREATE TABLE IF NOT EXISTS `application_fonction` (
  `fonction_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`fonction_id`,`application_id`),
  KEY `application_fonction_fonction_id_index` (`fonction_id`),
  KEY `application_fonction_application_id_index` (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `application_fonction`
--

INSERT INTO `application_fonction` (`fonction_id`, `application_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(6, 1),
(7, 6),
(8, 3),
(9, 3),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 6),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(15, 1),
(15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `application_user`
--

DROP TABLE IF EXISTS `application_user`;
CREATE TABLE IF NOT EXISTS `application_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`application_id`),
  KEY `application_user_user_id_index` (`user_id`),
  KEY `application_user_application_id_index` (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `application_user`
--

INSERT INTO `application_user` (`user_id`, `application_id`) VALUES
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(23, 1),
(23, 2),
(23, 3),
(23, 4),
(24, 1),
(25, 1),
(25, 2),
(25, 3),
(25, 4),
(25, 5),
(25, 6),
(28, 1),
(28, 2),
(28, 3),
(28, 4),
(28, 5),
(28, 6),
(29, 5),
(32, 5),
(33, 5);

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

DROP TABLE IF EXISTS `departements`;
CREATE TABLE IF NOT EXISTS `departements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departements_direction_id_foreign` (`direction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `direction_id`, `created_at`, `updated_at`) VALUES
(1, 'MOYENS GENERAUX\r\n', 1, '2023-04-10 16:26:22', '2023-04-10 16:23:22');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

DROP TABLE IF EXISTS `directions`;
CREATE TABLE IF NOT EXISTS `directions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'DIRECTION GENERALE\r\n', '2023-04-10 16:23:06', '2023-04-10 16:23:06');

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
CREATE TABLE IF NOT EXISTS `equipements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fonctions_service_id_foreign` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `fonctions`
--

INSERT INTO `fonctions` (`id`, `nom`, `service_id`, `created_at`, `updated_at`) VALUES
(5, 'Buiness', 1, '2023-04-11 17:01:10', '2023-04-11 17:01:10'),
(6, 'dasc', 1, '2023-04-11 17:23:56', '2023-04-11 17:23:56'),
(7, 'sasas', 1, '2023-04-11 17:24:06', '2023-04-11 17:24:06'),
(8, 'cas', 1, '2023-04-11 17:24:16', '2023-04-11 17:24:16'),
(9, 'tass', 1, '2023-04-11 17:24:32', '2023-04-11 17:24:32'),
(12, 'Commercant', 1, '2023-04-12 12:25:24', '2023-04-12 12:25:24'),
(13, 'test', 1, '2023-04-12 13:41:50', '2023-04-12 13:41:50'),
(14, 'dax', 1, '2023-04-12 13:42:08', '2023-04-12 13:42:08'),
(15, 'ass', 1, '2023-04-12 13:42:18', '2023-04-12 13:42:18'),
(16, 'dascu', 1, '2023-04-12 13:42:53', '2023-04-12 13:42:53'),
(17, 'qsd', 1, '2023-04-12 13:43:14', '2023-04-12 13:43:14');

-- --------------------------------------------------------

--
-- Structure de la table `fonction_actions`
--

DROP TABLE IF EXISTS `fonction_actions`;
CREATE TABLE IF NOT EXISTS `fonction_actions` (
  `fonction_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`fonction_id`,`action_id`),
  KEY `fonction_actions_fonction_id_index` (`fonction_id`),
  KEY `fonction_actions_action_id_index` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_04_05_000001_create_directions_table', 1),
(3, '2023_04_05_000002_create_departements_table', 1),
(4, '2023_04_05_000003_create_services_table', 1),
(5, '2023_04_05_000004_create_fonctions_table', 1),
(6, '2023_04_05_000005_create_equipements_table', 1),
(7, '2023_04_05_000006_create_applications_table', 1),
(8, '2023_04_05_000007_create_users_table', 1),
(9, '2023_04_05_000008_create_password_resets_table', 1),
(10, '2023_04_05_000009_create_failed_jobs_table', 1),
(11, '2023_04_05_000011_create_actions_table', 1),
(12, '2023_04_05_000012_create_table_application_user', 1),
(13, '2023_04_05_000013_create_table_application_fonction', 1),
(14, '2023_04_05_000014_create_fonction_actions_table', 1),
(15, '2023_04_05_000015_create_user_equipement_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_departement_id_foreign` (`departement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `departement_id`, `created_at`, `updated_at`) VALUES
(1, 'ACHATS\r\n', 1, '2023-04-10 16:27:33', '2023-04-10 16:27:33');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','rssi','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `fonction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_matricule_unique` (`matricule`),
  UNIQUE KEY `users_password_unique` (`password`),
  KEY `users_fonction_id_foreign` (`fonction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `matricule`, `password`, `phone`, `location`, `about_me`, `role`, `fonction_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daryl', 'test@test.gmail', 'ag881845', '$2y$10$S2oDJOh7FYLnEQDByY/zTOuyRohSUPwmDGIDP7QZwGdi5txWbcuGq', 55, '78', '78', 'user', 15, NULL, '2023-04-06 14:46:30', '2023-04-08 08:30:49'),
(2, 'Vivien Lebsack', 'jenkins.bernice@example.com', 'zh0Pzl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'user', 5, 'vLraVcOQOl', '2023-04-07 16:07:24', '2023-04-07 16:07:24'),
(5, 'Hope Batz', 'laisha.stokes@example.org', 'GbHAQR', 'NDz2Rf5KER', NULL, NULL, NULL, 'user', 5, 'IpbrrQhjlk', '2023-04-07 16:09:49', '2023-04-07 16:09:49'),
(6, 'Archibald Douglas', 'amy59@example.com', 'bbAVaO', 'AHFMH1e29h', NULL, NULL, NULL, 'user', 5, 'nCYnV6nLpl', '2023-04-07 16:09:56', '2023-04-07 16:09:56'),
(7, 'Prof. Sonny Schaefer', 'mschuppe@example.org', 'fgOxoB', 'okEtm5L9aC', NULL, NULL, NULL, 'user', 5, 'pFtbk014cY', '2023-04-07 16:09:56', '2023-04-07 16:09:56'),
(8, 'Rodolfo Reinger', 'rubye39@example.net', 'S3kiny', 'Fd6I7EElZT', NULL, NULL, NULL, 'user', 5, 'Jqv28Qr42L', '2023-04-07 16:09:56', '2023-04-07 16:09:56'),
(9, 'Mr. Matt Cruickshank', 'xschoen@example.com', 'jVkhhV', 'pCK8Wq7NDq', NULL, NULL, NULL, 'user', 5, 'aScWwYaIFw', '2023-04-07 16:09:56', '2023-04-07 16:09:56'),
(10, 'Paige Nader', 'jason.hansen@example.com', 'PfqiVu', '0J6jhPxPC2', NULL, NULL, NULL, 'user', 5, 'ZmzgGDDzlk', '2023-04-07 16:09:56', '2023-04-07 16:09:56'),
(11, 'Mr. Nelson Cartwright Sr.', 'wcrooks@example.org', 'sRVrsh', '5t2DJs5Ide', NULL, NULL, NULL, 'user', 5, 'BhpwjAUXjl', '2023-04-07 16:09:59', '2023-04-07 16:09:59'),
(12, 'Geovanny Johnson', 'oma.schiller@example.com', 'f1pSUy', 'HRbleqQJjl', NULL, NULL, NULL, 'user', 5, '7swqQHDii9', '2023-04-07 16:09:59', '2023-04-07 16:09:59'),
(13, 'Laisha Blick', 'kevon.ward@example.org', 'mXDpbw', 'oXE0RI9LJN', NULL, NULL, NULL, 'user', 5, 'vQf0BfCmSj', '2023-04-07 16:09:59', '2023-04-07 16:09:59'),
(14, 'Dalton Kerluke', 'audie62@example.net', '1nq4wA', '4lFczsn5zp', NULL, NULL, NULL, 'user', 5, 'yw8lC9NR1I', '2023-04-07 16:09:59', '2023-04-07 16:09:59'),
(15, 'Tyrique McKenzie', 'zkshlerin@example.net', 'ugC5G7', 'cYBKgXmUSF', NULL, NULL, NULL, 'user', 8, 'SIUIL1rIeF', '2023-04-07 16:09:59', '2023-04-07 16:09:59'),
(16, 'Junior', 'test@test.gmail.com', 'ag881847', '$2y$10$1FUqoyI3COjObstVcT4TCu2jB13NXvJ0eDxJccQE75Mg0/j8jclCy', NULL, NULL, NULL, 'admin', 12, NULL, '2023-04-13 09:17:51', '2023-04-13 09:17:51'),
(18, 'jordan', 'test@admin1.com', 'ag881848', '$2y$10$AkdxM2URYyE8hUUVPIw7n.7kYY4VCo9Do5AlTKxeJk3FjSLVBMCb2', NULL, NULL, NULL, 'user', 12, NULL, '2023-04-13 10:06:28', '2023-04-13 10:06:28'),
(20, 'Rose', 'test@test3.gmail', 'ag881849', '$2y$10$8VtsP4IOwuhiuzoDSaLewuR2AkuH5ZXUPp5zGvZk2t7y7YEmdf7y2', NULL, NULL, NULL, 'user', 13, NULL, '2023-04-13 10:24:31', '2023-04-13 10:24:31'),
(21, 'Ethan', 'ethan@gmail.com', 'ag881844', '$2y$10$Nxa1DD.aFg4qWe6RD37YkuOMaRPlbPOe8NSmIKuIf0w2bDTts6IWO', NULL, NULL, NULL, 'user', 5, NULL, '2023-04-13 21:09:07', '2023-04-13 21:09:07'),
(23, 'Dan', 'dan@blue.gn', 'ag881870', '$2y$10$NrrWx5uKaJ1r/rrNCPNeSOmYog76zSZY6pBvO.wK.8mKAHHMcdSxm', NULL, NULL, NULL, 'admin', 5, NULL, '2023-04-13 21:14:17', '2023-04-13 21:14:17'),
(24, 'glan', 'glan@gmail.com', 'ag881823', '$2y$10$03vk1oinJOVFFOJzAgAdduqicBpX63e0USRp4wAn4E97fCQv1OJ5e', NULL, NULL, NULL, 'user', 12, NULL, '2023-04-13 21:17:32', '2023-04-13 21:17:32'),
(25, 'Auklin', 'auklin@gmail.com', 'ag881877', '$2y$10$PrZfb1kQtDz63J8ew/t7Tu2Y0vXbCO0R5GKVvVW/FfV5D15nfqpN2', NULL, NULL, NULL, 'user', 5, NULL, '2023-04-14 10:40:18', '2023-04-14 10:40:18'),
(26, 'leila', 'leila@gmail.com', 'ag881689', '$2y$10$KhNy21i86qYk/Ixx0dyvYOkveSgmc.5TDne3R7OUBpQPt4.xYe.ja', NULL, NULL, NULL, 'user', 12, NULL, '2023-04-17 15:40:35', '2023-04-17 15:40:35'),
(28, 'leila2', 'leila2@gmail.com', 'ag881692', '$2y$10$GORmKjlGM6x7OisBDFJpTObX1KC4f5M/BGT14eMe/pK4NQ71hifD2', NULL, NULL, NULL, 'user', 12, NULL, '2023-04-17 15:50:35', '2023-04-17 15:50:35'),
(29, 'tata', 'tatue.fabrice@gmail.com', 'ag881830', '$2y$10$t5IL5eXFEzm5GGnIBQf2WeGabsCZTFabt31T0z17hRLTcSfmHDwX2', NULL, NULL, NULL, 'user', 14, NULL, '2023-04-17 15:52:20', '2023-04-17 15:52:20'),
(32, 'tata23', 'tatue2.fabrice@gmail.com', 'ag881820', '$2y$10$825Yqgaw7Xz9TqPHFd9JZOczewLsLIG535C4ukRn.J4QDScEI8dju', NULL, NULL, NULL, 'rssi', 14, NULL, '2023-04-17 15:54:20', '2023-04-17 15:54:20'),
(33, 'tata2323', 'tatue1.fabrice@gmail.com', 'ag881810', '$2y$10$kzmPQ4MVGgb3KOYqIdXs4OXKvrCNPlDB5FlmRK9HfgKpSsPOmPF5i', NULL, NULL, NULL, 'rssi', 14, NULL, '2023-04-17 15:55:23', '2023-04-17 15:55:23');

-- --------------------------------------------------------

--
-- Structure de la table `user_equipement`
--

DROP TABLE IF EXISTS `user_equipement`;
CREATE TABLE IF NOT EXISTS `user_equipement` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `equipement_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`equipement_id`),
  KEY `user_equipement_user_id_index` (`user_id`),
  KEY `user_equipement_equipement_id_index` (`equipement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `application_fonction`
--
ALTER TABLE `application_fonction`
  ADD CONSTRAINT `application_fonction_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_fonction_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `application_user`
--
ALTER TABLE `application_user`
  ADD CONSTRAINT `application_user_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fonctions`
--
ALTER TABLE `fonctions`
  ADD CONSTRAINT `fonctions_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fonction_actions`
--
ALTER TABLE `fonction_actions`
  ADD CONSTRAINT `fonction_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fonction_actions_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_equipement`
--
ALTER TABLE `user_equipement`
  ADD CONSTRAINT `user_equipement_equipement_id_foreign` FOREIGN KEY (`equipement_id`) REFERENCES `equipements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_equipement_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
