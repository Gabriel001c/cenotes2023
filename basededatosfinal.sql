
CREATE TABLE IF NOT EXISTS `estatus` (
  `IDEstatus` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NombreEstatus` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDEstatus`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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


