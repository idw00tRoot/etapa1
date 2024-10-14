-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2024 a las 17:04:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_asistencia_alumno` (IN `alumno` INT)   BEGIN
    SELECT a.fecha, a.presente, c.nombre AS categoria, c.serie 
    FROM asistencia a 
    JOIN categorias c ON a.categoria_id = c.id 
    WHERE a.alumno_id = alumno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_asistencia` (IN `alumno` INT, IN `categoria` INT, IN `fecha` DATE, IN `estado` BOOLEAN)   BEGIN
    INSERT INTO asistencia (alumno_id, categoria_id, fecha, presente) 
    VALUES (alumno, categoria, fecha, estado);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `total_asistencias` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `rut`, `nombre`, `email`, `fecha_nacimiento`, `total_asistencias`) VALUES
(1, '12345678-9', 'Natalia Peralta', 'natalia@mail.com', '2005-04-15', 4),
(2, '98765432-1', 'Lucas Díaz', 'lucas@mail.com', '2006-02-20', 2),
(3, '19283746-2', 'Amaro Díaz', 'amaro@mail.com', '2006-07-30', 2),
(4, '23456789-0', 'Sofía López', 'sofia@mail.com', '2007-06-21', 3),
(5, '34567890-1', 'Diego Herrera', 'diego@mail.com', '2008-03-10', 2),
(6, '45678901-2', 'Isabel Mena', 'isabel@mail.com', '2007-12-01', 2),
(7, '56789012-3', 'Tomás García', 'tomas@mail.com', '2006-08-15', 2),
(8, '67890123-4', 'Paula Castillo', 'paula@mail.com', '2009-02-18', 2),
(9, '78901234-5', 'Manuel Ramírez', 'manuel@mail.com', '2008-07-20', 2),
(10, '89012345-6', 'Gabriela Ríos', 'gabriela@mail.com', '2009-05-10', 2),
(11, '90123456-7', 'Lucas Espinoza', 'lucas@mail.com', '2008-03-12', 2),
(12, '01234567-8', 'Florencia Aguilera', 'florencia@mail.com', '2007-11-23', 3),
(13, '12345012-9', 'Agustín Varela', 'agustin@mail.com', '2008-04-09', 1),
(14, '23456123-0', 'Catalina Muñoz', 'catalina@mail.com', '2009-10-03', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `presente` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `alumno_id`, `categoria_id`, `fecha`, `presente`) VALUES
(13, 1, 1, '2024-10-01', 1),
(14, 2, 2, '2024-10-01', 1),
(15, 3, 3, '2024-10-01', 0),
(16, 1, 1, '2024-10-02', 1),
(17, 2, 2, '2024-10-02', 0),
(18, 3, 3, '2024-10-02', 1),
(19, 1, 1, '2024-10-01', 1),
(20, 2, 2, '2024-10-01', 1),
(21, 3, 3, '2024-10-01', 0),
(22, 1, 1, '2024-10-02', 1),
(23, 2, 2, '2024-10-02', 0),
(24, 3, 3, '2024-10-02', 1),
(25, 4, 4, '2024-10-03', 1),
(26, 5, 5, '2024-10-03', 0),
(27, 6, 6, '2024-10-03', 1),
(28, 7, 7, '2024-10-03', 1),
(29, 8, 8, '2024-10-03', 1),
(30, 9, 9, '2024-10-03', 1),
(31, 10, 10, '2024-10-04', 1),
(32, 11, 11, '2024-10-04', 0),
(33, 12, 12, '2024-10-04', 1),
(34, 13, 4, '2024-10-04', 0),
(35, 14, 5, '2024-10-04', 1),
(36, 4, 4, '2024-10-05', 1),
(37, 5, 5, '2024-10-05', 1),
(38, 6, 6, '2024-10-05', 0),
(39, 7, 7, '2024-10-05', 1),
(40, 8, 8, '2024-10-05', 0),
(41, 9, 9, '2024-10-06', 1),
(42, 10, 10, '2024-10-06', 0),
(43, 11, 11, '2024-10-06', 1),
(44, 12, 12, '2024-10-06', 1),
(45, 13, 4, '2024-10-06', 1),
(46, 14, 5, '2024-10-06', 0),
(47, 4, 4, '2024-10-07', 1),
(48, 5, 5, '2024-10-07', 1),
(49, 6, 6, '2024-10-07', 1),
(50, 7, 7, '2024-10-07', 0),
(51, 8, 8, '2024-10-07', 1),
(52, 9, 9, '2024-10-07', 0),
(53, 10, 10, '2024-10-08', 1),
(54, 11, 11, '2024-10-08', 1),
(55, 12, 12, '2024-10-08', 1),
(56, 13, 4, '2024-10-08', 0),
(57, 14, 5, '2024-10-08', 1);

--
-- Disparadores `asistencia`
--
DELIMITER $$
CREATE TRIGGER `actualizar_asistencia_despues_insertar` AFTER INSERT ON `asistencia` FOR EACH ROW BEGIN
    DECLARE asistencias INT;
    SELECT COUNT(*) INTO asistencias FROM asistencia WHERE alumno_id = NEW.alumno_id AND presente = 1;
    UPDATE alumnos SET total_asistencias = asistencias WHERE id = NEW.alumno_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `serie` varchar(10) NOT NULL,
  `rama` enum('masculina','femenina') NOT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `serie`, `rama`, `profesor_id`) VALUES
(1, 'Baloncesto', 'U9', 'masculina', 1),
(2, 'Fútbol', 'U9', 'masculina', 2),
(3, 'Voleibol', 'U9', 'femenina', 2),
(4, 'Fútbol', 'U11', 'masculina', NULL),
(5, 'Voleibol', 'U13', 'femenina', NULL),
(6, 'Atletismo', 'U15', 'femenina', NULL),
(7, 'Natación', 'U15', 'masculina', NULL),
(8, 'Baloncesto', 'U11', 'masculina', NULL),
(9, 'Atletismo', 'U13', 'femenina', NULL),
(10, 'Balonmano', 'U15', 'femenina', NULL),
(11, 'Natación', 'U11', 'masculina', NULL),
(12, 'Fútbol', 'U13', 'masculina', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_alumnos`
--

CREATE TABLE `categorias_alumnos` (
  `alumno_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias_alumnos`
--

INSERT INTO `categorias_alumnos` (`alumno_id`, `categoria_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 4),
(14, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre`, `email`) VALUES
(1, 'Prof. Juan Pérez', 'jperez@mail.com'),
(2, 'Prof. Ana Gutiérrez', 'agutierrez@mail.com'),
(3, 'Prof. Carlos Fernández', 'cfernandez@mail.com'),
(4, 'Prof. Andrea Morales', 'amorales@mail.com'),
(5, 'Prof. Javier Sánchez', 'jsanchez@mail.com'),
(6, 'Prof. Patricia Olivares', 'polivares@mail.com');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_asistencia_resumida`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_asistencia_resumida` (
`fecha` date
,`presente` tinyint(1)
,`alumno` varchar(100)
,`categoria` varchar(50)
,`serie` varchar(10)
,`profesor` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_asistencia_resumida`
--
DROP TABLE IF EXISTS `vista_asistencia_resumida`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_asistencia_resumida`  AS SELECT `a`.`fecha` AS `fecha`, `a`.`presente` AS `presente`, `al`.`nombre` AS `alumno`, `c`.`nombre` AS `categoria`, `c`.`serie` AS `serie`, `p`.`nombre` AS `profesor` FROM (((`asistencia` `a` join `alumnos` `al` on(`a`.`alumno_id` = `al`.`id`)) join `categorias` `c` on(`a`.`categoria_id` = `c`.`id`)) left join `profesores` `p` on(`c`.`profesor_id` = `p`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rut` (`rut`),
  ADD KEY `idx_alumno_rut` (`rut`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `idx_asistencia_fecha` (`fecha`),
  ADD KEY `idx_asistencia_alumno_categoria` (`alumno_id`,`categoria_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profesor_categoria` (`profesor_id`);

--
-- Indices de la tabla `categorias_alumnos`
--
ALTER TABLE `categorias_alumnos`
  ADD PRIMARY KEY (`alumno_id`,`categoria_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_profesor_categoria` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `categorias_alumnos`
--
ALTER TABLE `categorias_alumnos`
  ADD CONSTRAINT `categorias_alumnos_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categorias_alumnos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
