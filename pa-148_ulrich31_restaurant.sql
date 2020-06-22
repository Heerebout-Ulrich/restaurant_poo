-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 06 fév. 2020 à 10:47
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP :  7.3.6-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pa-148_ulrich31_restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(355) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `pseudo`, `email`, `password`) VALUES
(1, 'Ulrich', 'ulrich@homexity.fr', '$2y$10$.swdq7v6DBa4uGyigOzMDuytjPTXQWL4cEV4q7UN5ydbr7FuxzUu6');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `prix_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_user`, `date`, `prix_total`) VALUES
(18, 107, '2020-01-20 10:44:00', 79),
(19, 107, '2020-01-20 10:45:00', 73.6),
(20, 107, '2020-01-20 10:48:00', 49.6);

-- --------------------------------------------------------

--
-- Structure de la table `lignes_cmd`
--

CREATE TABLE `lignes_cmd` (
  `id_cmd` int(11) NOT NULL,
  `id_meal` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignes_cmd`
--

INSERT INTO `lignes_cmd` (`id_cmd`, `id_meal`, `quantite`, `prix_unit`) VALUES
(14, 2, 4, 9.8),
(14, 5, 4, 15),
(14, 3, 2, 12),
(15, 5, 1, 15),
(15, 3, 2, 12),
(16, 5, 1, 15),
(16, 2, 1, 9.8),
(17, 2, 5, 9.8),
(17, 5, 2, 15),
(18, 5, 2, 15),
(18, 2, 5, 9.8),
(19, 5, 2, 15),
(19, 2, 2, 9.8),
(19, 3, 2, 12),
(20, 2, 2, 9.8),
(20, 5, 2, 15);

-- --------------------------------------------------------

--
-- Structure de la table `meal`
--

CREATE TABLE `meal` (
  `id` int(11) NOT NULL,
  `name` varchar(355) COLLATE utf8_bin NOT NULL,
  `description` varchar(355) COLLATE utf8_bin NOT NULL,
  `prix` float NOT NULL,
  `photo` varchar(355) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `meal`
--

INSERT INTO `meal` (`id`, `name`, `description`, `prix`, `photo`) VALUES
(2, 'Lasagne', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 9.8, 'lasgnes-bolognaise.jpg'),
(3, 'Burger de Gambass', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua.', 12, 'burger-de-gambas.jpg'),
(5, 'Pizza Orientale', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 15, 'pizza-orientale.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `nb_couverts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `id_user`, `date`, `nb_couverts`) VALUES
(99, 107, '2020-10-15 15:20:00', 2),
(100, 107, '2020-10-15 15:20:00', 2),
(109, 107, '2020-10-18 10:20:00', 5),
(114, 107, '2020-12-10 10:10:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `code_postal` int(6) NOT NULL,
  `ville` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` varchar(15) COLLATE utf8_bin NOT NULL,
  `password` varchar(355) COLLATE utf8_bin NOT NULL,
  `naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `adresse`, `code_postal`, `ville`, `tel`, `password`, `naissance`) VALUES
(1, 'Ulrich', 'Heerebout', 'web@homexity.fr', '12 rue de Paris', 31780, 'paris', '0563396741', 'dsfsdfsdf', '1987-12-18'),
(100, 'SARL', 'HOMEXITY', 'webmm@homexity.fr', '990 route albias', 82800, 'Negrepelisse', '0563303155', '$2y$10$8pTGFqLDQEUFqA06gnoHbuovTqveIfNVUA3Il.X1JnbVavEijfxgy', '2020-01-01'),
(104, 'SARL', 'HOMEXITY', 'web@homexity.frggg', '990 route albias', 82800, 'Negrepelisse', '0563303155', '$2y$10$kCzXSODW1te2N9pfmx1KQemt1W1OBDRUQkJuXb3aWjvlGe3xu5VXy', '2020-01-01'),
(105, 'SARL', 'HOMEXITY', 'web@homexity.com', '990 route albias', 82800, 'Negrepelisse', '0563303155', '$2y$10$OCf24.Ks4tL/BvJ3ym/eTuiUQk4SZfC.HjHHsoUJCiTGe60Imv27K', '2020-01-01'),
(107, 'Heerebout', 'Ulrich', 'w@homexity.fr', '990 route albias', 82800, 'Negrepelisse', '0634473741', '$2y$10$bAnKlVOVUTx4GKRfu8oZFuMj7LkVV6El.MKe1OhP.HJ7P3Z9TMkci', '1987-01-01'),
(114, 'SARL', 'HOMEXITY', '33@yahoo.fr', '990 route albias', 82800, 'Negrepelisse', '0563303155', '$2y$10$CJIB/UaCiN0hoAKjBJNAJekhTYkSgKi8oUpTtpkf2LifspMFJUxAK', '2020-01-01'),
(116, 'chakour', 'leyla', 'chakour.leyla@gmail.com', 'gg', 123, 'paris', '6666', '$2y$10$KFnUpaq.PIiYYUjMgktgb.U5Wc/xGWOCz8o1ylDbY1tssfpvDUa9S', '2018-04-09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `lignes_cmd`
--
ALTER TABLE `lignes_cmd`
  ADD KEY `id_cmd` (`id_cmd`),
  ADD KEY `id_meal` (`id_meal`);

--
-- Index pour la table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
