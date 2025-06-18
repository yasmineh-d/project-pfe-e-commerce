-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 18 juin 2025 à 18:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `efm`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_Categories` int(10) UNSIGNED NOT NULL,
  `libelle_Categories` varchar(255) NOT NULL,
  `Description_Categories` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_Categories`, `libelle_Categories`, `Description_Categories`) VALUES
(1, 'Small Appliances', 'Discover our range of convenient small appliances like toasters, kettles, blenders, coffee makers, and food processors to make everyday tasks easier.'),
(2, 'Kitchen Appliances', 'Equip your kitchen with major appliances including refrigerators, freezers, ovens, cooktops, dishwashers, and microwaves for all your culinary needs.'),
(3, 'Laundry Appliances', 'Find efficient washing machines, dryers, and washer-dryer combos to take care of your laundry and keep your clothes fresh.'),
(4, 'Heating & Air Conditioning', 'Stay comfortable year-round with our heating and air conditioning solutions, including air conditioners, heaters, fans, and air purifiers.');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_Commande` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `email_Client` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

CREATE TABLE `detail` (
  `id_Detail` int(10) UNSIGNED NOT NULL,
  `id_Commande` int(10) UNSIGNED NOT NULL,
  `id_Product` int(10) UNSIGNED NOT NULL,
  `quantité` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `review` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_Produit` int(10) UNSIGNED NOT NULL,
  `libelle_Produit` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `Description_Produit` varchar(255) NOT NULL,
  `prix_de_vente` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_Categories` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_Produit`, `libelle_Produit`, `product_name`, `Description_Produit`, `prix_de_vente`, `image`, `id_Categories`) VALUES
(1, 'Aspirateur sans sac', 'CyclonePro 3000', 'Aspirateur puissant sans sac avec filtre HEPA', 899.00, 'images/Ventilador_Mini.png', 1),
(2, 'Purificateur d’air', 'AirPure Smart X5', 'Purificateur connecté avec capteur de qualité de l’air', 1199.00, 'purificateur.jpg', 1),
(3, 'Cafetière programmable', 'AromaBrew 12T', 'Cafetière programmable 12 tasses avec minuterie', 499.00, 'cafe.jpg', 2),
(4, 'Fer à repasser vapeur', 'SteamGlide Plus', 'Fer à vapeur avec semelle céramique anti-adhésive', 299.00, 'fer.jpg', 2),
(5, 'Mini lave-vaisselle', 'EcoWash Compact', 'Lave-vaisselle compact à faible consommation d’eau', 1599.00, 'lave-vaisselle.jpg', 3),
(6, 'Mixeur multifonction', 'KitchenMix Pro', 'Mixeur puissant pour smoothies, soupes et glaçons', 699.00, 'mixeur.jpg', 2),
(7, 'Ventilateur sur pied', 'CoolBreeze X2', 'Ventilateur réglable 3 vitesses avec télécommande', 349.00, 'ventilateur.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_Categories`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_Commande`),
  ADD KEY `email_Client` (`email_Client`);

--
-- Index pour la table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_Detail`),
  ADD KEY `id_Commande` (`id_Commande`),
  ADD KEY `id_Product` (`id_Product`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_Produit`),
  ADD KEY `id_Categories` (`id_Categories`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_Categories` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_Commande` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_Detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_Produit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`email_Client`) REFERENCES `client` (`email`);

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_Commande`) REFERENCES `commande` (`id_Commande`),
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_Product`) REFERENCES `produit` (`id_Produit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_Categories`) REFERENCES `categories` (`id_Categories`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
