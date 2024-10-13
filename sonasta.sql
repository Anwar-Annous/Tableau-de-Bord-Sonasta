-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Oct 13, 2024 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sonasta`
--

-- --------------------------------------------------------

--
-- Table structure for table `gestion_emp`
--

CREATE TABLE `gestion_emp` (
  `ID` int(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Tele` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Date_emb` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gestion_emp`
--

INSERT INTO `gestion_emp` (`ID`, `Photo`, `Nom`, `Email`, `Tele`, `Role`, `Date_emb`, `user`, `pass`) VALUES
(3, 'img/Employe3.jpg', 'Emily Johnson', 'emily.johnson@example.com', '+1122334455', 'Admin', '2024-03-10', 'emilyjohnson', 'password789'),
(4, 'img/Employe4.jpg', 'Michael Brown', 'michael.brown@example.com', '+1223344556', 'Employé', '2024-04-25', 'michaelbrown', 'password012'),
(5, 'img/Employe5.jpg', 'Sarah Davis11', 'sarah.davis@example.com', '+212607696960', 'Admin', '0000-00-00', 'sarahdavis', 'password345'),
(7, 'img/Employe7.jpg', 'David Smith', 'david.smith@example.com', '+1345678901', 'Chef-service', '2024-05-12', 'davidsmith', 'password567'),
(8, 'img/Employe8.jpg', 'Sophia Miller', 'sophia.miller@example.com', '+1456789012', 'Employé', '2024-06-03', 'sophiamiller', 'password891'),
(9, 'img/Employe9.jpg', 'James Wilson', 'james.wilson@example.com', '+1567890123', 'Chef-service', '2024-07-19', 'jameswilson', 'password234'),
(10, 'img/Employe10.jpg', 'Olivia Garcia', 'olivia.garcia@example.com', '+1678901234', 'Admin', '2024-08-05', 'oliviagarcia', 'password456'),
(11, 'img/Employe11.jpg', 'Liam Martinez', 'liam.martinez@example.com', '+1789012345', 'Employé', '2024-09-15', 'liammartinez', 'password678'),
(12, 'img/Employe12.jpg', 'Emma Lee', 'emma.lee@example.com', '+1890123456', 'Chef-service', '2024-10-01', 'emmalee', 'password890'),
(13, 'img/Employe13.jpg', 'Noah White', 'noah.white@example.com', '+1901234567', 'Employé', '2024-11-11', 'noahwhite', 'password1234'),
(14, 'img/Employe14.jpg', 'Ava Harris', 'ava.harris@example.com', '+2001234568', 'Admin', '2024-12-03', 'avaharris', 'password5678'),
(15, 'img/Employe15.jpg', 'William Clark', 'william.clark@example.com', '+2111234569', 'Chef-service', '2024-12-25', 'williamclark', 'password9101');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `diametre` varchar(50) DEFAULT NULL,
  `depot_stockage` varchar(255) DEFAULT NULL,
  `etat_actuel` enum('En stock','Rupture de stock') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `matiere`, `quantite`, `diametre`, `depot_stockage`, `etat_actuel`) VALUES
(17, 'Les plaquettes de freins', 100, '0.00', 'Depot A', 'En stock'),
(18, 'Huile', 200, '0.00', 'Depot B', 'En stock'),
(19, 'Les filtres', 150, '0.00', 'Depot A', 'En stock'),
(20, 'Demarreurs', 80, '0.00', 'Depot C', 'Rupture de stock'),
(21, 'Les batteries', 50, '0.00', 'Depot B', 'En stock'),
(22, 'Les feux rouges pompes (huile)', 30, '0.00', 'Depot D', 'En stock'),
(23, 'Turbo', 20, '0.00', 'Depot C', 'En stock'),
(24, 'Les reuli', 15, '0.00', 'Depot A', 'Rupture de stock'),
(25, 'Les fise', 10, '0.00', 'Depot B', 'En stock'),
(26, 'Suiglace', 40, '0.00', 'Depot D', 'En stock'),
(27, '12 volts', 25, '0.00', 'Depot A', 'En stock'),
(28, 'Poulet couroix', 60, '0.00', 'Depot B', 'En stock');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `ID` int(255) NOT NULL,
  `Nom_Machine` varchar(255) NOT NULL,
  `nbr_empg_annual` varchar(255) NOT NULL,
  `heur_sem` varchar(255) NOT NULL,
  `piece_dispo` varchar(255) NOT NULL,
  `etat_actual` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`ID`, `Nom_Machine`, `nbr_empg_annual`, `heur_sem`, `piece_dispo`, `etat_actual`) VALUES
(30, 'X-431 EURO TAB III', '10', '40', 'Câble OBD, Connecteur USB, Écran tactile', 'En-Service'),
(31, 'multimètre', '5', '35', 'Sondes, Fusibles, Batterie', 'En-Service'),
(32, 'les tornaux fice', '-', '20', 'Lames, Vis de serrage, Support métallique', 'Hors-Service'),
(33, 'pince coupante', '-', '-', 'Lames de rechange, Ressorts, Poignées', 'En-Service'),
(34, 'pince universelle', '-', '-', 'Ressorts, Poignées, Axe de rotation', 'Hors-Service'),
(35, 'clé à molette', '-', '-', 'Vis de réglage, Poignée, Tête ajustable', 'En-Service'),
(36, 'élévateur de voiture', '12', '40', 'Pompe hydraulique, Câbles, Rouleaux', 'Hors-Service');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_materials`
--

CREATE TABLE `maintenance_materials` (
  `id` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `diametre` varchar(50) NOT NULL,
  `depot_stockage` varchar(255) NOT NULL,
  `etat_actuel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_materials`
--

INSERT INTO `maintenance_materials` (`id`, `matiere`, `quantite`, `diametre`, `depot_stockage`, `etat_actuel`) VALUES
(1, 'Huile Moteur', 10, '1 L', 'Dépôt A', 'En stock'),
(3, 'Filtre à Huile', 8, 'N/A', 'Dépôt C', 'En stock'),
(4, 'Bougies d\'Allumage', 15, 'N/A', 'Dépôt A', 'En stock'),
(5, 'Plaquettes de Frein', 6, 'N/A', 'Dépôt D', 'Rupture de stock'),
(6, 'Batteries', 4, '12 V', 'Dépôt B', 'En stock'),
(7, 'Moteurs', 2, 'N/A', 'Dépôt C', 'En stock'),
(8, 'Capteurs', 20, 'N/A', 'Dépôt A', 'En stock');

-- --------------------------------------------------------

--
-- Table structure for table `prod_piece`
--

CREATE TABLE `prod_piece` (
  `id` int(255) NOT NULL,
  `Photo_Piece` varchar(255) NOT NULL,
  `Nom_piece` varchar(255) NOT NULL,
  `Diameter_Piece` varchar(255) NOT NULL,
  `prod_date` varchar(255) NOT NULL,
  `sale_date` varchar(255) NOT NULL,
  `sale_prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_piece`
--

INSERT INTO `prod_piece` (`id`, `Photo_Piece`, `Nom_piece`, `Diameter_Piece`, `prod_date`, `sale_date`, `sale_prix`) VALUES
(1, 'piece1.jpg', 'strator', '12000', '2023-01-15', '2023-03-10', '50'),
(2, 'piece4.png', 'Nut', '1', '2023-02-10', '2023-03-12', '90'),
(3, 'piece3.jpg', 'Bolt', '2.50', '2023-02-20', '2023-04-05', '10'),
(4, 'piece4.png', 'Washer', '1.00', '2023-03-01', '2023-04-15', '102'),
(5, 'piece2.png', 'Gear', '5.00', '2023-01-25', '2023-05-01', '70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gestion_emp`
--
ALTER TABLE `gestion_emp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `maintenance_materials`
--
ALTER TABLE `maintenance_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_piece`
--
ALTER TABLE `prod_piece`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gestion_emp`
--
ALTER TABLE `gestion_emp`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `maintenance_materials`
--
ALTER TABLE `maintenance_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prod_piece`
--
ALTER TABLE `prod_piece`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
