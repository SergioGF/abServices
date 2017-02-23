-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2017 a las 13:13:05
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abservices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id`) VALUES
('MACRIS'),
('CONSULTORES'),
('REMAR'),
('ALFONSOXII'),
('MONASTERIO'),
('DILUS_SISTEM '),
('INACON'),
('SANGAR'),
('UXAMA'),
('PATRONES'),
('DOMOTECH'),
('M&N'),
('URBINGES'),
('DILUS_CLIMA'),
('FASPA'),
('VALDELUZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `Id` int(11) NOT NULL,
  `IdCliente` varchar(30) NOT NULL,
  `Trabajador` varchar(3) NOT NULL,
  `FVisita` date NOT NULL,
  `HoraE` time NOT NULL,
  `HoraS` time NOT NULL,
  `Descripcion` text NOT NULL,
  `DescripcionMat` text,
  `Observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`Id`, `IdCliente`, `Trabajador`, `FVisita`, `HoraE`, `HoraS`, `Descripcion`, `DescripcionMat`, `Observaciones`) VALUES
(1, 'ALFONSOXII', 'FGB', '2017-02-21', '13:00:00', '14:00:00', 'Reparación de ordenadores', NULL, NULL),
(2, 'ALFONSOXII', 'FGB', '2017-02-19', '17:00:00', '19:00:00', 'Consultas.', NULL, NULL),
(3, 'ALFONSOXII', 'FGB', '2017-02-02', '15:25:00', '15:45:00', 'hgfh', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `Usuario` varchar(10) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `abServices` tinyint(1) NOT NULL,
  `EUROICO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`Usuario`, `Password`, `Tipo`, `abServices`, `EUROICO`) VALUES
('FGB', 'fgb', 3, 1, 1),
('RPR', 'rpr', 3, 1, 1),
('RS', 'rs', 3, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
