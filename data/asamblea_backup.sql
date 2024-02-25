-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para procedimiento asamblea.sp_i_area_01
DELIMITER //
CREATE PROCEDURE `sp_i_area_01`(
	IN `xusu_id` INT
)
BEGIN
DECLARE areaCount INT;

	SELECT COUNT(*) INTO areaCount FROM td_area_detalle WHERE usu_id = xusu_id;
	
	IF areaCount = 0 THEN
		INSERT INTO td_area_detalle(usu_id,area_id)
		SELECT xusu_id,area_id FROM tm_area WHERE est=1;
	ELSE
		INSERT INTO td_area_detalle(usu_id,area_id)
		SELECT xusu_id,area_id FROM tm_area WHERE est=1 AND area_id NOT IN (SELECT area_id FROM td_area_detalle WHERE usu_id = xusu_id);
	END IF;
	
	SELECT 
	td_area_detalle.aread_id,
	td_area_detalle.area_id,
	td_area_detalle.aread_permi,
	tm_area.area_nom,
	tm_area.area_correo 
	FROM td_area_detalle
	INNER JOIN tm_area ON tm_area.area_id = td_area_detalle.area_id
	WHERE 
	td_area_detalle.usu_id = xusu_id
	AND tm_area.est=1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento asamblea.sp_i_rol_01
DELIMITER //
CREATE PROCEDURE `sp_i_rol_01`(
	IN `xrol_id` INT
)
BEGIN
DECLARE rolCount INT;

	SELECT COUNT(*) INTO rolCount FROM td_menu_detalle WHERE rol_id = xrol_id;
	
	IF rolCount = 0 THEN
		INSERT INTO td_menu_detalle(rol_id,men_id)
		SELECT xrol_id,men_id FROM tm_menu WHERE est=1;
	ELSE
		INSERT INTO td_menu_detalle(rol_id,men_id)
		SELECT xrol_id,men_id FROM tm_menu WHERE est=1 AND men_id NOT IN (SELECT men_id FROM td_menu_detalle WHERE rol_id = xrol_id);
	END IF;
	
	SELECT 
		td_menu_detalle.mend_id,
		td_menu_detalle.rol_id,
		td_menu_detalle.mend_permi,
		tm_menu.men_id,
		tm_menu.men_nom,
		tm_menu.men_nom_vista,
		tm_menu.men_icon,
		tm_menu.men_ruta
	FROM td_menu_detalle
	INNER JOIN tm_menu ON tm_menu.men_id = td_menu_detalle.men_id
	WHERE 
	td_menu_detalle.rol_id = xrol_id
	AND tm_menu.est=1;

END//
DELIMITER ;

-- Volcando estructura para procedimiento asamblea.sp_l_documento_01
DELIMITER //
CREATE PROCEDURE `sp_l_documento_01`(
	IN `xdoc_id` INT
)
BEGIN
SELECT 
	tm_documento.doc_id,
	tm_documento.area_id,
	tm_area.area_nom,
	tm_area.area_correo,
	tm_documento.doc_externo,
	tm_documento.doc_dni,
	tm_documento.doc_nom,
	tm_documento.doc_descrip,
	tm_documento.tra_id,
	tm_tramite.tra_nom,
	tm_documento.tip_id,
	tm_tipo.tip_nom,
	tm_documento.usu_id,
	tm_usuario.usu_nomape,
	tm_usuario.usu_correo,
	tm_documento.doc_estado,
	tm_documento.doc_respuesta,
	COALESCE(contador.cant,0) AS cant,
	CONCAT(DATE_FORMAT(tm_documento.fech_crea,'%m'),'-',DATE_FORMAT(tm_documento.fech_crea,'%Y'),'-',tm_documento.doc_id) 
AS nrotramite
	FROM tm_documento
	INNER JOIN tm_area ON tm_documento.area_id = tm_area.area_id
	INNER JOIN tm_tramite ON tm_documento.tra_id = tm_tramite.tra_id
	INNER JOIN tm_tipo ON tm_documento.tip_id = tm_tipo.tip_id
	INNER JOIN tm_usuario ON tm_documento.usu_id = tm_usuario.usu_id
	LEFT JOIN (
		SELECT doc_id,COUNT(*) AS cant
		FROM td_documento_detalle 
		WHERE doc_id= xdoc_id
		GROUP BY doc_id
	) contador ON tm_documento.doc_id = contador.doc_id
	WHERE tm_documento.doc_id = xdoc_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento asamblea.sp_l_documento_02
DELIMITER //
CREATE PROCEDURE `sp_l_documento_02`(
	IN `xusu_id` INT
)
BEGIN
SELECT 
	tm_documento.doc_id,
	tm_documento.area_id,
	tm_area.area_nom,
	tm_area.area_correo,
	tm_documento.doc_externo,
	tm_documento.doc_dni,
	tm_documento.doc_nom,
	tm_documento.doc_descrip,
	tm_documento.tra_id,
	tm_tramite.tra_nom,
	tm_documento.tip_id,
	tm_tipo.tip_nom,
	tm_documento.usu_id,
	tm_usuario.usu_nomape,
	tm_usuario.usu_correo,
	tm_documento.doc_estado,
	CONCAT(DATE_FORMAT(tm_documento.fech_crea,'%m'),'-',DATE_FORMAT(tm_documento.fech_crea,'%Y'),'-',tm_documento.doc_id) 
AS nrotramite
	FROM tm_documento
	INNER JOIN tm_area ON tm_documento.area_id = tm_area.area_id
	INNER JOIN tm_tramite ON tm_documento.tra_id = tm_tramite.tra_id
	INNER JOIN tm_tipo ON tm_documento.tip_id = tm_tipo.tip_id
	INNER JOIN tm_usuario ON tm_documento.usu_id = tm_usuario.usu_id
	WHERE tm_documento.usu_id = xusu_id;
END//
DELIMITER ;

-- Volcando estructura para tabla asamblea.td_area_detalle
CREATE TABLE IF NOT EXISTS `td_area_detalle` (
  `aread_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `aread_permi` varchar(2) COLLATE utf8_spanish_ci DEFAULT 'No',
  `fecha_crea` datetime NOT NULL DEFAULT current_timestamp(),
  `fech_modi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fech_elim` datetime NOT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`aread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.td_area_detalle: ~36 rows (aproximadamente)
INSERT INTO `td_area_detalle` (`aread_id`, `usu_id`, `area_id`, `aread_permi`, `fecha_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 1, 1, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:54:27', '0000-00-00 00:00:00', 1),
	(2, 1, 2, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:51:41', '0000-00-00 00:00:00', 1),
	(3, 1, 3, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:51:43', '0000-00-00 00:00:00', 1),
	(4, 1, 4, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:53:11', '0000-00-00 00:00:00', 1),
	(5, 1, 5, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:54:32', '0000-00-00 00:00:00', 1),
	(6, 1, 6, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:51:50', '0000-00-00 00:00:00', 1),
	(7, 1, 8, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:54:42', '0000-00-00 00:00:00', 1),
	(8, 1, 9, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:54:47', '0000-00-00 00:00:00', 1),
	(9, 1, 10, 'Si', '2024-01-23 14:45:00', '2024-01-26 15:54:53', '0000-00-00 00:00:00', 1),
	(10, 47, 1, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(11, 47, 2, 'Si', '2024-01-25 18:38:19', '2024-01-25 21:38:27', '0000-00-00 00:00:00', 1),
	(12, 47, 3, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(13, 47, 4, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(14, 47, 5, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(15, 47, 6, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(16, 47, 8, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(17, 47, 9, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(18, 47, 10, 'No', '2024-01-25 18:38:19', '2024-01-25 21:38:19', '0000-00-00 00:00:00', 1),
	(19, 51, 1, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(20, 51, 2, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(21, 51, 3, 'Si', '2024-01-26 18:30:49', '2024-01-26 21:30:58', '0000-00-00 00:00:00', 1),
	(22, 51, 4, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(23, 51, 5, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(24, 51, 6, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(25, 51, 8, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(26, 51, 9, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(27, 51, 10, 'No', '2024-01-26 18:30:49', '2024-01-26 21:30:49', '0000-00-00 00:00:00', 1),
	(34, 50, 1, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(35, 50, 2, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(36, 50, 3, 'Si', '2024-01-26 19:53:12', '2024-01-27 22:11:09', '0000-00-00 00:00:00', 1),
	(37, 50, 4, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(38, 50, 5, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(39, 50, 6, 'Si', '2024-01-26 19:53:12', '2024-01-26 22:53:23', '0000-00-00 00:00:00', 1),
	(40, 50, 8, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(41, 50, 9, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1),
	(42, 50, 10, 'No', '2024-01-26 19:53:12', '2024-01-26 22:53:12', '0000-00-00 00:00:00', 1);

-- Volcando estructura para tabla asamblea.td_area_docente
CREATE TABLE IF NOT EXISTS `td_area_docente` (
  `aread_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `est` int(11) unsigned DEFAULT 0,
  PRIMARY KEY (`aread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.td_area_docente: ~0 rows (aproximadamente)

-- Volcando estructura para tabla asamblea.td_menu_detalle
CREATE TABLE IF NOT EXISTS `td_menu_detalle` (
  `mend_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `men_id` int(11) DEFAULT NULL,
  `mend_permi` varchar(2) DEFAULT 'No',
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`mend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.td_menu_detalle: ~35 rows (aproximadamente)
INSERT INTO `td_menu_detalle` (`mend_id`, `rol_id`, `men_id`, `mend_permi`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 3, 1, 'No', '2024-01-23 17:50:04', '2024-01-25 18:59:19', NULL, 1),
	(2, 3, 2, 'No', '2024-01-23 17:50:04', '2024-01-25 17:33:51', NULL, 1),
	(3, 3, 3, 'No', '2024-01-23 17:50:04', '2024-01-23 19:29:08', NULL, 1),
	(4, 3, 4, 'Si', '2024-01-23 17:50:04', '2024-01-25 18:59:20', NULL, 1),
	(5, 3, 5, 'No', '2024-01-23 17:50:04', '2024-01-25 17:33:42', NULL, 1),
	(6, 3, 6, 'No', '2024-01-23 17:50:04', '2024-01-25 18:59:09', NULL, 1),
	(7, 3, 7, 'Si', '2024-01-23 17:50:04', '2024-01-23 19:31:17', NULL, 1),
	(8, 3, 8, 'Si', '2024-01-23 17:50:04', '2024-01-23 19:31:17', NULL, 1),
	(9, 3, 9, 'No', '2024-01-23 17:50:04', '2024-02-21 21:11:36', NULL, 1),
	(10, 3, 10, 'No', '2024-01-23 17:50:04', '2024-02-21 21:11:36', NULL, 1),
	(11, 3, 11, 'Si', '2024-01-23 17:50:04', '2024-01-23 18:31:23', NULL, 1),
	(16, 2, 1, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:34', NULL, 1),
	(17, 2, 2, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:51', NULL, 1),
	(18, 2, 3, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:32', NULL, 1),
	(19, 2, 4, 'Si', '2024-01-23 18:31:02', '2024-01-23 18:31:06', NULL, 1),
	(20, 2, 5, 'Si', '2024-01-23 18:31:02', '2024-01-26 18:21:21', NULL, 1),
	(21, 2, 6, 'Si', '2024-01-23 18:31:02', '2024-01-23 18:31:04', NULL, 1),
	(22, 2, 7, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:45', NULL, 1),
	(23, 2, 8, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:44', NULL, 1),
	(24, 2, 9, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:47', NULL, 1),
	(25, 2, 10, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:46', NULL, 1),
	(26, 2, 11, 'No', '2024-01-23 18:31:02', '2024-01-26 17:51:45', NULL, 1),
	(31, 1, 1, 'Si', '2024-01-23 19:32:33', '2024-01-23 19:32:39', NULL, 1),
	(32, 1, 2, 'No', '2024-01-23 19:32:33', '2024-02-21 13:51:50', NULL, 1),
	(33, 1, 3, 'No', '2024-01-23 19:32:33', '2024-02-21 13:51:47', NULL, 1),
	(34, 1, 4, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(35, 1, 5, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(36, 1, 6, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(37, 1, 7, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(38, 1, 8, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(39, 1, 9, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(40, 1, 10, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(41, 1, 11, 'No', '2024-01-23 19:32:33', NULL, NULL, 1),
	(42, 3, 12, 'Si', '2024-02-08 19:38:28', '2024-02-08 19:38:38', NULL, 1),
	(43, 3, 13, 'Si', '2024-02-15 18:58:20', '2024-02-15 18:58:23', NULL, 1),
	(44, 1, 12, 'No', '2024-02-21 13:51:44', NULL, NULL, 1),
	(45, 1, 13, 'No', '2024-02-21 13:51:44', NULL, NULL, 1);

-- Volcando estructura para tabla asamblea.td_vacante_docente
CREATE TABLE IF NOT EXISTS `td_vacante_docente` (
  `vacanted_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) DEFAULT NULL,
  `vacante_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`vacanted_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.td_vacante_docente: ~8 rows (aproximadamente)
INSERT INTO `td_vacante_docente` (`vacanted_id`, `usu_id`, `vacante_id`) VALUES
	(13, 53, 1),
	(14, 53, 8),
	(15, 53, 9),
	(16, 53, 11),
	(17, 53, 13),
	(18, 53, 30),
	(19, 80, 1),
	(20, 84, 1),
	(21, 84, 11),
	(22, 89, 1);

-- Volcando estructura para tabla asamblea.tm_area
CREATE TABLE IF NOT EXISTS `tm_area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_area: ~6 rows (aproximadamente)
INSERT INTO `tm_area` (`area_id`, `area_nom`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Cargos', '2024-02-14 19:12:33', NULL, NULL, 1),
	(2, 'Comunicación y Expresión', '2024-02-14 19:12:42', NULL, NULL, 1),
	(3, 'Ciencias Sociales', '2024-02-14 19:12:48', NULL, NULL, 1),
	(4, 'Jurídicas y Contables', '2024-02-14 19:12:54', NULL, NULL, 1),
	(5, 'Técnicas y Modalidades', '2024-02-14 19:13:00', NULL, NULL, 1),
	(6, 'Exactas y Naturales', '2024-02-14 19:13:15', NULL, NULL, 1);

-- Volcando estructura para tabla asamblea.tm_documento
CREATE TABLE IF NOT EXISTS `tm_documento` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT NULL,
  `tra_id` int(11) DEFAULT NULL,
  `doc_externo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tip_id` int(11) DEFAULT NULL,
  `doc_dni` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_nom` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_descrip` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `doc_estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'Pendiente',
  `doc_respuesta` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_usu_terminado` int(11) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `fech_terminado` datetime DEFAULT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_documento: ~0 rows (aproximadamente)

-- Volcando estructura para tabla asamblea.tm_escuela
CREATE TABLE IF NOT EXISTS `tm_escuela` (
  `esc_id` int(11) NOT NULL AUTO_INCREMENT,
  `esc_nom` varchar(50) DEFAULT NULL,
  `esc_loc` varchar(50) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.tm_escuela: ~18 rows (aproximadamente)
INSERT INTO `tm_escuela` (`esc_id`, `esc_nom`, `esc_loc`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'ESRN 153', 'Choele Choel', '2024-02-09 00:36:26', '2024-02-09 00:38:28', NULL, 1),
	(2, 'CET 13', 'Choele Choel', '2024-02-09 00:38:39', '2024-02-09 00:39:43', NULL, 1),
	(3, 'ESRN 47', 'Choele Choel', '2024-02-09 00:38:50', NULL, NULL, 1),
	(4, 'CEM 130', 'Chimpay', '2024-02-09 00:40:25', NULL, NULL, 1),
	(5, 'CENS 14', 'Choele Choel', '2024-02-09 00:40:45', NULL, NULL, 1),
	(6, 'ESRN 52', 'Belisle', '2024-02-09 00:41:03', NULL, NULL, 1),
	(7, 'CET 20', 'Lamarque', '2024-02-09 00:41:20', NULL, NULL, 1),
	(8, 'RESIDENCIA', 'Choele Choel', '2024-02-09 00:42:04', NULL, NULL, 1),
	(9, 'CENS 24', 'Darwin', '2024-02-09 00:42:19', NULL, NULL, 1),
	(10, 'ESRN 55', 'Beltrán', '2024-02-09 00:42:39', NULL, NULL, 1),
	(11, 'CEM 127', 'Beltrán', '2024-02-09 00:42:58', NULL, NULL, 1),
	(12, 'CEM 63', 'Choele Choel', '2024-02-09 00:43:21', NULL, NULL, 1),
	(13, 'CET 29', 'Beltrán', '2024-02-09 00:43:39', NULL, NULL, 1),
	(14, 'ESRN 7', 'Lamarque', '2024-02-09 00:43:58', NULL, NULL, 1),
	(15, 'ESRN 135', 'Darwin', '2024-02-09 00:44:18', NULL, NULL, 1),
	(16, 'ESRN 139', 'Pomona', '2024-02-09 00:44:36', NULL, NULL, 1),
	(17, 'RES. MASC.', 'Beltrán', '2024-02-09 00:45:08', NULL, NULL, 1),
	(18, 'RES. FEM.', 'Beltrán', '2024-02-09 00:45:25', NULL, NULL, 1);

-- Volcando estructura para tabla asamblea.tm_menu
CREATE TABLE IF NOT EXISTS `tm_menu` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_nom` varchar(200) DEFAULT NULL,
  `men_nom_vista` varchar(200) DEFAULT NULL,
  `men_icon` varchar(200) DEFAULT NULL,
  `men_ruta` varchar(200) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`men_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.tm_menu: ~13 rows (aproximadamente)
INSERT INTO `tm_menu` (`men_id`, `men_nom`, `men_nom_vista`, `men_icon`, `men_ruta`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'home', 'Inicio', 'home', '../home/', '2024-01-23 13:48:05', NULL, NULL, 1),
	(2, 'nuevotramite', 'Nuevo Trámite', 'grid', '../NuevoTramite/', '2024-01-23 13:48:49', NULL, NULL, 1),
	(3, 'consultartramite', 'Consultar Trámite', 'users', '../ConsultarTramite/', '2024-01-23 13:50:07', NULL, NULL, 1),
	(4, 'iniciocolaborador', 'Inicio Administrador', 'home', '../homecolaborador/', '2024-01-23 13:51:11', NULL, NULL, 1),
	(5, 'gestionartramite', 'Gestionar Trámite', 'grid', '../gestionartramite/', '2024-01-23 13:52:06', NULL, NULL, 1),
	(6, 'buscartramite', 'Buscar Trámite', 'users', '../buscartramite/', '2024-01-23 13:53:09', NULL, NULL, 1),
	(7, 'mntcolaborador', 'Mantenimiento Usuarios', 'users', '../mntusuario/', '2024-01-23 13:54:46', NULL, NULL, 1),
	(8, 'mntarea', 'Mantenimiento Area', 'users', '../mntarea/', '2024-01-23 13:55:57', NULL, NULL, 1),
	(9, 'mnttramite', 'Mantenimiento Trámite', 'users', '../mnttramite/', '2024-01-23 13:57:08', NULL, NULL, 1),
	(10, 'mnttipo', 'Mantenimiento Tipo', 'users', '../mnttipo/', '2024-01-23 13:57:38', NULL, NULL, 1),
	(11, 'mntrol', 'Mantenimiento Rol', 'users', '../mntrol/', '2024-01-23 13:58:28', NULL, NULL, 1),
	(12, 'mntescuela', 'Mantenimiento Escuela', 'award', '../mntescuela/', '2024-02-08 19:36:05', NULL, NULL, 1),
	(13, 'mntvacantes', 'Mantenimiento Vacantes', 'grid', '../mntvacantes/', '2024-02-15 18:58:11', NULL, NULL, 1);

-- Volcando estructura para tabla asamblea.tm_rol
CREATE TABLE IF NOT EXISTS `tm_rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nom` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) DEFAULT 1,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_rol: ~5 rows (aproximadamente)
INSERT INTO `tm_rol` (`rol_id`, `rol_nom`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Persona', '2024-01-14 17:56:19', '2024-01-23 19:32:31', NULL, 1),
	(2, 'Colaborador', '2024-01-14 17:56:57', NULL, NULL, 1),
	(3, 'Administrador', '2024-01-14 17:57:16', NULL, NULL, 1),
	(4, 'Test2', '2024-01-23 13:26:42', '2024-01-23 13:31:47', '2024-01-23 13:32:58', 0),
	(5, 'Test', '2024-01-23 13:37:00', NULL, '2024-01-23 13:39:39', 0);

-- Volcando estructura para tabla asamblea.tm_tipo
CREATE TABLE IF NOT EXISTS `tm_tipo` (
  `tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`tip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_tipo: ~5 rows (aproximadamente)
INSERT INTO `tm_tipo` (`tip_id`, `tip_nom`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Natural', '2024-01-16 19:22:40', NULL, NULL, 1),
	(2, 'Jurídica', '2024-01-16 19:22:40', NULL, NULL, 1),
	(3, 'Otro', '2024-01-16 19:22:40', NULL, NULL, 1),
	(8, 'Test', '2024-01-18 19:09:51', NULL, '2024-01-19 21:15:58', 0),
	(9, 'Test 2', '2024-01-18 19:10:04', '2024-01-18 20:05:31', '2024-01-19 21:16:05', 0);

-- Volcando estructura para tabla asamblea.tm_tramite
CREATE TABLE IF NOT EXISTS `tm_tramite` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `tra_descrip` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`tra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_tramite: ~5 rows (aproximadamente)
INSERT INTO `tm_tramite` (`tra_id`, `tra_nom`, `tra_descrip`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Información Mensual de Liquidaciones', 'Documentación para la liquidación mensual de haberes.', NULL, '2024-01-26 18:28:22', NULL, 1),
	(2, 'Pedido de Suministros', 'Pedidos de material de administrativo.', NULL, '2024-01-26 18:29:07', NULL, 1),
	(3, 'Test1', 'Test 1', '2024-01-21 19:15:53', '2024-01-21 19:16:05', '2024-01-21 19:19:24', 0),
	(4, 'Información Mensual de Movilidad', 'Documentación mensual para la liquidación de movilidad.', '2024-01-26 18:29:52', NULL, NULL, 1),
	(5, 'Licencias', 'Información de licencias.', '2024-01-26 18:30:40', NULL, NULL, 1);

-- Volcando estructura para tabla asamblea.tm_usuario
CREATE TABLE IF NOT EXISTS `tm_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nomape` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `usu_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_pass` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usu_img` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `fech_crea` datetime NOT NULL DEFAULT current_timestamp(),
  `fech_acti` datetime NOT NULL,
  `fech_modi` datetime NOT NULL,
  `fech_elim` datetime NOT NULL,
  `est` int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla asamblea.tm_usuario: ~3 rows (aproximadamente)
INSERT INTO `tm_usuario` (`usu_id`, `usu_nomape`, `usu_correo`, `usu_pass`, `usu_img`, `rol_id`, `fech_crea`, `fech_acti`, `fech_modi`, `fech_elim`, `est`) VALUES
	(1, 'Guillermo Lapettina', 'glapettina@gmail.com', '8qOuUEJQ8GIZKghl3h1xRgBZxqrV6sCCcq0/8MrWRHs=', '', 3, '2024-01-02 20:00:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(53, 'Guillermo Lapettina', 'guillermolapettina@gmail.com', 'eBaTcYKbRC9NhBLI9dFfkP5V0Tt3G6hfJqvX+G7rnFs=', 'https://lh3.googleusercontent.com/a/ACg8ocKC4gWCjj4V9TJwrNE51kQROAfvnNcz7S2IGDxJzqMo=s96-c', 1, '2024-02-21 18:16:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(80, 'Guillermo Lapettina', 'guillermo@glsoftware.com.ar', 'jC3/2YFanZ7upRgcXXZyNTb8u7/LgBbw8KnLdcMlYNg=', '../../assets/picture/avatar.png', 1, '2024-02-22 09:30:04', '2024-02-22 09:44:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(89, 'Cuenta Prueba', 'cuentalape@gmail.com', 'iZIYnWfakMLG7EvuvZbjJXmWWvaLSKyA+9axJn6aoFA=', 'https://lh3.googleusercontent.com/a/ACg8ocKVVJTtTRYbdIgcP1-eA7VI_K1tRraWntw6CbiavIYH=s96-c', 1, '2024-02-22 18:16:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- Volcando estructura para tabla asamblea.tm_vacante
CREATE TABLE IF NOT EXISTS `tm_vacante` (
  `vacante_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT NULL,
  `esc_id` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `asignatura` varchar(200) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `horas` varchar(5) DEFAULT NULL,
  `turno` varchar(5) DEFAULT NULL,
  `origen` varchar(50) DEFAULT NULL,
  `docente` varchar(50) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`vacante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla asamblea.tm_vacante: ~19 rows (aproximadamente)
INSERT INTO `tm_vacante` (`vacante_id`, `area_id`, `esc_id`, `codigo`, `asignatura`, `id`, `horas`, `turno`, `origen`, `docente`, `fech_crea`, `fech_modi`, `fech_elim`, `estado`) VALUES
	(1, 1, 2, 400, 'Bibliotecario', 316, NULL, 'M', 'Lic. Art. 15º García, Laura', '', NULL, '2024-02-21 14:03:26', NULL, 1),
	(2, 1, 2, 310, 'Ayudante de Clases y TP de Física', 39, '', 'M', 'Lic. Art. 15° Jensen, Paula', '', NULL, '2024-02-20 20:56:44', NULL, 1),
	(3, 1, 2, 305, 'Ayudante de Clases y TP de Química', 273, '', 'M', 'Lic. Art. 15° Maquez, Marcela', '', NULL, NULL, NULL, 1),
	(6, 2, 11, 1900, 'Lengua y Literatura', 25, '4', 'N', 'Lic. Art. Nº 15º SOSA, Hugo', NULL, NULL, NULL, NULL, 1),
	(7, 2, 11, 1900, 'Lengua y Literatura', 26, '4', 'N', 'Lic. Art. Nº 15º SOSA, Hugo', NULL, NULL, NULL, NULL, 1),
	(8, 2, 4, 1900, 'Lengua y Literatura', 32, '4', 'N', 'Res. 997/06	', '', NULL, '2024-02-21 19:56:28', NULL, 1),
	(9, 3, 11, 1500, 'Historia', 27, '3', 'N', 'Lic Art. 9º 2do. Periodo', NULL, NULL, NULL, NULL, 1),
	(10, 4, 11, 900, 'Introd. Al Derecho	', 29, '2', 'N', 'Res. 288/06	', '', NULL, '2024-02-21 20:17:18', NULL, 1),
	(11, 4, 12, 800, 'Contabilidad', 23, '4', 'N', 'Res. 55217/08	', 'RENNI, Romina', NULL, '2024-02-22 11:36:33', NULL, 1),
	(12, 5, 2, 5000, 'Dibujo Técnico', 576, '4', 'T', '1224/15	', '', NULL, '2024-02-21 20:21:57', NULL, 1),
	(13, 5, 2, 5000, 'Dibujo Técnico', 574, '4', 'T', '1224/15', NULL, '2024-02-15 19:36:30', NULL, NULL, 1),
	(14, 5, 13, 6024, 'IEA Producción Porcina', 105, '20', 'M', 'Res 807/16 - Renuncia Mozzicafreddo Nazareno', NULL, '2024-02-15 19:49:41', NULL, '2024-02-15 20:37:33', 0),
	(18, 1, 15, 8064, 'REVE', 252, '9', 'M', 'Res. 1895/18', 'FIGUEROA, Alejandra', '2024-02-20 21:01:00', '2024-02-21 14:05:14', NULL, 1),
	(21, 1, 15, 200, 'Preceptor', 3, '20', 'M', 'LIC. ARTICULO Nº 15º ROSANA ZURITA', NULL, '2024-02-21 18:30:39', NULL, NULL, 1),
	(25, 3, 4, 1100, 'Educación Cívica', 23, '2', 'N', 'Lic. Art 15 Argaña María. E', '', '2024-02-21 20:09:56', '2024-02-21 20:10:23', NULL, 1),
	(26, 3, 5, 4100, 'Relaciones Públicas', 213, '3', 'V', 'Lic. Art 15 Argaña María. E', NULL, '2024-02-21 20:11:59', NULL, NULL, 1),
	(27, 6, 11, 2300, 'Química', 39, '3', 'N', 'Resol. 210/07', '', '2024-02-21 20:26:58', '2024-02-21 20:29:17', NULL, 1),
	(28, 6, 11, 2000, 'Matemática', 19, '4', 'N', 'Res. 288/06', NULL, '2024-02-21 20:27:52', NULL, NULL, 1),
	(29, 6, 5, 1300, 'Física', 14, '3', 'V', 'Res. 1536/00', NULL, '2024-02-21 20:28:23', NULL, NULL, 1),
	(30, 6, 5, 700, 'Biología', 12, '2', 'V', 'Ren. Molina Mirian', NULL, '2024-02-21 20:28:58', NULL, NULL, 1),
	(31, 3, 9, 1900, 'CONTABILIDAD', 999, '', '', '', NULL, '2024-02-24 09:44:56', NULL, NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
