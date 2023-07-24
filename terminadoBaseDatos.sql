-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.1.0-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla integrador5.estatus
CREATE TABLE IF NOT EXISTS `estatus` (
  `IDEstatus` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NombreEstatus` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDEstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla integrador5.estatus: ~5 rows (aproximadamente)
INSERT INTO `estatus` (`IDEstatus`, `NombreEstatus`) VALUES
	(1, 'Baile'),
	(2, 'Musica'),
	(3, 'cine'),
	(4, 'teatro'),
	(5, 'comedia');

-- Volcando estructura para tabla integrador5.eventos
CREATE TABLE IF NOT EXISTS `eventos` (
  `IDEventos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Fecha` date NOT NULL,
  `Fotos` varchar(200) NOT NULL,
  `IDEstatus` int(10) unsigned NOT NULL,
  `Aceptado` int(10) NOT NULL,
  `Ubicacion` varchar(200) NOT NULL,
  `IDUsuario` int(10) unsigned DEFAULT NULL,
  `Comentario` varchar(200) DEFAULT NULL,
  `Hora` time NOT NULL,
  `FechaFin` date DEFAULT NULL,
  PRIMARY KEY (`IDEventos`),
  KEY `IDEstatus` (`IDEstatus`),
  KEY `fk_eventos_usuarios` (`IDUsuario`),
  CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`IDEstatus`) REFERENCES `estatus` (`IDEstatus`),
  CONSTRAINT `fk_eventos_usuarios` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla integrador5.eventos: ~13 rows (aproximadamente)
INSERT INTO `eventos` (`IDEventos`, `Titulo`, `Descripcion`, `Fecha`, `Fotos`, `IDEstatus`, `Aceptado`, `Ubicacion`, `IDUsuario`, `Comentario`, `Hora`, `FechaFin`) VALUES
	(53, 'Entre música y naturaleza', 'Concientizar a los asistentes del espacio, lugar y tiempo, la importancia de situarnos en el presente y tomar acciones que ayuden y favorezcan la convivencia en el ecosistema por medio del sonido. ', '2023-08-20', 'fotos/Musica.jpg', 2, 1, 'kana', 2, '', '15:00:00', NULL),
	(54, 'Ven al Cine con la Familia', 'Super Mario Bros: La película (2023) Dir. Aaron Horvath y Michael Jelenic. Mientras trabajan en una avería subterránea, los fontaneros de Brooklyn, Mario y su hermano Luigi, viajan por una misteriosa tubería hasta un nuevo mundo mágico. Pero, cuando los hermanos se separan, Mario deberá emprender una épica misión para encontrar a Luigi. ', '2023-08-26', 'fotos/mario.jpeg', 1, 1, 'Kanasin', 1, NULL, '18:00:00', NULL),
	(55, 'Ven al Cine con la Familia 2', 'El rey León (2019) Dir. Jon Favreau Tras el asesinato de su padre, un joven león abandona su reino para descubrir el auténtico significado de la responsabilidad y de la valentía. Remake de "El Rey León", dirigido y producido por Jon Favreau, responsable de la puesta al día, con el mismo formato, de "El libro de la selva" (2016).', '2023-08-11', 'fotos/cine.jpg', 1, 1, 'Mulchechen', 1, NULL, '07:00:00', NULL),
	(57, '  Voz viva, lectura en boca de sus autoras. ', 'Con la presencia de: María Elena González Para toda la familia Cupo limitado', '2023-08-17', 'fotos/lectura.jpg', 2, 1, 'Cacalchen', 1, NULL, '16:00:00', NULL),
	(58, '  In k’áabae’ María Uicab (Me llamo María Uicab) ', 'De Christi Uicab Dir. Miguel Canto y Jazmín Alhelí Cía. Colectiva Contrayerba Sinopsis: Un apellido es el inicio de la búsqueda de una guerrera. Un mapa: mi nombre. Un documento histórico: mi cuerpo. In k’áabae’ María Uicab (Me llamo María Uicab) es un unipersonal que concebí tras conocer la vida de la lideresa de los mayas del oriente de la península durante la llamada Guerra de Castas del siglo XIX. Me atrapó apellidarme igual a ella: pasé de recordar a mi niña y a mi adolescente del pasado sintiendo miedo y vergüenza por mi apellido y mi autoimagen, a poder abrazar mi dignidad como mujer en María Uicab.', '2023-08-18', 'fotos/teatro.jpeg', 2, 1, 'Uman', 1, NULL, '17:00:00', NULL),
	(59, '  Proyección Rectangular: Culto a la Historia Natural de México ', 'Una historia de veneración a la naturaleza que tiene su sede en el ombligo de la luna. Acompáñanos a ver esta grandiosa proyección que tiene como objetivo celebrar y ofrendar la biodiversidad de esta tierra colmada de complejidad ecológica y bondades geográficas. Este trabajo compila 20 años de experiencia ininterrumpida de Miguel Ángel Sicilia recorriendo los rincones naturales de México. ', '2023-08-18', 'fotos/mariposa.jpeg', 2, 1, 'Baca', 4, '', '15:00:00', NULL),
	(190, 'BALET FOLKRORICO LUNA MAYA', 'EVENTO DE BAILE', '2023-08-18', 'fotos/JARANA.jpg', 1, 1, 'KANASIN', 21, '', '16:00:00', NULL),
	(200, 'prueba', 'jjjjajaja', '2023-07-19', 'fotos/JARANA.jpg', 3, 2, 'kanasin', 4, '', '17:04:30', NULL),
	(201, 'hola', 'kkajajaja', '2023-08-05', 'fotos/WhatsApp Image 2023-06-23 at 1.00.46 PM.jpeg', 4, 1, 'jjjlk', 4, '', '05:50:00', NULL),
	(202, 'juanito', 'hjkhkjhjk', '2023-07-21', 'fotos/WhatsApp Image 2023-06-22 at 3.40.04 PM.jpeg', 2, 2, 'kksksksk', 4, '', '07:58:00', NULL),
	(203, 'Canonico', 'darme de baja', '2023-07-21', 'fotos/image_2023_04_04_145646954.0.jpg', 3, 2, 'Merida', 2, '', '07:16:00', NULL),
	(204, 'Musica clásica 2023', 'Evento de musica para toda la familia', '2023-07-20', 'fotos/Sin título.jpg', 2, 2, 'Kanasin', 28, 'El nombre esta mal ', '20:00:00', NULL),
	(205, 'hola', 'fnfi', '2023-07-28', 'fotos/abner.jpeg', 3, 0, 'ijfoiwhgoiwngiown', 22, NULL, '13:37:00', NULL);

-- Volcando estructura para tabla integrador5.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NombreUsuarios` varchar(50) NOT NULL,
  `Correo` varchar(75) NOT NULL,
  `Contraseña` varchar(25) NOT NULL,
  `Facebook` varchar(50) DEFAULT NULL,
  `Google` varchar(75) DEFAULT NULL,
  `IDPER` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla integrador5.usuarios: ~11 rows (aproximadamente)
INSERT INTO `usuarios` (`ID`, `NombreUsuarios`, `Correo`, `Contraseña`, `Facebook`, `Google`, `IDPER`) VALUES
	(1, 'alan', 'alan@gmail.com', '1234', NULL, NULL, 1),
	(2, 'iker', 'iker@gmail.com', '1234', NULL, NULL, 0),
	(4, 'angel', 'angel@gmail.com', '1234', NULL, NULL, 0),
	(21, 'gael', 'gael@gmail.com', 'holisjaja', NULL, NULL, 0),
	(22, 'mex', 'mex@gmail.com', '1234', NULL, NULL, 0),
	(23, 'juanes', 'juan@gmail.com', 'asdf', NULL, NULL, 0),
	(24, 'juan', 'juan@gmail.com', 'asdf', NULL, NULL, 0),
	(25, 'pedro', 'pedro@gmail.com', 'asdf', NULL, NULL, 0),
	(26, 'fel', 'AHA@GAGA.COMas', 'asdf', NULL, NULL, 0),
	(27, 'kakaka', 'kakak@gmail.com', '1234', NULL, NULL, 0),
	(28, 'Joaquin', 'Joaquin@gmail.com', '1234', NULL, NULL, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
