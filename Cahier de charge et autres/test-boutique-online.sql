-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 07 juin 2024 à 01:11
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test-boutique-online`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(4, 'HIKSON', 'hikson@gmail.com', '$2y$10$rxyNLcUrMaV7EF4AQSueweBo08QQEWI7gEb6Wn.XBJthC8oB1Spq2');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `nom_client` varchar(100) NOT NULL,
  `adresse_livraison` varchar(255) NOT NULL,
  `email_client` varchar(255) NOT NULL,
  `mode_paiement` varchar(50) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `nom_client`, `adresse_livraison`, `email_client`, `mode_paiement`, `date_commande`) VALUES
(1, 'TALERANT HIKWOULBO', '00:08:22:e1:0F.55', 'hiksonthebadboy@gmail.com', 'paypal', '2024-05-24 10:08:49'),
(29, 'TALERANT HIKWOULBO', 'Bini', 'hiksonthebadboy@gmail.com', 'paypal', '2024-06-06 22:46:48');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `email`, `mot_de_passe`, `adresse`, `telephone`, `date_inscription`) VALUES
(2, 'HIKSON', 'hikson@gmail.com', '$2y$10$rSOSdbx5nHm32xnAv0eKLeRJ4VccjAq6os4Ez6vIHiQRcEck.md8m', NULL, NULL, '2024-05-23 13:38:27'),
(24, 'senghor', 'amedesainkor@gmail.com', '$2y$10$u5.B2wAHEj619ufpB7uQvuTwDyiFHMWYSD9raOwd5Fif1VUCZlbA6', NULL, NULL, '2024-06-06 09:32:35'),
(25, 'Kouyahbe', 'kouyahbepd@gmail.com', '$2y$10$R7RlBGvYFwXM3UjIYqlnY.vpFV277wVA8/tvyNOUooT37NfmT8ALC', NULL, NULL, '2024-06-06 09:33:35'),
(26, 'yabo', 'yab@gmail.com', '$2y$10$qZBppPI.GeW3tqh0RHUqMO2jGJv92hOPnoarvCbo3iZjvbh3pFhY.', NULL, NULL, '2024-06-06 09:35:39'),
(27, 'Bedji', 'moitangaradolphe@gmail.com', '$2y$10$qT2JyF0E05AIJngtFlm2be.iEzYjM8NoeFklFwQZHn47wH0qQdaB6', NULL, NULL, '2024-06-06 09:36:01'),
(30, 'jostha', 'mbaihogaoudjedouboumjosaphat@gmail.com', '$2y$10$TGACJ3Ot23.l9/8z7q/0GOvrcGD.WBljp0fhZpdr/UA8scq2uzn.e', NULL, NULL, '2024-06-06 09:40:51'),
(31, 'Yantelka Yabo ', 'yaboyantelka@gmail.com', '$2y$10$GJcklehFLO5gFBQAATFke.mGoigm0eCUC6hVMVujC0hVk2oC3.xUe', NULL, NULL, '2024-06-06 09:42:54'),
(32, 'HIKWOULBO', 'talerant@gmail.com', '$2y$10$xrNqmf2VDZqlNec7YAG8PO/KCG.qR/Ku65cnqpBgHRAROMTgCWlZe', NULL, NULL, '2024-06-06 23:00:30');

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `livreur_id` int(11) NOT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'En attente',
  `date_livraison` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `livraisons`
--

INSERT INTO `livraisons` (`id`, `commande_id`, `livreur_id`, `statut`, `date_livraison`) VALUES
(1, 1, 1, 'Livrée', '2024-05-27 09:52:42'),
(2, 2, 1, 'En cours de livraison', '2024-05-27 09:56:33'),
(28, 1, 1, 'En attente', '2024-06-06 21:39:42'),
(29, 1, 2, 'En cours de livraison', '2024-06-06 22:27:10'),
(30, 29, 2, 'Livrée', '2024-06-06 22:47:39');

-- --------------------------------------------------------

--
-- Structure de la table `livreurs`
--

CREATE TABLE `livreurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `livreurs`
--

INSERT INTO `livreurs` (`id`, `nom`, `email`, `mot_de_passe`, `telephone`, `date_inscription`) VALUES
(1, 'TALERANT HIKWOULBO', 'hiksontalerant@gmail.com', '$2y$10$z6Vhe22USxmA9M7u4CfBIeACd2ILHc/SDMFeVl0aTwp0UdNstkkc.', '+237699156551', '2024-05-27 09:30:46'),
(2, 'livreur', 'livreur@gmail.com', '$2y$10$pOdjP5HT/oe5ER46QPdhxOvzKcL7SSqKrV4YLYoT/Ws2UaEGoaBHe', '+237699156551', '2024-05-27 10:18:29'),
(3, 'kopade', 'kouyahbekpd@gmail.com', '$2y$10$.fTobh97iiPTfhMgukDsSu0uU.fSYOhq/xM.46fblUL0TyIusBYKO', '+237657233593', '2024-05-27 11:42:08'),
(6, 'Pauline', 'pauline@gmail.com', '$2y$10$zGcfBbWny/Gt.KkPz9LF1Om1weNXCAHbseFpzibZCKWvgqjyFKkVa', '6545456', '2024-06-06 23:03:07');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `fournisseur_id`, `nom`, `description`, `prix`, `stock`, `date_creation`, `date_modification`, `image`) VALUES
(9, 1, 'savon', 'savon liquide', 500.00, 500, '2024-05-23 18:59:22', '2024-05-23 18:59:22', 'issets/Chicken-shawarma_-4.jpg'),
(10, 1, 'gateau anniversaire', 'Meilleur Gateau d\'anniverssaire', 3000.00, 200, '2024-05-23 19:01:37', '2024-05-23 19:01:37', 'issets/template.png'),
(12, 2, 'Fruit', 'Fruit du sud', 200.00, 100, '2024-05-23 19:28:00', '2024-05-23 19:28:00', 'issets/tomate-1.jpg'),
(13, 2, 'Spaguetti', 'La meilleur qualité de spagueti', 300.00, 50, '2024-05-23 19:29:34', '2024-05-23 19:29:34', 'issets/spaghetti-1.jpg'),
(14, 2, 'Alvéoles', 'Découvrez les oeufs des dindons', 3000.00, 70, '2024-05-23 19:34:13', '2024-05-23 19:34:13', 'issets/oeuf-1.jpg'),
(15, 2, 'Huile', 'Huile Mayor trés bonne qualité', 2500.00, 100, '2024-05-23 19:34:59', '2024-05-23 19:34:59', 'issets/huile-1.jpg'),
(22, 1, 'Alimentattion', 'Tres bonne alimentation', 2455.00, 7865, '2024-05-24 10:54:05', '2024-05-24 10:54:05', 'issets/alimentation-3.jpg'),
(32, 26, 'TOMATO', 'New', 10.00, 10000, '2024-06-06 09:41:58', '2024-06-06 09:41:58', 'issets/tomate-1.jpg'),
(33, 24, 'riz ', 'riz bisou. 25kg la meilleur qualité et savoureux', 1500.00, 300, '2024-06-06 09:44:32', '2024-06-06 09:44:32', 'issets/AA.jpg'),
(35, 30, 'lait', 'votre lait est déjà disponible en quantité', 5000.00, 30, '2024-06-06 09:47:10', '2024-06-06 09:47:10', 'issets/lait-1.jpg'),
(37, 26, 'Chocolat', 'New', 50.00, 1000, '2024-06-06 09:48:26', '2024-06-06 09:48:26', 'issets/chocolat-1.jpg'),
(38, 26, 'Riz', 'New', 70.00, 500, '2024-06-06 09:51:17', '2024-06-06 09:51:17', 'issets/riz-1.jpg'),
(39, 30, 'huile', 'le huile dispo dans notre boutiaue ', 1500.00, 40, '2024-06-06 09:52:48', '2024-06-06 09:52:48', 'issets/huile-2.jpg'),
(40, 26, 'Spaghetti', 'New', 10.00, 400, '2024-06-06 09:53:47', '2024-06-06 09:53:47', 'issets/spaghetti-2.jpg'),
(44, 24, 'chocolat', 'la meileure qualité de chocolat fait à base de cacao', 12000.00, 20, '2024-06-06 10:00:14', '2024-06-06 10:00:14', 'issets/chocolat-1.jpg'),
(45, 30, 'oeuf', 'les gros oeufs sont déjà à votre disposition, vous pouvez passer vos commandes dès maintenant', 2500.00, 100, '2024-06-06 10:02:16', '2024-06-06 10:02:16', 'issets/oeuf-1.jpg'),
(47, 2, 'Chocolat', 'Chocolat du Tchad', 24.00, 123, '2024-06-06 22:57:31', '2024-06-06 22:57:31', 'issets/chocolat-1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `expire_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `livreur_id` (`livreur_id`);

--
-- Index pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fournisseur_id` (`fournisseur_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `fournisseur_id` (`fournisseur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `livreurs`
--
ALTER TABLE `livreurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
