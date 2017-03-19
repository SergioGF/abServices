-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2017 at 06:30 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `Id` varchar(30) NOT NULL,
  `Horas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`Id`, `Horas`) VALUES
('MACRIS', 20),
('CONSULTORES', 20),
('ALFONSOXII', 20),
('MONASTERIO', 20),
('DILUS_SISTEM ', 20),
('INACON', 20),
('SANGAR', 20),
('UXAMA', 20),
('PATRONES', 20),
('DOMOTECH', 20),
('MN', 20),
('URBINGES', 20),
('DILUS_CLIMA', 20),
('FASPAtos', 20),
('VALDELUZ', 20),
('REMAR', 12);

-- --------------------------------------------------------

--
-- Table structure for table `trabajos`
--

CREATE TABLE IF NOT EXISTS `trabajos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` varchar(30) NOT NULL,
  `Trabajador` varchar(3) NOT NULL,
  `Ubicacion` varchar(2) NOT NULL DEFAULT 'CC',
  `FVisita` date NOT NULL,
  `HoraE` time NOT NULL,
  `HoraS` time NOT NULL,
  `Descripcion` text NOT NULL,
  `DescripcionMat` text,
  `Observaciones` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `trabajos`
--

INSERT INTO `trabajos` (`Id`, `IdCliente`, `Trabajador`, `Ubicacion`, `FVisita`, `HoraE`, `HoraS`, `Descripcion`, `DescripcionMat`, `Observaciones`) VALUES
(2, 'ALFONSOXII', 'FGB', 'CC', '2017-02-19', '17:00:00', '19:00:00', 'Consultas2', '', ''),
(3, 'ALFONSOXII', 'FGB', 'CC', '2017-02-02', '15:25:00', '15:45:00', 'Arreglo de dominios', '', ''),
(4, 'ALFONSOXII', 'FGB', 'CC', '2017-03-14', '01:01:00', '03:00:00', 'Consultas2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Usuario` varchar(10) NOT NULL,
  `Password` varchar(72) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `abServices` tinyint(1) NOT NULL,
  `EUROICO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Usuario`, `Password`, `Tipo`, `abServices`, `EUROICO`) VALUES
('FGB', '$2y$10$SMRLfcSvgIziPjkFza.4aewIuhbGHPx64BiswTQslUBE9GIdr9hyO', 3, 1, 0),
('US2', '$2y$10$kxuUWw7i9n2zGVB1ZRQjCebbq2c0w4KDVJoTiqSJlyEDat8corhTO', 2, 1, 0),
('US1', '$2y$10$I6ZVgKevz4EFgylvt9tN2eStd1uLbLsRV9RPDXr6.BXxGT/hZ8G0G', 1, 1, 0),
('ADM', '$2y$10$2orjf8Nmv8GMp5wJVwlfFuqN7pFqDUvA7X.jhAhGY0SCs3Acm3lkS', 3, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
