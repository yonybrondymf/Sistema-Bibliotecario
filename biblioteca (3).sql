-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2017 a las 02:37:38
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoslibro`
--

CREATE TABLE IF NOT EXISTS `estadoslibro` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadoslibro`
--

INSERT INTO `estadoslibro` (`id`, `descripcion`) VALUES
(1, 'Prestado'),
(2, 'Disponible'),
(3, 'Extraviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE IF NOT EXISTS `facultades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id`, `nombre`) VALUES
(3, 'Ingenieria Ambiental'),
(5, 'Ingenieria de Sistemas e Informática'),
(6, 'Ingenieria de Pesquera'),
(7, 'Ingenieria Civil'),
(8, 'Ingenieria de Comercial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectores`
--

CREATE TABLE IF NOT EXISTS `lectores` (
  `id_lector` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `id_tipolector` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lectores`
--

INSERT INTO `lectores` (`id_lector`, `nombres`, `apellidos`, `dni`, `telefono`, `direccion`, `estado`, `id_tipolector`) VALUES
(2, 'juan carlos', 'perez alarcon', '45454545', '565656', 'Cale Primavera 430', 0, 1),
(3, 'yony', 'miguel', '45454548', '', 'miramar 3434', 1, 1),
(4, 'melisa', 'chacez', '45454546', '121121', 'Mirave 450', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL,
  `codigo_libro` varchar(20) NOT NULL,
  `isbn_libro` varchar(200) NOT NULL,
  `titulo_libro` varchar(150) NOT NULL,
  `subtitulo_libro` varchar(250) NOT NULL,
  `autor_libro` varchar(150) NOT NULL,
  `publicacion_libro` year(4) NOT NULL,
  `editorial_libro` varchar(250) NOT NULL,
  `ediccion_libro` varchar(250) NOT NULL,
  `idioma_libro` varchar(200) NOT NULL,
  `ejemplares_libro` int(11) NOT NULL,
  `prestados_libro` varchar(10) NOT NULL,
  `imagen_libro` varchar(250) NOT NULL,
  `id_facultad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `codigo_libro`, `isbn_libro`, `titulo_libro`, `subtitulo_libro`, `autor_libro`, `publicacion_libro`, `editorial_libro`, `ediccion_libro`, `idioma_libro`, `ejemplares_libro`, `prestados_libro`, `imagen_libro`, `id_facultad`) VALUES
(1, '5-001', '84-481-4008-7', 'SEGURIDAD INFORMÁTICA PARA EMPRESAS PARTICULARES', 'APLICACIONES, PROCEDIMIENTOS, Y EJEMPLOS PRACTICOS PARA TOMAR LAS DECISIONES RELATIVAS A LA SEGURIDAD', 'GONZALO ÁLVAREZ MARAÑÓN', 0000, 'MC GRAW HILL', 'PRIMERA', 'ESPAÑOL', 1, '0', '5-0011.jpg', 5),
(2, '5-002', '84-9732-400-5', 'MANUAL DE PRESTO', '', 'R. DE BENITO ARANGO-A.J. SÁNCHEZ GRANDA', 2007, 'MC GRAW HILL', 'CUARTA', 'ESPAÑOL', 2, '0', 'default-book.png', 5),
(3, '6-001', '978-84-282-1423-0', 'EL CULTIVO DE LA TRUCHA', 'PRINCIPALES ESPECIES DE CRIA, INFRAESTRUCTURA, TECNICAS DE ALEVINAJE, GENETICA, ALIMENTACION, GESTION DE LA PRODUCCION, HIGIENE Y COMERCIALIZACION.', 'BRETON, BERNARD', 2005, 'OMEGA', '', 'ESPAÑOL', 3, '2', '6-0011.jpg', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `id` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_lector` int(11) NOT NULL,
  `fechaprestamo` varchar(100) NOT NULL,
  `fechadevolucion` varchar(100) NOT NULL,
  `estado_prestamo` tinyint(4) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `id_libro`, `id_lector`, `fechaprestamo`, `fechadevolucion`, `estado_prestamo`, `id_usuario`) VALUES
(1, 1, 2, '12/04/2017', '29/04/2017', 1, 1),
(2, 1, 2, '12/04/2017', '05/05/2017', 1, 1),
(3, 3, 2, '05/05/2017', '', 0, 1),
(4, 3, 4, '05/05/2017', '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipolector`
--

CREATE TABLE IF NOT EXISTS `tipolector` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipolector`
--

INSERT INTO `tipolector` (`id`, `nombre`) VALUES
(1, 'Estudiante'),
(2, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id` int(11) NOT NULL,
  `denominacion` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id`, `denominacion`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass_usuario` varchar(150) NOT NULL,
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `dni`, `telefono`, `email`, `pass_usuario`, `idtipousuario`) VALUES
(1, 'yony brondy', 'mamani fuentes', '45454545', '343434', 'yony@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 'juan', 'perez', '34343343', '', 'juan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estadoslibro`
--
ALTER TABLE `estadoslibro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lectores`
--
ALTER TABLE `lectores`
  ADD PRIMARY KEY (`id_lector`), ADD UNIQUE KEY `dni` (`dni`), ADD KEY `id_tipolector` (`id_tipolector`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`), ADD UNIQUE KEY `isbn_libro` (`isbn_libro`), ADD KEY `id_facultad` (`id_facultad`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`), ADD KEY `id_usuario` (`id_usuario`), ADD KEY `id_libro` (`id_libro`), ADD KEY `id_lector` (`id_lector`);

--
-- Indices de la tabla `tipolector`
--
ALTER TABLE `tipolector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`), ADD KEY `idtipousuario` (`idtipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadoslibro`
--
ALTER TABLE `estadoslibro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `lectores`
--
ALTER TABLE `lectores`
  MODIFY `id_lector` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipolector`
--
ALTER TABLE `tipolector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lectores`
--
ALTER TABLE `lectores`
ADD CONSTRAINT `lectores_ibfk_1` FOREIGN KEY (`id_tipolector`) REFERENCES `tipolector` (`id`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
ADD CONSTRAINT `libros_ibfk_5` FOREIGN KEY (`id_facultad`) REFERENCES `facultades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `prestamos_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
