-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2026 at 01:14 AM
-- Server version: 12.2.2-MariaDB
-- PHP Version: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basededatos`
--

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `destino_id` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `fecha_regreso` datetime NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id`, `usuario_id`, `destino_id`, `fecha_salida`, `fecha_regreso`, `estado`) VALUES
(2, 2, 2, '2026-06-01 10:00:00', '2026-06-20 15:00:00', 'Pendiente');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fecha_de_registro` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `fecha_de_registro`, `password`) VALUES
(2, 'webadmin', 'webadmin@example.com', '2026-04-19', '$2y$12$e6zTF9EX4OI9/gN10.VjleNYWTPtUKPan8pRK9VRIJdc4K.pyPRei');

-- --------------------------------------------------------

--
-- Table structure for table `viaje`
--

CREATE TABLE `viaje` (
  `id` int(11) NOT NULL,
  `nombre_ciudad` varchar(100) NOT NULL,
  `pais` varchar(60) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viaje`
--

INSERT INTO `viaje` (`id`, `nombre_ciudad`, `pais`, `descripcion`, `precio`) VALUES
(1, 'Tandil', 'Argentina', 'Ciudad de las sierras y el salame.', 50000),
(2, 'Tokio', 'Japón', 'Metrópolis tecnológica y cultural.', 1500000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_reserva` (`usuario_id`),
  ADD KEY `fk_destino_reserva` (`destino_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_destino_reserva` FOREIGN KEY (`destino_id`) REFERENCES `viaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_reserva` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
