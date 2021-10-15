-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2021 a las 22:53:47
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `taller_mecanico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `automoviles`
--

CREATE TABLE IF NOT EXISTS `automoviles` (
  `IdAuto` int(11) NOT NULL,
  `Identidad` int(20) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `Anio` int(4) NOT NULL,
  PRIMARY KEY (`IdAuto`),
  KEY `FK_auto_propietario_ID_idx` (`Identidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `automoviles`
--

INSERT INTO `automoviles` (`IdAuto`, `Identidad`, `Marca`, `Modelo`, `Anio`) VALUES
(1, 8011974, 'Toyota', 'Corolla', 2003),
(2, 8011974, 'Honda', 'Civic', 2006),
(3, 1011987, 'Hiunday', 'Accent', 2008),
(4, 8011976, 'Toyota', 'Rav4', 2014),
(5, 8011976, 'Mazda', '323', 2010),
(7, 548756, 'Audi', 'A4', 2016),
(8, 1858779, 'Bugatti', 'Chiron', 2021),
(9, 2743804, 'BMW', 'Serie 3', 2008),
(10, 3138123, 'Chevrolet', 'Cruze', 2012),
(11, 3514412, 'Dacia', 'Logan', 2005),
(12, 548756, 'Seat', 'Ibiza', 2000),
(13, 2743804, 'Nissan', 'PathFinder', 2012),
(14, 3532729, 'Subaru', 'Forester', 2010),
(15, 3532729, 'Ferrari', 'GTC4', 2016),
(16, 4261978, 'Fiat', 'Panda', 2012),
(17, 5349824, 'Ford', 'Mustang', 1969),
(18, 5692906, 'Rolls-Royce', 'Phantom', 2021),
(19, 6289060, 'Kia', 'Picanto', 2018),
(20, 5692906, 'Jeep', 'Compass', 2018),
(21, 6647472, 'Peugeot', '308', 2019),
(22, 6647472, 'Lamborghini', 'Aventador', 2015),
(23, 6942165, 'Land Rover', 'Defender', 2021),
(24, 7886988, 'Lexus', 'GS', 2015),
(25, 9331416, 'Maserati', 'Gran Turismo', 2017),
(26, 9398756, 'Porsche', '911', 2013),
(27, 9398756, 'Mercedes', 'Clase C', 2019),
(28, 9885587, 'Suzuki', 'Grand Vitara', 2006),
(29, 9885587, 'Tesla', 'Model S', 2021),
(30, 9885587, 'Mitsubishi', 'Space Star', 2016),
(31, 1, 'Toyota', 'Corolla', 2006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE IF NOT EXISTS `mantenimiento` (
  `IdMantenimiento` int(11) NOT NULL AUTO_INCREMENT,
  `IdAuto` int(11) NOT NULL,
  `Fecha_Revision` date NOT NULL,
  `IdTipo_Revision` int(11) NOT NULL,
  `IdTecnico` int(11) NOT NULL,
  PRIMARY KEY (`IdMantenimiento`),
  KEY `FK_mantenimiento_auto_ID_idx` (`IdAuto`),
  KEY `FK_mantenimiento_tipoRevision_ID_idx` (`IdTipo_Revision`),
  KEY `FK_mantenimiento_tecnico_ID_idx` (`IdTecnico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`IdMantenimiento`, `IdAuto`, `Fecha_Revision`, `IdTipo_Revision`, `IdTecnico`) VALUES
(1, 1, '2014-09-25', 15, 8),
(2, 2, '2015-01-05', 2, 2),
(3, 3, '2015-11-11', 3, 2),
(4, 4, '2013-03-01', 1, 1),
(5, 5, '2015-03-12', 4, 3),
(7, 7, '2016-11-14', 10, 6),
(8, 8, '2016-12-30', 13, 3),
(9, 9, '2021-07-26', 8, 5),
(10, 10, '2018-09-04', 15, 4),
(11, 11, '2018-08-22', 5, 7),
(12, 12, '2017-11-25', 14, 5),
(13, 13, '2021-08-08', 9, 2),
(14, 14, '2015-02-04', 9, 2),
(15, 15, '2019-07-13', 4, 4),
(17, 17, '2019-08-18', 10, 5),
(18, 18, '2017-01-11', 13, 2),
(19, 19, '2019-01-17', 13, 4),
(20, 20, '2017-04-29', 1, 5),
(21, 21, '2019-08-09', 11, 2),
(22, 22, '2016-04-16', 1, 6),
(23, 23, '2018-04-11', 1, 6),
(24, 24, '2016-05-06', 12, 5),
(25, 25, '2021-07-31', 12, 1),
(26, 26, '2019-08-08', 2, 6),
(27, 27, '2018-12-05', 11, 7),
(28, 28, '2015-11-05', 11, 6),
(29, 29, '2017-11-22', 7, 1),
(30, 30, '2021-05-29', 2, 3),
(31, 18, '2015-04-02', 10, 3),
(32, 21, '2015-12-17', 11, 2),
(33, 17, '2016-04-26', 13, 1),
(34, 12, '2019-12-27', 1, 6),
(35, 5, '2017-07-13', 3, 7),
(37, 30, '2015-09-01', 14, 4),
(38, 23, '2015-11-07', 14, 3),
(39, 4, '2016-05-19', 2, 3),
(40, 8, '2017-02-08', 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE IF NOT EXISTS `propietarios` (
  `Identidad` int(11) NOT NULL,
  `Nombre_Propietario` varchar(255) NOT NULL,
  PRIMARY KEY (`Identidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`Identidad`, `Nombre_Propietario`) VALUES
(1, 'Andy Gomez'),
(10003, 'Jaime Ham'),
(548756, 'Felipe Gutierrez'),
(1011987, 'Ana Lozano'),
(1858779, 'Nuria Vives'),
(2743804, 'Mireya Rosell'),
(3138123, 'Francisco Mena'),
(3514412, 'Gracia Mansilla'),
(3532729, 'Dana Brito'),
(4261978, 'Bruno Tejeda'),
(5349824, 'Amalia SÃ¡nchez'),
(5692906, 'Anibal Mosquera'),
(6289060, 'Michael Espino'),
(6647472, 'Valeria Alcazar'),
(6942165, 'Dominga del Olmo'),
(7886988, 'Josefina Meza'),
(8011974, 'Juan PÃ©rez'),
(8011976, 'Luis Romero'),
(9331416, 'Oier Morillas'),
(9398756, 'Hugo Guillen'),
(9885587, 'Justa Burgos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE IF NOT EXISTS `tecnicos` (
  `IdTecnico` int(11) NOT NULL,
  `Nombre_Tecnico` varchar(100) NOT NULL,
  PRIMARY KEY (`IdTecnico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`IdTecnico`, `Nombre_Tecnico`) VALUES
(1, 'Julio'),
(2, 'Raul'),
(3, 'Marco'),
(4, 'Esteban'),
(5, 'Joseph'),
(6, 'Alejandro'),
(7, 'Carlos'),
(8, 'Maria ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_revision`
--

CREATE TABLE IF NOT EXISTS `tipo_revision` (
  `IdTipo_Revision` int(11) NOT NULL,
  `Tipo_Revision` varchar(100) NOT NULL,
  PRIMARY KEY (`IdTipo_Revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_revision`
--

INSERT INTO `tipo_revision` (`IdTipo_Revision`, `Tipo_Revision`) VALUES
(1, 'Cambio de Aceite'),
(2, 'Cambio de Llantas'),
(3, 'Luces'),
(4, 'Frenos'),
(5, 'Aceite'),
(6, 'Bateria'),
(7, 'Filtros'),
(8, 'Amortiguadores'),
(9, 'Correa de DistribuciÃ³n'),
(10, 'Sistema de Escape y Catalizadores'),
(11, 'AlineaciÃ³n y Balanceo'),
(12, 'Limpiaparabrisas'),
(13, 'Sistema de Enfriamiento'),
(14, 'Motor'),
(15, 'Cajas de Cambio');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `automoviles`
--
ALTER TABLE `automoviles`
  ADD CONSTRAINT `automoviles_ibfk_1` FOREIGN KEY (`Identidad`) REFERENCES `propietarios` (`Identidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `FK_mantenimiento_auto_ID` FOREIGN KEY (`IdAuto`) REFERENCES `automoviles` (`IdAuto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mantenimiento_tecnico_ID` FOREIGN KEY (`IdTecnico`) REFERENCES `tecnicos` (`IdTecnico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mantenimiento_tipoRevision_ID` FOREIGN KEY (`IdTipo_Revision`) REFERENCES `tipo_revision` (`IdTipo_Revision`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
