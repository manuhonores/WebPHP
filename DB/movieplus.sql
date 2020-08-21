-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2019 a las 13:57:59
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `movieplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_usuario` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_usuario`, `id_pelicula`, `comentario`, `puntuacion`, `id_comentario`) VALUES
(24, 61, 'Buena', 3, 50),
(24, 61, 'Regular', 3, 60),
(24, 61, 'Mala', 2, 61),
(24, 61, 'Excelente', 5, 62),
(24, 64, 'Muy buena', 5, 63),
(27, 64, 'Buena', 4, 64),
(27, 61, 'Buena', 4, 65);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre`) VALUES
(1, 'Accion'),
(2, 'Terror'),
(3, 'Drama'),
(9, 'Comedy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_pelicula` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `id_imagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_pelicula`, `ruta`, `id_imagen`) VALUES
(61, 'images_tmp/5ddc234d8cc00.jpg', 45),
(61, 'images_tmp/5ddc234d97e6e.png', 46),
(61, 'images_tmp/5ddc234dad496.png', 48),
(61, 'images_tmp/5de0372bef730.jpg', 49),
(64, 'images_tmp/5de078a20d866.jpg', 56),
(64, 'images_tmp/5de078a213c11.jpg', 57),
(64, 'images_tmp/5de078a22105e.jpg', 58),
(65, 'images_tmp/5de0797de0699.jpg', 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `id_genero`, `nombre`, `descripcion`) VALUES
(61, 1, 'Spiderman', 'Posteriormente a los eventos de Avengers: Endgame, y tras 8 meses de la muerte de su mentor Tony Stark, Peter Parker se va de vacaciones a Europa con sus amigos Ned y Michelle; pero sus vacaciones van a tener que esperar ya que se verá obligado a unirse a Mysterio con el objetivo de detener a los Elementales, unos extraños seres que nadie sabe de dónde vienen pero dispuestos a acabar con todo lo que se les atreviese en su camino.'),
(64, 2, 'Joker', 'Para siempre solo en una multitud, el comediante fracasado Arthur Fleck busca la conexión mientras camina por las calles de Gotham City. Arthur usa dos máscaras: la que pinta para su trabajo diario como payaso, y la apariencia que proyecta en un inútil intento de sentirse parte del mundo que lo rodea. Aislado, intimidado y desatendido por la sociedad, Fleck comienza un lento descenso hacia la locura mientras se transforma en el autor intelectual criminal conocido como el Joker'),
(65, 9, 'Simpsons', 'La combinación de Homero, su nuevo cerdo mascota, y un silo lleno de excrementos que gotea desencadena un desastre que amenaza no solo a Springfield sino a todo el mundo. Una multitud enojada desciende a la casa de los Simpson, separando a la familia. Con el destino de la Tierra en juego, Homero emprende una búsqueda de redención para salvar el mundo y ganar el perdón de Marge.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resetpass`
--

CREATE TABLE `resetpass` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_reset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `admin`) VALUES
(18, 'Manuel', 'manuel.honores.mh@gmail.com', '$2y$10$i0a145i0Ac4NhtFAsUQ/eufGznItPFZ3dit.xpROveIYwWhjSsx7C', 1),
(24, 'Manuel', 'manuel.honores.mh.1@gmail.com', '$2y$10$Xj0vDY5seU7Bo/4vKizJLe1yHt9na3Di0cDIUFXMSFY.HvkMi3HZK', 0),
(27, 'Ignacio', 'ignacio@ignacio.com', '$2y$10$M2oYy.VQ/m5BAHHgdRSt4.r7nO7FrXcdo.aGNyAHvu1jjtefZqbgy', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indices de la tabla `resetpass`
--
ALTER TABLE `resetpass`
  ADD PRIMARY KEY (`id_reset`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `resetpass`
--
ALTER TABLE `resetpass`
  MODIFY `id_reset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
