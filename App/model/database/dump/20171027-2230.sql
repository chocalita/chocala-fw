-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2017 a las 03:20:26
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jobs`
--

DELIMITER $$
--
-- Funciones
--
DROP FUNCTION IF EXISTS `busca_avisos`$$
CREATE FUNCTION `busca_avisos` (`p_areas` VARCHAR(500), `p_formaciones` VARCHAR(500)) RETURNS VARCHAR(200) CHARSET utf8 COLLATE utf8_german2_ci BEGIN
	    DECLARE v_id_aviso_list VARCHAR(200) DEFAULT '';
    DECLARE v_item_area_formacion VARCHAR(100) DEFAULT '';
    DECLARE v_id_aviso INT;
    DECLARE v_idx_split INT;
    DECLARE v_idx_cursor INT;
    DECLARE v_count INT;
    DECLARE v_cargo VARCHAR(200);

        DECLARE cursor_areas CURSOR FOR
        SELECT id, cargo
          FROM job_aviso
         WHERE fecha_vencimiento IS NOT NULL
           AND fecha_vencimiento >= curdate()
           AND areas LIKE CONCAT('%',v_item_area_formacion,'%')
         ORDER BY fecha_vencimiento DESC;

        DECLARE cursor_formaciones CURSOR FOR
        SELECT id, cargo
          FROM job_aviso
         WHERE fecha_vencimiento IS NOT NULL
           AND fecha_vencimiento >= curdate()
           AND nivel_formacion LIKE CONCAT('%',v_item_area_formacion,'%')
         ORDER BY fecha_vencimiento DESC;

        IF p_areas != '' THEN
    	SET v_id_aviso_list = ';';
        SET v_idx_split = 1;
		SET v_item_area_formacion = split(p_areas, ';', v_idx_split);
        WHILE v_item_area_formacion != '' DO
        	            SELECT COUNT(*)
              INTO v_count
              FROM job_aviso
             WHERE fecha_vencimiento IS NOT NULL
               AND fecha_vencimiento >= curdate()
               AND areas LIKE CONCAT('%',v_item_area_formacion,'%');
        	IF v_count > 0 THEN
                                SET v_idx_cursor := 0;
                OPEN cursor_areas;
                WHILE v_idx_cursor < v_count DO
                    FETCH cursor_areas INTO v_id_aviso, v_cargo;
                                        IF INSTR(v_id_aviso_list, CONCAT(';', v_id_aviso, ';')) = 0 THEN
                        SET v_id_aviso_list = CONCAT(v_id_aviso_list, v_id_aviso, ';');
                    END IF;
                    SET v_idx_cursor = v_idx_cursor + 1;
                END WHILE;
                CLOSE cursor_areas;
            END IF;
            			SET v_idx_split = v_idx_split + 1;
            SET v_item_area_formacion = split(p_areas, ';', v_idx_split);
        END WHILE;
    END IF;

        IF p_formaciones != '' THEN
    	IF v_id_aviso_list = '' THEN
	    	SET v_id_aviso_list = ';';
        END IF;
		SET v_idx_split = 1;
		SET v_item_area_formacion = split(p_formaciones, ';', v_idx_split);
        WHILE v_item_area_formacion != '' DO
        	            SELECT COUNT(*)
              INTO v_count
              FROM job_aviso
             WHERE fecha_vencimiento IS NOT NULL
               AND fecha_vencimiento >= curdate()
               AND nivel_formacion LIKE CONCAT('%',v_item_area_formacion,'%');
        	IF v_count > 0 THEN
                                SET v_idx_cursor := 0;
                OPEN cursor_formaciones;
				WHILE v_idx_cursor < v_count DO
                    FETCH cursor_formaciones INTO v_id_aviso, v_cargo;
                                        IF INSTR(v_id_aviso_list, CONCAT(';', v_id_aviso, ';')) = 0 THEN
                        SET v_id_aviso_list = CONCAT(v_id_aviso_list, v_id_aviso, ';');
                    END IF;
                    SET v_idx_cursor = v_idx_cursor + 1;
                END WHILE;
				CLOSE cursor_formaciones;
            END IF;
            			SET v_idx_split = v_idx_split + 1;
            SET v_item_area_formacion = split(p_formaciones, ';', v_idx_split);
        END WHILE;
    END IF;

    IF SUBSTRING(v_id_aviso_list, -1, 1) = ';' THEN
    	SET v_id_aviso_list = SUBSTRING(v_id_aviso_list, 1, LENGTH(v_id_aviso_list) - 1);
    END IF;

    IF SUBSTRING(v_id_aviso_list, 1, 1) = ';' THEN
    	SET v_id_aviso_list = SUBSTRING(v_id_aviso_list, 2);
    END IF;


	RETURN v_id_aviso_list;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_area`
--

DROP TABLE IF EXISTS `job_area`;
CREATE TABLE IF NOT EXISTS `job_area` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(30) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` text,
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `job_area`
--

INSERT INTO `job_area` (`ID`, `CODIGO`, `NOMBRE`, `DESCRIPCION`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(5, 'IND', 'Industria', 'Plantas y Fábricas insdustriales', 'ACTIVE', 0, '2016-05-27 01:48:40', NULL),
(6, 'ejem', 'ejemplo', 'jlajdfsadfasdf', 'DELETED', 1, '2016-05-29 03:53:07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_area_habilidad`
--

DROP TABLE IF EXISTS `job_area_habilidad`;
CREATE TABLE IF NOT EXISTS `job_area_habilidad` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` text,
  `STATUS` varchar(10) NOT NULL,
  `LAST_USER_ID` int(11) NOT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_area_relacionada`
--

DROP TABLE IF EXISTS `job_area_relacionada`;
CREATE TABLE IF NOT EXISTS `job_area_relacionada` (
  `ID_AREA_1` int(11) NOT NULL,
  `ID_AREA_2` int(11) NOT NULL,
  `NIVEL` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_AREA_1`,`ID_AREA_2`),
  KEY `ID_AREA_1` (`ID_AREA_1`),
  KEY `ID_AREA_2` (`ID_AREA_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_area_tecnica`
--

DROP TABLE IF EXISTS `job_area_tecnica`;
CREATE TABLE IF NOT EXISTS `job_area_tecnica` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_AREA_PRINCIPAL` int(11) DEFAULT NULL,
  `NIVEL` int(11) DEFAULT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `KEYWORDS` varchar(500) DEFAULT NULL,
  `DESCRIPCION` text,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `job_area_tecnica`
--

INSERT INTO `job_area_tecnica` (`ID`, `ID_AREA_PRINCIPAL`, `NIVEL`, `NOMBRE`, `KEYWORDS`, `DESCRIPCION`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, NULL, 1, 'ingenieria', NULL, 'ing en ...', 'INACTIVE', 1, '2016-05-29 03:53:54', '2016-05-29 04:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_area_tecnica_profesion`
--

DROP TABLE IF EXISTS `job_area_tecnica_profesion`;
CREATE TABLE IF NOT EXISTS `job_area_tecnica_profesion` (
  `ID_AREA_TECNICA` int(11) NOT NULL,
  `ID_PROFESION` int(11) NOT NULL,
  `NIVEL` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_AREA_TECNICA`,`ID_PROFESION`),
  KEY `ID_AREA_TECNICA` (`ID_AREA_TECNICA`),
  KEY `ID_PROFESION` (`ID_PROFESION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_aviso`
--

DROP TABLE IF EXISTS `job_aviso`;
CREATE TABLE IF NOT EXISTS `job_aviso` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AREA_ID` int(11) DEFAULT NULL,
  `AREA_TECNICA_ID` int(11) DEFAULT NULL,
  `LOCALIZACION` varchar(50) DEFAULT NULL,
  `CARGO` varchar(200) DEFAULT NULL,
  `DESCRIPCION` text,
  `NOMBRE_EMPRESA` varchar(500) DEFAULT NULL,
  `DIRECCION` varchar(200) DEFAULT NULL,
  `TELEFONO_CONTACTO` int(11) DEFAULT NULL,
  `CORREO_CONTACTO` varchar(100) DEFAULT NULL,
  `FECHA_PUBLICACION` date DEFAULT NULL,
  `FECHA_VENCIMIENTO` date DEFAULT NULL,
  `REQUISITO` varchar(2000) DEFAULT NULL,
  `ANIOS_EXPERIENCIA` int(11) DEFAULT NULL,
  `NIVEL_FORMACION` varchar(200) DEFAULT NULL,
  `SALARIO` decimal(11,0) DEFAULT NULL,
  `PROFESION` varchar(200) DEFAULT NULL,
  `FUENTE` varchar(500) DEFAULT NULL,
  `TIENE_IMAGEN` tinyint(1) NOT NULL DEFAULT '0',
  `MIMETYPE` varchar(30) DEFAULT NULL,
  `AREAS_REFERENCIA` varchar(500) DEFAULT NULL,
  `FORMACIONES_REFERENCIA` varchar(2000) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` varchar(20) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FORMACION_ACADEMICA_ID` (`NIVEL_FORMACION`),
  KEY `AREA_ID` (`AREA_ID`),
  KEY `AREA_TECNICA_ID` (`AREA_TECNICA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `job_aviso`
--

INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `AREAS_REFERENCIA`, `FORMACIONES_REFERENCIA`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 5, NULL, NULL, 'Secretaria Ejecutiva', 'Se requiere Secretaria Ejecutiva, tambien se aceptan pasantías de las carreras Administración de Empresas o Ingeniería Comercial, sueldo atractivo', 'Empresa Constructora / Bienes Raices', 'Miraflores, Edif. Olimpia 1er piso Of. 103, frente al estadium', 2228335, '', '2016-05-29', '2016-06-01', '- Secretaria Ejecutiva\r\nOptativo:\r\n- Estudiante Administración de Empresas\r\n- Estudiante Ingenieria Comercial', 0, 'TECNICO', NULL, NULL, 'Extra', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-05-29 23:00:00', '2016-05-29 23:00:00'),
(2, 5, NULL, NULL, 'Personal de Seguridad', 'Se requiere personal de seguridad física en horarios de 12h y 24h, desarrollo de actividades en Zona Sur y El Alto', 'Empresa de Seguridad Física', 'Av. Landaeta #547-A casi esq. Crespo, Zona San Pedro', 78846046, '', '2016-05-29', '2016-06-04', 'Personas con o sin experiencia en trabajos de seguridad', 0, 'SIN FORMACION', NULL, NULL, 'Extra', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-05-29 23:00:00', '2016-05-29 23:00:00'),
(3, 5, NULL, NULL, 'Auxiliar de contabilidad', 'Auxiliar de contabilidad recien egresad@', 'Catering', 'Av. Buenos Aires', 76565749, '', '2016-05-29', '2016-06-04', 'Egresad@', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-01 02:00:00', NULL),
(4, 5, NULL, NULL, 'Encargado de Almacen', 'Se requiere encarado de almacen, preferibelemente con experiencia.', 'Empresa Comercial', 'Ciudad de El Alto', 2852222, '', '2016-06-03', '2016-06-08', '- Manejo de invetarios\r\n- Control de almacenes', 1, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(6, 5, NULL, NULL, 'Ingeniero en Alimentos Junior', 'Heladeria requiere ingeniero alimentos junior /químico enviar C.V. y pretensión salarial.', 'Querubines y Diablitos', NULL, 71526672, 'querubinesydiablitos', '2016-06-03', '2016-06-11', 'Imgeniero en Alimentos / Ingeniero Químico', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', '2016-06-04 02:00:00'),
(7, 5, NULL, NULL, 'Auxiliar Contable', 'Se requiere para El alto auxiliar contable con conocimiento en inventarios.', 'El Provenir', NULL, 0, 'admin@elporvenir-bo.', '2016-06-03', '2016-06-08', 'Contabiidad General', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(9, 5, NULL, NULL, 'Almacenero', 'Empresa importadora requiere los servicios de un almacenero para El Alto con conocimientos de kardex enviar curriculum y carta con pretensión salarial.', 'Empresa Importadora', 'Calle Alto de la Alienza Nro: 608 (casi esquina Ingavi)', 0, '', '2016-06-03', '2016-06-09', 'Conocimiento en manejo de almacenes e inventarios.', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(10, 5, NULL, NULL, 'Ingeniero Civil Junior', 'Empresa constructora requiere ingeniero civil junior con registro para residente de obra', 'Empresa Constructora', NULL, 76681226, '', '2016-06-03', '2016-06-12', 'Egresado o Licenciado en Ingenieria Civil', 0, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(11, 5, NULL, NULL, 'Secretaria Recepcionista', 'Se requiere una secretaria recepcionista con conocimientos de enfermeria.\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Secretaria Ejecutiva\r\nEnfermeria básica', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(12, 5, NULL, NULL, 'Personal de Mantenimiento - Camillero', 'Se requiere un camillero / asistente de mantenimientos\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Formación bachiller', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', NULL),
(13, 5, NULL, NULL, 'Médico Radiólogo', 'Se requiere un médico Radiólogo, especialidad ecografista.\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Medico Radiólogo', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-04 02:00:00', '2016-06-14 02:00:00'),
(14, 5, NULL, NULL, 'Docente de Plomeria', 'Instituto Tecnologico Mariscal Sucre requiere docente de plomeria, de preferencia con certificaciones ministeriales', 'Instituto Tecnologico Mariscal Sucre', 'Calle Chuquizaca # 697esquina Paza Alonso de Mendoza', 2451191, 'itmsucre@gmail.com', '2016-06-13', '2016-06-18', '- Experiencia laboral certificada mínima de 4 años\r\n- Certificaciones ministeriales', 3, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-14 02:00:00', NULL),
(16, 5, NULL, NULL, 'Encargado de Ventas', 'Se solicita personal para el área de ventas ofrece buen sueldo estabilidad laboral, seguro y aporte AFP''S ', '24 HS', NULL, 76799508, '', '2016-06-13', '2016-06-21', 'Experiencia en Ventas', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-14 02:00:00', NULL),
(17, 5, NULL, NULL, 'Contador/Auditor', 'Se require Contadores y Auditores ', 'Consultora Caft SRL', NULL, 2200287, '', '2016-06-13', '2016-06-15', '- Experiencia profesional de 2 años\r\n- Conocimientos de contabilidad de costos', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-14 02:00:00', NULL),
(18, 5, NULL, NULL, 'Ortodoncista', 'Se requiere Ortodoncista, preferentemente especializado en odontopediatria', 'Clínica Bolivia Dent', NULL, 2825588, 'clinicaboliviadent@g', '2016-06-20', '2016-06-30', '- Licenciatura en Odontología\r\n- Especialidad en Ortodoncia\r\n- Deseable especialidad en odontopediatria', 2, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-22 02:00:00', NULL),
(20, 5, NULL, NULL, 'Pastelero', 'Pastelero/Repostero, con buenas habilidades en decoración', 'Restaurante Madagascar', 'Av/Raul Salmon #21 Ceja El Alto', 2825107, '', '2016-06-21', '2016-07-02', '- Certificación de trabajos en reposteria/pasteleria\r\n- Certtificación de formación en areas gastronómicas (deseable)', 4, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-22 02:00:00', NULL),
(21, 5, NULL, NULL, 'Ejecutivos de Venta', 'Empresa de Servicios Publicitarios requiere ejecutivos de ventas con experiencia en el rubro', 'Imago', NULL, 76339393, 'rroman@imago.com.bo', '2016-06-21', '2016-07-08', 'Experiencia en ventas y/o marketing', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-22 02:00:00', NULL),
(22, 5, NULL, NULL, 'Chofer de Cisterna', 'Se requiere chófer para cisterna, con licencia categoria "C" con experiencia y garantías interesados presentar hoja de vida en la gasolinera Volcan ubicada en la Av.Montes Esq. Pando ', 'Estación de Servicios Volcan S.R.L', 'Av.Montes Esq. Pando', 0, '', '2016-06-21', '2016-07-06', 'Licencia de Conducir Categoría "C"\r\nExperiencia en manejo de cisterna\r\nGarantias personasles y financieras', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-22 02:00:00', NULL),
(23, 5, NULL, NULL, 'Regente Farmaceútico', 'Se precisa regente farmaceutico con registro en colegio/sociedad de profesionales de area farmacológica.', 'BESCOS S.R.L. ', 'c/Capitán Ravelo #2124 frente al Hotel Camino Real.', 2442766, '', '2016-06-21', '2016-07-09', '- Titulo en Prov. Nal. en Farmacología o ramas afines\r\n- Registro Profesional en colegio de farmacólogos\r\n- Experiencia laboral mínima de 7 años en el área', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-06-22 02:00:00', '2016-06-22 02:00:00'),
(24, 5, NULL, NULL, 'Data Analyst', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'eoc enterprice', 'santa Cruz', 78955556, 'a@mail.com', '2016-06-21', '2016-07-09', ' Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-09-02 02:00:00', NULL),
(25, 5, NULL, NULL, 'infromatica', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'OEC ENTERPRICE', 'SANTA CRUZ', 78565645, 'a@mail.com', '2016-09-01', '2016-09-25', 'Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-09-02 02:00:00', NULL),
(26, 5, NULL, NULL, 'infromatica', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'OEC ENTERPRICE', 'SANTA CRUZ', 78565645, 'a@mail.com', '2016-09-01', '2016-09-25', 'Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-09-02 02:00:00', NULL),
(27, 5, NULL, NULL, 'Contador / Auditor ', 'Empresa en el Turrode cconstrucción requiere incorporar un contador o auditor a tiempo completo, enviar hoja de vida indicando propulsión salarial  ', 'Empresa Constructora ', 'El Alto', 0, 'bqconstruc@gmail.com', '2016-12-18', '2016-12-22', 'Licenciatura en contaduría publica  o auditoría ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-12-19 04:00:00', NULL),
(28, 5, NULL, NULL, 'Admistrador ', 'Administrador ', 'constructora', 'El Alto', 0, 'bqconstructor@gmail.', '2016-12-18', '2016-12-22', 'Licenciatura en administración de empresas o ramas afines  ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-12-19 04:00:00', NULL),
(29, 5, NULL, NULL, 'Secretaria ', 'Responsabilidad, iniciativa, organizacion, disponibilidad y capacidad de trabajo bbajoppresión ', 'Protel', NULL, 0, 'recursos.humanos@pro', '2016-12-18', '2016-12-30', 'Buena comunicación oral y escrita / manejo de paquetes de ccomputación  ', 2, 'TECNICO', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-12-19 04:00:00', NULL),
(30, 5, NULL, NULL, 'Comunicador Social', 'Que tenga manejo de redes sociales, ccoordinación con medios de ccomunicación, capacidad de relacionamiento ', 'Emaverde', 'La Paz', 0, '', '2016-12-18', '2016-12-24', 'Los Interesados deberán dejar su currículum vítae(fotocopias), indicando su pretension salarial  en un sobre cerrado hasta las 19:00 pm del día viernes 24 delpresente en el edificio EMAVERDE planta baja ubicado en la calle Francisco Bedegral N° 816 zona bajo sopocachi ', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-12-19 04:00:00', NULL),
(31, 5, NULL, NULL, 'Ingeniero Civil ', 'Ingeniero Civil ', 'CONSTRUCTORA', NULL, 0, 'requerimientopersona', '2016-12-18', '2017-01-06', 'Que tenga conocimiento en construcciónde de puentes en volados sucesivos, carreteras y topografías ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2016-12-20 04:00:00', NULL),
(32, 5, NULL, NULL, 'INGENIERO ELECTRICO', 'Predisposición para viajes, al interior y área rural del país. Enviar Hoja de Vida.', 'ARCON BOLIVIA', NULL, 73235485, 'rrhh@arconbolivia.co', '2017-01-08', '2017-01-14', 'Titulado con experiencia en acometidas electricas, tableros, puestos de transformación. \r\nDisponibilidad de viajes por el interior del país.', 2, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2017-01-10 04:00:00', NULL),
(33, 5, NULL, NULL, 'SECRETARIA / CONTADORA', 'Se requiere Secretaria Titulada con conocimientos de contabilidad.\r\nPuesto de trabajo en la Zona Sur', 'ARCON BOLIVIA', NULL, 73235485, 'rrhh@arconbolivia.co', '2017-01-08', '2017-01-13', 'Títulada Técnico Medio/Superior, ', 1, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2017-01-10 04:00:00', NULL),
(34, 5, NULL, NULL, 'cargo', 'puesto 1 vacante', 'empresa 1', 'direccion numero 1', 777777123, 'hola@mail.com', '2017-01-15', '2017-01-20', 'muchos requisitos', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, NULL, NULL, 'ACTIVE', '1', '2017-01-15 20:00:00', NULL),
(35, 5, NULL, NULL, 'Contador General', '*Ver Imagen', 'Empresa Financiera de Servicios Complementarios', NULL, 0, NULL, '2017-02-12', '2017-02-18', '- Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(36, 5, NULL, NULL, 'Auxiliar Contable', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(37, 5, NULL, NULL, 'Licenciada en Enfermeria', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(38, 5, NULL, NULL, 'Cajero(as)', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(39, 5, NULL, NULL, 'Atención al Cliente', '- Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'BACHILLER', NULL, NULL, '', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(40, 5, NULL, NULL, 'Asistente Administrativo', '*Ver Imagen', 'Aldeas Infantiles SOS', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver Imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(41, 5, NULL, NULL, 'Facturador/a', '*Ver imagen', 'Empresa Farmaceutica', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(42, 5, NULL, NULL, 'Ingeniero Civil', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-19', '2017-02-19', '*Ver imagen', 8, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(43, 5, NULL, NULL, 'Ingeniero Ambiental', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-19', '2017-02-12', '*Ver imagen', 8, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(44, 5, NULL, NULL, 'Ingeniero Mecanico', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 6, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', '2017-02-12 20:00:00'),
(45, 5, NULL, NULL, 'Sociologo/Abogado', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(46, 5, NULL, NULL, 'Analista Programador', '*Ver imagen', 'BMSC', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(47, 5, NULL, NULL, 'Asistente de Desarrollo Tecnológico (Sistemas)', '*Ver imagen', 'FUNDEMPRESA', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(48, 5, NULL, NULL, 'Asistente Comercial', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(49, 5, NULL, NULL, 'Asesor de Negocios MyPE', '*Ver imagen', 'Banco Económico', '*Ver imagen', 0, NULL, '2017-02-12', '2017-02-21', '*Ver imagen', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(50, 5, NULL, NULL, 'Contador/a General', '*Ver imagen', 'Empresa Farmaceutica', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, '', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', '2017-02-12 20:00:00'),
(51, 5, NULL, NULL, 'Economista', '*Ver imagen', 'Entidad Descentralizada', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 4, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(52, 5, NULL, NULL, 'Ingeniero de Sistemas', '*Ver Imagen', 'PROCOSI', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver Imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(53, 5, NULL, NULL, 'Jefe de Mantenimiento', '*Ver imagen', 'Industria Copacabana S.A.', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(54, 5, NULL, NULL, 'Responsable Técnico Apicultor', '*Ver imagen', 'Pacha Trek', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 2, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(55, 5, NULL, NULL, 'Mercadeo y Posicionamiento', '*Ver imagen', 'Pacha Trek', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 4, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(56, 5, NULL, NULL, 'Supervisor de Atención al Cliente', '*Ver imagen', 'Hotel Camino Real', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 4, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(57, 5, NULL, NULL, 'Médico', '*Ver imagen', 'Pro mujer', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(58, 5, NULL, NULL, 'Impulsador/a Vendedor/a', '*Ver imagen', 'Foodwell', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(59, 5, NULL, NULL, 'Asistente de Limpieza', '*Ver imagen', 'Empresa de Sector', NULL, 77293959, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(60, 5, NULL, NULL, 'Reponedor/a - Impulsador/a', '*Ver imagen', 'Empresa de Sector', NULL, 2910750, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(61, 5, NULL, NULL, 'Promotor/a de Ventas', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(62, 5, NULL, NULL, 'Mensajero', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(63, 5, NULL, NULL, 'Responsable de Fidelización de Donantes', '*Ver imagen', 'Aldeas Infantiles SOS', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(64, 5, NULL, NULL, 'Ejecutivo/a Comercial', '*Ver imagen', 'Empresa Privada', NULL, 0, NULL, '2017-02-12', '2017-02-21', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(65, 5, NULL, NULL, 'Ejecutivo/a de Ventas y Asesoramiento Técnico', '*Ver imagen', 'Electrotelefonía Boliviana Ltda.', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(66, 5, NULL, NULL, 'Despachador/a', '*Ver imagen', 'COFAR', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(67, 5, NULL, NULL, 'Jefe de Recursos Humanos', '*Ver imagen', 'Mutual de Servicios al Policia', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(68, 5, NULL, NULL, 'Responsable de Procesos Técnicos de Conservación', '*Ver imagen', 'Mutual de Servicios al Policia', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(69, 5, NULL, NULL, 'Técnico de Archivo', '*Ver imagen', 'Mutual de Servicios al Policia', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 1, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(70, 5, NULL, NULL, 'Recepcionista Nocturno', '*Ver imagen', 'Mutual de Servicios al Policia', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 1, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(71, 5, NULL, NULL, 'Camarera', '*Ver imagen', 'Mutual de Servicios al Policia', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 1, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(72, 5, NULL, NULL, 'Ejecutivo/a Comercial', '*Ver imagen', 'FullAssistance', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(73, 5, NULL, NULL, 'Cocinero/a', '*Ver imagen', 'Restaurante', NULL, 76753266, NULL, '2017-02-12', '2017-02-14', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(74, 5, NULL, NULL, 'Ayudante de Cocina', '*Ver imagen', 'Restaurante', NULL, 69839470, NULL, '2017-02-12', '2017-02-14', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(75, 5, NULL, NULL, 'Arquitectos(as)', '*Ver imagen', 'Creatica Suppliers SRL', NULL, 0, NULL, '2017-02-12', '2017-02-23', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(76, 5, NULL, NULL, 'Secretaria Ejecutiva', '*Ver imagen', 'Empresa Financiera', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(77, 5, NULL, NULL, 'Asistente Contable', '*Ver imagen', 'Empresa Financiera', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(78, 5, NULL, NULL, 'Asistente de Sistemas', '*Ver imagen', 'Empresa Financiera', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 1, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(79, 5, NULL, NULL, 'Asistente de Cumplimiento  y Riesgo', '*Ver imagen', 'Empresa Financiera', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(80, 5, NULL, NULL, 'Agentes de Seguros', '*Ver imagen', 'Nacional Seguros', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(81, 5, NULL, NULL, 'Jefe de Abastecimiento', '*Ver imagen', 'Empresa (El Alto)', NULL, 0, NULL, '2017-02-12', '2017-02-21', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(82, 5, NULL, NULL, 'Jefe/a Nacional de Servicios Educativos', '*Ver imagen', 'Crecer', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 0, 'MAESTRIA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(83, 5, NULL, NULL, 'Personal de Ventas', '*Ver imagen', 'Breick Bombonerias', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(84, 5, NULL, NULL, 'Ejecutivo Comercial', '*Ver imagen', 'Seven English', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(85, 5, NULL, NULL, 'Auxiliar Contable', '*Ver imagen', 'Empresa de Servicios', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(86, 5, NULL, NULL, 'Cocinero', '*Ver imagen', 'Privado', NULL, 67010310, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(87, 5, NULL, NULL, 'Auditores Senior / Junior', '*Ver imagen', 'Z.R.', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(88, 5, NULL, NULL, 'Auditor', '*Ver imagen', 'Empresa de Servicios', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(89, 5, NULL, NULL, 'Auxiliar de Metal Mecanica', '*Ver imagen', 'DPI Gigantografia industrial S.R.L.', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(90, 5, NULL, NULL, 'Ingeniero de Proyectos', '*Ver imagen', 'Proyecto Quinua', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(91, 5, NULL, NULL, 'Analista de Calidad y Procesos', '*Ver imagen', 'Crecer', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(92, 5, NULL, NULL, 'Preventistas', '*Ver imagen', 'Empresa Distribuidora', NULL, 2307428, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', '2017-02-12 20:00:00'),
(93, 5, NULL, NULL, 'Conserje de Edificio', '*Ver imagen', 'Edificio Privado', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(94, 5, NULL, NULL, 'Ejecutivo/a de Ventas', '*Ver imagen', 'Astrix SA', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(95, 5, NULL, NULL, 'Analista Comercial', '*Ver imagen', 'Hansa Ltda', NULL, 0, NULL, '2017-02-12', '2017-02-28', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(96, 5, NULL, NULL, 'Ejecutivo de Ventas de Autos', '*Ver imagen', 'Hansa Ltda', NULL, 0, NULL, '2017-02-12', '2017-02-28', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(97, 5, NULL, NULL, 'Administrador', '*Ver imagen', 'Bolivia Retail Solutions SRL', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(98, 5, NULL, NULL, 'Asesor/a Optica', '*Ver imagen', 'Clínica de Marketing y Negocios', NULL, 0, NULL, '2017-02-12', '2017-02-13', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-12 20:00:00', NULL),
(99, 5, NULL, NULL, 'Analista Contable SOAT', '*Ver imagen', 'UNIVIDA', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, '', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', '2017-02-13 20:00:00'),
(100, 5, NULL, NULL, 'Analista de Investigación Financiera', '*Ver imagen', 'UNIVIDA', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(101, 5, NULL, NULL, 'Analista de Impuestos', '*Ver imagen', 'UNIVIDA', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(102, 5, NULL, NULL, 'Analista Contable de Cobranzas', '*Ver imagen', 'UNIVIDA', NULL, 0, NULL, '2017-02-12', '2017-02-14', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(103, 5, NULL, NULL, 'Modelos Mujeres y Varones', '*Ver imagen', 'Fashion School', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(104, 5, NULL, NULL, 'Encargado de Ventas y Marketing', '*Ver imagen', 'Hotel Zona Sur', NULL, 0, NULL, '2017-02-12', '2017-02-21', '*Ver imagen', 1, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(105, 5, NULL, NULL, 'Asistente de Producción de Planta', '*Ver imagen', 'Empresa Productiva', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 1, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(106, 5, NULL, NULL, 'Jefe de Residentes', '*Ver imagen', 'NIEMEYER', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 10, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(107, 5, NULL, NULL, 'Ingeniero de Planificación y Control', '*Ver imagen', 'NIEMEYER', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(108, 5, NULL, NULL, 'Vendedor/a de Panaderia', '*Ver imagen', 'GUSTU Gastronomia S.A.', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 1, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(109, 5, NULL, NULL, 'Chofer / Encargado(a) de Mantenimiento', '*Ver imagen', 'GUSTU Gastronomia S.A.', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(110, 5, NULL, NULL, 'Asistente de Ventas', '*Ver imagen', 'Late Bolivia', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(111, 5, NULL, NULL, 'Jefe Nacional de Ventas', '*Ver imagen', 'Editorial Don Bosco', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(112, 5, NULL, NULL, 'Asistente de Dirección', '*Ver imagen', 'Editorial Don Bosco', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(113, 5, NULL, NULL, 'Encargado/a de Recursos Humanos', '*Ver imagen', 'Editorial Don Bosco', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(114, 5, NULL, NULL, 'Contador/a General', '*Ver imagen', 'Editorial Don Bosco', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(115, 5, NULL, NULL, 'Encargado/a de Almacen', '*Ver imagen', 'Editorial Don Bosco', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 5, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(116, 5, NULL, NULL, 'Asesor/a de Ventas', '*Ver imagen', 'MONOPOL', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(117, 5, NULL, NULL, 'Auxiliar Contable/Almacenes', '*Ver imagen', 'Hotel Rosario', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(118, 5, NULL, NULL, 'Ayudante de Cocina', '*Ver imagen', 'Hotel Rosario', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(119, 5, NULL, NULL, 'Panadero Pastelero', '*Ver imagen', 'Hotel Rosario', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 1, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(120, 5, NULL, NULL, 'Auxiliar de Oficina', '*Ver imagen', 'MATRIPLAST', NULL, 0, NULL, '2017-02-12', '2017-02-14', '*Ver imagen', 2, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(121, 5, NULL, NULL, 'Agrónomo', '*Ver imagen', 'PRO-RURAL', NULL, 0, NULL, '2017-02-12', '2017-02-20', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(122, 5, NULL, NULL, 'Vendedor/a de Luminarias LED', '*Ver imagen', '*Ver imagen', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(123, 5, NULL, NULL, 'Arquitecto/a', '*Ver imagen', 'Empresa Transnacional', NULL, 0, NULL, '2017-02-12', '2017-02-24', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(124, 5, NULL, NULL, 'Gestor de Cobranza', '*Ver imagen', 'ECOFUTURO', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(125, 5, NULL, NULL, 'Administrador o Equivalente', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 12, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(126, 5, NULL, NULL, 'Ingeniero Electricista o Equivalente', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 10, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(127, 5, NULL, NULL, 'Ingeniero Geotecnista', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 15, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(128, 5, NULL, NULL, 'Ingeniero Electromecánico', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 15, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(129, 5, NULL, NULL, 'Ingeniero Mecánico o Equivalente', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 6, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(130, 5, NULL, NULL, 'Ingeniero Geólogo o Equivalente', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 15, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-13 20:00:00', NULL),
(131, 5, NULL, NULL, 'Ingeniero Eléctrico, Mecánico, Electromecánico o Equivalente', '*Ver imagen', 'Empresa Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-20', '*Ver imagen', 15, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(132, 5, NULL, NULL, 'Regente / Auxiliar Farmaceutico', '*Ver imagen', 'HIPERMAXI', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(133, 5, NULL, NULL, 'Distribuidor / Marketing', '*Ver imagen', 'Empresa Distribuidora', NULL, 0, NULL, '2017-02-12', '2017-02-14', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(134, 5, NULL, NULL, 'Química Farmaceutica', '*Ver imagen', 'Addax Internacional', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(135, 5, NULL, NULL, 'Atención al Cliente', '*Ver imagen', 'INTERSALUD', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(136, 5, NULL, NULL, 'Venderod/a de Tienda', '*Ver imagen', 'DISMAC', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 2, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(137, 5, NULL, NULL, 'Profesional en Comercio Exterior', '*Ver imagen', 'EBA', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ADUANAS;COMERCIALIZACIÓN;COMERCIO EXTERIOR;RELACIONES INTERNACIONALES;TRIBUTACIÓN E IMPUESTOS', 'COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-02-14 20:00:00', '2017-02-19 20:00:00'),
(138, 5, NULL, NULL, 'Mensajero', '*Ver imagen', 'INTERSALUD', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, NULL, NULL, 'ACTIVE', '1', '2017-02-14 20:00:00', NULL),
(141, NULL, NULL, 'LA PAZ', 'SecretARIA', NULL, 'LA PA ', NULL, 2147483647, 'PABA', '2017-09-04', '2017-09-06', 'AAAAAAAAAA', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS', 'BIBLIOTECOLOGÍA Y CIENCIAS DE LA INFORMACIÓN;BIOMÉDICO', 'DELETED', '1', '2017-09-04 19:00:00', NULL),
(143, NULL, NULL, 'LA PAZ', 'Secretaria ', NULL, 'Empresa Farmacéutica', NULL, 0, 'convocatoria.secreta', '2017-09-04', '2017-09-06', 'Dominio en manejo de paquetes de computación.\r\nBuen conocimiento de técnicas de archivo y orden.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'HABILIDADES SECRETARIALES', 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-09-04 19:00:00', NULL),
(144, NULL, NULL, 'LA PAZ', 'Secretaria y relacionador/a publico/a', NULL, 'Empresa de carga aérea', NULL, 0, NULL, '2017-09-03', '2017-09-07', 'Contar con el nivel de licenciatura o técnico superior en comunicación. Requisitos ver la imagen.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'COMPUTACIÓN;HABILIDADES SECRETARIALES', 'SECRETARIADO COMERCIAL;SECRETARIADO COMPUTACIONAL;SECRETARIADO EJECUTIVO;TURISMO', 'ACTIVE', '1', '2017-09-04 19:00:00', '2017-09-04 19:00:00'),
(145, NULL, NULL, 'LA PAZ', 'Gerente Comercial', NULL, 'Seguros Illimani', NULL, 0, 'rrhh@segurosillimani', '2017-09-03', '2017-09-07', 'Ver imagen los requisitos.\r\n', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;MARKETING', 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-04 19:00:00', NULL),
(146, NULL, NULL, 'LA PAZ', 'Encargado nacional de transporte', NULL, 'Empresa líder en distribución y comercialización', NULL, 0, 'reclutamientoempresacomercial2@gmail.com', '2017-09-03', '2017-09-08', 'Ver en la imagen los requisitos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADUANAS;COMERCIO EXTERIOR', 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-04 19:00:00', '2017-09-04 19:00:00'),
(147, NULL, NULL, 'LA PAZ', 'Encargado nacional de transporte', NULL, 'Empresa líder en distribución y comercialización de productos de consumo masivo', NULL, 0, 'reclutamientoempresa', '2017-09-03', '2017-09-08', 'Ver en la imagen los requisitos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADUANAS;COMERCIO EXTERIOR', 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-04 19:00:00', NULL),
(148, NULL, NULL, 'LA PAZ', 'Encargado de almacenes', NULL, 'Empresa comercial', NULL, 0, 'gutierrezjohn65@gmail.com', '2017-09-03', '2017-09-08', 'Titulado/a o egresado/a de la carrera de Administración,\r\nDebe presentar garantía real de un bien inmueble.\r\nVer los demás requisitos en la imagen.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;COMERCIALIZACIÓN', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;TÉCNICAS EN APLICACIÓN', 'ACTIVE', '1', '2017-09-04 19:00:00', '2017-09-04 19:00:00'),
(149, NULL, NULL, 'LA PAZ', 'Promotor/a de ventas ', NULL, 'Laboratorio farmacéutico', NULL, 0, 'requerimientorrhh2017@gmail.com', '2017-09-03', '2017-09-08', 'Experiencia y conocimiento del mercado farmacéutico, publico y privado con habilidades para la promoción y ventas.\r\nConocimiento de las rutas de trabajo de la ciudad de El Alto (Indispensable)\r\nOtros requisitos ver la imagen.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'MEDICINA', 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-09-04 19:00:00', NULL),
(150, NULL, NULL, 'LA PAZ', 'Coordinador de programas', NULL, 'Gestión Organizacional', NULL, 72024176, 'gestion.organizacional.tm@gmail.com', '2017-09-03', '2017-09-10', 'Profesional titulado en gestion y ramas sociales.\r\nManejo y dominio del idioma ingles\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'IDIOMAS;PLANIFICACIÓN;PROYECTOS', 'GESTIÓN AMBIENTAL', 'ACTIVE', '1', '2017-09-04 19:00:00', NULL),
(151, NULL, NULL, 'LA PAZ', 'Encargado/a de afiliaciones y vigencia de derechos', NULL, 'Seguro medico delegado de cotel', NULL, 2392544, 'sharimbascope@gmail.com', '2017-09-03', '2017-09-07', 'Conocimiento y manejo del código de seguridad social.\r\nmanejo de paquete de computación entorno a Windows, MS Office e internet.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA', 'ADMINISTRACIÓN', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(152, NULL, NULL, 'LA PAZ', 'Administrador/a de campo', NULL, 'Empresa de construcción industrial', NULL, 0, 'buscandotalentosscz@gmail.com', '2017-09-03', '2017-09-07', 'Profesional o egresado/a en áreas administrativas', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS', 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(153, NULL, NULL, 'LA PAZ', 'Cajero/a', NULL, 'Brinks', NULL, 72056901, 'rrhh-seleccion-lp@brinksbolivia.com', '2017-09-03', '2017-09-08', 'Egresado/a , estudiante o técnico en adm. de empresas, ing. comercial, auditoria o carreras afines.\r\nConocimiento de manejo de efectivo y documentos mercantiles.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;AUDITORÍA GENERAL;CONTABILIDAD', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(154, NULL, NULL, 'LA PAZ', 'Jefe de marketing', NULL, 'empresa líder en servicios', NULL, 0, 'lp.empresa.servicios.rrhh@gmail.com', '2017-09-03', '2017-09-08', 'Formación académica en ingeniería comercial, marketing o administración de empresas.\r\nOtros requisito ver en imagen.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;MARKETING', 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(155, NULL, NULL, 'LA PAZ', 'Desarrollador comercial', NULL, 'empresa líder en servicios', NULL, 0, 'lp.empresa.servicios.rrhh@gmail.com', '2017-09-03', '2017-09-08', 'Profesional con formación en ingeniería comercial, marketing o administración de empresas.\r\nExperiencia en venta de servicios a clientes cooperativos.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;MARKETING', 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(156, NULL, NULL, 'LA PAZ', 'Analistas de riesgo', NULL, 'PCRI', NULL, 0, 'Reclutamiento@ratingspcr.com', '2017-09-03', '2017-09-08', 'Titulo de licenciatura en economía, administración, finanzas, ingeniería.\r\nDominio de ingles.\r\nManejo de paquetes de computación.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ECONOMÍA;FINANZAS', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(157, NULL, NULL, 'LA PAZ', 'Auditor de proyectos ', NULL, 'Proyectos', NULL, 72024176, 'gestion.organizacional.tm@gmail.com', '2017-09-03', '2017-09-10', 'Profesional titulado en contaduría publica o auditoria con firma registrada en el colegio de contadores.\r\nSolido conocimiento en auditoria financiera, monitoreo e identificación de riesgos.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'AUDITORÍA GENERAL', 'AUDITORÍA;AUDITORIA FINANCIERA;CONTADURÍA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(158, NULL, NULL, 'LA PAZ', 'Coordinador/a de recepción', NULL, 'AFS', NULL, 0, 'info-bolivia@afs.org', '2017-09-03', '2017-09-11', 'Egresado o titulado en carreras administrativas, sociales, humanísticas, psicología o ramas afines.\r\nTener residencia fija en La Paz.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;CAPACITACIÓN EMPRESARIAL;PROYECTOS;SISTEMAS DE INFORMACION Y GESTION', 'PSICOLOGÍA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(159, NULL, NULL, 'LA PAZ', 'Supervisor de seguridad industrial y alud ocupacional', NULL, 'Empresa de construcción', NULL, 0, 'constunelesbol@gmail.com', '2017-09-03', '2017-09-15', 'Titulado en provisión nacional en ingeniería industrial, ingeniería minera, ingeniería ambiental.\r\nContar con carnet de especialista en seguridad industrial otorgado por el ministerio de trabajo.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'INGENIERÍA AMBIENTAL', 'INGENIERÍA AMBIENTAL;INGENIERÍA INDUSTRIAL;INGENIERÍA METALÚRGICA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(160, NULL, NULL, 'LA PAZ', 'Visitador/a medico', NULL, 'Laboratorio farmacéutico', NULL, 0, 'requerimientorrhh2017@gmail.com', '2017-09-03', '2017-09-08', 'Experiencia en visita medica en las especialidades de cardiogia, endocrinólogia y medicina interna.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'SALUD OCUPACIONAL', 'QUÍMICA FARMACEÚTICA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(161, NULL, NULL, 'LA PAZ', 'Analista de almacenes', NULL, 'TOTTO', NULL, 0, 'c.cossio@rosuma.com', '2017-09-03', '2017-09-08', 'Licenciado/a en ingeniería industrial o administración de empresas.\r\nConocimiento de SySO.\r\nConocimiento de MS Oficce nivel avanzado.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS', 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(162, NULL, NULL, 'LA PAZ', 'Jefe/a de ventas', NULL, 'Hansa', NULL, 0, 'blanza@hansa.com.bo', '2017-09-03', '2017-09-20', 'Profesional en ingeniería comercial.\r\nPost grado en marketing/ventas\r\nConocimientos SAP, CRM.\r\nLicencia de conducir.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS', 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL);
INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `AREAS_REFERENCIA`, `FORMACIONES_REFERENCIA`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(163, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de venta', NULL, 'Empresa de telecomunicaciones ', NULL, 75852333, 'talentoelalto@gmail.com', '2017-09-03', '2017-09-10', 'Iniciativa\r\nDinamismo\r\nResponsabilidad\r\nCarisma', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(164, NULL, NULL, 'LA PAZ', 'Programadores/as web', NULL, 'Programadores/as web', NULL, 0, 'cataleya.dani@gmail.com', '2017-09-03', '2017-09-07', 'Experiencia en:\r\nASP.Net MVC, Web AP12, JQUERY, BOOTSTRAP 3, JSON, ENTITY FRAMEWORK\r\nOtros requisitos ver la imagen ', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'COMPUTACIÓN;INFORMÁTICA;SEGURIDAD INFORMÁTICA', 'ANÁLISIS DE SISTEMAS;ANÁLISIS DE SISTEMAS INFORMÁTICOS;ANÁLISIS Y PROGRAMACIÓN DE COMPUTADORAS;ANALISTA DE SISTEMAS;ANALISTA DE SISTEMAS INFORMÁTICOS;INFORMÁTICA;INGENIERÍA DE SISTEMAS;OPERADOR DE APLICACIONES INFORMÁTICAS;OPERADOR DE PAQUETES;OPERADOR DE PAQUETES COMERCIALES;OPERADOR EN COMPUTADORAS', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(165, NULL, NULL, 'LA PAZ', 'Agentes de seguros de vida', NULL, 'Nacional de sseguros', NULL, 0, 'tmorato@nacionalseguros.com.bo', '2017-09-03', '2017-09-08', 'Capacidad de autogestion.\r\nPro actividad\r\nPredisposición al trabajo en equipo\r\nGanas de superación personal\r\ncon o sin experiencia  ', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(166, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de negocios', NULL, 'WKR', NULL, 0, 'seleccionwkrbolivia@gmail.com', '2017-09-03', '2017-09-07', 'Titulado/a de administración de empresas, ingeniería comercial, economía, ingeniería industrial.\r\nConocimiento del idioma ingles ( nivel intermedio)\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;COMERCIO EXTERIOR;COMERCIO INTERNACIONAL;ECONOMÍA;INFORMÁTICA INDUSTRIAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(167, NULL, NULL, 'LA PAZ', 'Analista de sistemas/ Control de calidad', NULL, 'Empresa privada', NULL, 0, 'contacto@genneo.com.bo', '2017-09-03', '2017-09-08', 'Experiencia solida en análisis y diseño de sistemas informáticos.\r\nExperiencia solida en herramientas de modelado (UML)\r\nExperiencia solida en control de calidad de software\r\nExperiencia en la gestión de proyectos con SCRUM/ÑANBAN', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'COMPUTACIÓN;INFORMÁTICA', 'HARDWARE;INFORMÁTICA;INGENIERÍA DE SISTEMAS;INGENIERÍA DE SOFTWARE;PROGRAMACIÓN Y APLICACIONES;PROGRAMADOR DE COMPUTADORAS;PROGRAMADOR DE SISTEMAS', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(168, NULL, NULL, 'LA PAZ', 'Desarrollador/a de Software', NULL, 'Empresa Privada', NULL, 0, 'contacto@genneo.com.bo', '2017-09-03', '2017-09-08', 'Experiencia solida en el lenguaje de programación JAVA\r\nExperiencia solida en desarrollo de servicios web REST\r\nExperiencia en desarrollo de sistema web con angular JS / Angular 2\r\nOtros requisitos ver en la imagen', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'DESARROLLO DE SISTEMAS', 'INFORMÁTICA;INGENIERÍA DE SISTEMAS;INGENIERÍA DE SOFTWARE', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(169, NULL, NULL, 'LA PAZ', 'Ingeniero en redes de acceso', NULL, 'hola', NULL, 0, 'Lvaleria@humanvalue.com.bo', '2017-09-03', '2017-09-08', 'Formación en ingeniería Electrónica o Telecomunicaciones.\r\nConocimiento en sistemas de telefonía celular 3G, LTE y red de datos.\r\nIngles técnico.\r\nLicencia de conducir.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', 'INGENIERÍA ELECTRÓNICA;TELECOMUNICACIONES', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(170, NULL, NULL, 'LA PAZ', 'Analista contable', NULL, 'Grupo financiero BISA', NULL, 0, 'KPonce@grupobisa.com', '2017-09-03', '2017-09-07', 'Técnico superior en contabilidad y/o Contador publico.\r\nConocimientos relacionados a normativa impositiva, declaraciones y manejo de información tributaria.\r\nManejo de paquetes computacionales a nivel intermedio (Word, Excel)', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN FINANCIERA;CONTABILIDAD', 'CONTABILIDAD;CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(171, NULL, NULL, 'LA PAZ', 'Encargado regional', NULL, 'Alimenticia', NULL, 0, 'info@dosis.com.bo', '2017-09-03', '2017-09-10', 'Profesional egresado/a o titulado/a en ingeniería de alimentos.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(172, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'Ventas', NULL, 0, 'paolamur@yahoo.com', '2017-09-03', '2017-09-10', 'Estudiante o egresado de la carrera de Arquitectura e Ingeniería comercial.\r\nConocimiento de MS Office.\r\nOtros requisitos ver la imagen.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-05 19:00:00', NULL),
(173, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa', NULL, 0, 'lpzadmisiones@gmail.com', '2017-09-10', '2017-09-12', 'Amplio conocimiento en materia tributaria, confección EE.FF. , aportes seguro social, dominio excel, paquetes contables.\r\nLicenciado en contaduría y/o contador/a general.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA;CONTADURÍA GENERAL;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(174, NULL, NULL, 'LA PAZ', 'Ingeniero de campo', NULL, 'Telecom', NULL, 0, 'rrhhtelecom17@yahoo.com', '2017-09-10', '2017-09-16', 'Conocimientos en redes. (cisco deseable)\r\nConocimiento teórico/practico de radio enlaces microondas.\r\nApto para realizar trabajos en altura.\r\nLicencia de conducir..\r\nDisponibilidad de viaje al interior del país.\r\n\r\n\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA Y TELECOMUNICACIONES;INGENIERÍA ELECTRÓNICA;TÉCNICO EN TELECOMUNICACIONES', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(175, NULL, NULL, 'LA PAZ', 'Ingeniero de campo', NULL, 'Telecom', NULL, 0, 'rrhhtelecom17@yahoo.com', '2017-09-10', '2017-09-16', 'Conocimientos en redes. (cisco deseable)\r\nConocimiento teórico/practico de radio enlaces microondas.\r\nApto para realizar trabajos en altura.\r\nLicencia de conducir..\r\nDisponibilidad de viaje al interior del país.\r\n\r\n\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA Y TELECOMUNICACIONES;INGENIERÍA ELECTRÓNICA;TÉCNICO EN TELECOMUNICACIONES', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(176, NULL, NULL, 'LA PAZ', 'Ejecutivo/a comercial', NULL, 'Productos florida', NULL, 0, 'productosflorida@hotmail.com', '2017-09-10', '2017-09-16', 'Ventas corporativas\r\nAtención al cliente\r\nGestión de carrera', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(177, NULL, NULL, 'LA PAZ', 'Encargado/a de producción, (medio tiempo por las tardes)', NULL, 'Productos florida ', NULL, 0, 'productosflorida@hotmail.com', '2017-09-10', '2017-09-16', 'Labores supervisor, producción, mantenimiento.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(178, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Acs Bolivia ', NULL, 0, 'acs.bolivia.lp@gmail.com', '2017-09-10', '2017-09-15', 'Solidos conocimientos en normas contables, laborales y tributarias.\r\nManejo avanzado de Excel.\r\nConocimiento de procesos presupuestarios y administración de inventario.', 5, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR CONTABLE;AUXILIAR DE CONTABILIDAD Y COMPUTACIÓN;AUXILIAR EN CONTABILIDAD', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(179, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de venta', NULL, 'Empresa de materiales de construcción', NULL, 0, 'convocatoria.rrhh.09@gmail.com', '2017-09-10', '2017-09-15', 'Técnicas de ventas.\r\nHabilidades para la comunicación..\r\nCapacidad de negociación.\r\n\r\n', 2, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(180, NULL, NULL, 'LA PAZ', 'Jefe se sucursal', NULL, 'Autosud LTDA ( Kia Motors)', NULL, 0, 'incorporar.rrhh@gmail.com', '2017-09-10', '2017-09-14', 'Titulado/a en Ing. Comercial, Adm. de Empresas, Marketing o ramas afines.\r\nPost Grado o Maestría.\r\nExperiencia en elaboración y ejecución de estrategia comerciales de ventas en el rubro automotriz.\r\nExperiencia en negociación y venta de vehículos.\r\nIdioma ingles fluido.\r\n\r\n', 4, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(181, NULL, NULL, 'LA PAZ', 'Responsable de seguridad ', NULL, 'Pan American Silver', NULL, 0, 'rrhh_pas@hotmail.com', '2017-09-10', '2017-09-15', 'Profesional en ingeniería en minas y/o ramas afines.\r\nEspecialidad en Gestión de Sistema Integrado.\r\nConocimiento en la ISO 9000, 14000, 1800, 26000, OSA 1801.\r\nConocimientos de primeros auxilios.\r\nLicencia de conducir.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA METALÚRGICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(182, NULL, NULL, 'LA PAZ', 'Consultor', NULL, 'La Vitalicia', NULL, 2157800, 'ngrajeda@grupobisa.com', '2017-09-10', '2017-09-13', 'Personas que deseen generar ingresos adicionales.\r\nPersonas con actitud positiva y que tengan altos deseos de superación económica y personal.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(183, NULL, NULL, 'LA PAZ', 'Atención al cliente, ventas y despachos.', NULL, 'Industria del plastico', NULL, 0, 'rrhhindustrialplas@gmail.com', '2017-09-10', '2017-09-15', 'Estudiantes del área comercial y experiencia en venta de masivos.\r\nAtención de llamadas.\r\n\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(184, NULL, NULL, 'LA PAZ', 'Jefe de planta ', NULL, 'Industria el plastico', NULL, 0, 'rrhhindustrialplas@gmail.com', '2017-09-10', '2017-09-15', 'Ingeniero/a o técnico superior, con experiencia en puestos similares, organización, planificación, y control.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE PROCESOS INDUSTRIALES;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(185, NULL, NULL, 'LA PAZ', 'Ejecutivo/a comercial', NULL, 'Empresa logística', NULL, 0, 'logisticarecursoshumanos@gmail.com', '2017-09-10', '2017-09-16', 'Conocimiento de ingles nivel excelente.\r\nExperiencia de trabajo mínima 2 años .', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADUANAS Y COMERCIO INTERNACIONAL;COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(186, NULL, NULL, 'LA PAZ', 'Comex y aduana ( Gestores, liquidadores, tramitadores. )', NULL, 'Empresa logística', NULL, 0, 'logisticarecursoshumanos@gmail.com', '2017-09-10', '2017-09-16', 'Conocimiento e ingles nivel excelente.\r\nExperiencia de trabajo minima de 2 años ', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADUANAS Y COMERCIO INTERNACIONAL;COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(187, NULL, NULL, 'LA PAZ', 'Jefe de área', NULL, 'Empresa exportadora de textiles', NULL, 0, 'reclutamientotoak@gmail.com', '2017-09-10', '2017-09-15', 'Titulo profesional en: Ing. Industrial, Ing. de Producción, Electrónica o ramas afines.\r\nConocimientos y experiencia en control de calidad.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE CONTROL DE PROCESOS;INGENIERÍA DE LA PRODUCCIÓN;INGENIERÍA DE PROCESOS INDUSTRIALES;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(188, NULL, NULL, 'LA PAZ', 'Jefe de control de gestion', NULL, 'Empresa exportadora de textiles', NULL, 0, 'reclutamientoak@gmail.com', '2017-09-10', '2017-09-15', 'Titulo profesional en : Ing. Industrial, Ingeniería de Producción o ramas afines.\r\nManejo de SAP BUSINESS ONE.\r\nConocimientos sólidos en Microsoft Office.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE PRODUCCIÓN;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(189, NULL, NULL, 'LA PAZ', 'Sub-Gerente de planificación financiera y presupuesto', NULL, 'Pro Mujer', NULL, 0, 'rrhh@promujer.org', '2017-09-10', '2017-09-15', 'Formación profesional en Administración de Empresas, Ingeniería Financiera, Economía y/o ramas afines.\r\nDeseable Postgrado o Maestría en getion presupuestaria.\r\nExperiencia en liderar procesos de planificación financiera.\r\nIdioma ingles avanzado.\r\nMAS REQUISITOS VER LA IMAGEN.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA;INGENIERÍA COMERCIAL;INGENIERÍA FINANCIERA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(190, NULL, NULL, 'LA PAZ', 'Analista de Marketing', NULL, 'Latin Malls.com', NULL, 0, 'rrhh@latinmalls.com', '2017-09-10', '2017-09-16', 'Profesional de Administración de Empresas, Ing. Comercial o afines.\r\nCapacidad de planificar, implementar y optimizar campañas de marketing on-line.\r\nMuy buen nivel del idioma ingles.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS', 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(191, NULL, NULL, NULL, 'Programador/a PHP', NULL, 'Latin Malls.com', NULL, 0, 'rrhh@latinmalls.com', '2017-09-10', '2017-09-16', 'Estudiante o egresado de Ingeniería de sistemas, informática o análisis y programación de sistemas.\r\nExperiencia en programación PHP.\r\n\r\n', 0, 'TECNICO', NULL, NULL, NULL, 1, 'image/jpeg', NULL, 'ANÁLISIS DE SISTEMAS;ANÁLISIS DE SISTEMAS INFORMÁTICOS;ANÁLISIS Y PROGRAMACIÓN DE COMPUTADORAS;ANALISTA DE SISTEMAS INFORMÁTICOS;ANALISTA Y PROGRAMACIÓN DE SISTEMAS;INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(192, NULL, NULL, 'LA PAZ', 'Asistente de sistemas e inventarios', NULL, 'Empresa importadora', NULL, 0, 'empresa.emportadora818@gmail.com', '2017-09-10', '2017-09-16', 'Conocimientos de sistemas contables/administrativos.\r\nManejo de Microsoft Office.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ANALISTA DE SISTEMAS INFORMÁTICOS;INFORMÁTICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(193, NULL, NULL, 'LA PAZ', 'Encargado/a de Marketing y Servicios', NULL, 'Empresa importadora de insumos médicos ', NULL, 0, 'recursos_humanos.2017@outlook.com', '2017-09-10', '2017-09-15', 'Egresado o titulado de Marketing, Comunicación Social, Ing. Comercial, Administración de Empresas.\r\nLiderazgo y orientación al logro de resultados.\r\nAlta capacidad de organización y planificación.\r\nPro-actividad.', 0, 'TECNICO', NULL, NULL, 'La Razón', 0, NULL, NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;COMUNICACIÓN SOCIAL;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(194, NULL, NULL, 'LA PAZ', 'Ayudantes de Repostería y Pastelería', NULL, 'Empresa hotelera de Uyuni', NULL, 7240832, 'rrhh.adm.hoteles@gmail.com', '2017-09-10', '2017-09-15', 'Disponibilidad de viaje al interior', 0, 'TECNICO', NULL, NULL, 'La Razón', 0, NULL, 'OTROS', NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(195, NULL, NULL, 'LA PAZ', 'Recepcionista', NULL, 'Loki hostel ', NULL, 0, 'la_paz@lokihotel.com', '2017-09-10', '2017-09-15', 'Disponibilidad de horarios.\r\nIngles avanzado.\r\n', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'IDIOMAS', 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(196, NULL, NULL, 'LA PAZ', 'Ayudante de cocina', NULL, 'Loki hostal', NULL, 0, 'la_paz@lokihostel.com', '2017-09-10', '2017-09-15', 'Disponibilidad para trabajar en diferentes horarios.\r\ncon o sin experiencia en el área.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(197, NULL, NULL, 'LA PAZ', 'Administrador/a de edificio', NULL, 'Acs Bolivia', NULL, 0, 'acs.bolivia.lp@gmail.com', '2017-09-10', '2017-09-15', 'Mayor de edad.\r\nExperiencia en trabajo similar de 5 años.\r\nCertificado de antecedentes.\r\nPreferentemente conocimientos de contabilidad y administración.\r\nEl cargo es por medio tiempo de lunes a sábado.', 5, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(198, NULL, NULL, 'LA PAZ', 'Auxiliar de oficina', NULL, 'Hipersabor', NULL, 0, 'ventas.lpz@hipersabor.com', '2017-09-10', '2017-09-15', 'Titulado/a en contaduría publica.\r\nExperiencia mínima de 1 año.\r\n', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(199, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas', NULL, 'Hipersabor', NULL, 0, 'ventas.lpz@hipersabor.com', '2017-09-10', '2017-09-15', 'Experiencia minima de 1 año.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(200, NULL, NULL, 'LA PAZ', 'Impulsadores/as', NULL, 'Empresa de pinturas', NULL, 0, 'postulantelpz@gmail.com', '2017-09-10', '2017-09-14', 'Estudiante o egresado/a de Arquitectura, Decoración de interiores, carreras comerciales o ramas afines.\r\nSer carismáticos/as y pro-activos/as.  ', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA;DISEÑO DE INTERIORES;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(201, NULL, NULL, 'LA PAZ', 'Chofer Distribuidor/a', NULL, 'Empresa de pinturas ', NULL, 0, 'postulantelpz@gmail.com', '2017-09-10', '2017-09-14', 'Licencia de conducir categoría C.\r\nExperiencia en manejo de carga mínimo 1 año.\r\nPresentar garantia real de inmueble o similar.\r\ntitulo de bachiller.\r\nConocimientos de Office.\r\nConocer zonas de La Paz y El Alto.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(202, NULL, NULL, 'LA PAZ', 'Supervisor/a de producción', NULL, 'Empresa industrial', NULL, 0, 'gtalento2@gmail.com', '2017-09-10', '2017-09-17', 'Titulado/a o Egresado/a en Ing. Industrial, Ingeniería Química y/o ramas afines.\r\nPleno conocimiento en buenas practicas de manufactura, HACCP, ISO 9001, ISO 22000.\r\nExperiencia especifica de 1 año en:\r\nOptimización de procesos de producción.\r\nAdministración de costos.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL;INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(203, NULL, NULL, 'LA PAZ', 'Asistente administrativo/contale', NULL, 'Empresa de neomaticos', NULL, 0, 'recursoshumanos@gmx.es', '2017-09-10', '2017-09-13', 'Estudios técnicos en contabilidad/administración.\r\nMínimo 1 año de experiencia en control contable, papeletas de pago trabajo, liquidaciones, viáticos, compras y ventas.\r\nManejo de Sistema Contable.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;CONTABILIDAD', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(204, NULL, NULL, 'LA PAZ', 'Facturador/a', NULL, 'Compañía farmacéutica', NULL, 0, 'facturacionea17@gmail.com', '2017-09-10', '2017-09-15', 'Estudios de Contabilidad, Administración o carreras afines.\r\nConocimientos en facturación y reportes de control.\r\nConocimientos básicos de MS Office.\r\n', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;CONTABILIDAD', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(205, NULL, NULL, 'LA PAZ', 'Recepcion', NULL, 'Empresa hotelera', NULL, 0, 'personalrah@gmail.com', '2017-09-10', '2017-09-15', 'Conocimiento de atención al cliente y servicio de hoteleria.\r\nIngles avanzado.\r\nExperiencia en cargos similares.\r\nDisponibilidad para trabajo en turnos nocturnos.\r\n\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(206, NULL, NULL, 'LA PAZ', 'Asesor de tienda', NULL, 'hola', NULL, 0, 'Lvaleria@humanvalue.com.bo', '2017-09-10', '2017-09-15', 'Formación en carreras administrativas y/o tecnológicas.\r\nExperiencia en procesos de venta.\r\nConocimiento del funcionamiento de redes sociales, equipos celulares y aplicaciones.\r\nConocimiento de estrategias de ventas.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(207, NULL, NULL, 'LA PAZ', 'Coordinador nacional de instituciones ', NULL, 'LAFAR', NULL, 0, 'promociontalentohumano@gmail.com', '2017-09-10', '2017-09-17', 'Titulado en Ingeniería comercial, administración de empresas, farmacología, bioquímica o ramas afines.\r\nExperiencia en licitaciones y ANPEs.\r\nConocimientos en normativa del SABS y reglamento del DS 181\r\n\r\n', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;BIOQUÍMICA;FARMACIA Y BIOQUÍMICA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(208, NULL, NULL, 'LA PAZ', 'Diseñador de artes ', NULL, 'LAFAR', NULL, 0, 'promociontalentohumano@gmail.com', '2017-09-10', '2017-09-17', 'Licenciado en diseño gráfico o ramas afines.\r\nConocimiento buenas practicas de manufactura.\r\nConocimiento avanzado de paquetes de diseño gráfico.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DISEÑO GRÁFICO;DISEÑO, DESARROLLO Y PRODUCCIÓN DIGITAL DE MEDIOS AUDIOVISUALES Y WEB', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(209, NULL, NULL, 'LA PAZ', 'Encargado de sistemas de apoyo critico', NULL, 'LAFAR', NULL, 0, 'promociontalentohumano@gmail.com', '2017-09-10', '2017-09-17', 'Titulado en Ing. Electromecánica, mecánica, eléctrica, mecatronica o ramas afines.\r\nConocimiento de buenas practicas de manufactura.\r\nConocimiento de manejo de climatización industrial.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD INDUSTRIAL;ELECTROMECÁNICA;ELECTRÓNICA;INGENIERÍA ELECTROMECÁNICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(210, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Empresa de transporte', NULL, 0, 'postulaciones_rrhh@bec.com.bo', '2017-09-10', '2017-09-16', 'Conocimientos contables.\r\nExperiencia en manejo Kardex.\r\nConocimiento mantenimiento de vehículos y comprar partes.\r\n', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(211, NULL, NULL, 'LA PAZ', 'Medico de guardia', NULL, 'Clinica', NULL, 0, 'importanteclinica@hotmail.com', '2017-09-10', '2017-09-14', 'Titulo provisión nacional.\r\nMatricula profesional del ministerio de salud.\r\nDisponibilidad de tiempo.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'MEDICINA', 'MEDICINA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(212, NULL, NULL, 'LA PAZ', 'Secretaria ejecutiva', NULL, 'PSG Bolivia', NULL, 0, 'psgbolivia@gmail.com', '2017-09-10', '2017-09-15', 'Buen trato y facilidad de palabra.\r\nRecepción de documentación y archivo.\r\nElaboración de informes, cartas y otros.\r\nGestión de tramites en general.\r\nSoporte especifico a contabilidad y administración.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(213, NULL, NULL, 'LA PAZ', 'Asistente de ventas/contabilidad', NULL, 'PSG Bolivia', NULL, 0, 'psgbolivia@gmail.com', '2017-09-10', '2017-09-15', 'Contador general.\r\nConocimiento avanzado de Oficce.\r\nExperiencia de facturación en puntos de venta.\r\nConocimiento de contabilidad de costo.\r\nconocimiento en sistemas ERP.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA GENERAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(214, NULL, NULL, 'LA PAZ', 'Medico Cirujano', NULL, 'Centro de salud Jesús Obrero', NULL, 2833949, NULL, '2017-09-10', '2017-09-13', '', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'MEDICINA', 'MEDICINA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(215, NULL, NULL, 'LA PAZ', 'Medico Cirujano', NULL, 'Centro de salud Jesús Obrero', NULL, 2833949, NULL, '2017-09-10', '2017-09-13', '', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'MEDICINA', 'MEDICINA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(216, NULL, NULL, 'LA PAZ', 'Medico Cirujano', NULL, 'Centro de salud Jesús Obrero', NULL, 2833949, NULL, '2017-09-10', '2017-09-13', 'Titulo profesional en provisión nacional.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'MEDICINA', 'MEDICINA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(217, NULL, NULL, 'LA PAZ', 'Visitador/a Medico/a Especializado/a Bioquímico/a', NULL, 'Equipamiento medico', NULL, 0, 'recursoshmedicos@gmail.com', '2017-09-10', '2017-09-17', 'Licencia en Bioquímica, Farmacéutica o Bioquímica.\r\nQue cuente con inscripción en el colegio de Bioquímicos.\r\nConocimiento del idioma ingles nivel intermedio.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(218, NULL, NULL, 'LA PAZ', 'Sales Engineer ( Ingeniero/a de ventas )', NULL, 'Empresa de equipamiento medico', NULL, 0, 'recursoshmedicos@gmail.com', '2017-09-10', '2017-09-17', 'Ingeniería Biomedica, Mecatronica, Automatización o Electrónica.\r\nCertificado de cursos que avalen el dominio del idioma ingles conversacional 90%.\r\nConocimiento comercial y administrativo.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUTOMATIZACIÓN INDUSTRIAL;ELECTRÓNICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(219, NULL, NULL, 'LA PAZ', 'Sub gerente de seguros de salud', NULL, 'Empresa de seguros', NULL, 0, 'seleccionderrhhseguros@yahoo.com', '2017-09-10', '2017-09-13', 'Titulado en Ing. Comercial, Administración de Empresas o ramas afines.\r\nFormación técnica en seguros.\r\nConocimientos en código civil, código de comercio, ley de seguros, normas APS y UIF.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(220, NULL, NULL, 'LA PAZ', 'Un/a Administrador/a contable', NULL, 'Fundacion Sumaj Huas SH', NULL, 0, 'contacto@sumaj.org', '2017-09-10', '2017-09-15', 'Licenciado/a como contador/a, Contador/a Publico, Administrador/a.\r\nExperiencia de trabajo de al menos 3 años en ONGs.\r\nConocimiento de las normas fiscales y tributarias de Bolivia.\r\nDominio de paquetes contables para ONGs.\r\nDominio de paquetes de computación Word, Excel, Power Point e Internet.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;CONTABILIDAD;CONTADURÍA;CONTADURÍA GENERAL;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(221, NULL, NULL, 'LA PAZ', 'Topografo', NULL, 'Empresa constructora', NULL, 0, 'jquispe@riotintoa.com', '2017-09-10', '2017-09-20', 'Ingeniero topografo.\r\nExperiencia mínima en el rubro minero de 3 años.\r\nConocimiento de geomecanica.\r\nManejo de paquete AutoCAD.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TOPOGRAFÍA;TOPOGRAFÍA Y GEODESIA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(222, NULL, NULL, 'LA PAZ', 'Ingeniero/a Industrial o ramas afines', NULL, 'Proveedora de productos industriales', NULL, 0, 'paul.vasquezk@vaporinox.com', '2017-09-10', '2017-09-19', 'Conocimiento en sistemas de vapor y refrigeración.\r\nConocimiento en procesos de producción en rubro industrial.\r\nConocimiento en metal mecánica.\r\n\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(223, NULL, NULL, 'LA PAZ', 'Analista', NULL, 'Empresa financiera', NULL, 0, 'personalfinanciera3@gmail.com', '2017-09-10', '2017-09-15', 'Licenciatura en Economía, Ingeniería Financiera, Ing. Industrial o ramas afines.\r\nPostgrado en desarrollo organizacional.\r\nAmplio conocimiento de leyes bancarias y normas ISO 9000 y 9001.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ADMINISTRACIÓN GENERAL;CIENCIAS CONTABLES;ECONOMÍA;INGENIERÍA FINANCIERA;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(224, NULL, NULL, 'LA PAZ', 'Controller Administrativo', NULL, 'Solutions', NULL, 0, 'postulaciones@bps.com.bo', '2017-09-10', '2017-09-19', 'Formación en Ing. Financiera, Contaduría publica, Adm. de Empresas.\r\nSolidos conocimientos en seguimiento a presupuestos empresariales, contabilidad y finanzas corporativa.\r\nGarantías reales.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;CONTADURÍA PÚBLICA;INGENIERÍA FINANCIERA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(225, NULL, NULL, 'LA PAZ', 'Profesional en sistemas', NULL, 'Empresa de sistemas', NULL, 0, 'convocatoriasrrhh2017@gmail.com', '2017-09-10', '2017-09-15', 'Titulo en Provisión nacional a nivel licenciatura en Ing. de Sistemas, informática.\r\nIdioma ingles nivel técnico.\r\nTener nacionalidad boliviana.\r\n*Ver el resto de los requisitos en la imagen.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(226, NULL, NULL, 'LA PAZ', 'Encargado/a de almacenes', NULL, 'CEARE', NULL, 78443700, 'comercial@ceare.com.bo', '2017-09-10', '2017-09-15', 'Titulado en Ing. Industrial, Producción, Auditoria, Contabilidad, Administración de Empresas o carreras afines.\r\nExperiencia de 2 años en área de logística, almacenamiento, distribución y relacionada.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;AUDITORÍA;CONTABILIDAD;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(227, NULL, NULL, 'LA PAZ', 'Encargado/a de licitaciones publicas', NULL, 'Empresa de licitaciones ', NULL, 0, 'lpz.seleccion@gmail.com', '2017-09-10', '2017-09-17', 'Formación en Secretariado Administrativo, Ejecutivo.\r\nConocimientos en leyes de contratación del estado, decreto supremo 181.\r\nExperiencia en el área de salud.\r\nDominio de Microsoft Office.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(228, NULL, NULL, 'LA PAZ', 'Brand Manager', NULL, 'Empresa', NULL, 0, 'buscatalentosc@gmail.com', '2017-09-10', '2017-09-15', 'Titulo profesional en Ing. Comercial, Mercadotecnia, Administración de Empresas.\r\nConocimientos en elaboración de planes comerciales, gestión de presupuestos, gestión de proveedores, gestión de clientes.\r\nManejo de Excel avanzado.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MERCADOTECNIA', 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(229, NULL, NULL, 'LA PAZ', 'Personal Fipaz', NULL, 'Empresa Cochabambina ', NULL, 0, 'ecbbafipaz@gmail.com', '2017-09-10', '2017-09-14', 'Facilidad de expresión oral.\r\nCapacidad de relacionarse con diferentes tipos de personas.\r\nCuidadosos en su presentación personal.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-10 19:00:00', NULL),
(230, NULL, NULL, NULL, 'Operador de trade marketing', NULL, 'Empresa industrial', NULL, 0, 'industrialrecluta@gmail.com', '2017-09-10', '2017-09-15', 'Técnico medio en carreras comerciales, administrativas, marketing, ventas.\r\nManejo de cartera de clientes.\r\nManejo de inventarios.\r\n', 2, 'TECNICO', NULL, NULL, NULL, 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;MARKETING', 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(231, NULL, NULL, 'LA PAZ', 'Oficial de suscripción', NULL, 'Empresa de seguros', NULL, 0, 'requerimientoseguros@gmail.com', '2017-09-10', '2017-09-15', 'Licenciado en administración de empresa, ing. comercial, derecho o ramas afines.\r\nConocimientos:\r\nLey de seguros.\r\nCódigo de comercio.\r\nPólizas, clausulas y coberturas de seguros generales.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;DERECHO;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(232, NULL, NULL, 'LA PAZ', 'Superintendente de proyecto', NULL, 'Empresa constructora ', NULL, 0, 'ja.de.proyecto@gmail.com', '2017-09-10', '2017-09-15', 'Experiencia en construcción de carreteras, habiendo desempeñado el cargo de superintendente, director de obra o residente de obra.\r\nDentro su experiencia, deberá demostrar el haber realizado por lo menos 2 obras nuevas con pavimento  asfáltico con una extencion mínima de 25 kilómetros.\r\n', 15, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(233, NULL, NULL, 'LA PAZ', 'Ingeniero/a especialista en control de calidad ', NULL, 'Empresa constructora', NULL, 0, 'ja.de.proyecto@gmail.com', '2017-09-10', '2017-09-15', 'Experiencia especifica y certificada de mas de 5 años en proyectos, carreteras como especialista de control de calidad, director de obra o residente de obra.', 10, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(234, NULL, NULL, 'LA PAZ', 'Jefe/a de maestranza ', NULL, 'Empresa constructora ', NULL, 0, 'ja.de.proyecto@gmail.com', '2017-09-10', '2017-09-15', 'Profesional en Ing. Mecánica o Ing. Automotriz.\r\nExperiencia certificada en mas de 5 años habiendo desempeñado al cargo en empresas constructoras de carreteras.\r\nConocimientos certificados en maquinaria pesada, especialmente CAT y KOMATSU.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA AUTOMOTRIZ;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(235, NULL, NULL, 'LA PAZ', 'analista de recursos humanos', NULL, 'Empresa de transporte de valores S.A.', NULL, 0, 'etvsa.rrhh@gmail.com', '2017-09-10', '2017-09-14', 'Licenciatura en Psicología o Administración de Empresas.\r\nLibreta de servicio Militar.\r\nManejo de Excel, Word, Power Point.\r\nManejo, aplicación y calificación de pruebas psicometricas.', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;PSICOLOGÍA', 'ACTIVE', '1', '2017-09-12 19:00:00', NULL),
(236, NULL, NULL, NULL, 'Vendedores/as', NULL, 'Importaciones de consumo masivo', NULL, 0, 'rrhh_importadora@hotmail.com', '2017-09-10', '2017-09-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, '', NULL, NULL, 'DELETED', '1', '2017-09-12 19:00:00', NULL),
(237, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa constructora ', NULL, 0, 'requerimientodepersonalv@gmail.com', '2017-09-17', '2017-09-30', 'Titulado/a en Contabilidad, Contaduría publica o ramas afines.\r\nTener registro profesional a nivel departamental y nacional.\r\nManejo de paquetes contables con prioridad Sistema Pulzar Client.\r\nDisponibilidad de viajes al interior del país.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD COMERCIAL;CONTABILIDAD GENERAL;CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(238, NULL, NULL, 'LA PAZ', 'Mensajero/a', NULL, 'Empresa de construcción ', NULL, 0, 'computadora777@gmail.com', '2017-09-17', '2017-09-21', 'Honrado, puntual y proactivo.\r\nControl de correspondencia.\r\nEjecución de tareas de limpieza.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(239, NULL, NULL, 'LA PAZ', 'Analista de mercado ', NULL, 'KAMPO ', NULL, 0, 'jflores@kampobolivia.com', '2017-09-17', '2017-09-19', '', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TÉCNICO', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(240, NULL, NULL, 'LA PAZ', 'Analista de mercado ', NULL, 'KAMPO ', NULL, 0, 'jflores@kampobolivia.com', '2017-09-17', '2017-09-19', 'Egresado de una carrera técnica o universitaria de preferencia que tenga conocimiento en trabajos de pre-venta.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TÉCNICO', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(241, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de negocios', NULL, 'Brinks Bolivia', NULL, 0, 'rrhh-seleccion-cm@brinksbolivia.com', '2017-09-17', '2017-09-26', 'Egresado/a o Licenciado/a en carreras asociadas a ciencias empresariales. \r\nConocimientos y experiencia en ventas consultivas y estratégicas.\r\nConocimientos y manejo en procesos de innovación.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ADMINISTRACIÓN GENERAL;FINANZAS', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(242, NULL, NULL, 'LA PAZ', 'Abogado/a semi senior', NULL, 'Empresa Legal', NULL, 0, 'reclutamiento2017legal@gmail.com', '2017-09-17', '2017-09-22', 'Licenciado en Derecho.\r\nMaestría en derecho corporativo, aduanero, civil, comercial y/o administrativo.\r\nCursos en materia tributaria, laboral, comercial, civil, aduanera, administrativa, laboral y procesal.\r\n', 5, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DERECHO', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(243, NULL, NULL, 'LA PAZ', 'Almacenero/a ( Área rural )', NULL, 'Empresa Hotelera y Turismo', NULL, 0, 'rrhh4299@gmail.com', '2017-09-17', '2017-09-25', 'Experiencia en cargos similares.\r\nExperiencia en manejo de alimentos.\r\nDisponibilidad de viaje.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(244, NULL, NULL, 'LA PAZ', 'Recepcionista ( Área rural )', NULL, 'Empresa Hotelera y Turismo', NULL, 0, 'rrhh4299@gmail.com', '2017-09-17', '2017-09-25', 'Excelente trato al cliente, altos valores en honestidad y responsabilidad.\r\nDominio de ingles (escrito y hablado) se valora otros idiomas.\r\nDisponibilidad inmediata de viaje.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'IDIOMAS', 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(246, NULL, NULL, 'LA PAZ', 'Cheff', NULL, 'Empresa Hotelera y Turismo', NULL, 0, 'rrhh4299@gmail.com', '2017-09-17', '2017-09-25', '\r\nDominio de ingles se valora otros idiomas.\r\nManejo técnicas gastronómicas y personal.\r\nDisponibilidad inmediata de viaje.', 4, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(247, NULL, NULL, 'LA PAZ', 'Cocinero/a', NULL, 'Empresa Hotelera y Turismo', NULL, 0, 'rrhh4299@gmail.com', '2017-09-17', '2017-09-25', 'Se valora conocimiento de ingles.\r\nManejo de personal, disponibilidad inmediata de viaje.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(248, NULL, NULL, 'LA PAZ', 'Cocinero/a ', NULL, 'Restaurante ', NULL, 0, 'rr.pinto2017@gmail.com', '2017-09-17', '2017-09-21', 'Para la ciudad de El Alto ', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(249, NULL, NULL, 'LA PAZ', 'Operador de maquina para industria maderera', NULL, 'Maderera ', NULL, 0, 'IndustriaMaderera2017@gmail.com', '2017-09-17', '2017-09-19', 'Operadores/as de maquinas Moldureras y otras maquinas.\r\n', 0, '', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(250, NULL, NULL, 'LA PAZ', 'Operador de maquina para industria maderera', NULL, 'Maderera ', NULL, 0, 'IndustriaMaderera2017@gmail.com', '2017-09-17', '2017-09-19', 'Operadores/as de maquinas Moldureras y otras maquinas.\r\n', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(251, NULL, NULL, 'LA PAZ', 'Psicologo/a', NULL, 'Institucion', NULL, 0, 'gestion-talentorrhh@hotmail.com', '2017-09-17', '2017-09-21', 'Formación profesional en Psicología.\r\nExperiencia de trabajo en Centros de Acogida.\r\nExperiencia de trabajo con población en situación de calle.\r\nConocimiento de la ley 548.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'PSICOLOGÍA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(252, NULL, NULL, 'LA PAZ', 'Educador/a', NULL, 'Institucion', NULL, 0, 'gestion-talentorrhh@hotmail.com', '2017-09-17', '2017-09-21', 'Formación profesional en Ciencias Sociales.\r\nExperiencia de trabajo en centro de acogida.\r\nExperiencia de trabajo con niños, niñas y adolescentes.\r\nConocimiento de la ley 548\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'EDUCACIÓN SUPERIOR', 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(253, NULL, NULL, 'LA PAZ', 'Auditores/as Externos', NULL, 'Empresa de auditores ', NULL, 0, 'reclutasfs@gmail.com', '2017-09-17', '2017-09-25', 'Experiencia en el sector gubernamental.\r\nDisponibilidad de realizar viajes al interior.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'AUDITORÍA;AUDITORIA FINANCIERA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(254, NULL, NULL, 'LA PAZ', 'Técnico eléctrico o Electromecánico', NULL, 'Empresa de energia', NULL, 0, 'recursoshumanos@amperonline.com', '2017-09-17', '2017-09-22', 'Egresado o titulado de instituto o universidad técnica.\r\nConocimientos y experiencia laboral en instalación de aire acondicionado.\r\nConocimiento en instalación de grupos generadores.\r\nConocimiento en instalaciones eléctricas industriales.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD INDUSTRIAL;ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(255, NULL, NULL, 'LA PAZ', 'Asistente al cliente ', NULL, 'BISA', NULL, 0, 'kponce@grupobisa.com', '2017-09-17', '2017-09-21', 'Licenciatura o egreso en carreras administrativo o financieras.\r\nDominio en el manejo de sistemas informáticos. ( Microsoft Office )\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA', 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN DE RECURSOS HUMANOS;ADMINISTRACIÓN FINANCIERA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(256, NULL, NULL, 'LA PAZ', 'Jefe Comercial', NULL, 'Efecto', NULL, 0, 'landivarseleccion@gmail.com', '2017-09-17', '2017-09-23', 'Lic. en Ingernieria Comercial, Marketing, Administración de empresas o ramas afines.\r\nParticipación en licitaciones.\r\nProponer acciones que permitan consolidar, ampliar y potenciar la participacion en el mercado existente.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ADMINISTRACIÓN GENERAL;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-09-17 19:00:00', '2017-09-17 19:00:00'),
(257, NULL, NULL, 'LA PAZ', 'Contador Senior', NULL, 'Empresa Minera', NULL, 0, 'rrhh_mineria@autlook.com', '2017-09-17', '2017-09-22', 'Titulo profesional contabilidad general o licenciatura en auditoria financiera.\r\nPost Grado relacionado al área.\r\nConocimientos de Sistema de información ERP.\r\nActualización de normativa tributaria y social.\r\nFormulación y ejecución de presupuestos.', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;AUDITORIA FINANCIERA;CONTABILIDAD GENERAL', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(258, NULL, NULL, 'LA PAZ', 'Instalador de equipos', NULL, 'Empresa de telecomunicaciones', NULL, 2, 'empresatelecom7@gmail.com', '2017-09-17', '2017-09-25', 'Disponibilidad de viajes al interior.\r\nCon o sin experiencia.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/png', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(259, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa de bienes raíces ', NULL, 0, 'ritziaconsultingservicessrl@gmail.com', '2017-09-17', '2017-09-22', 'Conocimiento en el área administrativa.\r\nSolidos conocimientos contables y de impuestos.\r\nManejo de paquetes contables y programas Windows.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA;CONTADURÍA GENERAL', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(260, NULL, NULL, 'LA PAZ', 'Encargado/a Comercial', NULL, 'Dumbo', NULL, 0, 'Rrhh.dumbolapaz@gmail.com', '2017-09-17', '2017-09-25', 'Lic. Ing. Comercial, Marketing, Comunicación afines.\r\nCon cartera de clientes en servicio.\r\nVocación de atención al cliente y orientación a resultados.\r\nConocimientos de diseño gráfico.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'COMUNICACIÓN;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(261, NULL, NULL, 'LA PAZ', 'Administrador/a', NULL, 'Empresa constructora', NULL, 0, 'ronnie.rios@cotienne.com', '2017-09-17', '2017-09-21', 'Experiencia en manejo de recursos humanos, tramites administrativos en Min. de trabajo, AFP, CNS.\r\nDisponibilidad de viaje al interior del país.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'ADMINISTRACIÓN', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(262, NULL, NULL, 'LA PAZ', 'Asistente técnico en sistema de informática', NULL, 'Empresa de sistemas', NULL, 0, 'lizzethmollinedo@hotmail.com', '2017-09-17', '2017-09-22', 'Experiencia de trabajo especifica en administración, desarrollo y soporte técnico, mínimo 1 año.\r\nSolidos conocimientos en administración de servicios de correo, pagina web y DNS en sistema operativo Windows con documentos que certifiquen.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(263, NULL, NULL, 'LA PAZ', 'Cocinera/o ( Contrato por servicios )', NULL, 'Empresa de construcción ', NULL, 0, 'rrhhcontrataciones17@gmail.com', '2017-09-17', '2017-09-21', 'Experiencia aprobada de al menos 2 años.\r\n', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(264, NULL, NULL, 'LA PAZ', 'Asistente de oficina y mensajeria', NULL, 'Empresa de construcción ', NULL, 0, 'rrhhcontrataciones17@gmail.com', '2017-09-17', '2017-09-21', 'Experiencia aprobada de 2 años en cargos similares.\r\nConocimiento en gestión de archivos, tramites administrativos en general en instituciones publicas y privadas.\r\nConocimiento de la ciudad de La Paz.', 2, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(265, NULL, NULL, 'LA PAZ', 'Asesor Técnico de Ventas', NULL, 'HANSA', NULL, 0, 'mponcedeleon@hansa.com.bo', '2017-09-17', '2017-09-30', 'Lic. en Ing. Mecánica, Electromecánica, Industrial.\r\nExperiencia de trabajo en el ramo industrial mínimo 4 años.\r\nDisponibilidad de viajes al interior del país ( mínimo 1 semana al mes ) .\r\n\r\n', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;INGENIERÍA INDUSTRIAL;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(266, NULL, NULL, 'LA PAZ', 'Certificador', NULL, 'Fundempresa', NULL, 0, 'recursoshumanos@fundempresa.org.bo', '2017-09-17', '2017-09-20', 'Derecho comercial.\r\nManejo de herramientas  Office.\r\nDerecho registral.\r\nDerecho civil.\r\nDerecho Procesal civil.\r\nRedacción.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DERECHO', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(267, NULL, NULL, 'LA PAZ', 'Ejecutivos/as Comerciales', NULL, 'Empresa de Seguros', NULL, 0, 'carla.hoyos@unibrosa.com.bo', '2017-09-17', '2017-09-21', 'Lic. de carreras comerciales y/o administrativas.\r\nConocimientos de programas computacionales.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ADMINISTRACIÓN GENERAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(268, NULL, NULL, 'LA PAZ', 'Auditores/as Senior', NULL, 'UPPCONTROL S.R.L', NULL, 0, 'yossmmy@hotmail.com', '2017-09-17', '2017-09-21', 'Titulo académico.\r\nTitulo en provisión nacional.\r\nRegistro de profesional respectivo.\r\nMaestrías y diplomados.\r\nCursos de especialización.\r\nExperiencia en consultorias o haber sido funcionario de entidades del sector publico.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA', 'ACTIVE', '1', '2017-09-17 19:00:00', '2017-09-18 19:00:00');
INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `AREAS_REFERENCIA`, `FORMACIONES_REFERENCIA`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(269, NULL, NULL, 'LA PAZ', 'Auditores/as Junior ( egresados y/o recién titulados )', NULL, 'UPPCONTROL S.R.L.', NULL, 0, 'yossmmy@hotmail.com', '2017-09-17', '2017-09-21', 'Titulo académico.\r\nTitulo en provisión nacional.\r\nRegistro de profesional respectivo.\r\nMaestrías y diplomados.\r\nCursos de especialización.\r\nExperiencia en consultorias o haber sido funcionario de entidades del sector publico.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'AUDITORÍA GENERAL', 'AUDITORÍA;AUDITORIA FINANCIERA', 'ACTIVE', '1', '2017-09-17 19:00:00', '2017-09-18 19:00:00'),
(270, NULL, NULL, 'LA PAZ', 'Ingeniero/a Ambiental y Civil', NULL, 'UPPCONTROL S.R.L.', NULL, 0, 'yossmmy@hotmail.com', '2017-09-17', '2017-09-21', 'Titulo académico.\r\nTitulo en provisión nacional.\r\nRegistro de profesional respectivo.\r\nMaestrías y diplomados.\r\nCursos de especialización.\r\nExperiencia en consultorias o haber sido funcionario de entidades del sector publico.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA AMBIENTAL;INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-09-17 19:00:00', '2017-09-18 19:00:00'),
(271, NULL, NULL, 'LA PAZ', 'Químico farmacéutico y/o farmacéutico y/o bioquímico farmacéutico', NULL, 'Industria Farmacéutica ', NULL, 0, 'arearrhh.reclutamiento@gmail.com', '2017-09-17', '2017-09-22', 'Poseer titulado en provisión nacional con experiencia mínima de 5 años en industria farmacéutica, maestría en producción farmacéutica.\r\nConocimientos sólidos en buenas practicas de manufactura.\r\nManejo de documentación.\r\nProcesamiento de datos y de registro.\r\nDominio de ingles.\r\nDominio de sistemas computarizados, Excel Avanzado.\r\nConocimiento de estadística.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA;QUÍMICA FARMACEÚTICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(272, NULL, NULL, 'LA PAZ', 'Responsable de calidad ', NULL, 'Alimentos Cara', NULL, 0, 'ssanjines@carsabolivia.com             arodriguez@carsabolivia.com', '2017-09-17', '2017-09-22', 'Ingeniero/a de alimentos, químico o ramas afines.\r\nFormación en BPM, HACCP, ISo 22000, ISO 9000.', 6, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(273, NULL, NULL, 'LA PAZ', 'Responsable de calidad ', NULL, 'Alimentos Cara', NULL, 0, 'ssanjines@carsabolivia.com', '2017-09-17', '2017-09-22', 'Ingeniero/a de alimentos, químico o ramas afines.\r\nFormación en BPM, HACCP, ISo 22000, ISO 9000.', 6, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(274, NULL, NULL, 'LA PAZ', 'Secretaria de gerencia', NULL, 'Wella', NULL, 0, 'dmorales@wella.com.bo', '2017-09-17', '2017-09-22', 'Conocimientos de paquetes de computación.\r\nConocimientos de contabilidad.\r\nConocimiento de ingles.', 5, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO COMERCIAL;SECRETARIADO EJECUTIVO', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(275, NULL, NULL, 'LA PAZ', 'Auxiliar de servicio técnico', NULL, 'Empresa de equipos electrónicos', NULL, 0, 'proceso072017@gmail.com', '2017-09-17', '2017-09-22', 'Técnico medio o profesional en Ing. Electrónica o ramas afines.\r\nWord, Excel y Power Point intermedio.\r\nIdioma inglles.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA ELECTRÓNICA', 'ACTIVE', '1', '2017-09-17 19:00:00', NULL),
(276, NULL, NULL, 'LA PAZ', 'Desarrollador de aplicaciones ', NULL, 'Innovapplications', NULL, 0, 'rrhh@innovapplications.com', '2017-09-17', '2017-09-22', 'Licenciado/a, Egresado/a, o técnico superior de las carreras de sistemas o informática.\r\nConocimientos técnicos  en :\r\nApps Móviles: Angular JS, lonic, Android, Swift.\r\nProgramación: PHP, JAVA, JavaScript, Bootstrap, Laravel, ASP, NET.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(277, NULL, NULL, 'LA PAZ', 'Contador/a general', NULL, 'Empresa de mercado de valores ', NULL, 0, 'rrhhentfin@gmail.com', '2017-09-17', '2017-09-20', 'Titulo en provisión nacional en contaduría general o auditoria financiera o contaduría publica, con registro en el respectivo colegio profesional y firma autorizad.\r\nEstudios de Postgrado en el área financiera, tributaria, presupuestos u otros relacionados con el ámbito financiero.\r\nConocimiento en normas contables y tributarias.\r\nConocimientos en paquetes de computacion Microoft Office.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;AUDITORIA FINANCIERA;CONTADURÍA;CONTADURÍA GENERAL;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(278, NULL, NULL, 'LA PAZ', 'Técnico superior  en diseño de muebles', NULL, 'Empresa consultora', NULL, 0, 'hort.postulaciones@gmail.com', '2017-09-17', '2017-09-21', 'Técnico superior o Técnico medio en carpintería.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CARPINTERIA;CARPINTERÍA;CARPINTERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(279, NULL, NULL, 'LA PAZ', 'Topografo o geodésico', NULL, 'Empresa consultora', NULL, 0, 'hort.postulaciones@gmail.com', '2017-09-17', '2017-09-21', 'Ingeniero o técnico superior.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TOPOGRAFÍA;TOPOGRAFÍA Y GEODESIA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(280, NULL, NULL, 'LA PAZ', 'Agronomo ', NULL, 'Empresa consultora ', NULL, 0, 'hort.postulaciones@gmail.com', '2017-09-17', '2017-09-21', 'Ingeniero/a o técnico/a en agronomia.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AGRONOMÍA;INGENIERIA AGRONOMICA;INGENIERÍA AGRONÓMICA;INGENIERÍA AGROPECUARÍA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(281, NULL, NULL, 'LA PAZ', 'Agentes de seguros de salud ', NULL, 'Nacional de Seguros vida y salud S.A.', NULL, 0, 'echacon@nacionalseguros.com.bo', '2017-09-17', '2017-09-22', 'Excelente habilidad de relacionamiento.\r\nOrientado al logro de resultados.\r\nExperiencia en ventas.\r\nPredisposición al trabajo en equipo.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(282, NULL, NULL, 'LA PAZ', 'Analista contable', NULL, 'Empresa de Consumo', NULL, 0, 'tmf.consultores@gmail.com', '2017-09-17', '2017-09-20', 'Técnico superior en Contabilidad, o egresado/a de la carrera de contaduría publica.\r\nExperiencia en registros contables, manejo de almacenes, conciliaciones bancarias.\r\nDominio Excel.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD GENERAL;CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(283, NULL, NULL, 'LA PAZ', 'Asistente para almacén ', NULL, 'Empresa importadora ', NULL, 0, 'empresa.importadora818@gmail.com', '2017-09-17', '2017-09-25', 'Disponibilidad de horarios.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(284, NULL, NULL, 'LA PAZ', 'Ingeniero civil', NULL, 'Empresa constructora', NULL, 0, 'reqpersonal1@hotmail.com', '2017-09-17', '2017-09-25', 'Experiencia en construcción de carreteras.', 7, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(285, NULL, NULL, 'LA PAZ', 'Ingeniero Geotecnista', NULL, 'Empresa constructor', NULL, 0, 'reqpersonal1@hotmail.com', '2017-09-17', '2017-09-25', 'Experiencia en construcción de carreteras.', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA GEOGRÁFICA;TOPOGRAFÍA Y GEODESIA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(286, NULL, NULL, 'LA PAZ', 'Vendedor/a de maquinaria pesada ', NULL, 'FinningCAT', NULL, 0, 'recursoshumanos@finning.com', '2017-09-17', '2017-09-24', 'Amplio conocimiento en maquinaria pesada, equipo de generación eléctrica, motores de combustión interna, componentes, repuestos y servicio técnico.\r\nDisponibilidad para realizar viajes al interior, área rural y exterior del país.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL;INGENIERÍA INDUSTRIAL;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(287, NULL, NULL, 'LA PAZ', 'Encargado/a para tienda de ropa deportiva ( Zona Sur )', NULL, 'GAV SPORT', NULL, 0, 'gavsport@gmail.com', '2017-09-17', '2017-09-25', 'Excelente actitud.\r\nManejo de caja.\r\nManejo de inventario.\r\nManejo de Word y Excel.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(288, NULL, NULL, 'LA PAZ', 'Cajero/a ', NULL, 'Empresa comercial', NULL, 0, 'ger.rrhhcbba@hotmail.com', '2017-09-17', '2017-09-25', 'Experiencia mínima de 1 año en el área.\r\nManejo de cajas, detección de billetes falsos.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;CONTABILIDAD', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(289, NULL, NULL, 'LA PAZ', 'Supervisor/a de ventas ', NULL, 'Empresa alimenticia', NULL, 0, 'rrhhalimentosiag@gmail.com', '2017-09-17', '2017-09-30', 'Egresados/as en Administración de Empresas, Ingeniería comercial y/o ramas afines.\r\nConocimientos amplios de técnicas de pre-venta canal horizontal y mercados masivos.\r\nBuenas relaciones interpersonales.\r\nGarantías personales.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(290, NULL, NULL, 'LA PAZ', 'Jefe de sucursal ', NULL, 'AUTOSUD LTDA ( KIA MOTORS )', NULL, 0, 'incorporar.rrhh@gmail.com', '2017-09-17', '2017-09-21', 'Titulado/a en Ing. Comercial, Adm. de Empresas, Marketing o ramas afines.\r\nPostgrado o maestría.\r\nExperiencia en elaboración y ejecución de estrategias comerciales de ventas en el rubro automotriz.\r\nIdioma ingles fluido.\r\n', 4, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(291, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas linea reposteria', NULL, 'MADIASA', NULL, 0, 'madisareclutalentos@gmail.com', '2017-09-17', '2017-09-20', 'Técnico o especialista en repostería, Chocolateria, pastelería o similares.\r\nConocimientos de mercados formales o atención al cliente.\r\nConocimiento y manejo de las herramientas de Microsoft Office.\r\nGarantías reales y personales.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TECNICO EN GASTRONOMIA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(292, NULL, NULL, 'LA PAZ', 'Contador/a ', NULL, 'Aldeas Infantiles S.O.S.', NULL, 0, 'gth@aldeasinfantiles.org.bo', '2017-09-17', '2017-09-22', 'Licenciatura en carreras de la rama contable.\r\nExperiencia de trabajo en organizaciones no gubernamentales.\r\nExperiencia en elaboración y ejecución presupuestaria.\r\nExperiencia en administración de bienes y servicios.\r\nManejo avanzado de MS Excel ( formulas y tablas dinámicas ).\r\nConocimiento de leyes relacionadas con los procesos contables administrativos, tributarias, L.G. del trabajo y pensiones.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD COMERCIAL;CONTABILIDAD GENERAL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(293, NULL, NULL, 'LA PAZ', '', NULL, 'Empresa farmacéutica', NULL, 0, 'liderrrhh.2013@gmail.com', '2017-09-17', '2017-09-22', 'Experiencia de trabajo en el área de mantenimiento en industria alimenticia o farmacéutica.\r\nConocimientos de BPM´s y normas ISO 9001, ISO 14001 y OHSAS 18001.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTRICIDAD INDUSTRIAL;ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL;MECÁNICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(294, NULL, NULL, 'LA PAZ', 'Área de mantenimiento ', NULL, 'Empresa farmacéutica', NULL, 0, 'liderrrhh.2013@gmail.com', '2017-09-17', '2017-09-22', 'Experiencia de trabajo en el área de mantenimiento en industria alimenticia o farmacéutica.\r\nConocimientos de BPM´s y normas ISO 9001, ISO 14001 y OHSAS 18001.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTRICIDAD INDUSTRIAL;ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL;MECÁNICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(295, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de servicio al cliente', NULL, 'Empresa multinacional ', NULL, 0, 'talentoprofesionalbolivia@gmail.com', '2017-09-17', '2017-09-21', 'Titulado/a en Administración de Empresas, Ing. Comercial, Economía, Negocio internacionales, logística.\r\nConocimiento el idioma ingles.\r\nConocimiento de paquetes Microsoft Ofice.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL;LOGÍSTICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(296, NULL, NULL, 'LA PAZ', 'Auditor/a ', NULL, 'Empresa de consultoria por producto', NULL, 0, 'profesionales.empresa.lp@gmail.com', '2017-09-17', '2017-09-22', 'Experiencia mínima de 3 años.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(297, NULL, NULL, 'LA PAZ', 'Encargado/a de recursos humanos ', NULL, 'Empresa ', NULL, 0, 'contratacionesrrhh7@outlook.com', '2017-09-17', '2017-09-25', 'Administrador/a de empresas. Contador publico, o ramas afines,\r\nConocimiento en cargas sociales, AFPS- CNS, Finiquitos, etc.\r\nConocimientos en normativa laboral L.G.T., reglamentos y otras disposiciones en materia laboral.\r\nConocimiento en tramites Ministerio de trabajo.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(298, NULL, NULL, 'LA PAZ', 'Administrador/a de tienda - Consignatario/a', NULL, 'Hush Pupples', NULL, 0, 'hushpupplesbolivia@gmail.com', '2017-09-17', '2017-09-24', 'Egresado/a o profesionales en : Administración de Empresas, o carreras afines: Ing. Comercial, Marketing y publicidad o en el área social.\r\n\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(299, NULL, NULL, 'COCHABAMBA', 'Gerente Comercial Nacional ', NULL, 'Empresa ', NULL, 0, 'reclutamientorrhh2209@gmail.com', '2017-09-17', '2017-09-22', 'Titulado/a en Adm. de Empresas, Ing. Comercial, Ing. Industrial, Marketing o carreras afines.\r\nPreferentemente con estudios de postgrado en planificación, Marketing o ventas.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL;MARKETING;MARKETING Y LOGÍSTICA;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(300, NULL, NULL, 'LA PAZ', 'Psicóloga/o ', NULL, 'Maya Paya Kimsa El Alto - Bolivia', NULL, 0, 'iniciativa@mayapayakimsa.org', '2017-09-17', '2017-09-24', 'Experiencia laboral.\r\nDestrezas, habilidades técnicas, artísticas y/o deportivas.\r\nConocimientos en metodología de intervención con grupos de alto riesgo social.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'PSICOLOGÍA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(301, NULL, NULL, 'LA PAZ', '}}ejecutivo/a de ventas ', NULL, 'Empresa alimenticia', NULL, 0, 'contratadosrrhh@gmail.com', '2017-09-17', '2017-09-23', 'Formación en Administración de Empresas, Ing. Comercial, Marketing, Comunicación o ramas afines.\r\nManejo de herramientas MS IFFICE a nivel intermedio.\r\nManejo de kardex de clientes.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMUNICACIÓN;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(302, NULL, NULL, 'LA PAZ', 'Responsable técnico de equipos médicos ', NULL, 'Empresa importadora de equipos médicos Alemanes ', NULL, 0, 'contacto7rrhh@gmail.com', '2017-09-17', '2017-09-22', 'Licenciado en el área electromecánica o biomedica.\r\nFluidez en el idioma ingles, tanto oral como escrito.\r\nDisponibilidad para realizar viajes de capacitación a Europa y Estados Unidos y de gestión técnica en el interior del país.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOMÉDICO;ELECTROMECÁNICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(303, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de negocios industrias', NULL, 'Ferrotodo', NULL, 0, 'rrhh@ferrotodo.com', '2017-09-17', '2017-09-22', 'Ing. Industrial, Civil, Electromecánico con amplios conocimientos comerciales en el campo de la metalmecanica.\r\nConocimiento de Microsoft Office, Word, Excel, Power Point, etc.\r\nLicencia de conducir.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL;INGENIERÍA ELECTROMECÁNICA;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(304, NULL, NULL, 'LA PAZ', 'Secretaria recepcionista ', NULL, 'Institución educativa', NULL, 0, 'institucioneducativabolivia@gmail.com', '2017-09-17', '2017-09-21', 'Excelente redacción.\r\nConocimiento de manejo de archivos.\r\nConocimiento de entorno office.\r\nCapacidad de manejar equipos de oficina, fotocopiadoras, central telefónica, fax.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(305, NULL, NULL, 'LA PAZ', 'Vendedor/a industrial senior', NULL, 'Distribuidora de equipos industriales', NULL, 0, 'reclutagestionth@gmail.com', '2017-09-17', '2017-09-22', 'Experiencia en ventas industriales de almenos 3 años.\r\nExperiencia de manejo de equipos de ventas.\r\nExperiencia en desarrollo de marcas y mercados en el ámbito industrial y de construcción.\r\nDisponibilidad de viajes.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA ELÉCTRICA;INGENIERÍA ELECTROMECÁNICA;INGENIERÍA ELECTRÓNICA;INGENIERÍA INDUSTRIAL;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-09-18 19:00:00', NULL),
(306, NULL, NULL, 'LA PAZ', 'Promotor/a de ventas ', NULL, 'Lafalco', NULL, 0, 'proyectos.lafalco@gmail.com', '2017-10-01', '2017-10-05', 'Experiencia en el are de ventas de materiales de construccion.\r\nFacilidad de palabra, proactivo/a, responsable, activo/a, dinamico/a, honesto/a.\r\n', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(307, NULL, NULL, 'LA PAZ', 'Asesor/a comercial', NULL, 'Ribepar', NULL, 70071143, 'coordinadorarrhh@ribepar.com.bo', '2017-10-01', '2017-10-09', 'Experiencia minima de 1 año en ventas de productos de mercado masivo.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(308, NULL, NULL, 'LA PAZ', 'Encargado/a de redes sociales y web', NULL, 'Jotta Evolution SRL', NULL, 71550339, 'jottaevolutionsrl@gmail.com', '2017-10-01', '2017-10-03', 'Conocimientos en marketing y publicidad, con amplia experiencia en la administracion de redes sociales como Facebook, Instagram, Twitter y otras.\r\nCon capacidad de creacion, gestion y seguimiento de campañas.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(309, NULL, NULL, 'LA PAZ', 'Auditor interno ', NULL, 'Importante grupo financiero ', NULL, 0, 'grupofinancierorrhh@gmail.com', '2017-10-01', '2017-10-08', 'Conocimiento de normativa ASFI, APS, UIF, BBV, ley de servicios financieros y de seguros, codigo de comercio.\r\nManejo de herramientas Office ( Word, Excel, Power Point. ).', 8, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(310, NULL, NULL, 'LA PAZ', 'Ejecutivo/a Operativo', NULL, 'SAFI Mercantil Santa Cruz', NULL, 0, 'mcarazas@bmsc.com.bo', '2017-10-01', '2017-10-05', 'Experiencia:\r\nEn manejo y orden de documentacion.\r\nEn el manejo del entorno office ( word, excel, etc. )', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;INGENIERÍA COMERCIAL;INGENIERÍA ECONÓMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(311, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Constructora', NULL, 0, 'cv.inge.obras@gmail.com', '2017-10-01', '2017-10-08', 'Experiencia en construccion de obras de agua potable y/o saneamiento.\r\nDiseño de proyectos de agua potable y/o saneamiento.\r\nResidencia en obra en el departamento de La Paz ( Pucarani - Chuma ).', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(312, NULL, NULL, 'LA PAZ', 'Gerente de estrategias y proyectos', NULL, 'Institucion empresarial', NULL, 0, 'rrppbolivia@gmail.com', '2017-10-01', '2017-10-09', 'Maestria en Administracion de empresas, economia, finanzas, comercio internacional o preparacion y evaluacion de proyectos.\r\n', 10, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ECONOMÍA;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(313, NULL, NULL, 'LA PAZ', 'Regente farmaceutica', NULL, 'Distribuidora farmaceutica', NULL, 0, 'reclutamientoempresacomercial2@gmail.com', '2017-10-01', '2017-10-04', 'Titulo de bioquimica y marmaceutica en provision nacional.\r\nCarnet del colegio de bioquimica y farmaceutica.\r\nMatricula profesional.\r\nHabilitacion  en Senasag para gestionar tramites.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(314, NULL, NULL, 'LA PAZ', 'Supervisor/a de ventas ', NULL, 'Empresa de consumo', NULL, 0, 'supervisor.comercial.2017@gmail.com', '2017-10-01', '2017-10-08', 'Eperiencia en cargos similares de preferencia en empresas de consumo masivo.\r\nExperiencia en supervision de ventas y manejo de personal.\r\nManejo de Ms Office.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(315, NULL, NULL, 'LA PAZ', 'Jefe de operaciones ', NULL, 'Trueno Corp.', NULL, 76770230, 'rrhh@truenocorp.com.bo', '2017-10-01', '2017-10-08', 'Conocimiento en Seguridad privada bancaria industrial.\r\nLicencia de conducir categoria M y A.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(316, NULL, NULL, 'LA PAZ', 'Vendedor/a  / Promotor/a de ventas ', NULL, 'Stolzel', NULL, 0, 'rrhh@stolzel.com.bo', '2017-10-01', '2017-10-08', 'Ing, Comercial.\r\nExperiencia minima de 1 a;o en gestion de ventas y manejo de consumo masivo.\r\nExperiencia en mercado tradicional y moderno.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(317, NULL, NULL, 'LA PAZ', 'Vendedor/a senior - Mercado internacional ', NULL, 'Stolzel', NULL, 0, 'rrhh@stolzel.com.bo', '2017-10-01', '2017-10-08', 'Especializacion en negocios internacionales / comercio exterior.\r\nConocimiento en mercados internacionales.\r\nConocimiento en negociaciones.\r\nManejo en logistica internacional.\r\nIdioma ingles avanzado.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(318, NULL, NULL, 'LA PAZ', 'Analistas para desarrollo de modulos de capacitacion', NULL, 'Empresa capacitadora', NULL, 0, 'capacitaempresa2017@gmail.com', '2017-10-01', '2017-10-09', 'Trabajo en equipo, responsabilidad, compromiso y pro actividad.\r\nExcelente ortografia y redaccion.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(319, NULL, NULL, 'LA PAZ', 'Asistente de oficina', NULL, 'Fabbri & Asociados - Estudio Juridico', NULL, 0, 'info@fabbri.com.bo', '2017-10-01', '2017-10-08', 'Experiencia en contabilidad y administracion.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'ASISTENCIA GERENCIAL;AUXILIAR DE CONTABILIDAD Y COMPUTACIÓN;AUXILIARES EN ADMINISTRACIÓN', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(320, NULL, NULL, 'LA PAZ', 'Personal para atencion de restaurante', NULL, 'Restaurante', NULL, 68216889, 'c2pssrl@gmail.com', '2017-10-01', '2017-10-08', 'Personal con experiencia para apertura de restaurante de comida rapida', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(321, NULL, NULL, 'LA PAZ', 'Cargos administrativos', NULL, 'Hierro Brothers', NULL, 71517177, 'contact@hierrobrothers.com', '2017-10-01', '2017-10-08', 'CV con referencias.\r\nIdioma Ingles.\r\nOtros Idiomas.\r\nBuen manejjo de office.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AYMARA;IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(322, NULL, NULL, 'LA PAZ', 'Secretario/a Ejecutivo/a', NULL, 'Empresa importadora y distribuidora', NULL, 0, 'talentohumano2109@gmail.com', '2017-10-01', '2017-10-08', 'Conocimiento de ingles y buena experiencia de trabajo ', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO EJECUTIVO', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(323, NULL, NULL, 'LA PAZ', 'Almacenero/a', NULL, 'Empresa importadora y distribuidora', NULL, 0, 'talentohumano2109@gmail.com', '2017-10-01', '2017-10-08', 'Con experiencia y manejo de MS Office y paquetes informaticos.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(324, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa importadora y distribuidora', NULL, 0, 'talentohumano2109@gmail.com', '2017-10-01', '2017-10-08', 'Contador/a con experiencia, trabajo a medio tiempo.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD GENERAL;CONTADURÍA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(325, NULL, NULL, 'LA PAZ', 'Topografo', NULL, 'Indigo & Isiven', NULL, 0, 'jtortoza@isiven.com', '2017-10-01', '2017-10-03', 'Experiencia laboral y trabajo de campo comprobado mayor a 2 años.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TOPOGRAFÍA;TOPOGRAFÍA Y GEODESIA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(326, NULL, NULL, 'LA PAZ', 'Consultor/a Externo/a', NULL, 'Grupo Taxamir SRL', NULL, 0, 'grupotexamir@gmail.com', '2017-10-01', '2017-10-04', 'Tener conocimientos solidos para enfrentar una fiscalizacion de impuestos internos y de caja petrolera de salud.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;AUDITORIA FINANCIERA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(327, NULL, NULL, 'LA PAZ', 'Encuestadores y supervisores de encuesta', NULL, 'Gerenssa SRL', NULL, 0, 'base.profesionales@gmail.com', '2017-10-01', '2017-10-08', 'Experiencia en aplicacion y supervision de encuestas en area urbana y periurbana.\r\nManejo del idioma aymara.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ECONOMÍA;SOCIOLOGÍA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(328, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa de ventas masivas ', NULL, 0, 'ventasmasivasbol@hotmail.com', '2017-10-01', '2017-10-08', 'Gente dinamica con actitud positiva y deseos de superacion.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(329, NULL, NULL, 'LA PAZ', 'Seguridad', NULL, 'Truenocorp', NULL, 76770230, 'rrhh@truenocorp.com.bo', '2017-10-01', '2017-10-08', 'Personal para supervisores con conocimientos en computacion, seguridad privada, industrial, bancaria, hospitales y experiencia en cargoss similares.\r\nContar con licencia de conducir M y A.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(330, NULL, NULL, 'LA PAZ', 'Gerente general', NULL, 'Bolkama Motors', NULL, 77285243, 'bolkamamotors@gmail.com', '2017-10-01', '2017-10-08', 'Con experiencia y conocimiento en contabilidad y comercio exterior.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(331, NULL, NULL, 'LA PAZ', 'Promotor/a de ventas', NULL, 'Industria del Plastico', NULL, 0, 'rrhhindustrialplas@gmail.coom', '2017-10-01', '2017-10-06', 'Experiencia en venta de masivos.\r\nFacilidad de palabra y poder de convencimiento.\r\nAtencion de llamadas y recepcion de pedidos.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(332, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa constructora', NULL, 0, 'req.personal.aic', '2017-10-01', '2017-10-04', 'Dominio de Autocad, Microsoft Office.\r\nRedaccion propia.\r\nDisponibilidad para viajes.\r\nConocimientos de Quark.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(333, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa constructora', NULL, 0, 'req.personal.aic', '2017-10-01', '2017-10-04', 'Dominio de Autocad, Microsoft Office.\r\nRedaccion propia.\r\nDisponibilidad para viajes.\r\nConocimientos de Quark.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'DELETED', '1', '2017-10-01 19:00:00', NULL),
(334, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa constructora', NULL, 0, 'req.personal.aic@amail.com', '2017-10-01', '2017-10-04', 'Dominio de Autocad, Microsoft Office.\r\nRedaccion propia.\r\nDisponibilidad para viajes.\r\nConocimientos de Quark.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'DELETED', '1', '2017-10-01 19:00:00', NULL),
(335, NULL, NULL, 'LA PAZ', 'Arquitecto/a', NULL, 'Empresa constructora', NULL, 0, 'req.personal.aic@amail.com', '2017-10-01', '2017-10-08', 'Dominio de Autocad, Microsoft Office.\r\nRedaccion propia.\r\nDisponibilidad para viajes.\r\nConocimientos de Quark.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(336, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Empresa constructora', NULL, 0, 'req.personal.aic@amail.com', '2017-10-01', '2017-10-04', 'Disponibilidad inmediata y de tiempo completo.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD GENERAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(338, NULL, NULL, 'LA PAZ', 'Regentes Farmaceuticos', NULL, 'Farmacorp', NULL, 0, 'seleccion.farmacorp@gmail.com', '2017-10-01', '2017-10-08', 'Lic. en farmacia y/o bioquimica y farmacia.\r\nCon experiencia en regencia y manejo de personal.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(339, NULL, NULL, 'LA PAZ', 'Auxiliares de farmacia', NULL, 'Farmacorp', NULL, 0, 'seleccion.farmacorp@gmail.com', '2017-10-01', '2017-10-08', 'Estudiantes a nivel tecnico o universitarios de bioquimica o farmacia, con conocimientos de farmacologia y servicio al cliente.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(340, NULL, NULL, 'LA PAZ', 'Promotor/a de ventas', NULL, 'Empresa industrial', NULL, 0, 'rrhhbtlpcbz23@gmail.com', '2017-10-01', '2017-10-06', 'Contar con conocimientos solidos en tecnicas de ventas y manejo de clientes.\r\nSolidas habilidades en cierre de ventas y capacitacion de clientes.\r\nDisponibilidad para viajes al interior del pais.\r\nBuen manejo de paquete Office, excel, word y power point.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;MARKETING;MARKETING Y LOGÍSTICA;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(341, NULL, NULL, 'LA PAZ', 'Cajero', NULL, 'Antares ( Consultoria Administrativa y Auditoria ) ', NULL, 0, 'personal@gpp.com.bo', '2017-10-01', '2017-10-06', 'Conocimiento y experiencia en tasacion de joyas.\r\n', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(342, NULL, NULL, 'LA PAZ', 'Jefe/a de producto', NULL, 'COFAR', NULL, 0, 'srodriguez@cofar.com.bo', '2017-10-01', '2017-10-06', 'Experiencia en el rubro farmaceutico.\r\nConocimientos en Excel, Power Point, Outlook.\r\nDisponibilidad para realizar viajes frecuentes.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(343, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa de cosmeticos capilares', NULL, 0, 'rec.humera@gmail.com', '2017-10-01', '2017-10-08', 'Experiencia en ventas minimmo de 3 años.', 3, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(344, NULL, NULL, 'LA PAZ', 'Vendedor/a de tienda', NULL, 'dismac', NULL, 0, 'dismaclpz@gmail.com', '2017-10-01', '2017-10-06', 'Experiencia en atencion al cliente, cierre de ventas, facilidad de palabra y buen trato.\r\nManejo avanzado de Microsoft Office e internet.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(345, NULL, NULL, 'LA PAZ', 'Agentes de Seguros de Vida ', NULL, 'Nacional de Seguros', NULL, 0, 'tmorato@nacionalseguros.com.bo', '2017-10-01', '2017-10-06', 'Capacidad de autogestion.\r\nPro actividad.\r\nPredispocicion al trabajo en equipo.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(346, NULL, NULL, 'LA PAZ', 'Agentes de seguros', NULL, 'La Boliviana Ciacruz', NULL, 0, 'reclutamiento.agentes@lbc.bo', '2017-10-01', '2017-10-11', 'Proactividad.\r\nHabilidad de negociacion.\r\nOrientacion a logro de objetivos y resultados.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(347, NULL, NULL, 'LA PAZ', 'Arquitecto/a', NULL, 'Empresa Constructora', NULL, 0, 'construcciones108@gmail.com', '2017-10-01', '2017-10-09', 'Con experiencia en:\r\nCalculos de cantidades y costos de obra.\r\nManejo de programas de diseño en 3D.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(348, NULL, NULL, 'LA PAZ', 'Ingeniero/a en Sistemas', NULL, 'Credito facil', NULL, 78971117, 'info@creditofacil.com.bo', '2017-10-01', '2017-10-09', 'Conocimientos avanzados en PHP, manejo de FRAMEWORKS, ORM, Modelo MVC y POO.\r\nConocimiento intermedio en diseño Web en HTML 5, Bootstrap 3, CSS3, JS, Jquery, diseño responsive y manejo de Hosting y dominios.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(349, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas y Promotores/as ', NULL, 'Credito Fasil', NULL, 78971117, 'info@creditofacil.com.bo', '2017-10-01', '2017-10-09', 'Proactivos', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(350, NULL, NULL, 'LA PAZ', '', NULL, 'Bavaria SRL', NULL, 0, 'info@bavaria.bo', '2017-10-01', '2017-10-09', 'Conocimientos solidos en instrumentacion de campo programacion de PLC´s.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL;INGENIERÍA ELECTRÓNICA', 'DELETED', '1', '2017-10-01 19:00:00', NULL),
(351, NULL, NULL, 'LA PAZ', 'Ventas', NULL, 'Bavaria SRL', NULL, 0, 'info@bavaria.bo', '2017-10-01', '2017-10-09', 'Conocimientos solidos en instrumentacion de campo programacion de PLC´s.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;ELECTROMECÁNICA INDUSTRIAL;INGENIERÍA ELECTRÓNICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(352, NULL, NULL, 'LA PAZ', 'Ventas', NULL, 'Bavaria SRL', NULL, 0, 'info@bavaria.bo', '2017-10-01', '2017-10-09', 'Conocimientos solidos en SISO, SIMA, mercadeo y ventas.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA AMBIENTAL;INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(353, NULL, NULL, 'LA PAZ', 'Asistente de ventas ', NULL, 'Empresa industrial', NULL, 0, 'jefeplanta17@gmail.com', '2017-10-01', '2017-10-08', 'Domicilio en El Alto.\r\nBuenas referencias.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(354, NULL, NULL, 'LA PAZ', 'Mensajero/a', NULL, 'Empresa industrial', NULL, 0, 'jefeplanta17@gmail.com', '2017-10-01', '2017-10-08', 'Domicilio en El Alto .\r\nBuenas referencias.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(355, NULL, NULL, 'LA PAZ', 'Secretaria', NULL, 'Empresa industrial', NULL, 0, 'jefeplanta17@gmail.com', '2017-10-01', '2017-10-08', 'Domicilio en El Alto.\r\nBuenas referencias.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO COMPUTACIONAL;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(356, NULL, NULL, 'LA PAZ', 'Supervisor/a de ventas', NULL, 'Copelme', NULL, 0, 'recursoshumanos@copelme.com', '2017-10-01', '2017-10-06', 'Conocimientos en: \r\nTecnicas de ventas.\r\nHabilidades de negociacion.\r\nTecnicas de manejo de clientes.\r\nConocimientos de normativas impositivas vigentes.\r\nManejo de office.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(357, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa tecnologica ', NULL, 0, 'comercial.lpz.017@gmail.com', '2017-10-01', '2017-10-11', 'Trabajo en equipo.\r\nTrabajo bajo presion.\r\nHabilidad de negociacion.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(358, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Empresa industrial', NULL, 0, 'rrhh.personal69@gmail.com', '2017-10-01', '2017-10-05', 'Solidos conocimientos en :\r\nContabilidad industrial, registros contables, liquidacion y declaracion de impuestos, normativas tributarias y laborales vigentes.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR CONTABLE', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(359, NULL, NULL, 'LA PAZ', 'Ingeniero/a Metalurgista', NULL, 'Empresa minera', NULL, 0, 'postulacionestres@gmail.com', '2017-10-01', '2017-10-08', 'Solida experiencia en puestos similares:\r\nIngeniero metalurgico con especialidad en concentracion de minerales, gestion minera o medio ambiente minero.', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA METALÚRGICA;METALURGIA Y FUNDICIÓN', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(360, NULL, NULL, 'LA PAZ', 'Ingeniero/a geologo mina ', NULL, 'Empresa minera', NULL, 0, 'postulacionesdos@gmail.com', '2017-10-01', '2017-10-08', 'Ingeniero geologo con especialidad en geomecanica, gestion minera o medio ambiente minero.', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA GEOLÓGICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(361, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa minera', NULL, 0, 'postulacionesuno@gmail.com', '2017-10-01', '2017-10-08', 'Ingeniero civil con especialidad en medio ambiente minero.\r\nConocimiento de autocad y otros paquetes de diseño de diques.\r\nIdioma ingles.', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(362, NULL, NULL, 'LA PAZ', 'Supervisor/a de laboratorio de control de procesos', NULL, 'Empresa industrial', NULL, 0, 'sobretalentohumano@gmail.com', '2017-10-01', '2017-10-06', 'Tecnico superior en quimica y procesos o faines.\r\nConocimiento en buenas practicas de manufacturas y HACCP.\r\nConocimientos en sistemas de gestion de inocuidad alimentaria.\r\nDisponibilidad de trabajo en turnos.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'FARMACIA Y BIOQUÍMICA;INGENIERÍA INDUSTRIAL;QUÍMICA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(363, NULL, NULL, 'LA PAZ', 'Arqueologo/a', NULL, 'Empresa internacional', NULL, 0, 'fezegarra@gmail.com', '2017-10-01', '2017-10-08', 'Arqueologo/a con registro en la UNAM, para proyectos viales en el departamento de Pando.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(364, NULL, NULL, 'LA PAZ', 'Ingeniero/a Comercial', NULL, 'Empresa comercializadora', NULL, 0, 'seleccionoctubre.2017@gmail.com', '2017-10-01', '2017-10-06', 'Pro activos', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(365, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa comercializadora', NULL, 0, 'seleccionoctubre.2017@gmail.com', '2017-10-01', '2017-10-06', 'Pro activo.\r\nDomicilio en El Alto', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(366, NULL, NULL, 'LA PAZ', 'Reponedor', NULL, 'Empresa comercializadora', NULL, 0, 'seleccionoctubre.2017@gmail.com', '2017-10-01', '2017-10-06', 'Pro activo .\r\nDomicilio en El Alto.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(367, NULL, NULL, 'LA PAZ', 'Asistente', NULL, 'Empresa comercializadora', NULL, 0, 'seleccionoctubre.2017@gmail.com', '2017-10-01', '2017-10-06', 'Pro activo.\r\nDomicilio en El Alto.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ASISTENCIA GERENCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(368, NULL, NULL, 'LA PAZ', 'Almacenero/a', NULL, 'Chinbol S.R.L. supermercado', NULL, 0, 'chinbollpz@hotmail.com', '2017-10-01', '2017-10-08', 'con conocimiento en manejo de sistema de inventarios', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(369, NULL, NULL, 'LA PAZ', 'Vendedores/as', NULL, 'Chinbol S.R.L. supermercado', NULL, 0, 'chinbollpz@hotmail.com', '2017-10-01', '2017-10-08', 'Pro activos.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(370, NULL, NULL, 'LA PAZ', 'Tecnico de mantenimiento', NULL, 'Industrial procesadora de alimentos', NULL, 0, 'convocatoriasvarios@yahoo.com', '2017-10-01', '2017-10-05', 'Experiencia en manejo de maquinas, herramientas, neumatica, electricidad.\r\nExperiencia en programacion de mantenimiento preventivo.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'MECÁNICA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(371, NULL, NULL, 'LA PAZ', 'Encargado de almacenes', NULL, 'Emprea industrial', NULL, 0, 'talento.humano.bo.2015@gmail.com', '2017-10-01', '2017-10-06', 'Conocimiento de gestion de la cadena de Suministro - Supply Chain.\r\nConocimientos solidos en sistemas integrados de gestion.\r\nExperienci en manejo de Almacenes y sistemas de distribucion, en empresas industriales.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(372, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa de Marketing', NULL, 0, 'personalconfuturo@gmail.com', '2017-10-01', '2017-10-06', 'Conocimiento de dispoiciones legales vigentes en el pais en materia financiera e impositiva.\r\nDominio de normas y procedimientos actuales de la AEMP y SIN.\r\nExperiencia en analisis financiero, recursos humanos y manejo de personal.', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;CONTADURÍA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(373, NULL, NULL, 'LA PAZ', 'Analista de compras y produccion', NULL, 'Empresa de Marketing', NULL, 0, 'personalconfuturo@gmail.com', '2017-10-01', '2017-10-06', 'Elaboracion de cuadros comparativos, presupuestos y ordenes de servicio.\r\nConocimientos de Microsoft Office y administracion de base de datos.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(374, NULL, NULL, 'LA PAZ', 'Coordinador/a comercial y marketing', NULL, 'Distribuidora de equipos industriales', NULL, 0, 'reclutagestionth@gmail.com', '2017-10-01', '2017-10-06', 'Desarrollar actividades comerciales y de marketing.\r\nDominio de MS Office.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL;MARKETING', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(375, NULL, NULL, 'LA PAZ', 'Jefe/a de logistica', NULL, 'Empresa farmaceutica', NULL, 0, 'talentohumano454@gmail.com', '2017-10-01', '2017-10-06', 'Alto grado de responsabilidad y compromiso con la empresa.\r\nRegistro en el colegio de ingenieros industriales.', 5, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(376, NULL, NULL, 'LA PAZ', 'Jefe/a de planta', NULL, 'Empresa farmaceutica', NULL, 0, 'talentohumano454@gmail.com', '2017-10-01', '2017-10-06', 'Tener Post grado en procesos productivos.\r\nConocimiento en ISO 22000 y HACCP, haber sido parte de la preparacion de documentacion de seguimiento y control para la certificacion de la ISO.\r\nConocimiento de la Normativa de UNIMED: BPM, BPA.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL;INGENIERÍA QUÍMICA', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(377, NULL, NULL, 'LA PAZ', 'Representante comercial', NULL, 'Empresa comercial', NULL, 0, 'contacto7rrhh', '2017-10-01', '2017-10-06', '" años de experiencia en el area comercial.\r\nContactar a los clientes, realizar cotizaciones personalizadas y ampliar la cartera de clientes nuevos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'DELETED', '1', '2017-10-01 19:00:00', NULL),
(378, NULL, NULL, 'LA PAZ', 'Representante comercial', NULL, 'Empresa comercial', NULL, 0, 'contacto7rrhh', '2017-10-01', '2017-10-06', '" años de experiencia en el area comercial.\r\nContactar a los clientes, realizar cotizaciones personalizadas y ampliar la cartera de clientes nuevos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'DELETED', '1', '2017-10-01 19:00:00', NULL),
(379, NULL, NULL, 'LA PAZ', 'Representante comercial', NULL, 'Empresa comercial', NULL, 0, 'contacto7rrhh@gmail.com', '2017-10-01', '2017-10-06', '" años de experiencia en el area comercial.\r\nContactar a los clientes, realizar cotizaciones personalizadas y ampliar la cartera de clientes nuevos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-01 19:00:00', NULL),
(381, NULL, NULL, 'LA PAZ', 'asistente comercial y almacenes', NULL, 'Anapqui Empresa ', NULL, 0, 'reclutamientoanapqui@gmail.com', '2017-10-08', '2017-10-11', 'Experiencia en el area comercial, marqueting y mercadeo.\r\nExperiencia en manejo de almacenes.\r\nManejo de paquetes de computacion ( word, excel ).\r\nConocimientos basicos en contabilidad.\r\nExperiencia en realizacion de inventarios.\r\nExperiencia en manejo de activos fijos ', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(382, NULL, NULL, 'LA PAZ', 'Topografo/a', NULL, 'Empresa Constructora', NULL, 0, 'empresaconstructorapersonal@gmail.com', '2017-10-08', '2017-10-18', 'Amplios conocimientos en manejo de estacion total para trabajo en campamento.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TOPOGRAFÍA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL);
INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `AREAS_REFERENCIA`, `FORMACIONES_REFERENCIA`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(383, NULL, NULL, 'LA PAZ', 'Agentes de Seguros de Vida', NULL, 'Nacional de Seguros', NULL, 0, 'ecordova@nacionalseguros.com.bo', '2017-10-08', '2017-10-13', 'Capacidad de autogestion.\r\nProactividad.\r\nPredisposicion al trabajo en equipo.\r\nGanas de superacion personal.\r\nResidencia en la ciudad de El Alto.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(384, NULL, NULL, 'LA PAZ', 'Ejecutivo de ventas senior', NULL, 'MADEPA', NULL, 0, 'lzegarra@madepa.com.bo', '2017-10-08', '2017-10-12', 'Apertura de nuevos canales.\r\nCoordinar con los clientes la entrega de sus productos.\r\nCoordinar las cobranzas.\r\nGenerar, dar seguimiento y cierre a las propuestas comerciales.', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(385, NULL, NULL, 'LA PAZ', 'Ejecutivo de ventas junior', NULL, 'MADEPA', NULL, 0, 'lzegarra@madepa.com.bo', '2017-10-08', '2017-10-12', 'Generar, dar seguimiento y cierre a las propuestas comerciales.\r\nElaborar reporte de seguimiento y proyeccion de ventas.\r\nCoordinar con los clientes la entrega de sus productos.\r\nBuen manejo de sistemas informaticos.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(386, NULL, NULL, 'LA PAZ', 'Analista de Auditoria Interna ', NULL, 'Entidad de mercado de valores', NULL, 0, 'rrhhentfin@bdpst.com.bo', '2017-10-08', '2017-10-12', 'Profesional universitario con titulo en Provision Nacional en Contaduria Publica e inscrito en el colegio de Auditores.\r\nConocimientos en :\r\nMercado de valores y normativa ASFI.\r\nAnalisis financiero.\r\nPost grado en finanzas, administracion de empresas, auditoria.', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(387, NULL, NULL, 'LA PAZ', 'Vigilancia y Monitoreo', NULL, 'Torre Azul', NULL, 0, 'administracion@torre-azul.com', '2017-10-08', '2017-10-11', 'Bachiller en Humanidades.\r\nLibreta de servicio Militar ( Varones ).\r\nCertificado de antecedentes y buena conducta de la F.E.L.C.C.\r\nGarante personal.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 0, NULL, NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(388, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas Comerciales.', NULL, 'PLUSCARGO BOLIVIA', NULL, 0, 'asaucedo@pluscargobolivia.com', '2017-10-08', '2017-10-18', 'Ingles intermedio o avanado ( oral y escrito ).\r\nExperiencia en ventas de servicios logisticos.\r\nCartera de clientes.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'COMERCIO EXTERIOR;COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(389, NULL, NULL, 'LA PAZ', 'Asistente de Contabilidad ', NULL, 'Productores de Quinua - ANAPQUI', NULL, 0, 'reclutamientoanapqui@gmail.com', '2017-10-08', '2017-10-11', 'Conocimiento basico de normas tributarias y legislacion laboral.}Buen manejo de Microsoft Office nivel intermedio.\r\nManejo del sistema SIAP.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;CONTADURÍA PÚBLICA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(390, NULL, NULL, 'LA PAZ', 'Ventas', NULL, 'Ventas', NULL, 76525595, 'marcos196944@yahoo.com', '2017-10-08', '2017-10-16', 'Idioma Ingles avanzado.\r\nPreferible que tenga movilidad.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(391, NULL, NULL, 'LA PAZ', 'Meseros/as', NULL, 'Prestigioso y tradicional local gastronomico', NULL, 0, 'mdiezdemedina21@gmail.com', '2017-10-08', '2017-10-16', 'Disponibilidad en horario nocturno', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(392, NULL, NULL, 'LA PAZ', 'Administrador de base de datos', NULL, 'Empresa', NULL, 79544179, 'requerimiento_personal_dba@outlook.es', '2017-10-08', '2017-10-18', 'Con experiencia demostrable en administracion de bases de datos MS SQL, Server y/o PostgreSQL', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(393, NULL, NULL, 'LA PAZ', 'Contratista en obras Civiles ', NULL, 'Empresa Constructora', NULL, 0, 'elaltoconstruc@hotmail.com', '2017-10-08', '2017-10-17', 'Amplia experiencia en obras civiles.\r\nCapacidad de trabajo en equipo.\r\n', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(394, NULL, NULL, 'LA PAZ', 'Operador de camion grua', NULL, 'Empresa constructora', NULL, 0, 'elaltoconstruc@hotmail.com', '2017-10-08', '2017-10-17', 'Licencia de conducir categoria T.\r\nDomicilio preferentemente en El Alto.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(395, NULL, NULL, 'LA PAZ', 'Mensajero/a Auxiliar de oficina', NULL, 'LatinMalls.com', NULL, 0, 'rrhh@latinmalls.com', '2017-10-08', '2017-10-18', 'Capacidad de trabajo en equipo, relacionamiento y comunicacion.\r\nSolidos conocimientos de rutas y calles de la ciudad.\r\nCertificado de antecedentes policiales.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR SECRETARIADO;AUXILIARES EN ADMINISTRACIÓN;BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(396, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas ', NULL, 'Bellcos', NULL, 0, 'ivonencinas@bellcos.com.bo', '2017-10-08', '2017-10-13', 'Vehiculo propio.\r\nConocimiento del mercado formal ( supermercados ).\r\nBuena negociacion con clientes.\r\n', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(397, NULL, NULL, 'LA PAZ', 'Asesor/a legal ', NULL, 'Entidad del mercado de valores ', NULL, 0, 'rrhhentfin@bdpst.com.bo', '2017-10-08', '2017-10-12', 'Experiencia especifica en asesoramiento legal a nivel ejecutivo en instituciones del sistema financiero o del mercado de valores.\r\nConocimientos especificos en:\r\nDerecho laboral, bancario y comercial.\r\nMercado de valores y normativa ASFI.\r\nNorma tributaria vigente.', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DERECHO', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(398, NULL, NULL, 'LA PAZ', 'Asistente de arquitectura', NULL, 'Empresa constructora', NULL, 0, 'computadora777@gmail.com', '2017-10-08', '2017-10-12', 'Arquitecto/a Junior o egresado/a.\r\nDominio de Autocad 2D/3D.\r\nREVIT/Lumion/3D STUDIO.\r\nBIAA.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(399, NULL, NULL, 'LA PAZ', 'Ingeniero/a Mecanico ', NULL, 'Empresa', NULL, 0, 'auditorinterno12@gmail.com', '2017-10-08', '2017-10-20', 'Con experiencia en soldadura', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(400, NULL, NULL, 'LA PAZ', 'Area informatica', NULL, 'Empresa', NULL, 77509922, 'conseincoltda@yahoo.com', '2017-10-08', '2017-10-18', 'Experto en diseño de paginas Web dinamicas, base de datos, PHP, Java, Python, Servidores Windows - Linux y Marketing en redes sociales.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(401, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa Constructora', NULL, 0, 'cidal1980@yahoo.es', '2017-10-08', '2017-10-11', 'Con experiencia en construccion de carreteras.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(403, NULL, NULL, 'LA PAZ', 'Ingeniero/a Industrial Junior ', NULL, 'Training', NULL, 0, 'training.rrhh@gmail.com', '2017-10-08', '2017-10-18', 'Ingeniero industrial', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(404, NULL, NULL, 'LA PAZ', 'Auxiliar administrativo', NULL, 'Trining', NULL, 0, 'training.rrhh@gmail.com', '2017-10-08', '2017-10-16', 'Auxiliar administrativo', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIARES EN ADMINISTRACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(405, NULL, NULL, 'LA PAZ', 'Portero para edificio', NULL, 'Training', NULL, 0, 'training.rrhh@gmail.com', '2017-10-08', '2017-10-16', 'Bachiller en humanidades', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(406, NULL, NULL, 'LA PAZ', 'Jefe de Ventas ', NULL, 'Importadora Tamiva', NULL, 0, 'asistente@importamiva.com', '2017-10-08', '2017-10-16', 'Buen relacionamiento comercial.\r\nGarantias personales.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(407, NULL, NULL, 'LA PAZ', 'Jefe/a de ventas ', NULL, 'Credito Facil', NULL, 0, 'info@creditofacil.com.bo', '2017-10-08', '2017-10-16', 'Experiencia en ventas', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(408, NULL, NULL, 'LA PAZ', 'Diseñador/a Grafico/a', NULL, 'Izimport Ltda', NULL, 78971117, 'info@izimport.com', '2017-10-08', '2017-10-16', 'Experiencia en diseño de paginas Web y publicidad.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(409, NULL, NULL, 'LA PAZ', 'Chofer', NULL, 'Empresa Hotelera ', NULL, 0, 'rrhh.adm.hoteles@gmail.com', '2017-10-08', '2017-10-16', 'Con licencia de conducir categoria B o C.\r\nIdioma Ingles fluido.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES;IDIOMA INGLÉS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(410, NULL, NULL, 'LA PAZ', 'Recepcionista', NULL, 'Empresa Hotelera ', NULL, 0, 'rrhh.adm.hoteles@gmail.com', '2017-10-08', '2017-10-16', 'Idioma ingles fluido.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(411, NULL, NULL, 'LA PAZ', 'Supervisor/a de tiemda', NULL, 'Empresa comercial', NULL, 0, 'empresacomercial0815@gmail.com', '2017-10-08', '2017-10-13', 'Manejo de personal.\r\nConocimientos especificos en:\r\nServicio al cliente.\r\nManejo de caja.\r\nExcel a nivel intermedio.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ARQUITECTURA;ECONOMÍA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(412, NULL, NULL, 'LA PAZ', 'Maestro/a de primaria', NULL, 'Institucion educativa privada', NULL, 0, 'convocatoriadocentes0220172gmail.com', '2017-10-08', '2017-10-27', 'Formacion profesional en el nivel o area curricular en la que postula.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'DELETED', '1', '2017-10-08 19:00:00', NULL),
(413, NULL, NULL, 'LA PAZ', 'Maestro/a de primaria', NULL, 'Institucion educativa privada', NULL, 0, 'convocatoriadocentes0220172@gmail.com', '2017-10-08', '2017-10-27', 'Formacion profesional en el nivel o area curricular en la que postula.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(414, NULL, NULL, 'LA PAZ', 'Maestro/a de Fisica', NULL, 'Institucion educativa privada', NULL, 0, 'convocatoriadocentes0220172@gmail.com', '2017-10-08', '2017-10-27', 'Formacion profesional en el nivel o area curricular a la que postula.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(415, NULL, NULL, 'LA PAZ', 'Profesor/a de Ciencias Sociales', NULL, 'Institucion educativa privada', NULL, 0, 'convocatoriadocentes0220172@gmail.com', '2017-10-08', '2017-10-27', 'Formacion profesional en el nivel o area curricular a la que postula.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(416, NULL, NULL, 'LA PAZ', 'Area comercial', NULL, 'Cordova Bolivia', NULL, 0, 'icordova@cordovabolivia.com', '2017-10-08', '2017-10-14', 'Experiencia deseable en operaciones logisticas y aduaneras ( importacion y exportacion 9.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(417, NULL, NULL, 'LA PAZ', 'Supervisor/a Comercial', NULL, 'Empresa comercial ', NULL, 0, 'postulantelpz@gmail.com', '2017-10-08', '2017-10-12', 'Presentar garantia real de inmueble o similar.\r\nMovilidad propia.\r\nManejo de Microsoft Office nivel intermedio.\r\nExcelentes referencias laborales.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(418, NULL, NULL, 'LA PAZ', 'Jefe/a Farmaceutico/a', NULL, 'Empresa farmaceutica', NULL, 0, 'tthh.ga@gmail.com', '2017-10-08', '2017-10-18', 'Conocimientos en normas BPM, BPA, ISO9000.\r\nConocimientos de procesos productivos y de control.\r\nConocimientos en sistemas informaticos office nivel intermedio.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA;QUÍMICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(419, NULL, NULL, 'LA PAZ', 'Jefe/a de producto', NULL, 'Empresa farmaceutica', NULL, 0, 'tthh.ga@gmail.com', '2017-10-08', '2017-10-18', 'conocimientos en :\r\nOfimatica a nivel avanzado.\r\ningles nivel intermedio.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MEDICINA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(420, NULL, NULL, 'LA PAZ', 'Experto/a en patronaje industrial y desarrollo de producto', NULL, 'GAV SPORT', NULL, 0, 'gavsport@gmail.com', '2017-10-08', '2017-10-16', 'Experiencia de trabajo en cargo similar.\r\nLugar de trabajo El Alto.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(421, NULL, NULL, 'LA PAZ', 'Jefe/a de producto', NULL, 'COFAR', NULL, 0, 'recursoshumanos@cofar.com.bo', '2017-10-08', '2017-10-13', 'Experiencia en el rubro farmaceutico.\r\nConocimientos de Excel, Power Point, Outlook.\r\nDisponibilidad para realizar viajes frecuentes.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(422, NULL, NULL, 'LA PAZ', 'Encargado/A de Cotizaciones', NULL, 'Protel', NULL, 0, 'recursos.humanos@protel.com.bo', '2017-10-08', '2017-10-11', 'Se valorara experiencia en el area.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA ELECTRÓNICA;SISTEMAS INFORMÁTICOS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(423, NULL, NULL, 'LA PAZ', 'Consultores/as', NULL, 'Empresa consultora', NULL, 0, 'hort.postulaciones@gmail.com', '2017-10-08', '2017-10-13', 'Rpofesional con titulo en provision nacional o certificado de egreso.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;FINANZAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(425, NULL, NULL, 'LA PAZ', 'Tecnico electronico', NULL, 'SIMA S.R.L.', NULL, 2816603, NULL, '2017-10-08', '2017-10-16', 'Tecnico Electrico', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTRICIDAD INDUSTRIAL;ELECTRÓNICA;TÉCNICO', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(426, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas ', NULL, 'Empresa de telecomunicaiones', NULL, 75852333, 'talentoelalto@gmail.com', '2017-10-08', '2017-10-16', 'Responsables.\r\nDinamicas.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(427, NULL, NULL, 'LA PAZ', 'Trade Marketing', NULL, 'Centro LUA', NULL, 0, 'andrea@centrolua.com.bro', '2017-10-08', '2017-10-13', 'Idioma ingles.\r\nConocimiento de Excel, Word, Power Point.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(428, NULL, NULL, 'LA PAZ', 'Responsable de mantenimiento', NULL, 'MATRIPLAST S.A.', NULL, 0, 'recursohumanolpz@gmail.com', '2017-10-08', '2017-10-11', 'Experiencia practica en mantenimiento de maquinaria de plasticos (inyeccion y soplado).\r\nExperiencia solida en hidraulica, neumatica, electronica de control y automatizacion con PLC´s.\r\nManejo de programas para diseño de planos mecanicos y electronicos.\r\nIngles tecnico.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA ELECTROMECÁNICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(429, NULL, NULL, 'LA PAZ', 'Auxiliar de Reaseguros', NULL, 'La Vitalicia', NULL, 0, 'alebolivar@grupobisa.com', '2017-10-08', '2017-10-12', 'Conocimientos de bases contables.\r\nConocimiento de la ley de seguros y reaseguros.\r\nManejo a nivel avanzado de excel.\r\n', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ECONOMÍA;FINANZAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(430, NULL, NULL, 'LA PAZ', 'Auxiliar de farmacia', NULL, 'Farmacorp', NULL, 0, 'seleccion.farmacorp@gmail.com', '2017-10-08', '2017-10-12', 'Tener conocimientos de farmacologia y orientacion al cliente.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(431, NULL, NULL, 'LA PAZ', 'asistente comercial ', NULL, 'Empresa farmaceutica', NULL, 0, 'buscamospersonal70@gmail.com', '2017-10-08', '2017-10-13', 'Experiencia en organizacion de eventos profesionales ( congresos, lanzamientos, simposios, etc. ).\r\nIdioma ingles fluido.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;TURISMO', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(432, NULL, NULL, 'LA PAZ', 'Ingeniero/a de aplicaciones - ventas', NULL, 'Empresa industrial', NULL, 0, 'proceso.seleccion.bo@gmail.com', '2017-10-08', '2017-10-18', 'Vehiculo propio. ( requisito indispensable ) .\r\nExperiencia en el area de ventas.\r\nExperiencia en licitaciones.\r\nBuen manejo de Microsoft Office y otros.\r\nIdioma ingles.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL;INGENIERÍA MECÁNICA;INGENIERÍA QUÍMICA;MECÁNICA GENERAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(433, NULL, NULL, 'LA PAZ', 'Revisor/a ', NULL, 'Pro-mujer', NULL, 0, 'rrhh@promujer.org', '2017-10-08', '2017-10-13', 'Conocimiento en Normativa ASFI y ley 393 Servicios Financieros.\r\nConocimiento del sector micro-empresarial y micro-financiero.\r\nContar con conocimiento en manejo de efectivo y deteccion de billetes.\r\nManejo de aplicaciones de Microsoft Office.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ADMINISTRACIÓN FINANCIERA;ECONOMÍA;FINANZAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(434, NULL, NULL, 'LA PAZ', 'Editor/a de Cine  y video', NULL, 'Empresa Cinematografica y video', NULL, 0, 'talentoaudiovisual2017@gmail.com', '2017-10-08', '2017-10-18', 'Experiencia en el manejo de :\r\nAdobe Premier.\r\nAdobe After Effects.\r\nCinema 4D y/o Maya.\r\nEdicion de sonido.\r\nAnimacion 2D.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CINEMATOGRAFIA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(435, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas', NULL, 'Empresa de comercializacion de productos', NULL, 0, 'postulantes.rec2017@gmail.com', '2017-10-08', '2017-10-13', 'Manejo de Microsoft Office.\r\nTecnicas de ventas.\r\nExperiencia en el mercado tradicional y moderno mayorista.\r\nDisponibilidad para viajes.\r\nGarantia real.', 2, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(436, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas Institucional', NULL, 'Empresa comercializacion de productos', NULL, 0, 'postulantes.rec2017@gmail.com', '2017-10-08', '2017-10-13', 'Marketing y servicio al cliente.\r\nVentas de productos y servicios.\r\nManejo de Microsoft Office.\r\nCartera de clientes establecidos. \r\nGarantia real.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(437, NULL, NULL, 'LA PAZ', 'Vendedores/as', NULL, 'Boliviamar', NULL, 0, 'c.vargas@boliviamar.com.bo', '2017-10-08', '2017-10-16', 'Personas con experiencia en ventas', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(438, NULL, NULL, 'LA PAZ', 'Vendedores/as', NULL, 'Empresa', NULL, 0, 'rodriguez24o1@hotmail.com', '2017-10-08', '2017-10-16', 'Conocimiento tecnico en ventas.\r\nFacilidad de palabra.\r\nContar con garantia real.\r\nCon domicilio en El Alto.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(440, NULL, NULL, 'LA PAZ', 'Preventista', NULL, 'Empresa', NULL, 2307428, NULL, '2017-10-08', '2017-10-16', 'Personas con actitud positiva.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(441, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Chimbol S.R.L.', NULL, 0, 'Chinbollpz@hotmail.com', '2017-10-08', '2017-10-16', 'Vendedores con experiencia', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'ADMINISTRACIÓN FINANCIERA', 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(442, NULL, NULL, 'LA PAZ', 'Supervisor/a de ventas', NULL, 'Empresa alimenticia industrial', NULL, 0, 'rrhhalimentosiag@gmail.com', '2017-10-08', '2017-10-14', 'Conocimientos amplios en tecnicas de preventa horizontal y mercados masivos.\r\nGarantias personales.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(443, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Yotau', NULL, 0, 'directvtas.nac.clubvacacional@yotau.com.bo', '2017-10-08', '2017-10-11', 'Con o Sin Experiencia.\r\nDon de liderazgo y experiencia en manejar grupos.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;BACHILLER EN HUM;ANIDADES;INGENIERÍA COMERCIAL;TURISMO', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(444, NULL, NULL, 'LA PAZ', 'Profesional de gestion estrategica', NULL, 'IBNORCA', NULL, 0, 'reclutamiento@ibnorca.org', '2017-10-08', '2017-10-13', 'Tecnico medio en dieño grafico o post grado en marketing digital, relaciones publicas o areas afines.\r\nIdioma ingles avanzado.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING Y PUBLICIDAD;RELACIONES PÚBLICAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(445, NULL, NULL, 'LA PAZ', 'Agentes de seguros', NULL, 'La Vitalicia', NULL, 0, 'rmontoya@grupobisa.com', '2017-10-08', '2017-10-11', 'Personas que desean generar ingresos adicionales sin descuidar su actividad actual.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(446, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas', NULL, 'Sinapsis S.R.L.', NULL, 72153832, NULL, '2017-10-08', '2017-10-10', 'Prestigiosa empresa con más de 8 años en el país requiere personal de ambos sexos para el área de marketing y ventas con o sin experiencia.\r\nSe ofrece:\r\n* Estabilidad laboral.\r\n* Oportunidad de crecimiento dentro la empresa.\r\n* Excelentes ingresos por comisiones.\r\n* Premios e incentivos.\r\n* Capacitación constante.\r\n* Buen ambiente laboral.\r\n* Prestaciones laborales.\r\n* Contratación inmediata.\r\nLas personas interesadas comunicarse al número de celular 72153832 para agendar una entrevista de trabajo o aproximarse a nuestra oficina el día martes 10 de Octubre de 09:00 a.m. a 11:00 a.m. en la Av. del Ejército #1145 entre Av. Saavedra y calle Juan Manuel Loza en la zona de Miraflores media cuadra antes de llegar al parque Laikakota.\r\nCon los siguientes requisitos:\r\n* Traer su C.V. en un folder color amarillo.\r\n* Venir con traje formal varones y mujeres.\r\n* Disponibilidad inmediata.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;ASISTENCIA GERENCIAL;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', '2017-10-08 19:00:00'),
(447, NULL, NULL, 'LA PAZ', 'Responsable de mantenimiento', NULL, 'Empresa farmaceutica', NULL, 0, 'buscamospersonal70@gmail.com', '2017-10-08', '2017-10-13', 'Experiencia en el area de mantenimiento en industria alimenticia o farmaceutica.\r\nConocimientos en BPM´s y Normas ISO 9001, ISO 14001 y OHSAS 18991.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTROMECÁNICA;ELECTRÓNICA;MECÁNICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(448, NULL, NULL, 'LA PAZ', 'Auxiliar Parvularia', NULL, 'Guarderia', NULL, 0, 'daniela_danielita@hotmail.com', '2017-10-08', '2017-10-16', 'Parvularia con eperiencia para guarderia en la zona sur.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', '2017-10-08 19:00:00'),
(449, NULL, NULL, 'LA PAZ', 'Consultor de proyectos', NULL, 'Empresa de capacitacion', NULL, 71526672, 'gatochefbolivia@gmail.com', '2017-10-08', '2017-10-16', 'Experiencia en proyectos para apertura de instituto de capacitacion tecnica', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(450, NULL, NULL, 'LA PAZ', 'Supervisor/a ', NULL, 'Empresa de comida rapida ', NULL, 0, 'bolivia.personal.2017@gmail.com', '2017-10-08', '2017-10-16', 'Dotes de liderazgo y experiencia en el sector', 0, 'BACHILLER', NULL, NULL, 'La Razón', 0, NULL, NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(451, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'Empresa comercial de materiales de obra fina', NULL, 75372709, 'jmanuel@porcelamax.com.bo', '2017-10-08', '2017-10-16', '', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(452, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'Porcelamax', NULL, 75372709, 'jmanuel@porcelamax.com.bo', '2017-10-08', '2017-10-16', 'Personas con experiencia en el area de ventas ', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-10-08 19:00:00', '2017-10-08 19:00:00'),
(453, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Porcelamax', NULL, 0, 'jmanuel@porcelamax.com.bo', '2017-10-08', '2017-10-16', 'Personal proactivas .', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR CONTABLE', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(454, NULL, NULL, 'LA PAZ', 'Docente en el area de Matematica, Fisica, Quimica.', NULL, 'CIFAST S.R.L.', NULL, 0, 'requerimiento2017bolivia@gmail.com', '2017-10-08', '2017-10-11', 'Titulado de la carrera ciencias de la educacion.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CIENCIAS DE LA EDUCACIÓN', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(455, NULL, NULL, 'LA PAZ', 'Secretaria - asistente', NULL, 'CIFAST S.R.L.', NULL, 0, 'requerimiento2017bolivia@gmail.com', '2017-10-08', '2017-10-11', 'Disponibilidad inmediata', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ASISTENCIA GERENCIAL;SECRETARIADO COMERCIAL;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(456, NULL, NULL, 'LA PAZ', 'Promotor/a de ventas', NULL, 'Gismart S.R.L.', NULL, 0, 'contabilidad@gismart.com.bo', '2017-10-08', '2017-10-12', 'Experiencia laboral en el area de ventas en productos de consumo  masivo.\r\nConocimiento de las ciudades de La Pa y El Alto.\r\nManejo de Office nivel medio.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;BACHILLER EN HUM;ANIDADES;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(457, NULL, NULL, 'SANTA CRUZ', 'Oficial de credito ', NULL, 'La Merced', NULL, 0, 'cvega@lamerced.coop', '2017-10-08', '2017-10-18', 'Conocimiento de la normativa ASFI.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(458, NULL, NULL, 'SANTA CRUZ', 'Docente de Ingenieria Industrial', NULL, 'Universidad Catolica Boliviana ´San Pablo´', NULL, 0, 'convocatoria-rrhh@ucbscz.edu.bo', '2017-10-08', '2017-10-17', 'Titulado a nivel de pregrado en Ingenieria Industrial.\r\nMaestria o Doctorado en areas de Ingenieria industrial.\r\n', 6, 'MAESTRIA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(459, NULL, NULL, 'SANTA CRUZ', 'Gerente Comercial', NULL, 'Centro Lua', NULL, 0, 'andrea@centrolua.com.bo', '2017-10-08', '2017-10-18', 'Implementar estrategias comerciales, de acuerdo al analisis del mercado, garantizando la rentabilidad del negocio.\r\nRealizar el control del stock de productos nacionales o importados.\r\nElaborar y presentar reportes mensuales de ventas al Directorio.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(460, NULL, NULL, 'SANTA CRUZ', 'Vendedores/as', NULL, 'Empresa alimenticia', NULL, 0, 'selecciondepersonal.profesiona@gmail.com', '2017-10-08', '2017-10-13', 'Experiencia minima de 1 año ', 1, 'BACHILLER', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(461, NULL, NULL, 'SANTA CRUZ', 'Asistente Administrativo/a', NULL, 'Empresa constructora', NULL, 0, 'empresalider.reh@gmail.com', '2017-10-08', '2017-10-12', 'Conocimiento en atencion al cliente.\r\nFacilidad en el manejo de programas informaticos.\r\nContar con un garante.', 0, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(462, NULL, NULL, 'SANTA CRUZ', 'Visitador/a Medico', NULL, 'COFAR', NULL, 0, 'lab.cofar.sa@gmail.com', '2017-10-08', '2017-10-13', '', 1, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BIOMÉDICO;BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(463, NULL, NULL, 'SANTA CRUZ', 'Visitador/a Medico', NULL, 'COFAR', NULL, 0, 'lab.cofar.sa@gmail.com', '2017-10-08', '2017-10-13', 'Experiencia de trabajo en el area comercial del rubro farmaceutico.\r\nConocimientos de computacion e internet.', 1, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BIOMÉDICO;BIOQUÍMICA;FARMACIA Y BIOQUÍMICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(464, NULL, NULL, 'SANTA CRUZ', 'Encargado comercial de ruta distribucion de productos agroforestales', NULL, 'HILLER S.A.', NULL, 0, 'rrhh@hiller.com.bo', '2017-10-08', '2017-10-18', 'Conocimientos en MS Office (Excel, Outolook, Power Point).\r\nDisponibilidad para realizar viajes a areas rurales.\r\nLicencia de conducir.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA AGRÍCOLA;INGENIERÍA AGROINDUSTRIAL;INGENIERIA AGRONOMICA;INGENIERÍA AGRONÓMICA', 'ACTIVE', '1', '2017-10-08 19:00:00', '2017-10-08 19:00:00'),
(465, NULL, NULL, 'SANTA CRUZ', 'Chofer', NULL, 'MONOPOL', NULL, 0, 'reclutamonopolsc@gmail.com', '2017-10-08', '2017-10-12', 'Licencia de conducir categoria B o C.\r\nGarantias Reales.\r\nDebe residir en Montero.', 2, 'BACHILLER', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(466, NULL, NULL, 'SANTA CRUZ', 'Jefe regional de almacenes', NULL, 'HANSA', NULL, 0, 'pchavez@hansa.com.bo', '2017-10-08', '2017-10-11', 'Experiencia al menos de 2 años en gestioon de almacenes, seguimiento y control a los inventarios, control y seguimiento de los equipos & herramientas, manejo de personal en almacenes.\r\nConocimiento en cadena de sumunistros o gestion de proyectos.\r\nIdioma ingles basico.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;AUDITORÍA;INFORMÁTICA Y TELECOMUNICACIONES;INGENIERÍA INDUSTRIAL;TELECOMUNICACIONES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(467, NULL, NULL, 'SANTA CRUZ', 'Encargado de registros de Agroquimicos', NULL, 'Empresa de insumos agricolas', NULL, 0, 'rrhh.insumoagricola@gmail.com', '2017-10-08', '2017-10-12', 'Conocimiento de las normas aplicables para el Registro de Agroquimicos.\r\nConocimiento de propiedades fisico-quimicas de agroquimicos.\r\nManejo de herramientas Office y Corel Draw.\r\nIdioma ingles ', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'INGENIERIA AGRONOMICA;INGENIERÍA AMBIENTAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(468, NULL, NULL, 'SANTA CRUZ', 'Vendedor/a', NULL, 'MARRIOTT SANTA CRUZ', NULL, 0, 'marriott.recluta@gmail.com', '2017-10-08', '2017-10-16', 'Idioma ingles', 0, 'TECNICO', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(469, NULL, NULL, 'SANTA CRUZ', 'Contabilidad y finanzas', NULL, 'MARRIOTT SANTA CRUZ', NULL, 0, 'marriott.recluta@gmail.com', '2017-10-08', '2017-10-16', 'Idioma ingles', 0, 'TECNICO', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'CONTABILIDAD;FINANZAS', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(470, NULL, NULL, 'SANTA CRUZ', 'Supervisor/a de promocion medica ', NULL, 'Empresa farmaceutica', NULL, 0, 'solicitudes.candidatos@gmail.com', '2017-10-08', '2017-10-18', 'Manejo de auditorias farmaceuticas IMS y CLOSE UP.\r\nManejo del sistema Office 8excel, word, power point).\r\nAmplio conocimiento del universo medico.\r\nMovilidad propia.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;BIOQUÍMICA;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(471, NULL, NULL, 'SANTA CRUZ', 'Supervisor/a de promocion medica ', NULL, 'Empresa farmaceutica', NULL, 0, 'solicitudes.candidatos@gmail.com', '2017-10-08', '2017-10-18', 'Manejo de auditorias farmaceuticas IMS y CLOSE UP.\r\nManejo del sistema Office 8excel, word, power point).\r\nAmplio conocimiento del universo medico.\r\nMovilidad propia.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;BIOQUÍMICA;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'DELETED', '1', '2017-10-08 19:00:00', NULL),
(472, NULL, NULL, 'SANTA CRUZ', 'Coordinador Administrativo de ventas', NULL, 'Tecnopor', NULL, 0, 'talentohumano@tecnopor.net', '2017-10-08', '2017-10-13', 'Solidos conocimientos en manejo de canales de distribucion.\r\nManejo de CRM.\r\nSolidos conocimientos en planificacion y experiencia en manejo de equipos de venta.\r\nManejo de programas Microsoft Office ( Word, Excel, hojas de calculo, Power point, etc.).', 4, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(473, NULL, NULL, 'SANTA CRUZ', 'Encargada de sucursal', NULL, 'AMC S.R.L.', NULL, 0, 'ventas1@amc.com.bo', '2017-10-08', '2017-10-18', 'Se valorara experiencia en el puesto.\r\nManejo de redes sociales.\r\nSketch up o programa de diseño.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ARQUITECTURA;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(474, NULL, NULL, 'SANTA CRUZ', 'Jefe de Contabilidad y Finanzas', NULL, 'San Fernando S.R.L.', NULL, 323, 'vacancias@buscotrabajobolivia.com', '2017-10-08', '2017-10-12', 'Firma autorizada del colegio de contadores publicos o auditores.\r\nExperiencia en analisis financiero.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'AUDITORIA FINANCIERA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(475, NULL, NULL, 'SANTA CRUZ', 'Ejecutivo de ventas ', NULL, 'Empresa comercial', NULL, 0, 'empresa.comercial@hotmail.com', '2017-10-08', '2017-10-13', 'Experiencia en el area comercial, deseable cargos similares en empresas del rubro comercial.\r\nLicencia de conducir categoria A.\r\nGarantias reales.', 0, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(476, NULL, NULL, 'SANTA CRUZ', 'Supervisor de servicio de distribucion independiente', NULL, ' ALCOS S.A.', NULL, 0, 'distrib.independientes2017@gmail.com', '2017-10-08', '2017-10-14', 'Contar con movilidad propia preferentemente vagoneta.\r\nAltos valores humanos.\r\nGarantias reales.', 0, 'BACHILLER', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-08 19:00:00', NULL),
(477, NULL, NULL, 'LA PAZ', 'Jefe de operaciones', NULL, 'Nutrimentos Maybo SRL', NULL, 0, 'nutrimaybo@gmail.com', '2017-10-15', '2017-10-23', 'Diplomado en inocuidad alimentaria.\r\nPlanificación de la producción.\r\nSistema de gestion integrado', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(478, NULL, NULL, 'LA PAZ', 'Administrador/a de Planta', NULL, 'Lincor S.R.L.', NULL, 0, 'yamali.huarachi@gmail.com', '2017-10-15', '2017-10-23', 'Haber realizado funciones de caja y ventas.\r\nManejo de almacenes y suministros.\r\nDisponibilidad de viajar para capacitación.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(479, NULL, NULL, 'LA PAZ', 'Secretaria de gerencia', NULL, 'Empresa', NULL, 0, 'reclutamiento.institucional@gmail.com', '2017-10-15', '2017-10-18', 'Funciones de secretariado y asistencia a la gerencia.\r\nIdioma ingles ( deseable ).', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO COMERCIAL;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(480, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Empresa', NULL, 0, NULL, '2017-10-15', '2017-10-18', 'Funciones de asistencia en el ciclo contable, apoyo en funciones administrativas.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(481, NULL, NULL, 'LA PAZ', 'Mensajería y auxiliar de oficina', NULL, 'Empresa', NULL, 0, 'Reclutamiento.institucional@gmail.com', '2017-10-15', '2017-10-18', 'Funciones:\r\nEntrega y recepción de documentación.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR SECRETARIADO;AUXILIARES EN ADMINISTRACIÓN', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(482, NULL, NULL, 'LA PAZ', 'Mensajería y auxiliar de oficina', NULL, 'Empresa', NULL, 0, 'Reclutamiento.institucional@gmail.com', '2017-10-15', '2017-10-18', 'Funciones:\r\nEntrega y recepción de documentación.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR SECRETARIADO;AUXILIARES EN ADMINISTRACIÓN', 'DELETED', '1', '2017-10-15 22:00:00', NULL),
(483, NULL, NULL, 'SANTA CRUZ', 'Coordinador/a de control de calidad ', NULL, 'Empresa Industrial', NULL, 0, 'coordcontrolcalidad1017@gmail.com', '2017-10-15', '2017-10-23', 'Se valorara conocimientos en :\r\nSistemas de control y gestión de calidad.\r\nSeguridad industrial.\r\nCalibración de equipos.\r\nProcesos de Producción Industrial.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA QUÍMICA;INGENIERO QUÍMICO EN PROCESOS INDUSTRIALES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(488, NULL, NULL, 'LA PAZ', 'Abogado/a', NULL, 'HANSA ', NULL, 0, 'ydelarroyo@hansa.com.bo', '2017-10-15', '2017-10-19', 'Maestría en Derecho: Corporativo, aduanero, civil, comercial y/o administrativo.\r\nCursos en materia tributaria, laboral, comercial, civil, aduanera, administrativa, laboral .', 5, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DERECHO', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(492, NULL, NULL, 'LA PAZ', 'Ingenieros/as Civiles ', NULL, 'Empresa constructora', NULL, 0, NULL, '2017-10-15', '2017-10-23', 'Experiencia en obras hidráulicas de 5 años,  manejo de Autocad y otros\r\nLos/as interesados/as favor hacer llegar su hoja de vida documentada a la calle Mercado # 1328, piso 11, of. 1101', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARCHIVOLOGIA - DOCUMENTACIÓN;INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(493, NULL, NULL, 'LA PAZ', 'contador general', NULL, 'Empresa importadora', NULL, 0, 'rrhhsteelza@gmail.com', '2017-10-15', '2017-10-19', 'Dominio de normativa tributaria vigente y laboral vigente.\r\nDominio del aplicativo FACILITO y OFICINA VIRTUAL.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(494, NULL, NULL, 'LA PAZ', 'Bioquímico/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia imprescindible de 1 año en el área y tramites en AGEMED.\r\nManejo de equipos de laboratorio.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(495, NULL, NULL, 'LA PAZ', 'Bioquímico/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia imprescindible de 1 año en el área y tramites en AGEMED.\r\nManejo de equipos de laboratorio.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(496, NULL, NULL, 'LA PAZ', 'Bioquímico/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia imprescindible de 1 año en el área y tramites en AGEMED.\r\nManejo de equipos de laboratorio.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOQUÍMICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(497, NULL, NULL, 'LA PAZ', 'Ingeniero/a  Biomedico/a', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Imprescindible inscripción en el C.I.B.\r\nExperiencia de 1 año en Biomedicina.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOMÉDICO', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(498, NULL, NULL, 'LA PAZ', 'Ingeniero/a  Biomedico/a', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Imprescindible inscripción en el C.I.B.\r\nExperiencia de 1 año en Biomedicina.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BIOMÉDICO', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(499, NULL, NULL, 'LA PAZ', 'Vendedor/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia de 1 año en ventas de medicamentos e insumos médicos o similares.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(500, NULL, NULL, 'LA PAZ', 'Vendedor/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia de 1 año en ventas de medicamentos e insumos médicos o similares.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(501, NULL, NULL, 'LA PAZ', 'Vendedor/a ', NULL, 'Empresa importadora', NULL, 0, 'correo_oriente@yahoo.es', '2017-10-15', '2017-10-21', 'Experiencia de 1 año en ventas de medicamentos e insumos médicos o similares.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(502, NULL, NULL, 'LA PAZ', 'Auxiliar de almacén ', NULL, 'Empresa hotelera', NULL, 0, 'RR.HH.adm.hoteles@gmail.com', '2017-10-15', '2017-10-23', 'Manejo de excel.\r\n', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(503, NULL, NULL, 'LA PAZ', 'Consultor contable', NULL, 'Empresa industrial', NULL, 0, 'rrhh2017lpbol@gmail.com', '2017-10-15', '2017-10-20', 'Tener amplia experiencia  en costos para la ejecución de un trabajo por producto, que consiste en realizar  Conciliaciones de cuentas de exigible y pasivo del balance general al 31/03/2017', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD GENERAL;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(504, NULL, NULL, 'LA PAZ', 'Encuestadores/as ', NULL, '', NULL, 69826123, 'rparedes@equiposmori.com', '2017-10-15', '2017-10-23', 'Tener una buena ortografía y fluidez verbal.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(505, NULL, NULL, 'LA PAZ', 'Encuestadores/as ', NULL, 'Empresa de estudios de investigación ', NULL, 69826123, 'rparedes@equiposmori.com', '2017-10-15', '2017-10-23', 'Tener una buena ortografía y fluidez verbal.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(506, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas ', NULL, 'Grupo imágenes BOLIVIA', NULL, 0, 'grupoimagenes.bo@gmail.com', '2017-10-15', '2017-10-18', 'Tener facilidad de palabra y trabajo en equipo.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(507, NULL, NULL, 'LA PAZ', 'Especialista en Medicina Interna ', NULL, 'TES Tecnología en Salud S.A.', NULL, 0, 'tes.ofnal@tes.com.bo', '2017-10-15', '2017-10-27', 'Los/as interesados/as deberán solicitar el formulario de postulacion  a nuestro correo tes.ofnal@tes.com.bo', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'MEDICINA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(508, NULL, NULL, 'LA PAZ', 'Ginecólogo/a Obstetricia  ', NULL, 'TES Tecnología en Salud S.A.', NULL, 0, 'tes.ofnal@tes.com.bo', '2017-10-15', '2017-10-27', 'Los/as interesados/as deberán solicitar el formulario de postulacion  a nuestro correo tes.ofnal@tes.com.bo', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'MEDICINA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(509, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil', NULL, 'Empresa constructora', NULL, 0, 'personal.constructora17@gmail.com', '2017-10-15', '2017-10-23', 'Conocer la ciudad de El Alto.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(510, NULL, NULL, 'LA PAZ', 'Operador de retroexcavadora', NULL, 'Empresa constructora', NULL, 0, 'personal.constructora17@gmail.com', '2017-10-15', '2017-10-23', 'Tener licencia de conducir de maquinaria ', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(511, NULL, NULL, 'LA PAZ', 'Contador/a Publico/a', NULL, 'Empresa de servicios ', NULL, 0, 'empasc@hotmail.com', '2017-10-15', '2017-10-19', 'Solido conocimiento de Sistemas Contables en entidades privadas.\r\nConocimientos tributarios.\r\nSolidos conocimientos en normas NIC-NIIF y otras relacionadas al área contable.\r\n', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(512, NULL, NULL, 'LA PAZ', 'Chofer', NULL, 'Empresa gastronómica ', NULL, 0, 'req.chofer2017@gmail.com', '2017-10-15', '2017-10-20', 'Tener licencia de conducir categoría C y certificado de buena conducta.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL);
INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `AREAS_REFERENCIA`, `FORMACIONES_REFERENCIA`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(513, NULL, NULL, 'LA PAZ', 'Jefe/a de producción ', NULL, 'Jallaza', NULL, 0, 'denicemaldonadob@jallaza.com', '2017-10-15', '2017-10-20', 'Experiencia en hacer cumplir la producción.\r\nTener garantías reales.\r\nImplantar y ejecutar las políticas de calidad y medio ambiente. ', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE LA PRODUCCIÓN;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(514, NULL, NULL, 'LA PAZ', 'Consultor de linea para el desarrollo de Software', NULL, '', NULL, 0, 'FinancieraBolivia-RH@hotmail.com', '2017-10-15', '2017-10-18', 'Los postulantes deben contar con conocimientos y experiencia en:\r\nJEE, JSF, Boolstrap, Jquery, JasperReports.\r\nDesarrollo web, Servicios WEB ( Restful, SOAP)\r\nMaven, Git.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE SISTEMAS;INGENIERÍA DE SOFTWARE', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(515, NULL, NULL, 'LA PAZ', 'Consultor de linea para el desarrollo de Software', NULL, 'Empresa de servicios financieros', NULL, 0, 'FinancieraBolivia-RH@hotmail.com', '2017-10-15', '2017-10-18', 'Los postulantes deben contar con conocimientos y experiencia en:\r\nJEE, JSF, Boolstrap, Jquery, JasperReports.\r\nDesarrollo web, Servicios WEB ( Restful, SOAP)\r\nMaven, Git.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE SISTEMAS;INGENIERÍA DE SOFTWARE', 'ACTIVE', '1', '2017-10-15 22:00:00', NULL),
(517, NULL, NULL, 'LA PAZ', 'Ejecutivo/a comercial', NULL, 'Truenocorp', NULL, 76792930, 'adm@truenocorp.com.bo', '2017-10-22', '2017-10-30', 'Egresado/a o Licenciado/a en área de marketing, comercial, tener experiencia de trabajo similares, conocimiento de Adobe PhotoShop, medios de comunicación.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(518, NULL, NULL, 'LA PAZ', 'Cajero/a', NULL, 'Truenocorp', NULL, 60583069, 'rrhh@tuenocorp.com.bo', '2017-10-22', '2017-10-30', 'Tener experiencia en manejo de caja, inventarios, deteccion de billetes falsos, manejo de control de efectivo de buena presencia.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/png', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(519, NULL, NULL, 'LA PAZ', 'Vendedores/as', NULL, 'estacion / La Paz', NULL, 0, 'info@estacionlapaz.com', '2017-10-22', '2017-10-30', 'Personnal con experiencia en ventas.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(520, NULL, NULL, 'LA PAZ', 'Diseñador/a Grafico/a junior ', NULL, 'estacion 7 La Paz ', NULL, 0, 'info@estacionlapaz.com', '2017-10-22', '2017-10-30', 'Diseñador/a Grafico/a', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'DISEÑO GRÁFICO', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(521, NULL, NULL, 'LA PAZ', 'Jefe de mantenimiento', NULL, 'Trans Cruz', NULL, 72147727, 'jorgecondori@transcruz.com.bo', '2017-10-22', '2017-10-30', 'Titulado/a en mecanica automotriz y especialidad en motor a diesel.\r\nAmplio conocimiento en informatica.\r\nLicencia de conducir categoria C.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'MECÁNICA AUTOMOTRIZ', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(522, NULL, NULL, 'LA PAZ', 'Ing. Civil Gerente de supervision y control', NULL, 'EMBOL S.A.', NULL, 0, 'mdelgado@embol-sa.com', '2017-10-22', '2017-10-30', 'Experiencia especifica en proyectos viales de carreteras de montaña y movimiento de tierras.', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(523, NULL, NULL, 'LA PAZ', 'Ing. Civil especialista en hidraulica y estructuras', NULL, 'EMBOL S.A.', NULL, 0, 'mddelgado@embol-sa.ccom', '2017-10-22', '2017-10-30', 'ESTRUCTURAS con experiencia en drenajes y diseño de estructuras en proyectos viales.', 0, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(524, NULL, NULL, 'LA PAZ', 'Ing. Geologo Especialista en geologia, geotecnica y materiales', NULL, 'EMBOL S.A.', NULL, 0, 'mdelgado@embol-sa.com', '2017-10-22', '2017-10-30', 'Para el control geologico y gestion de la obra.\r\nIncluyendo ademas Personal Tecnico de apoyo ( Topografo, alarifes, laboratorista de suelos, hormigos y asfalto ) .', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'GEOLOGÍA;INGENIERÍA GEOLÓGICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(525, NULL, NULL, 'LA PAZ', 'Supervisor/a de ventas', NULL, 'Jotta Evolution S.R.L.', NULL, 0, 'jottaevolutionsrl@gmail.com', '2017-10-22', '2017-10-25', 'Excelente manejo de sistema office ( Excel, Word, Power Point ).\r\nExcelente atencion al cliente.\r\n', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(526, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, '', NULL, 0, 'jottaevolutionsrl@gmail.com', '2017-10-22', '2017-10-25', 'Experiencia de venta en el rubro de roductos musicales teclados y pianos ( exclusivo ).\r\nExcelente atencion al cliente.\r\nmanejo de sistemas contables.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(527, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Jotta Evolution S.R.L.', NULL, 0, 'jottaevolutionsrl@gmail.com', '2017-10-22', '2017-10-25', 'Experiencia de venta en el rubro de roductos musicales teclados y pianos ( exclusivo ).\r\nExcelente atencion al cliente.\r\nmanejo de sistemas contables.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(528, NULL, NULL, 'LA PAZ', 'Gerente de ventas ', NULL, 'Empresa de distribucion ', NULL, 0, 'recluta.talentohumano10@gmail.com', '2017-10-22', '2017-11-05', 'Experiencia minima de 5 años en el area comercial, de los cuale 3 años en puestos similares de direccion, de preferencia en empresas de consumo masivo.\r\nExperiencia en desarrollo de estrategias comerciales.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(529, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'TERBOL', NULL, 0, 'talento.humano@hotmail.com', '2017-10-22', '2017-10-27', 'Manejo de Microsoft Office.\r\n', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(530, NULL, NULL, 'LA PAZ', 'Responsable de mantenimiento', NULL, 'Empresa farmaceutica', NULL, 0, 'tthh.ga@gmail.com', '2017-10-22', '2017-10-29', 'Conocimiento de la normativa de instalaciones electricas.\r\nConocimientos en motores electricos y servicios de apoyo critico.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;INGENIERÍA ELÉCTRICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(531, NULL, NULL, 'LA PAZ', 'Secretario/a general', NULL, 'Institucion de educacion superior ', NULL, 0, 'contratacionuniversidad@gmail.com', '2017-10-22', '2017-10-27', 'Amplio conocimiento del reglamento general y especificos de universidades privadas.\r\nDominio de hojas electronicas y procesadores de texto.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMUNICACIÓN SOCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(532, NULL, NULL, 'LA PAZ', 'Coordinador/a de gestion del talento ', NULL, 'YANBAL', NULL, 0, 'YanbalBolivia.RRHH@yanbal.com', '2017-10-22', '2017-10-29', 'Manejo de excel nivel avanzado.\r\nVer el resto de los requisitos en la imagen.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(537, NULL, NULL, 'LA PAZ', 'Asistente de seguridad de la informacion', NULL, 'REDENLACE', NULL, 0, 'reclutamiento@redenlace.com.bo', '2017-10-22', '2017-10-26', 'Cursos de especializacion en gestion de riesgos, seguridad de informacion o similares.\r\nConocimientos en :\r\nMetodologia para la gestion integral de riesgos tecnologicos.\r\nMetodologias de desarrollo.\r\nIngles basico', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA;INGENIERÍA DE SISTEMAS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(539, NULL, NULL, 'LA PAZ', 'Contador/a general', NULL, 'Imprenta Sagitario', NULL, 2110077, 'requerimiento.personal@imprentasagitario.com', '2017-10-22', '2017-10-30', 'Titulado/a, Colegiado/a, con conocimientos solidos contables, tributario y laboral.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA GENERAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(540, NULL, NULL, 'LA PAZ', 'Tecnico en comercio exterior', NULL, 'Imprenta Sagitario', NULL, 2110077, 'requerimiento.personal@imprentasagitario.com', '2017-10-22', '2017-10-30', 'Tener conocimientos en importaciones y contable.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'COMERCIO EXTERIOR', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(541, NULL, NULL, 'LA PAZ', 'Secretaria', NULL, 'Imprenta Sagitario', NULL, 2110077, 'requerimiento.personal@imprentasagitario.com', '2017-10-22', '2017-10-30', 'Tener buena redaccion, manejo de Microsoft Office, conocimiento contable basico.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO ADMINISTRATIVO;SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(542, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Imprenta Sagitario', NULL, 2110077, 'requerimiento.personal@imprentasagitario.com', '2017-10-22', '2017-10-30', 'Auxiliar contable', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR CONTABLE', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(543, NULL, NULL, 'LA PAZ', 'Ingenieros/as Civiles', NULL, 'Consultora integral LTDA', NULL, 0, 'consultoraintegralltda@gmail.com', '2017-10-22', '2017-10-31', 'Supervison y diseño de carreteras.\r\nExperiencia minima de 3 años a partir de la obtencion del titulo academico.\r\nEspecialidades requeridas:\r\nPavimentos.\r\nHidrologia e hidraulica.\r\nControl de calidad', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(544, NULL, NULL, 'LA PAZ', 'Geologos/as', NULL, 'Consultora Integral LTDA', NULL, 0, 'consultoraintegralltda@gmail.com', '2017-10-22', '2017-10-31', 'Experiencia minima de 3 años a partir de la obtencion del titulo academico.\r\nEspecialidades requeridas:\r\nGeologia, geotecnia y suelos.\r\nEvaluacion ambiental.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 0, NULL, NULL, 'GEOLOGÍA;INGENIERÍA GEOLÓGICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(545, NULL, NULL, 'LA PAZ', 'Ingenieros/as en telecomunicaciones ', NULL, 'Consultora Integral LTDA', NULL, 0, 'consultoraintegralltda@gmail.com', '2017-10-22', '2017-10-31', 'Experiencia minima de 3 años a partir de la obtencion del titulo academico.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'TELECOMUNICACIONES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(546, NULL, NULL, 'LA PAZ', 'Agentes de seguros', NULL, 'Bupa Insurance ( Bolivia ) S.A.', NULL, 0, 'amendivil@bupalatinamerica.com', '2017-10-22', '2017-10-30', 'Altos niveles de integridad, dedicacion y deseos de triunfar.\r\nExperiencias en ventas.\r\nConocimientos del rubro de seguros.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(547, NULL, NULL, 'LA PAZ', 'Vendedores/as', NULL, 'Empresa distribuidora', NULL, 0, 'lpz.rrhh.bolivia@gmail.com', '2017-10-22', '2017-10-29', 'Con experiencia minima de 3 años en ventas de productos masivos.', 3, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(548, NULL, NULL, 'LA PAZ', 'Administradores/as', NULL, 'Empresa distribuidora', NULL, 0, 'lpz.rrhh.bolivia@gmail.com', '2017-10-22', '2017-10-29', 'Experiencia minima de 3 años ', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(549, NULL, NULL, 'LA PAZ', 'Choferes', NULL, 'Empresa distribuidora', NULL, 0, 'lpz.rrhh.bolivia@gmail.com', '2017-10-22', '2017-10-29', 'Tener experiencia en distribucion.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(550, NULL, NULL, 'LA PAZ', 'Guia turistico', NULL, 'Empresa hotelera y turistica ', NULL, 0, 'rrhh4299@gmail.com', '2017-10-22', '2017-10-30', 'Excelente trato al cliente y responsabilidad.\r\nDominio de ingles, se valora otros idiomas.\r\nDisponibilidad de viajes y traslado inmediato.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'HOTELERÍA Y TURISMO;IDIOMA INGLÉS;IDIOMAS;INGLES;INGLÉS;TURISMO', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(551, NULL, NULL, 'LA PAZ', 'Director de obra ', NULL, 'Sociedad constructora S.R.L.', NULL, 0, 'sociedadconstructorasrl@yahoo.com', '2017-10-22', '2017-10-24', 'Disponibilidad de viaje a Villa Tunari ( Cochabamba )', 8, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(552, NULL, NULL, 'LA PAZ', 'Encargado/a de centros de distribucion y logistica ', NULL, 'Empresa industrial', NULL, 0, 'industrialrecluta@gmail.com', '2017-10-22', '2017-10-27', 'tener cursos en distribucion y almacenaje, logistica.\r\nExperiencia minima de 5 año en las siguientes funciones:\r\nVerificar el cumplimiento de la distribucion de productos terminados, de acuerdo a los lineamientos determinados por el area de planificacion.\r\nRevisar la distribucion correcta de materias primas e insumos.', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA DE LA PRODUCCIÓN;INGENIERÍA DE PROCESOS;INGENIERÍA DE PROCESOS INDUSTRIALES;INGENIERÍA DE PRODUCCIÓN;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(553, NULL, NULL, 'LA PAZ', 'Jefe/a de contabilidad y administracion ', NULL, 'ILBISA', NULL, 0, 'rrhh@ilbisa.com', '2017-10-22', '2017-10-25', 'Saber manejar excel nivel intermedio.\r\nSe valorara conocimientos de SAP Business One u otros sistemas de control financiero.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA;CONTADURÍA GENERAL;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(554, NULL, NULL, 'LA PAZ', 'Contador/a', NULL, 'Empresa comercial', NULL, 0, 'incorporar.rrhh@gmail.com', '2017-10-22', '2017-10-27', 'Experiencia en elaboracion e interpretacion de estados financieros.\r\nExperiencia en conciliaciones bancarias, bancarizacion e intervalos.\r\nExperiencia en manejo de contabilidad fiscal.\r\nBuen manejo de sistemas contables.', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(555, NULL, NULL, 'LA PAZ', 'Analista contable', NULL, 'OPAL LTDA.', NULL, 0, 'seleccion@gruponudelpa.com', '2017-10-22', '2017-10-30', 'Dominio y aplicacion de conocimientos contables.\r\nConocimientos y manejo de sistema de informacion en la gestion financiera.\r\nElaborar mensualmente reportes financieros.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 0, NULL, NULL, 'CONTADURÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(556, NULL, NULL, 'LA PAZ', 'Quimico farmaceutico y/o ingeniero quimico ', NULL, 'Industria farmaceutica', NULL, 0, 'farmaceutico.quimico2013@gmail.com', '2017-10-22', '2017-10-27', 'Solidos conocimientos de Buenas practicas de Manufactura.\r\nConocimientos de las normas ISO 9001, ISO 14001 y OHSAS 18001.\r\nBuen manejo de entorno Microsoft Office.\r\nIdioma Ingles.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'FARMACIA Y BIOQUÍMICA;INGENIERÍA QUÍMICA;QUÍMICA FARMACEÚTICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(558, NULL, NULL, 'LA PAZ', 'Jefe de recursos humanos y administracion ', NULL, 'Empresa comercial', NULL, 0, 'rrhh.tiens.bolivia@gmail.com', '2017-10-22', '2017-10-26', 'Buen manejo de paquetes de Microsoft Office.\r\nTener experiencia de 4 años en el area de recursos humanos.', 4, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(559, NULL, NULL, 'LA PAZ', 'Gerente general', NULL, 'CEARE', NULL, 0, 'rrhh@ceare.com.bo', '2017-10-22', '2017-10-29', 'Postgrado en temas financieros o de micro finanzas en el ambito rural.\r\nExperiencia en formulacion de presupuestos, flujos de caja, analisis de balances y estados de resultados.\r\nConocimiento del mercado de valores.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;ECONOMÍA;FINANZAS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(560, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas externo', NULL, 'Empresa comercial', NULL, 0, 'madelkagarcia@gmail.com', '2017-10-22', '2017-10-27', '\r\nexperiencia en ventas ( material de construccion ).\r\n', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;ARQUITECTURA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(561, NULL, NULL, 'LA PAZ', 'Residente de obra', NULL, 'Empresa constructora', NULL, 0, 'const.civil@gmail.com', '2017-10-22', '2017-10-31', 'Profesional con titulo en Provision Nacional y experiencia como residente de obra en redes de gas o agua potable.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA;INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(562, NULL, NULL, 'LA PAZ', 'Ingeniero/a Industrial ', NULL, 'Empresa constructora', NULL, 0, 'const.civil@gmail.com', '2017-10-22', '2017-10-31', 'Experiencia de  año en proyecto de gas y/o rubro industrial, ocupacional y medio ambiente.', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(563, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de cuentas', NULL, 'EDOBOL', NULL, 0, 'consultas@edprint.com.bo', '2017-10-22', '2017-10-31', 'Se valorara experiencia como ejecutiva de cuentas en agencia de publicidad y/o conocimientos de industria grafica.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(564, NULL, NULL, 'LA PAZ', 'Tecnico en mantenimiento', NULL, 'Empresa farmaceutica', NULL, 0, 'tthh.ga@gmail.com', '2017-10-22', '2017-10-29', 'experiencia de 1 año en instalaciones electricas de baja tension e industriales.\r\nConocimientos en :\r\nMaquinaria industrial.\r\nServicios de apoyo critico.\r\nOffice nivel intermedio.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTROMECÁNICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(565, NULL, NULL, 'LA PAZ', 'Ingeniero/a para proyectos y calibraciones junior', NULL, 'Industria farmaceutica', NULL, 0, 'electromecanicoingeniero@gmail.com', '2017-10-22', '2017-10-27', 'Experiencia en manejo de equipos, maquinaria y automatizacion de procesos industriales.\r\nExperiencia de trabajo en el area de mantenimiento en industria alimenticia o farmaceutica.\r\nConocimiento de BPM´s y Normas ISO 9001, iso 14001 y OHSAS 18001.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA ELÉCTRICA;INGENIERÍA ELECTROMECÁNICA;INGENIERÍA ELECTRÓNICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(566, NULL, NULL, 'LA PAZ', 'Supervisor/a de exportaciones', NULL, 'Empresa industrial', NULL, 0, 'rrhh.empresa.lider.2016@gmail.com', '2017-10-22', '2017-10-28', 'Tecnico en ventas.\r\nAtencion al cliente.\r\nSistema de gestion de calidad.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'COMERCIO EXTERIOR;MARKETING', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(567, NULL, NULL, 'LA PAZ', 'Pasante area contabilidad', NULL, 'Empresa de medio de comunicacion escrita ', NULL, 0, 'reclutamiento@gmcsa.com', '2017-10-22', '2017-10-25', 'Carta de la universidad o instituto de educacion superior.\r\nExperiencia laboral en el area.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'CONTABILIDAD;CONTABILIDAD GENERAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(568, NULL, NULL, 'LA PAZ', 'Controller comercial', NULL, 'Monopol', NULL, 0, 'reclutamonopol@gmail.com', '2017-10-22', '2017-10-27', 'Experiencia minima de 2 años en cargos similares gestionando ventas de consumo masivo, analisis de mercado, auditoria contable, gestion de personal, presentacion de informes gerenciales.\r\nNivel superior de Analisis Estadistico y base de datos ( Excel a evaluar ).', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;AUDITORÍA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(569, NULL, NULL, 'LA PAZ', 'Recepcionista', NULL, 'Loki Hostel', NULL, 0, 'la_paz@lokihostel.com', '2017-10-22', '2017-10-31', 'Tener disponibilidad de trabajar en distintos horarios.\r\nIdioma ingles avanzado.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'IDIOMA INGLÉS;IDIOMAS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(570, NULL, NULL, 'LA PAZ', '', NULL, '', NULL, 0, 'la_paz@lokihostel.com', '2017-10-22', '2017-10-31', 'Disponibilidad para trabajar en distintos horarios.\r\nAntecedentes policiales actualizados.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(571, NULL, NULL, 'LA PAZ', 'Seguridad', NULL, 'Loki Hostel', NULL, 0, 'la_paz@lokihostel.com', '2017-10-22', '2017-10-31', 'Disponibilidad para trabajar en distintos horarios.\r\nAntecedentes policiales actualizados.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(572, NULL, NULL, 'LA PAZ', 'Ingeniero/a Comercial', NULL, 'Empresa internacional', NULL, 0, 'bd.requerimientopersonal@gmail.com', '2017-10-22', '2017-11-15', 'Experiencia minima 1 año ', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(573, NULL, NULL, 'LA PAZ', 'Administrador/a de empresas ', NULL, 'Empresa internacional', NULL, 0, 'bd.requerimientopersonal@gmail.com', '2017-10-22', '2017-11-15', 'Experiencia minima de 1 año', 1, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(574, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa de tecnologia', NULL, 0, 'comercial.lpz.017@gmail.com', '2017-10-22', '2017-11-01', 'Experiencia en ventas de equipos electronicos.', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(575, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'Astrix S.A.', NULL, 0, 'rrhh@astrixsa.com', '2017-10-22', '2017-10-26', 'Experiencia en ventas de productos de consumo masivo.\r\nConocimiento del sistema SAP.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(576, NULL, NULL, 'LA PAZ', 'Ingeniero/a en telecomunicaciones  ( Jefe de proyecto )', NULL, 'Empresa de telecomunicaciones ', NULL, 0, 'cvitae.bo@gmail.com', '2017-10-22', '2017-10-31', 'Tener conocimiento en fibra optica, FTTX y CCNA.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INFORMÁTICA Y TELECOMUNICACIONES;INGENIERÍA EN SISTEMAS ELECTRÓNICOS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(577, NULL, NULL, 'LA PAZ', 'Asistente Trade Marketing', NULL, 'Empresa distribuidora ', NULL, 0, 'agasser@imasivos.com', '2017-10-22', '2017-10-31', 'Conocimiento del mercado de LPZ.\r\nManejo de Microsoft Office y Outlook.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(578, NULL, NULL, 'LA PAZ', 'Auxiliar contable', NULL, 'Casa Grande Hotel', NULL, 0, 'rrhh@casa-grande.com.bo', '2017-10-22', '2017-10-31', 'Experiencia minima de 1 año en puestos de similar responsabilidad.\r\nConocimientos solidos de Microsoft Office a nivel usuario y manejo de paquetes contables.', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUXILIAR CONTABLE', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(579, NULL, NULL, 'LA PAZ', 'Recepcionista', NULL, 'Casa Grande Hotel', NULL, 0, 'rrhh@casa-grande.com.bo', '2017-10-22', '2017-10-31', 'Minimo 2 años de experiencia en cargos similares.\r\ningles fluido .\r\nManejo de aplicaciones Microsoft Office', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'HOTELERÍA Y TURISMO;IDIOMA INGLÉS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(580, NULL, NULL, 'LA PAZ', 'Bartender ', NULL, 'Casa Grande Hotel', NULL, 0, 'rrhh@casa-grande.com.bo', '2017-10-22', '2017-10-31', 'Estudios de gastronomia7Cocteleria ', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, NULL, 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(581, NULL, NULL, 'LA PAZ', 'Agente de seguridad ', NULL, 'Casa Grande Hotel', NULL, 0, 'rrhh@casa-grande.com.bo', '2017-10-22', '2017-10-31', 'Titulo bachiller', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(582, NULL, NULL, 'LA PAZ', 'Asistente de direccion y programas', NULL, 'Ipas', NULL, 0, 'ipasbolivia@ipas.org', '2017-10-22', '2017-10-27', 'Manejo de paquetes de computacion ( word, Excel, Power Point).\r\nExperiencia en logistica de eventos nacionales e internacionales incluido voletos aereos.\r\n', 5, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO EJECUTIVO', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(583, NULL, NULL, 'LA PAZ', 'Administrador/a de empresas', NULL, 'Empresa ', NULL, 0, 'recluta.aspirantes@gmail.com', '2017-10-22', '2017-10-31', 'Tener experiencia en :\r\nManejo de personal.\r\nAdministracion de proyectos.\r\nConocimientos contables solidos.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(584, NULL, NULL, 'LA PAZ', 'Administrador/a Regional La Paz', NULL, 'Stolzel', NULL, 0, 'rrhh@stolzel.com.bo', '2017-10-22', '2017-10-25', 'Cursos de contabilidad y&o administracion.\r\nNormas de contabilidad generalmente aceptados para la preparacion de estados financieros.\r\nLey 843 y decretos reglamentarios.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;ADMINISTRACIÓN DE EMPRESAS;CONTADURÍA;FINANZAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(585, NULL, NULL, 'LA PAZ', 'Tecnico en electricidad o electromecanico ', NULL, 'Stolzel', NULL, 0, 'rrhh@stolzel.com.bo', '2017-10-22', '2017-10-25', 'Disponibilidad para viajar.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTRICIDAD;ELECTROMECÁNICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(586, NULL, NULL, 'LA PAZ', 'Vendedor/a Senior ', NULL, 'Stolzel', NULL, 0, 'rrhh@stolzel.com.bo', '2017-10-22', '2017-10-25', 'Especializacion en negocios internacionales/comercio exterior.\r\nConocimiento en mercados internacionales.\r\nManejo en logistica internacional.\r\nIdioma ingles avanzado\r\nDisponibilidad de viajes.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;COMERCIO EXTERIOR;COMERCIO INTERNACIONAL;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(587, NULL, NULL, 'LA PAZ', 'Supervisor/a de Produccion', NULL, 'Empresa de alimentos ', NULL, 0, 'sobretalentohumano@gmail.com', '2017-10-22', '2017-10-26', 'Conocimiento de la  norma FSSC 22000.\r\nConocimientos en salud y seguridad ocupacional.\r\nConocimiento en sistema de gestion de inventarios.\r\nManejo de herramientas de gestion. (tablero de comando integral, indicadores).\r\nManejo de herramientas Ms. Office 365.\r\n', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA DE LA PRODUCCIÓN;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(588, NULL, NULL, 'LA PAZ', 'Ingeniero/a Civil o Arquitecto/a', NULL, 'Constructora Malaga', NULL, 0, 'jvila@c-malaga.com', '2017-10-22', '2017-10-31', 'Para coordinador de ejecucion.\r\nExperiencia en carreteras', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA;INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(589, NULL, NULL, 'LA PAZ', 'Arqueologo/a', NULL, 'Constructora Malaga', NULL, 0, 'jvila@c-malaga.com', '2017-10-22', '2017-10-31', 'Especialista en prospeccion y rescate arqueologico.', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', 'OTROS', NULL, 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(590, NULL, NULL, 'LA PAZ', 'Vendedor/a', NULL, 'Empresa farmaceutica', NULL, 0, 'vendedorfarmaciaselalto@gmail.com', '2017-10-22', '2017-10-27', 'Predisposicion para aprender sobre tecnicas nuevas de ventas y nuevos productos.\r\nConocimiento de MS Office.\r\nDomicilio en la ciudad de El Alto.', 2, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(591, NULL, NULL, 'LA PAZ', 'Auditor/a Interno/a', NULL, 'Empresa financiera', NULL, 0, 'grupofinancierorrhh2017@gmail.com', '2017-10-22', '2017-10-29', 'Conocimiento de normativa ASFI, APS, UIF, BBV, Ley de servicios financieros y de seguros, Codigo de comercio.\r\nManejo de herramientas office (word, excel, power point).\r\n', 7, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;CONTADURÍA PÚBLICA', 'ACTIVE', '1', '2017-10-22 15:00:00', NULL),
(592, NULL, NULL, 'LA PAZ', 'Ayudante de chofer ', NULL, 'Empresa farmaceutica', NULL, 0, 'tthh.ga@gmail.com', '2017-10-22', '2017-10-29', 'Experiencia de 1 año en distribucion y reparto de productos.\r\nContar con licencia de conducir cat. C.\r\nSaber de mecanica automotriz.', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(593, NULL, NULL, 'LA PAZ', 'Ejecutivo/a de ventas', NULL, 'Empresa comercial', NULL, 0, 'gestionderrhh4@gmail.com', '2017-10-22', '2017-10-24', 'Conocimiento en ventas y promocion de productos.\r\nConocimientos de estrategias, atencion y fidelizacion de cliente.\r\nManejo de Microsoft Office/power point/ excel/word.', 3, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;BACHILLER EN HUM;ANIDADES;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(594, NULL, NULL, 'LA PAZ', 'Asistente de produccion', NULL, 'Empresa industrial', NULL, 0, 'reclutamientoempresarial18@gmail.com', '2017-10-22', '2017-10-27', 'Nivel avanzado en aplicaciones Windows Office y similares.\r\nConocimientos en sistemas de gestion de la calidad.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(595, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas', NULL, 'Empresa comercial', NULL, 70562336, 'cmapv@hotmail.com', '2017-10-22', '2017-10-31', 'Facilidad de comunicacion.\r\nDisponibilidad de viajar.', 2, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(596, NULL, NULL, 'LA PAZ', 'Asistente Gerencial/ Secretaria', NULL, 'Importadora', NULL, 75247371, 'elmer.choque.copa@gmail.com', '2017-10-22', '2017-10-31', 'Se solicita personal con experiencia', 1, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'SECRETARIADO EJECUTIVO;SECRETARIADO GENERAL', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(597, NULL, NULL, 'LA PAZ', 'Ejecutivos/as de ventas', NULL, 'Hiper Sabor', NULL, 0, 'ventas.lpz@hipersabor.com', '2017-10-22', '2017-10-27', 'Personas con experiencia en ventas ', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(598, NULL, NULL, 'LA PAZ', 'Distribuidor/a y Cobrador/a', NULL, 'Hiper Sabor', NULL, 0, 'ventas.lpz@hipersabor.com', '2017-10-22', '2017-10-27', 'Personas con experiencia', 1, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(599, NULL, NULL, 'LA PAZ', 'Encargado/a Contable', NULL, 'Empresa', NULL, 0, 'juliocesarvillena@gmail.com', '2017-10-22', '2017-10-26', 'Liderazgo y manejo de personal.\r\nManejo de paquetes Microsoft Office.', 3, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'AUDITORÍA;CONTABILIDAD', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(600, NULL, NULL, 'LA PAZ', 'Mensajero/a - Asistente de limpieza', NULL, 'Empresa de seguros', NULL, 0, 'reqpersonal3@gmail.com', '2017-10-22', '2017-10-27', 'Personas interesadas enviar su CV al correo electronico', 0, 'BACHILLER', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(601, NULL, NULL, 'LA PAZ', 'Visitador/a Medico', NULL, 'Empresa farmaceutica', NULL, 0, 'visitasucelalto@gmail.com', '2017-10-22', '2017-10-27', 'Capacidad de desarrollar relaciones a todo nivel.\r\nDomiciliado en la Ciudad de El Alto.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL;MEDICINA;QUÍMICA FARMACEÚTICA', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(602, NULL, NULL, 'LA PAZ', 'Jefe/a nacional del producto', NULL, 'COFAR', NULL, 0, 'recursoshumanos@cofar.com.bo', '2017-10-22', '2017-10-27', 'Experiencia comercial especifica en el rubro farmaceutico.\r\nconocimientos en excel, power point, Outook.\r\nDisponibilidad de viajes .', 3, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(603, NULL, NULL, 'LA PAZ', 'Asistente de Gerencia ', NULL, 'Empresa Agroindustrial ', NULL, 0, 'contrataciones164@gmail.com', '2017-10-22', '2017-10-31', 'Requisito indispensable, disponibilidad de vivir en el campamento.\r\nManejo de Excel.\r\nLicencia de conducir.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ASISTENCIA GERENCIAL;AUXILIARES EN ADMINISTRACIÓN', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(604, NULL, NULL, 'LA PAZ', 'Jefe de operaciones', NULL, 'Empresa Agroindustrial', NULL, 0, 'contrataciones164@gmail.com', '2017-10-22', '2017-10-31', 'Requisito indispensable, disponibilidad de vivir en el campamento.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA CIVIL;INGENIERÍA INDUSTRIAL;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-10-22 04:00:00', NULL),
(605, NULL, NULL, 'LA PAZ', 'Sub gerente de recursos humanos', NULL, 'Empresa', NULL, 0, 'subgerente2017@gmail.com', '2017-10-23', '2017-10-29', 'Pots grado o especialidad en gestion y desarrollo del talento humano.\r\nAmplio conocimiento de la LGT.\r\nPlanificacion y seguimiento de indicadores de area de RRHH.', 6, 'MAESTRIA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(606, NULL, NULL, 'LA PAZ', 'Trade Regional', NULL, 'Industrias Venado S.A.', NULL, 0, 'rrhh@grupovenado.com', '2017-10-23', '2017-10-26', 'Experiencia en manejo de canales de venta.\r\nExperiencia en planificacion estrategica.\r\nConocimientos del sector industrial.\r\nConocimiento de Microsoft Office.\r\n', 2, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(607, NULL, NULL, 'LA PAZ', 'Ingeniero/a Mecanico o Electromecanico', NULL, 'Emprea constructora ', NULL, 0, 'postulacioningeniero2015@outlook.com', '2017-10-23', '2017-10-27', 'Tener disponibilidad de viajar al interior del pais.\r\nTener conocimientos  en Microsoft Office, Autocad, programas de diseño estructural como ser SAP 2000, CYPE CAD, PRESCOM.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ELECTROMECÁNICA;INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(608, NULL, NULL, 'LA PAZ', 'Asistente de administracion', NULL, 'Eurosigma', NULL, 0, 'ingretec@eurosigma.com.bo', '2017-10-23', '2017-10-26', 'Experiencia en manejo y direccion de personal.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(609, NULL, NULL, 'LA PAZ', 'Administrador/a de tienda', NULL, 'Fair Play', NULL, 0, 'reclutamiento@fairplay.com.bo', '2017-10-23', '2017-10-29', 'Disponibilidad inmediata y a tiempo completo.\r\nPresentacion de una garantia, pudiendo ser: Hipotecaria (inmueble) o deposito en efectivo.', 2, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(610, NULL, NULL, 'LA PAZ', 'Arquitecto/a', NULL, 'Constructora', NULL, 0, 'constructoraviva@gmail.com', '2017-10-23', '2017-10-27', 'Amplio conocimiento en Autocad y elaboracion de planillas.\r\nTener experiencia en proyectos de viviendas sociales.', 0, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'ARQUITECTURA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(611, NULL, NULL, 'LA PAZ', 'Ingenieros/as Junior', NULL, 'ALTIFIBERS', NULL, 0, 'ccalidad.planta2017@gmail.com', '2017-10-23', '2017-10-25', 'Conocimiento en ensayos de materiales textiles en laboratorio de Hilanderia y Tintoreria.\r\nConocimiento de las normas de gestion de calidad.\r\nDisponibilidad para rotar turnos semanales.\r\nManejo de Microsoft Office.', 0, 'TECNICO', NULL, NULL, 'La Razón', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL;INGENIERÍA QUÍMICA;INGENIERO QUÍMICO EN PROCESOS INDUSTRIALES', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(613, NULL, NULL, 'SANTA CRUZ', 'Contador Jr', NULL, 'Empresa industrial', NULL, 0, 'npfreclutamiento@hotmail.com', '2017-10-23', '2017-10-31', 'Tener conocimientos tributarios.\r\nManejo de Office - Excel.\r\nExperiencia en Software contable.\r\nContar con referencias profesionales.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'CONTADURÍA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(614, NULL, NULL, 'SANTA CRUZ', 'Agentes de seguros', NULL, 'Bupa Insurance (Bolivia) S.A. ', NULL, 0, 'pvasquez@bupalatinamerica.com', '2017-10-23', '2017-10-30', 'Credencial de agentes de seguros.\r\nExcelentes relaciones comerciales y personales de alto perfil.\r\nExperiencia en ventas.', 1, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(615, NULL, NULL, 'SANTA CRUZ', 'Coordinador de planta', NULL, 'PRH Bolivia', NULL, 75017461, 'psicologia@prhbolivia.com', '2017-10-23', '2017-10-31', 'Experiencia solida en planificacion, coordinacion y seguimiento de programas de produccion y mantenimiento preventivo y correctivo de maquinas.\r\nExperiencia en elaboracion, ejecucion y seguimiento a presupuestos.', 5, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(616, NULL, NULL, 'SANTA CRUZ', 'Inspector de riesgos', NULL, 'Nacional Seguros', NULL, 0, 'sroca@conecta.com.bo', '2017-10-23', '2017-10-27', 'Post grados en gestion de salud, seguridad industrial y medio ambiente.\r\n Disponibilidad para realizar viajes al interior del pais.\r\n', 5, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(617, NULL, NULL, 'SANTA CRUZ', 'Encargado de instalaciones PVC', NULL, 'Efecto', NULL, 0, 'landivarseleccion@gmail.com', '2017-10-23', '2017-10-26', 'Experiencia en obras de construccion .\r\n', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ARQUITECTURA;INGENIERÍA CIVIL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(618, NULL, NULL, 'SANTA CRUZ', 'Encargado de compras ', NULL, 'Empresa constructora', NULL, 0, 'recepcioncv@cartellone.com.ar', '2017-10-23', '2017-10-26', 'Disponibilidad para viajes y cambio de residencia.\r\nEspecializado en comercio, gestion de ventas.', 10, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(619, NULL, NULL, 'SANTA CRUZ', 'Coordinador/a de gestion del talento', NULL, 'Yanbal', NULL, 0, 'YanbalBolivia.RRHH@yanbal.com', '2017-10-23', '2017-10-29', 'Conocimientos en procesos de administracion de personal, indicadores de gestion, legislacion laboral.\r\nExperiencia en ejecucion de procesos Recursos Humanos tales como Clima Laboral, desempeño, desarrollo, capacitacion, salud ocupacional, seleccion e induccion.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(620, NULL, NULL, 'SANTA CRUZ', 'Gestor de Cobranzas', NULL, 'Empresa Agroindustrial', NULL, 0, 'hragronegocios@gmail.com', '2017-10-23', '2017-10-26', 'Experiencia en procesos de negociacion con clientes.\r\nConocimientos de cobranzas en campo.\r\nLicencia de conducir vigente.\r\nDisponibilidad inmediata.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'AGRONOMÍA;DERECHO', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(621, NULL, NULL, 'SANTA CRUZ', 'Jefe de Ventas', NULL, 'PlaxBurg', NULL, 0, 'contacto@plaxburg.com', '2017-10-23', '2017-10-27', 'Manejo de Office ( word, excel, power point ).\r\nCartas de recomendacion o referencia.', 5, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(622, NULL, NULL, 'SANTA CRUZ', 'Gerente de restaurante', NULL, 'Empresa gastronimica', NULL, 0, 'gruporoessrl@gmail.com', '2017-10-23', '2017-10-31', 'Experiencia en manejo de restaurante.\r\nDisponibilidad de horarios.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;HOTELERÍA Y TURISMO;TECNICO EN GASTRONOMIA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(623, NULL, NULL, 'SANTA CRUZ', 'Encargado de turno', NULL, 'Empresa gastronomica ', NULL, 0, 'gruporoessrl@gmail.com', '2017-10-23', '2017-10-31', 'Experiencia en manejo de restaurantes.\r\nGarantizar la calidad del servicio y la satisfaccion del cliente.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;HOTELERÍA Y TURISMO', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(624, NULL, NULL, 'SANTA CRUZ', 'Administrador de tienda ', NULL, 'Fair Play', NULL, 0, 'reclutamiento@fairplay.com.bo', '2017-10-23', '2017-10-29', 'Disponibilidad inmediata y a tiempo completo.\r\nPresentacion de una garantia,', 2, 'TECNICO', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING;MARKETING Y PUBLICIDAD', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(625, NULL, NULL, 'SANTA CRUZ', 'Jefe o analista de recursos humanos', NULL, 'Empresa comercial', NULL, 0, 'rrhhreclutamiento512@gmail.com', '2017-10-23', '2017-10-31', 'Titulado de carreras universitarias con relacion a RRHH: Psicologia, Administracion, Auditoria.', 1, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN;AUDITORÍA;PSICOLOGÍA', 'ACTIVE', '1', '2017-10-23 11:00:00', '2017-10-23 11:00:00'),
(626, NULL, NULL, 'SANTA CRUZ', 'Vendedor', NULL, 'Empresa', NULL, 0, 'depto.rrhh.scz@gmail.com', '2017-10-23', '2017-10-31', 'Excelencia en atencion al publico.\r\nDisponibilidad de viajes a provincias.', 5, 'BACHILLER', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'BACHILLER EN HUM;ANIDADES', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(627, NULL, NULL, 'SANTA CRUZ', 'Jefe comercial', NULL, 'Emprea de nutricion animal', NULL, 0, 'nutricionvet.rrhh@gmail.com', '2017-10-23', '2017-10-31', 'Capacidad de negociacion.\r\nManejo de tablas dinamicas (excel).', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'INGENIERÍA COMERCIAL;INGENIERÍA INDUSTRIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(628, NULL, NULL, 'SANTA CRUZ', 'Traductor/Interprete', NULL, 'La Fuente', NULL, 0, 'dlimon@grupo-lafuente.com', '2017-10-23', '2017-10-27', 'Dominio del idioma ingles y coreano.\r\nCertificacion del idioma.\r\nExperiencia comprobada.\r\nBuena presencia.\r\nManejo de Microsoft Office.', 0, 'TECNICO', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'IDIOMAS', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(629, NULL, NULL, 'SANTA CRUZ', 'Ejecutivo/a de ventas', NULL, 'Empresa comercial', NULL, 0, 'seleccion2014hgo@gmail.com', '2017-10-23', '2017-10-28', 'Experiencia en area de ventas.\r\nBuen relacionamiento interpersonal y alta capacidad de negociacion.', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL;MARKETING', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(630, NULL, NULL, 'SANTA CRUZ', 'Psicologo organizacional', NULL, 'Corporacion', NULL, 0, 'incorporar.rrhh@gmail.com', '2017-10-23', '2017-10-27', 'Conocimiento en toma de pruebas psicotecnicas.\r\nExperiencia elaboracion de informes psicologicos.\r\nSoporte general al area de RRHH.', 0, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'PSICOLOGÍA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(631, NULL, NULL, 'SANTA CRUZ', 'Auditor interno', NULL, 'La Merced', NULL, 0, 'cvega@lamerced.coop', '2017-10-23', '2017-10-28', 'Experiencia en auditoria en entidades financieras.\r\nConocimiento de la Ley de Servicios Financieros, Normativa ASFI y normas de Auditoria y Contabilidad.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'AUDITORÍA;AUDITORIA FINANCIERA', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(633, NULL, NULL, 'SANTA CRUZ', 'Oficial de credito', NULL, 'La Merced', NULL, 0, 'cvega@lamerced.coop', '2017-10-23', '2017-10-28', 'Conocimiento de la Ley de Servicios financieros y normativa ASFI', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-23 11:00:00', NULL),
(634, NULL, NULL, 'SANTA CRUZ', 'Supervisor de ventas', NULL, 'Distribuidora', NULL, 0, 'recluta.talentohumano10@gmail.com', '2017-10-24', '2017-10-30', 'Experiencia liderando equipos de ventas mínimo 2 años.\r\nManejo de Microsoft Office y dominio de Excel avanzado.', 3, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-24 11:00:00', NULL),
(635, NULL, NULL, 'SANTA CRUZ', 'Asesor Comercial.', NULL, 'Empresa', NULL, 0, 'rrhh.santa@gmail.com', '2017-10-24', '2017-10-26', 'Conocimiento del rubro automotriz.\r\nConocimiento y manejo de vehículos de lujo.\r\nManejo de microsoft office.\r\nConocimiento del idioma ingles.', 4, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-24 11:00:00', NULL),
(636, NULL, NULL, 'SANTA CRUZ', 'Jefe de marketing y publicidad ', NULL, 'Latco universal S.R.L.', NULL, 0, 'rrhh@latcouniversal.com', '2017-10-24', '2017-10-30', 'Experiencia en cargos y/o funciones similares.\r\nCapacidad de análisis y negociación.\r\nDisponibilidad para realizar viajes a nivel nacional.', 1, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'INGENIERÍA MECÁNICA', 'ACTIVE', '1', '2017-10-24 11:00:00', NULL),
(637, NULL, NULL, 'SANTA CRUZ', 'Ejecutivo de ventas', NULL, 'Latco Universal S.R.L.', NULL, 0, 'rrhh@latcouniversal.com', '2017-10-24', '2017-10-31', 'Experiencia en venta de lubricantes en el rubro automotriz.\r\nDisponibilidad para viajar a provincias de Santa Cruz.\r\nLicencia de conducir.', 1, 'TECNICO', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN COMERCIAL;ADMINISTRACIÓN DE EMPRESAS;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-25 11:00:00', NULL),
(638, NULL, NULL, 'SANTA CRUZ', 'Oficial de negocios - PYME', NULL, 'Empresa financiera ', NULL, 0, 'mail.rrhh.operaciones@gmail.com', '2017-10-25', '2017-10-26', 'Conocimiento de Análisis financiero y de riesgo crediticio.\r\nConocimiento en la otorgacion, normalizacion y cobranza de créditos.\r\nConocimientos sobre la normativa ASFI.', 0, 'LICENCIATURA', NULL, NULL, 'El Deber', 1, 'image/jpeg', NULL, 'ADMINISTRACIÓN DE EMPRESAS;AUDITORÍA;ECONOMÍA;INGENIERÍA COMERCIAL', 'ACTIVE', '1', '2017-10-25 11:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_curriculum`
--

DROP TABLE IF EXISTS `job_curriculum`;
CREATE TABLE IF NOT EXISTS `job_curriculum` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSONA` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_PERSONA` (`ID_PERSONA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_formacion_academica`
--

DROP TABLE IF EXISTS `job_formacion_academica`;
CREATE TABLE IF NOT EXISTS `job_formacion_academica` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CURRICULUM` int(11) NOT NULL,
  `ID_TIPO_FORMACION` int(11) NOT NULL,
  `ID_PROFESION` int(11) DEFAULT NULL,
  `ID_INSTITUCION` int(11) NOT NULL,
  `NOMBRE_INSTITUCION` varchar(200) NOT NULL,
  `NOMBRE_ESTUDIOS` varchar(200) NOT NULL,
  `NOMBRE_TITULO` varchar(200) DEFAULT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FIN` date NOT NULL,
  `ESTUDIANTE` tinyint(1) NOT NULL DEFAULT '0',
  `EGRESADO` tinyint(1) NOT NULL DEFAULT '0',
  `TITULADO_ACADEMICO` tinyint(1) NOT NULL DEFAULT '0',
  `TITULADO_CONVALIDADO` tinyint(1) NOT NULL DEFAULT '0',
  `ANIOS_CURSADOS` varchar(20) DEFAULT NULL,
  `DOCUMENTO_EGRESO` varchar(30) DEFAULT NULL,
  `DOCUMENTO_ACADEMICO` varchar(30) DEFAULT NULL,
  `DOCUMENTO_CONVALIDADO` varchar(30) DEFAULT NULL,
  `FECHA_EGRESO` date DEFAULT NULL,
  `FECHA_TITULACION` date DEFAULT NULL,
  `VERIFICACIONES` int(11) NOT NULL DEFAULT '0',
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  KEY `ID_TIPO_ESTUDIO` (`ID_TIPO_FORMACION`),
  KEY `ID_PROFESION` (`ID_PROFESION`),
  KEY `ID_CURRICULUM` (`ID_CURRICULUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_oficio`
--

DROP TABLE IF EXISTS `job_oficio`;
CREATE TABLE IF NOT EXISTS `job_oficio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` text,
  `VERIFICADO` tinyint(1) DEFAULT '0',
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `job_oficio`
--

INSERT INTO `job_oficio` (`ID`, `NOMBRE`, `DESCRIPCION`, `VERIFICADO`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 'Mi Oficio', 'Este oficio', 0, 'ACTIVE', 0, '2016-02-09 03:28:42', '0000-00-00 00:00:00'),
(2, 'El Oficio oficial', 'dfgdfg', 0, 'ACTIVE', 0, '2016-02-09 03:48:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_oficio_curriculum`
--

DROP TABLE IF EXISTS `job_oficio_curriculum`;
CREATE TABLE IF NOT EXISTS `job_oficio_curriculum` (
  `ID_OFICIO` int(11) NOT NULL,
  `ID_CURRICULUM` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_CURRICULUM`,`ID_OFICIO`),
  KEY `ID_OFICIO` (`ID_OFICIO`),
  KEY `ID_CURRICULUM` (`ID_CURRICULUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_profesion`
--

DROP TABLE IF EXISTS `job_profesion`;
CREATE TABLE IF NOT EXISTS `job_profesion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TIPO_FORMACION` int(11) NOT NULL,
  `NOMBRE` varchar(200) NOT NULL,
  `OTROS_NOMBRES` varchar(2000) DEFAULT NULL,
  `DESCRIPCION` text,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  KEY `ID_TIPO_FORMACION` (`ID_TIPO_FORMACION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_tipo_formacion`
--

DROP TABLE IF EXISTS `job_tipo_formacion`;
CREATE TABLE IF NOT EXISTS `job_tipo_formacion` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(30) NOT NULL,
  `NIVEL` varchar(20) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scrap_actividad`
--

DROP TABLE IF EXISTS `scrap_actividad`;
CREATE TABLE IF NOT EXISTS `scrap_actividad` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(20) NOT NULL,
  `CODIGO_PRINCIPAL` varchar(20) DEFAULT NULL,
  `NIVEL` int(11) NOT NULL,
  `NOMBRE` varchar(500) NOT NULL,
  `DESCRIPCION` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scrap_empresa`
--

DROP TABLE IF EXISTS `scrap_empresa`;
CREATE TABLE IF NOT EXISTS `scrap_empresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAGINA` int(11) NOT NULL,
  `ID_ACTIVIDAD` int(11) DEFAULT NULL,
  `ID_TIPO_EMPRESA` int(11) DEFAULT NULL,
  `ID_EMPRESA` varchar(200) NOT NULL,
  `NIT` varchar(30) DEFAULT NULL,
  `NOMBRE` varchar(500) NOT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  `ACTIVIDAD` text,
  `LEIDO` tinyint(1) NOT NULL DEFAULT '0',
  `MATRICULA` varchar(30) DEFAULT NULL,
  `LICENCIA` varchar(30) DEFAULT NULL,
  `MUNICIPIO` varchar(30) DEFAULT NULL,
  `DIRECCION` text,
  `TELEFONO` varchar(50) DEFAULT NULL,
  `FAX` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_ACTIVIDAD` (`ID_ACTIVIDAD`),
  KEY `ID_ACTIVIDAD_2` (`ID_ACTIVIDAD`,`ID_TIPO_EMPRESA`),
  KEY `ID_TIPO_EMPRESA` (`ID_TIPO_EMPRESA`),
  KEY `ID_PAGINA` (`ID_PAGINA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scrap_pagina`
--

DROP TABLE IF EXISTS `scrap_pagina`;
CREATE TABLE IF NOT EXISTS `scrap_pagina` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEPARTAMENTO` varchar(20) NOT NULL,
  `NUMERO` int(11) NOT NULL,
  `LEIDO` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scrap_tipo_empresa`
--

DROP TABLE IF EXISTS `scrap_tipo_empresa`;
CREATE TABLE IF NOT EXISTS `scrap_tipo_empresa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) NOT NULL,
  `DESCRIPCION` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_email`
--

DROP TABLE IF EXISTS `sys_email`;
CREATE TABLE IF NOT EXISTS `sys_email` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(30) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `FROM_EMAIL` varchar(100) NOT NULL,
  `FROM_NAME` varchar(100) NOT NULL,
  `CC` varchar(2000) DEFAULT NULL,
  `BCC` varchar(500) DEFAULT NULL,
  `SUBJECT` varchar(200) NOT NULL,
  `BODY` text NOT NULL,
  `ATTACHMENTS` varchar(2000) DEFAULT NULL,
  `TEMPLATE` varchar(50) DEFAULT NULL,
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_SYS_EMAIL_CODE` (`CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_email`
--

INSERT INTO `sys_email` (`ID`, `CODE`, `NAME`, `DESCRIPTION`, `FROM_EMAIL`, `FROM_NAME`, `CC`, `BCC`, `SUBJECT`, `BODY`, `ATTACHMENTS`, `TEMPLATE`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 'X_EMAIL_ACCOUNT_CREATION', 'Creación de Cuenta de Usuario', 'Email de envío de acceso como nuevo usuario del sistema.', 'soporte@empleos.click', 'El equipo de Empleos.Click', NULL, 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Creación de su Cuenta de Usuario', '<span style="font-family: Arial;">Hola ~NOMBRE~, te informamos que tu cuenta en el sistema fue creada exitosamente.<br><br>Para acceder debes ingresar al siguiente enlace:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="~ACCESS_LINK~"><span style="font-family: Arial;">~ACCESS_LINK~</span></a><br><br>Tienes un password temporal que deberás cambiar al acceder al sistema, este password es: ~PASSWORD~ <br><br>Agradecemos tu confianza y esperamos brindarte una experiencia agradable.<br><br>Saludos<br><span style="font-style: italic;"><br>El equipo de <a href="http://www.empleos.click">Empleos.Click</a><br></span></span>', NULL, 'generic', 0, '2016-03-08 06:19:49', '0000-00-00 00:00:00'),
(2, 'X_EMAIL_PASSWORD_REQUEST', 'Recuperación de Acceso', 'Es el correo de recuperación de accesos al sistema', 'soporte@empleos.click', 'Soporte Empleos.Click', NULL, 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Recuperación de contraseña solicitada', '<span style="font-family: Arial;">Hola ~NOMBRE~, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="~RESET_LINK~"><span style="font-family: Arial;">~RESET_LINK~</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo de <a href="http://www.empleos.click" target="_blank">Empleos.Click</a></span></span><br>', NULL, 'generic', 0, '2016-03-09 00:57:39', '0000-00-00 00:00:00'),
(3, 'X_EMAIL_SUBSCRIPTION', 'Suscripción de Usuario', 'Correo de bienvenida al sistema.\r\n\r\nEquipo ISAXBO', 'soporte@empleos.click', 'El equipo de Empleos.Click', NULL, NULL, 'Bienvenida a Empleos.Click', 'Email de envío de acceso como nuevo usuario del sistema', NULL, 'generic', 0, '2016-04-10 00:19:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_email_sent`
--

DROP TABLE IF EXISTS `sys_email_sent`;
CREATE TABLE IF NOT EXISTS `sys_email_sent` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `SENDER_ID` int(11) NOT NULL DEFAULT '0',
  `HASH_STRING` varchar(500) NOT NULL,
  `FROM_NAME` varchar(100) NOT NULL,
  `FROM_EMAIL` varchar(100) NOT NULL,
  `TO_EMAIL` text NOT NULL,
  `CC` text,
  `BCC` text,
  `SUBJECT` varchar(500) NOT NULL,
  `CONTENT` text NOT NULL,
  `IS_SUCCESS` tinyint(1) NOT NULL,
  `SHIPPING_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OPENING_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `EMAIL_ID` (`EMAIL_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_email_sent`
--

INSERT INTO `sys_email_sent` (`ID`, `EMAIL_ID`, `USER_ID`, `SENDER_ID`, `HASH_STRING`, `FROM_NAME`, `FROM_EMAIL`, `TO_EMAIL`, `CC`, `BCC`, `SUBJECT`, `CONTENT`, `IS_SUCCESS`, `SHIPPING_DATE`, `OPENING_DATE`) VALUES
(1, 2, 1, 1, 'd9M6J6TeSPHHer39L8ZC', 'My Site Info', 'info@mysite.com', 'yecid@mysite.com<YECID>', '<>', 'yecid.pra@gmail.com<>;yecid_pra@hotmail.com<>', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola YECID, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/resetPassword/d9M6J6TeSPHHer39L8ZC"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/resetPassword/d9M6J6TeSPHHer39L8ZC</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/d9M6J6TeSPHHer39L8ZC" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 05:53:13', '2016-04-08 07:19:27'),
(2, 2, 1, 1, 'cocUspciWcSFo3SiTSAy', 'My Site Info', 'info@mysite.com', 'yecid@mysite.com<YECID>', '<>', 'yecid.pra@gmail.com<>;yecid_pra@hotmail.com<>', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola YECID, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/resetPassword/cocUspciWcSFo3SiTSAy"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/resetPassword/cocUspciWcSFo3SiTSAy</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/cocUspciWcSFo3SiTSAy" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 05:54:45', '2016-04-08 03:40:01'),
(3, 2, 3, 1, 'Cxmf6fy2sCzyDcD7RWra', 'My Site Info', 'info@mysite.com', 'miema@site.com<JAVIER>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola JAVIER, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://192.168.43.233/jobs/App/public/main/system/resetPassword/Cxmf6fy2sCzyDcD7RWra"><span style="font-family: Arial;">http://192.168.43.233/jobs/App/public/main/system/resetPassword/Cxmf6fy2sCzyDcD7RWra</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://192.168.43.233/jobs/App/public/main/system/emailTracking/Cxmf6fy2sCzyDcD7RWra" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 06:27:17', '0000-00-00 00:00:00'),
(4, 1, 4, 1, 'gv5oPrLYt8TwqziLruotUPAtC2wPrS', 'System Info', 'info@mysite.com', 'miemail@dominio.com<MATIAS>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Creación de su Nueva Cuenta de Usuario', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Creación de su Nueva Cuenta de Usuario</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola MATIAS, te informamos que tu cuenta en el sistema fue creada exitosamente.<br><br>Para acceder debes ingresar al siguiente enlace:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/access/"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/access/</span></a><br><br>Tienes un password temporal que deberás cambiar al acceder al sistema, este password es: jpJ6VNZx <br><br>Agradecemos tu confianza y esperamos brindarte una experiencia agradable.<br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><span style="font-style: italic;"></span>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/gv5oPrLYt8TwqziLruotUPAtC2wPrS" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-10 01:12:07', '0000-00-00 00:00:00'),
(5, 2, 2, 1, 'z23DcDpcz2nabCF4x55z', 'My Site Info', 'info@mysite.com', 'raul@mysite.com<RAUL>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola RAUL, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/empleos.click/App/public/main/system/resetPassword/z23DcDpcz2nabCF4x55z"><span style="font-family: Arial;">http://localhost/empleos.click/App/public/main/system/resetPassword/z23DcDpcz2nabCF4x55z</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/empleos.click/App/public/main/system/emailTracking/z23DcDpcz2nabCF4x55z" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2017-10-22 16:51:06', NULL),
(6, 2, 2, 1, 'f4yvzE8hPBmP8ZE8LGhv', 'My Site Info', 'info@mysite.com', 'raul@mysite.com<RAUL>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola RAUL, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/empleos.click/App/public/main/system/resetPassword/f4yvzE8hPBmP8ZE8LGhv"><span style="font-family: Arial;">http://localhost/empleos.click/App/public/main/system/resetPassword/f4yvzE8hPBmP8ZE8LGhv</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/empleos.click/App/public/main/system/emailTracking/f4yvzE8hPBmP8ZE8LGhv" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2017-10-22 17:01:02', NULL),
(7, 2, 2, 1, 'C3kLSSyj94NA3oScDEQs', 'My Site Info', 'info@mysite.com', 'raul@mysite.com<RAUL>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola RAUL, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/empleos.click/App/public/main/system/resetPassword/C3kLSSyj94NA3oScDEQs"><span style="font-family: Arial;">http://localhost/empleos.click/App/public/main/system/resetPassword/C3kLSSyj94NA3oScDEQs</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/empleos.click/App/public/main/system/emailTracking/C3kLSSyj94NA3oScDEQs" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2017-10-22 17:01:46', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_entity`
--

DROP TABLE IF EXISTS `sys_entity`;
CREATE TABLE IF NOT EXISTS `sys_entity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_TYPE_ID` int(11) NOT NULL,
  `LOCATION_ID` int(11) DEFAULT NULL,
  `MAIN_BRANCH_ID` int(11) NOT NULL,
  `CODE` varchar(50) NOT NULL,
  `COMERCIAL_NAME` varchar(500) NOT NULL,
  `FORMAL_NAME` varchar(500) NOT NULL,
  `NIT` varchar(50) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `ADDRESS` text NOT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `CELLPHONE` varchar(30) DEFAULT NULL,
  `ACTIVITIES` text,
  `DESCRIPTION` text,
  `LAST_USER_ID` int(11) NOT NULL,
  `CREATION_DATE` datetime NOT NULL,
  `MODIFICACION_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_SYS_ENTITY_NIT` (`NIT`),
  KEY `ENTITY_TYPE_ID` (`ENTITY_TYPE_ID`),
  KEY `LOCATION_ID` (`LOCATION_ID`),
  KEY `IDX_SYS_ENTITY_FORMAL_NAME` (`FORMAL_NAME`(255)),
  KEY `IDX_SYS_ENTITY_COMERCIAL_NAME` (`COMERCIAL_NAME`(255))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_entity`
--

INSERT INTO `sys_entity` (`ID`, `ENTITY_TYPE_ID`, `LOCATION_ID`, `MAIN_BRANCH_ID`, `CODE`, `COMERCIAL_NAME`, `FORMAL_NAME`, `NIT`, `EMAIL`, `ADDRESS`, `PHONE`, `CELLPHONE`, `ACTIVITIES`, `DESCRIPTION`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICACION_DATE`) VALUES
(1, 1, 1, 1, '10102030', 'Libreria Petete', 'PEREZ TEJERINA ASOC.', '10102030', 'peteteescolar@gmail.com', 'Av. de la bandera #37', '24361952', '71956428', 'Comercio de Productos Escolares', 'Venta de Productos', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_entity_branch`
--

DROP TABLE IF EXISTS `sys_entity_branch`;
CREATE TABLE IF NOT EXISTS `sys_entity_branch` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` int(11) NOT NULL,
  `LOCATION_ID` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `NAME` varchar(100) NOT NULL,
  `ADDRESS` varchar(20) NOT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `CELLPHONE` varchar(30) DEFAULT NULL,
  `FAX` varchar(30) DEFAULT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID`),
  KEY `ENTITY_ID` (`ENTITY_ID`),
  KEY `LOCATION_ID` (`LOCATION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_entity_branch`
--

INSERT INTO `sys_entity_branch` (`ID`, `ENTITY_ID`, `LOCATION_ID`, `STATUS`, `NAME`, `ADDRESS`, `PHONE`, `CELLPHONE`, `FAX`, `DESCRIPTION`) VALUES
(1, 1, 1, 'ACTIVE', 'FLAGGERSSS', 'Av. de la bandera #3', '24361952', '71956428', NULL, 'Venta de Productos'),
(2, 1, 1, 'ACTIVE', 'PRINCIPAL', 'Av. siempre viva #37', '24365952', '71956428', NULL, 'Libreria de productos escolares'),
(3, 1, 1, 'ACTIVE', 'CRUCENA', 'Av. Banzer #1329', '3199032', '75172378', '34115578', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_entity_param`
--

DROP TABLE IF EXISTS `sys_entity_param`;
CREATE TABLE IF NOT EXISTS `sys_entity_param` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` int(11) NOT NULL,
  `PARAM_ID` int(11) NOT NULL,
  `VALUE` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(300) DEFAULT NULL,
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_SYS_ENTITY_PARAM` (`ENTITY_ID`,`PARAM_ID`),
  KEY `ENTITY_ID` (`ENTITY_ID`),
  KEY `PARAM_ID` (`PARAM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_entity_param`
--

INSERT INTO `sys_entity_param` (`ID`, `ENTITY_ID`, `PARAM_ID`, `VALUE`, `DESCRIPTION`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 1, 4, 'Saludos Cordiales', '', 0, '2016-03-15 03:54:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_entity_type`
--

DROP TABLE IF EXISTS `sys_entity_type`;
CREATE TABLE IF NOT EXISTS `sys_entity_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_CODE` varchar(50) NOT NULL,
  `CODE` varchar(20) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `uk_sys_entity_type_code` (`CODE`),
  UNIQUE KEY `uk_sys_entity_type_name` (`GROUP_CODE`,`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_entity_type`
--

INSERT INTO `sys_entity_type` (`ID`, `GROUP_CODE`, `CODE`, `NAME`, `DESCRIPTION`) VALUES
(1, 'SMALL_COMPANY', 'E_UNI', 'Empresa Unipersonal', NULL),
(2, 'BUSINESS', 'N_FAM', 'Negocio Familiar', NULL),
(3, 'FORMAL_COMPANY', 'E_SA', 'Sociedad Anónima', NULL),
(4, 'FORMAL_COMPANY', 'E_SRL', 'Sociedad de Responsabilidad Limitada', NULL),
(5, 'PUBLIC_ENTITY', 'P_MIN', 'MInisterio Gubernamental', NULL),
(6, 'PUBLIC_ENTITY', 'P_AGE', 'Agencia Estatal', NULL),
(7, 'NO_BUSINESS', 'X_IND', 'Persona/Familia', NULL),
(8, 'FORMAL_COMPANY', 'E_ACC', 'Sociedad Accidental', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_entity_user`
--

DROP TABLE IF EXISTS `sys_entity_user`;
CREATE TABLE IF NOT EXISTS `sys_entity_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `ROL_ID` int(11) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_ENTITY_USER` (`USER_ID`,`ENTITY_ID`,`ROL_ID`),
  KEY `IDX_ENTITY_USER` (`USER_ID`,`ENTITY_ID`),
  KEY `ENTITY_ID` (`ENTITY_ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `ROL_ID` (`ROL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_image`
--

DROP TABLE IF EXISTS `sys_image`;
CREATE TABLE IF NOT EXISTS `sys_image` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `TITLE` varchar(500) NOT NULL,
  `DESCRIPTION` text,
  `IMG_NAME` varchar(500) NOT NULL,
  `IMG_TYPE` varchar(30) NOT NULL,
  `IMG_SIZE` int(11) NOT NULL,
  `LAST_USER_ID` int(11) NOT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_location`
--

DROP TABLE IF EXISTS `sys_location`;
CREATE TABLE IF NOT EXISTS `sys_location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAIN_ID` int(11) DEFAULT NULL,
  `CODE` varchar(30) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `TYPE` varchar(30) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  `LFT` int(11) DEFAULT NULL,
  `RGT` int(11) DEFAULT NULL,
  `LAST_USER_ID` int(11) NOT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_location`
--

INSERT INTO `sys_location` (`ID`, `MAIN_ID`, `CODE`, `STATUS`, `NAME`, `TYPE`, `LEVEL`, `LFT`, `RGT`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, NULL, 'BO', 'ACTIVE', 'BOLIVIA', 'COUNTRY', 1, 1, 2, 0, '2016-02-11 03:16:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_module`
--

DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE IF NOT EXISTS `sys_module` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(30) NOT NULL,
  `URI` varchar(30) NOT NULL,
  `ACCESS` varchar(20) NOT NULL,
  `POSITION` int(11) NOT NULL,
  `DESCRIPTION` text,
  `ICON_CLASS` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_MODULE_NAME` (`NAME`),
  UNIQUE KEY `NAME` (`NAME`),
  UNIQUE KEY `URI` (`URI`),
  UNIQUE KEY `NAME_2` (`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=8 AVG_ROW_LENGTH=4096 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_module`
--

INSERT INTO `sys_module` (`ID`, `NAME`, `URI`, `ACCESS`, `POSITION`, `DESCRIPTION`, `ICON_CLASS`) VALUES
(1, 'Portal', 'main', 'PROTECTED', 2, 'Portal público', 'icon icon-fa-cho-gunnery'),
(2, 'Administración', 'admin', 'PRIVATE', 3, 'Administración', 'icon icon-fa-cho-organization'),
(3, 'Sistema', 'system', 'PRIVATE', 4, 'Parámetros', 'icon icon-fa-cho-team'),
(4, 'Clientes', 'customers', 'PRIVATE', 7, 'Clientes del Sistema', 'fa fa-ts'),
(5, 'abc', 'abc', 'PRIVATE', 1, 'fdhfdfghf', 'dfhgfdh'),
(6, 'Parámetros', 'parametros', 'PRIVATE', 5, 'Parametros generales', 'clase'),
(7, 'Recursos', 'recursos', 'PRIVATE', 6, 'Recursos de información', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_param`
--

DROP TABLE IF EXISTS `sys_param`;
CREATE TABLE IF NOT EXISTS `sys_param` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VISIBILITY` varchar(30) NOT NULL DEFAULT 'GLOBAL',
  `CODE` varchar(30) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `TYPE` varchar(10) NOT NULL DEFAULT 'STRING',
  `VALUE` varchar(2000) NOT NULL,
  `OPTIONS` varchar(2000) DEFAULT NULL,
  `DESCRIPTION` text NOT NULL,
  `CUSTOMIZABLE` tinyint(1) NOT NULL DEFAULT '0',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CODE` (`CODE`),
  UNIQUE KEY `CODE_2` (`CODE`),
  UNIQUE KEY `NAME` (`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_param`
--

INSERT INTO `sys_param` (`ID`, `VISIBILITY`, `CODE`, `NAME`, `TYPE`, `VALUE`, `OPTIONS`, `DESCRIPTION`, `CUSTOMIZABLE`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 'GLOBAL', 'G_MAX_USER_SESSION_TIME', 'Máximo tiempo de sesión de usuario', 'INTEGER', '30', '', 'Máximo tiempo de sesión de un usuario, tiempo en minutos', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'GLOBAL', 'G_MAX_USER_INCORRECT_LOGIN', 'Máximo número de intentos de login', 'INTEGER', '5', '', 'Máximo número de intentos de login antes de bloquear la cuenta', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'GLOBAL', 'E_MAX_AVAILABLE_USERS', 'Máximo número de usuarios para entidad', 'INTEGER', '5', NULL, 'Es el número máximo de cuentas que pueden administrar la información de una entidad', 0, 0, '2016-03-14 04:53:14', '0000-00-00 00:00:00'),
(4, 'ENTITY', 'E_EMAIL_SALUTATION', 'Salutación de Email', 'STRING', 'Saludos Cordiales', NULL, 'Es la salutación que se pone en la firma de los correos enviados', 1, 0, '2016-03-14 04:54:12', '0000-00-00 00:00:00'),
(5, 'USER', 'U_SESSION_TIME', 'Máximo tiempo de sesión por usuario', 'INTEGER', '15', NULL, 'Máximo tiempo de sesión por usuario.', 1, 0, '2016-03-18 02:37:05', '0000-00-00 00:00:00'),
(6, 'GLOBAL', 'G_EMAIL_MAX_SENDING_TRIES', 'Máximo número de intentos de envío de correos', 'INTEGER', '3', NULL, 'Representa el máximo número de intentos de envío de correos que puede hacer el sistema', 0, 0, '2016-04-07 02:01:36', '0000-00-00 00:00:00'),
(7, 'GLOBAL', 'G_EMAIL_TIME_BETWEEN_SEND', 'Número de segundos entre cada intento de envió de correo', 'INTEGER', '2', NULL, 'Representa el número de segundos entre cada intento de envió de un correo', 0, 0, '2016-04-07 02:11:14', '0000-00-00 00:00:00'),
(8, 'GLOBAL', 'G_EMAIL_TRACKING_URI', 'URI de rastreo de correos electrónicos', 'STRING', 'main/system/emailTracking/', NULL, 'Es la URI donde se rastrea la apertura de correos electrónicos enviados por el sistema', 0, 0, '2016-04-07 02:41:49', '0000-00-00 00:00:00'),
(9, 'GLOBAL', 'G_USER_ACCESS_URI', 'URI de acceso mediante usuario y contraseña al sistema', 'STRING', 'main/system/access/', NULL, 'Es la URI del sistema donde se accede mediante usuario y password.', 0, 0, '2016-04-10 00:59:21', '0000-00-00 00:00:00'),
(10, 'GLOBAL', 'JOB_FUENTES', 'Fuentes de avisos', 'LIST', 'La Razón', 'El Deber;El Diario;Extra;La Razón', 'Fuentes de avisos', 0, 0, '2016-05-26 18:12:02', NULL),
(11, 'GLOBAL', 'P_MAX_TAMANO_AVISO', 'Máximo tamaño de imagen de aviso', 'NUMBER', '600', NULL, 'Es el tamaño máximo de las imagener de Avisos', 0, 0, '2017-02-19 01:43:54', NULL),
(12, 'GLOBAL', 'P_LOCALIZACIONES_AVISO', 'Localizaciones de Avisos', 'LIST', 'La Paz', 'LA PAZ;COCHABAMBA;SANTA CRUZ', 'Localizaciones de Avisos', 0, 0, '2017-02-19 16:11:24', NULL),
(13, 'GLOBAL', 'G_PASSWORD_REQUEST_LIFE', 'Tiempo de Validez de soilicitud de recuperacion de password', 'INTEGER', '21', NULL, 'Es el tiempo máximo de vida en horas del hash de recuperación de password que es enviado por email', 0, 0, '2017-10-22 17:07:41', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_password`
--

DROP TABLE IF EXISTS `sys_password`;
CREATE TABLE IF NOT EXISTS `sys_password` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `PASSWORD_REQUEST_ID` int(11) DEFAULT NULL,
  `VALUE` varchar(500) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `START_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `PASSWORD_REQUEST_ID` (`PASSWORD_REQUEST_ID`),
  KEY `ind_password_start_date` (`START_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_password_request`
--

DROP TABLE IF EXISTS `sys_password_request`;
CREATE TABLE IF NOT EXISTS `sys_password_request` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `HASH_STRING` varchar(500) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  `LIFE_TIME` int(11) NOT NULL,
  `REQUEST_IP` varchar(30) NOT NULL,
  `RESTORED_IP` varchar(30) DEFAULT NULL,
  `ACCEDED_TIMES` int(11) NOT NULL DEFAULT '0',
  `REQUESTED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RESTORED_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_password_request`
--

INSERT INTO `sys_password_request` (`ID`, `USER_ID`, `EMAIL`, `HASH_STRING`, `ACTIVE`, `LIFE_TIME`, `REQUEST_IP`, `RESTORED_IP`, `ACCEDED_TIMES`, `REQUESTED_DATE`, `RESTORED_DATE`) VALUES
(1, 1, 'yecid@mysite.com', 'd9M6J6TeSPHHer39L8ZC', 1, 24, '::1', '', 0, '2016-04-07 05:53:13', NULL),
(2, 1, 'yecid@mysite.com', 'cocUspciWcSFo3SiTSAy', 1, 24, '::1', '', 0, '2016-04-07 05:54:45', NULL),
(3, 3, 'miema@site.com', 'Cxmf6fy2sCzyDcD7RWra', 1, 24, '192.168.43.1', '', 0, '2016-04-07 06:27:17', NULL),
(4, 2, 'raul@mysite.com', 'C3kLSSyj94NA3oScDEQs', 1, 24, '::1', NULL, 0, '2017-10-22 17:01:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_person`
--

DROP TABLE IF EXISTS `sys_person`;
CREATE TABLE IF NOT EXISTS `sys_person` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `LOCATION_ID` int(11) DEFAULT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `MIDDLE_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `SECOND_LAST_NAME` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `ID_NUMBER` varchar(20) DEFAULT NULL,
  `ID_EXTENSION` varchar(10) DEFAULT NULL,
  `GENDER` varchar(10) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `PLACE_OF_BIRTH` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(200) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT NULL,
  `POB` varchar(20) DEFAULT NULL,
  `PHONE_HOME` varchar(30) DEFAULT NULL,
  `PHONE_WORK` varchar(30) DEFAULT NULL,
  `CELLPHONE_1` varchar(30) DEFAULT NULL,
  `CELLPHONE_2` varchar(30) DEFAULT NULL,
  `PHOTO_MIME` varchar(20) DEFAULT NULL,
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_USER_ID` (`USER_ID`),
  UNIQUE KEY `UK_PERSON_EMAIL` (`EMAIL`,`ID_NUMBER`),
  UNIQUE KEY `UK_PERSON_NAMES` (`FIRST_NAME`,`LAST_NAME`,`ID_NUMBER`),
  KEY `IDX_SYS_PERSON_ID_NUMBER` (`ID_NUMBER`),
  KEY `IDX_SYS_PERSON_EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_person`
--

INSERT INTO `sys_person` (`ID`, `USER_ID`, `LOCATION_ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `SECOND_LAST_NAME`, `EMAIL`, `ID_NUMBER`, `ID_EXTENSION`, `GENDER`, `DATE_OF_BIRTH`, `PLACE_OF_BIRTH`, `ADDRESS`, `CITY`, `POB`, `PHONE_HOME`, `PHONE_WORK`, `CELLPHONE_1`, `CELLPHONE_2`, `PHOTO_MIME`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 1, 1, 'YECID', 'PACIFICO', 'RODRIGUEZ', 'ARANDA', 'yecid.pra@system.com', '123456', NULL, 'MALE', NULL, 'LA PAZ', NULL, 'LA PAZ', '1234567', NULL, NULL, NULL, NULL, NULL, 0, '2016-02-11 03:18:38', '0000-00-00 00:00:00'),
(2, 2, 1, 'RAUL', NULL, 'HUANCA', NULL, 'raul@system.com', '1234567', NULL, 'MALE', '1983-02-17', 'TUPIZA', NULL, 'TUPIZA', '1234567', NULL, NULL, NULL, NULL, NULL, 0, '2016-02-11 03:20:32', '0000-00-00 00:00:00'),
(3, 3, NULL, 'JAVIER', 'CALAMARDO', 'RENTERIA', 'PAZ', 'miema@dsd.com', '2122233', NULL, 'MALE', '1991-02-25', 'La Paz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-02-25 08:44:31', '0000-00-00 00:00:00'),
(4, 4, NULL, 'MATIAS', NULL, 'FERNANDEZ', 'LIMA', 'miemail@dominio.com', '5856566', NULL, 'MALE', '1996-01-16', 'La Paz', 'Calle Bueno #815', 'LA PAZ', '543534', '24543346', NULL, '73056581', NULL, NULL, 0, '2016-04-10 01:11:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_rol`
--

DROP TABLE IF EXISTS `sys_rol`;
CREATE TABLE IF NOT EXISTS `sys_rol` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(20) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_CODE` (`CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_rol`
--

INSERT INTO `sys_rol` (`ID`, `CODE`, `NAME`, `DESCRIPTION`) VALUES
(1, 'SUPER', 'Superusuario', 'Superusuario'),
(2, 'ADM', 'Administrador de Sistema', 'Rol de Administrador de Sistema'),
(3, 'USR', 'Usuario', 'Usuario Generico'),
(4, 'ENT_ADM', 'Administrador de Entidad', 'Rol de Usuarios Administrador de Entidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_rol_x_uri`
--

DROP TABLE IF EXISTS `sys_rol_x_uri`;
CREATE TABLE IF NOT EXISTS `sys_rol_x_uri` (
  `ROL_ID` int(11) NOT NULL,
  `URI_ID` int(11) NOT NULL,
  `AUT_READ` tinyint(1) NOT NULL DEFAULT '1',
  `AUT_CREATE` tinyint(1) NOT NULL DEFAULT '0',
  `AUT_UPDATE` tinyint(1) NOT NULL DEFAULT '0',
  `AUT_DELETE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ROL_ID`,`URI_ID`),
  KEY `ROL_ID` (`ROL_ID`),
  KEY `URI_ID` (`URI_ID`)
) ENGINE=InnoDB AVG_ROW_LENGTH=481 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_rol_x_uri`
--

INSERT INTO `sys_rol_x_uri` (`ROL_ID`, `URI_ID`, `AUT_READ`, `AUT_CREATE`, `AUT_UPDATE`, `AUT_DELETE`) VALUES
(1, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 14, 1, 1, 1, 1),
(1, 15, 1, 1, 1, 1),
(1, 22, 1, 1, 1, 1),
(1, 23, 1, 1, 1, 1),
(1, 24, 1, 1, 1, 1),
(1, 25, 1, 1, 1, 1),
(1, 26, 1, 1, 1, 1),
(1, 27, 1, 1, 1, 1),
(1, 28, 1, 1, 1, 1),
(1, 29, 1, 1, 1, 1),
(1, 30, 1, 1, 1, 1),
(2, 27, 1, 1, 1, 1),
(2, 28, 1, 1, 1, 1),
(2, 29, 1, 1, 1, 1),
(2, 30, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_uri`
--

DROP TABLE IF EXISTS `sys_uri`;
CREATE TABLE IF NOT EXISTS `sys_uri` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MODULE_ID` int(11) NOT NULL,
  `URI` varchar(200) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `ACCESS` varchar(20) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `POSITION` int(11) NOT NULL,
  `DESCRIPTION` text,
  `ICON` varchar(30) DEFAULT NULL,
  `MARK` varchar(200) DEFAULT NULL,
  `AFTER_DIVISOR` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_URI` (`URI`,`MODULE_ID`),
  KEY `MODULE_ID` (`MODULE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 AVG_ROW_LENGTH=2340 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_uri`
--

INSERT INTO `sys_uri` (`ID`, `MODULE_ID`, `URI`, `TITLE`, `ACCESS`, `TYPE`, `POSITION`, `DESCRIPTION`, `ICON`, `MARK`, `AFTER_DIVISOR`) VALUES
(1, 1, 'index/', 'Inicio', 'PUBLIC', 'MENU', 1, 'P', NULL, NULL, 1),
(2, 1, 'system/', 'Sistema', 'PROTECTED', 'SECTION', 2, 'Segunda P', NULL, NULL, 2),
(3, 2, 'param/', 'Parámetros', 'PRIVATE', 'MENU', 1, '', NULL, NULL, 1),
(4, 2, 'rol/', 'Roles', 'PRIVATE', 'MENU', 2, '', NULL, NULL, 2),
(5, 2, 'module/', 'Módulos', 'PRIVATE', 'MENU', 3, '', NULL, NULL, 3),
(6, 2, 'uri/', 'URIs', 'PRIVATE', 'SECTION', 4, '', NULL, NULL, 4),
(7, 2, 'user/', 'Usuarios', 'PRIVATE', 'MENU', 5, '', NULL, NULL, 5),
(8, 2, 'user/profile/', 'Perfil', 'PROTECTED', 'SECTION', 6, NULL, NULL, NULL, 6),
(11, 4, 'entityType/', 'Tipos de Entidad', 'PRIVATE', 'MENU', 1, '', NULL, NULL, 0),
(12, 4, 'entity/', 'Entidades', 'PRIVATE', 'MENU', 2, 'Centro de Administraci', NULL, NULL, 0),
(13, 4, 'entityBranch/', 'Sucursales', 'PRIVATE', 'SECTION', 3, '', NULL, NULL, 0),
(14, 4, 'entityUser/', 'Usuarios de Entidad', 'PRIVATE', 'SECTION', 4, 'Administración de usuarios por entidad', NULL, NULL, 0),
(15, 4, 'entityParam/', 'Parámetros de Entidad', 'PRIVATE', 'SECTION', 5, '', NULL, NULL, 0),
(16, 4, 'entityRol/', 'Roles de Entidad', 'PRIVATE', 'SECTION', 6, NULL, NULL, NULL, 0),
(21, 3, 'location/', 'Localizaciones Geográficas', 'PRIVATE', 'MENU', 1, 'Localización Geográfica', NULL, NULL, 1),
(22, 3, 'email/', 'Correos', 'PRIVATE', 'MENU', 2, NULL, NULL, NULL, 0),
(23, 2, 'userParam/', 'Parámetros de Usuario', 'PRIVATE', 'SECTION', 7, NULL, NULL, NULL, 0),
(24, 4, 'aviso/', 'Avisos', 'PRIVATE', 'MENU', 7, 'pagina de administracion de avisos', NULL, NULL, 0),
(25, 6, 'area/', 'Area', 'PRIVATE', 'MENU', 1, 'Areas de empleo', NULL, NULL, 0),
(26, 6, 'areaTecnica/', 'Areas Técnicas', 'PRIVATE', 'MENU', 2, 'Areas técnicas de profesiones', NULL, NULL, 0),
(27, 7, 'paginaDirectorio/', 'Directorio Web Empresas', 'PRIVATE', 'MENU', 1, 'Directorio web de empresas', NULL, NULL, 0),
(28, 7, 'empresaDirectorio/', 'Empresas de Directorio', 'PRIVATE', 'SECTION', 2, 'Empresas registradas en directorio Web', NULL, NULL, 0),
(29, 7, 'actividad', 'Actividades Empresariales', 'PRIVATE', 'SECTION', 3, 'Actividades Empresariales de Directorio: General, Primaria, Específica', NULL, NULL, 0),
(30, 7, 'tipoEmpresa', 'Tipos de Empresa (Directorio)', 'PRIVATE', 'SECTION', 4, 'Clasificacion de Empresas por constitución Societaria', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_user`
--

DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE IF NOT EXISTS `sys_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(80) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(500) NOT NULL,
  `STATUS` varchar(20) NOT NULL DEFAULT 'CREATED',
  `LOCATION` varchar(100) DEFAULT NULL,
  `ADDRESS` text,
  `IMAGE_MIME` varchar(20) DEFAULT NULL,
  `ACTUAL_ACCESS` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LAST_ACCESS` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ACCESS_FAILURES` int(11) NOT NULL DEFAULT '0',
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_SYS_USER_USERNAME` (`USERNAME`),
  UNIQUE KEY `UK_SYS_USER_EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 AVG_ROW_LENGTH=455 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_user`
--

INSERT INTO `sys_user` (`ID`, `EMAIL`, `USERNAME`, `PASSWORD`, `STATUS`, `LOCATION`, `ADDRESS`, `IMAGE_MIME`, `ACTUAL_ACCESS`, `LAST_ACCESS`, `ACCESS_FAILURES`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 'yecid@mysite.com', 'yecid', 'yecid.pra.2017', 'ACTIVE', NULL, NULL, 'image/jpeg', '0000-00-00 00:00:00', '2014-09-09 11:36:33', 0, 0, '2014-08-02 11:36:33', '0000-00-00 00:00:00'),
(2, 'raul@mysite.com', 'raul', 'raul.ehb.2017', 'ACTIVE', 'TUPIZA', NULL, NULL, '0000-00-00 00:00:00', '2014-09-09 11:36:33', 0, 0, '2014-08-02 11:36:33', '0000-00-00 00:00:00'),
(3, 'miema@site.com', 'noasas', 'abc.2016', 'CREATED', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2016-02-25 08:44:31', '0000-00-00 00:00:00'),
(4, 'miemail@dominio.com', 'usuario1', 'abc.2016', 'CREATED', 'LA PAZ', 'Calle Bueno #815', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2016-04-10 01:11:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_user_param`
--

DROP TABLE IF EXISTS `sys_user_param`;
CREATE TABLE IF NOT EXISTS `sys_user_param` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `PARAM_ID` int(11) NOT NULL,
  `VALUE` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(300) DEFAULT NULL,
  `LAST_USER_ID` int(11) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK_SYS_USER_PARAM` (`USER_ID`,`PARAM_ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `PARAM_ID` (`PARAM_ID`)
) ENGINE=InnoDB AVG_ROW_LENGTH=16384 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sys_user_x_rol`
--

DROP TABLE IF EXISTS `sys_user_x_rol`;
CREATE TABLE IF NOT EXISTS `sys_user_x_rol` (
  `USER_ID` int(11) NOT NULL,
  `ROL_ID` int(11) NOT NULL,
  PRIMARY KEY (`USER_ID`,`ROL_ID`),
  KEY `ROL_ID` (`ROL_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AVG_ROW_LENGTH=2730 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sys_user_x_rol`
--

INSERT INTO `sys_user_x_rol` (`USER_ID`, `ROL_ID`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(4, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_area`
--

DROP TABLE IF EXISTS `tmp_area`;
CREATE TABLE IF NOT EXISTS `tmp_area` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `tmp_area`
--

INSERT INTO `tmp_area` (`id`, `nombre`) VALUES
(1, 'ADMINISTRACIÓN DE EMPRESAS'),
(2, 'ADMINISTRACIÓN FINANCIERA'),
(3, 'ADUANAS'),
(4, 'AUDITORÍA GENERAL'),
(5, 'AUDITORÍA INTERNA'),
(6, 'AUTOMOTRIZ'),
(7, 'BIBLIOTECOLOGIA-DOCUMENTACIÓN'),
(8, 'CAPACITACIÓN EMPRESARIAL'),
(9, 'CIENCIAS MATERIALES'),
(10, 'COMERCIALIZACIÓN'),
(11, 'COMERCIO EXTERIOR'),
(12, 'COMPUTACIÓN'),
(13, 'CONTABILIDAD'),
(14, 'DERECHO'),
(15, 'DERECHO INMUEBLE'),
(16, 'DESARROLLO DE SISTEMAS'),
(17, 'ECONOMÍA'),
(18, 'EDUCACIÓN SUPERIOR'),
(19, 'ELECTRICIDAD'),
(20, 'ELECTROMECÁNICA'),
(21, 'EXPLORACIÓN'),
(22, 'EXPLOTACIÓN'),
(23, 'FINANZAS'),
(24, 'FLUIDOS DE PERFORACION'),
(25, 'GESTIÓN DE DOCUMENTOS'),
(26, 'GESTIÓN DE RIESGOS'),
(27, 'HABILIDADES SECRETARIALES'),
(28, 'HIDROCARBUROS'),
(29, 'IDIOMAS'),
(30, 'INDUSTRIALIZACIÓN DE HIDROCARBUROS'),
(31, 'INFORMÁTICA'),
(32, 'INGENIERÍA AGRONÓMICA'),
(33, 'INGENIERÍA AMBIENTAL'),
(34, 'INGENIERÍA FORESTAL'),
(35, 'INGENIERÍA GEOGRÁFICA'),
(36, 'INSTALACIONES DE GAS'),
(37, 'INSTRUMENTACIÓN Y CONTROL'),
(38, 'LEGAL'),
(39, 'LOGÍSTICA'),
(40, 'MANTENIMIENTO INDUSTRIAL'),
(41, 'MARKETING'),
(42, 'MECÁNICA'),
(43, 'MEDICINA'),
(44, 'NORMAS DE CALIDAD'),
(45, 'OBRAS CIVILES'),
(46, 'OTROS'),
(47, 'PEDAGOGÍA'),
(48, 'PENAL O CONSTITUCIONAL'),
(49, 'PERFORACIÓN'),
(50, 'PERFORACION DE POZOS'),
(51, 'PLANIFICACIÓN'),
(52, 'PROCESOS'),
(53, 'PRODUCCIÓN'),
(54, 'PROYECTOS'),
(55, 'RECURSOS HUMANOS'),
(56, 'RELACIONES INTERNACIONALES'),
(57, 'RESERVORIOS'),
(58, 'SALUD OCUPACIONAL'),
(59, 'SEGURIDAD INDUSTRIAL'),
(60, 'SEGURIDAD INFORMÁTICA'),
(61, 'SISTEMAS DE INFORMACION Y GESTION'),
(62, 'SISTEMAS LEY 1178 SAFCO'),
(63, 'TRANSPORTE'),
(64, 'TRIBUTACIÓN E IMPUESTOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_formacion`
--

DROP TABLE IF EXISTS `tmp_formacion`;
CREATE TABLE IF NOT EXISTS `tmp_formacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `tmp_formacion`
--

INSERT INTO `tmp_formacion` (`id`, `nombre`) VALUES
(1, 'ADMINISTRACIÓN'),
(2, 'ADMINISTRACIÓN AGROPECUARIA'),
(3, 'ADMINISTRACIÓN COMERCIAL'),
(4, 'ADMINISTRACIÓN DE EMPRESAS'),
(5, 'ADMINISTRACIÓN DE EMPRESAS PARA PYMES'),
(6, 'ADMINISTRACIÓN DE RECURSOS HUMANOS'),
(7, 'ADMINISTRACIÓN FINANCIERA'),
(8, 'ADMINISTRACIÓN GENERAL'),
(9, 'ADMINISTRACIÓN INDUSTRIAL COMERCIAL'),
(10, 'ADMINISTRACIÓN PETROLERA'),
(11, 'ADMINISTRACIÓN TURÍSTICA HOTELERA'),
(12, 'ADMINISTRACIÓN VENTAS'),
(13, 'ADMINISTRACIÓN Y ORGANIZACIÓN INDUSTRIAL'),
(14, 'ADMINISTRADOR FINANCIERO'),
(15, 'ADUANAS Y COMERCIO INTERNACIONAL'),
(16, 'AGRONOMÍA'),
(17, 'AGROPECUARIA'),
(18, 'ANÁLISIS DE SISTEMAS'),
(19, 'ANÁLISIS DE SISTEMAS INFORMÁTICOS'),
(20, 'ANÁLISIS Y PROGRAMACIÓN DE COMPUTADORAS'),
(21, 'ANALISTA DE SISTEMAS'),
(22, 'ANALISTA DE SISTEMAS INFORMÁTICOS'),
(23, 'ANALISTA Y PROGRAMACIÓN DE SISTEMAS'),
(24, 'ANTROPOLOGÍA'),
(25, 'ARCHIVOLOGIA - DOCUMENTACIÓN'),
(26, 'ARCHIVOS'),
(27, 'ARQUITECTURA'),
(28, 'ARTES PLÁSTICAS'),
(29, 'ASISTENCIA GERENCIAL'),
(30, 'ASISTENTE PROCURADOR GENERAL'),
(31, 'AUDITORÍA'),
(32, 'AUDITORIA FINANCIERA'),
(33, 'AUTOMATIZACIÓN INDUSTRIAL'),
(34, 'AUTOMOTRIZ'),
(35, 'AUXILIAR CONTABLE'),
(36, 'AUXILIAR DE CONTABILIDAD Y COMPUTACIÓN'),
(37, 'AUXILIAR EN CONTABILIDAD'),
(38, 'AUXILIAR EN ENFERMERÍA'),
(39, 'AUXILIAR SECRETARIADO'),
(40, 'AUXILIARES EN ADMINISTRACIÓN'),
(41, 'AYMARA'),
(42, 'BACHILLER EN HUM;ANIDADES'),
(43, 'BIBLIOTECOLOGIA - DOCUMENTACIÓN'),
(44, 'BIBLIOTECOLOGÍA - DOCUMENTACIÓN'),
(45, 'BIBLIOTECOLOGÍA Y CIENCIAS DE LA INFORMACIÓN'),
(46, 'BIOLOGÍA'),
(47, 'BIOMÉDICO'),
(48, 'BIOQUÍMICA'),
(49, 'CARPINTERIA'),
(50, 'CARPINTERÍA'),
(51, 'CARPINTERÍA INDUSTRIAL'),
(52, 'CIENCIAS ADMINISTRATIVAS'),
(53, 'CIENCIAS CONTABLES'),
(54, 'CIENCIAS DE LA COMUNICACÓN'),
(55, 'CIENCIAS DE LA EDUCACIÓN'),
(56, 'CIENCIAS JURÍDICAS'),
(57, 'CIENCIAS POLÍTICAS'),
(58, 'COMERCIO EXTERIOR'),
(59, 'COMERCIO EXTERIOR, POLÍTICA Y ADMINISTRACIÓN ADUANERA'),
(60, 'COMERCIO INTERNACIONAL'),
(61, 'COMUNICACIÓN'),
(62, 'COMUNICACIÓN SOCIAL'),
(63, 'CONSTRUCCIÓN'),
(64, 'CONSTRUCCIÓN CIVIL'),
(65, 'CONSTRUCCIONES'),
(66, 'CONSTRUCCIONES CIVILES'),
(67, 'CONTABILIDAD'),
(68, 'CONTABILIDAD COMERCIAL'),
(69, 'CONTABILIDAD COMPUTARIZADA'),
(70, 'CONTABILIDAD GENERAL'),
(71, 'CONTADURÍA'),
(72, 'CONTADURÍA COMPUTARIZADA'),
(73, 'CONTADURÍA GENERAL'),
(74, 'CONTADURÍA PÚBLICA'),
(75, 'CORROSIÓN'),
(76, 'CURSOS INTEGRADOS DE APLICACIÓN ADMINISTRATIVA'),
(77, 'DACTILOGRAFÍA'),
(78, 'DERECHO'),
(79, 'DIBUJO ARQUITECTÓNICO'),
(80, 'DISEÑO CIVIL'),
(81, 'DISEÑO DE INTERIORES'),
(82, 'DISEÑO GRÁFICO'),
(83, 'DISEÑO, DESARROLLO Y PRODUCCIÓN DIGITAL DE MEDIOS AUDIOVISUALES Y WEB'),
(84, 'ECONOMÍA'),
(85, 'EDUCACIÓN MUSICAL'),
(86, 'ELECTRICIDAD'),
(87, 'ELECTRICIDAD INDUSTRIAL'),
(88, 'ELECTRICISTA'),
(89, 'ELECTROMECÁNICA'),
(90, 'ELECTROMECÁNICA INDUSTRIAL'),
(91, 'ELECTRONICA'),
(92, 'ELECTRÓNICA'),
(93, 'ELECTRÓNICA DIGITAL'),
(94, 'ELECTRÓNICA ELECTRICIDAD'),
(95, 'ELECTRÓNICA Y AUTOMATIZACIÓN INDUSTRIAL'),
(96, 'ELECTRÓNICA Y ELECTROTECNIA'),
(97, 'ELECTRONICA Y TELECOMUNICACIONES'),
(98, 'ELECTRÓNICA Y TELECOMUNICACIONES'),
(99, 'EN PROYECTOS DE GAS DOMICILIARIO'),
(100, 'ENFERMERÍA'),
(101, 'ESPAÑOL'),
(102, 'ESTADÍSTICA'),
(103, 'FARMACIA Y BIOQUÍMICA'),
(104, 'FILOSOFÍA'),
(105, 'FINANZAS'),
(106, 'FÍSICA'),
(107, 'FISIOTERAPIA'),
(108, 'FRANCÉS'),
(109, 'GAS Y PETRÓLEO'),
(110, 'GAS Y PETROQUÍMICA'),
(111, 'GEOFÍSICA'),
(112, 'GEOLOGÍA'),
(113, 'GESTIÓN AMBIENTAL'),
(114, 'GESTIÓN DE PETROLÉO Y GAS'),
(115, 'GESTIÓN MUNICIPAL'),
(116, 'GESTIÓN PETROLERA'),
(117, 'GESTIÓN SOCIAL DEL DESARROLLO LOCAL'),
(118, 'HARDWARE'),
(119, 'HARDWARE ELECTRÓNICA'),
(120, 'HIDROCARBUROS'),
(121, 'HISTORIA'),
(122, 'HOTELERÍA Y TURISMO'),
(123, 'IDIOMA INGLÉS'),
(124, 'IDIOMAS'),
(125, 'INDUSTRIA DEL GAS Y PETROLÉO'),
(126, 'INFORMACIÓN Y CONTROL DE GESTIÓN'),
(127, 'INFORMÁTICA'),
(128, 'INFORMÁTICA INDUSTRIAL'),
(129, 'INFORMÁTICA Y TELECOMUNICACIONES'),
(130, 'INFRAESTRUCTURA TECNOLÓGICA'),
(131, 'INGENIERÍA AGRÍCOLA'),
(132, 'INGENIERÍA AGROINDUSTRIAL'),
(133, 'INGENIERIA AGRONOMICA'),
(134, 'INGENIERÍA AGRONÓMICA'),
(135, 'INGENIERÍA AGROPECUARÍA'),
(136, 'INGENIERÍA AMBIENTAL'),
(137, 'INGENIERÍA AUTOMOTRIZ'),
(138, 'INGENIERÍA CIVIL'),
(139, 'INGENIERÍA COMERCIAL'),
(140, 'INGENIERÍA DE CONSTRUCCIONES'),
(141, 'INGENIERÍA DE CONTROL DE PROCESOS'),
(142, 'INGENIERÍA DE ESTRUCTURAS'),
(143, 'INGENIERÍA DE GAS'),
(144, 'INGENIERÍA DE GAS Y PETRÓLEO'),
(145, 'INGENIERÍA DE LA PRODUCCIÓN'),
(146, 'INGENIERÍA DE PERFORACIÓN'),
(147, 'INGENIERÍA DE PETROLEO GAS Y PROCESOS'),
(148, 'INGENIERÍA DE PROCESOS'),
(149, 'INGENIERÍA DE PROCESOS INDUSTRIALES'),
(150, 'INGENIERÍA DE PRODUCCIÓN'),
(151, 'INGENIERÍA DE RECURSOS NATURALES'),
(152, 'INGENIERÍA DE SISTEMAS'),
(153, 'INGENIERÍA DE SOFTWARE'),
(154, 'INGENIERÍA DEL GAS Y PETROQUÍMICA'),
(155, 'INGENIERÍA DEL PETROLEO Y GAS NATURAL'),
(156, 'INGENIERÍA DEL PETRÓLEO Y GAS NATURAL'),
(157, 'INGENIERÍA DEL PETRÓLEO, GAS Y ENERGIA'),
(158, 'INGENIERÍA ECONÓMICA'),
(159, 'INGENIERÍA ELÉCTRICA'),
(160, 'INGENIERÍA ELECTROMECÁNICA'),
(161, 'INGENIERÍA ELECTRÓNICA'),
(162, 'INGENIERÍA EN ECOLOGÍA Y MEDIO AMBIENTE'),
(163, 'INGENIERÍA EN GAS Y PETROLEO'),
(164, 'INGENIERÍA EN GEODESIA Y TOPOGRAFIA'),
(165, 'INGENIERÍA EN GESTIÓN PETROLERA'),
(166, 'INGENIERÍA EN INSTRUMENTACIÓN'),
(167, 'INGENIERÍA EN MANTENIMIENTO MECÁNICO'),
(168, 'INGENIERÍA EN MECÁNICA AUTOMOTRIZ'),
(169, 'INGENIERÍA EN PETRÓLEO Y GAS'),
(170, 'INGENIERÍA EN PETRÓLEO Y GAS NATURAL'),
(171, 'INGENIERÍA EN RECURSOS NATURALES'),
(172, 'INGENIERÍA EN SISTEMAS ELECTRÓNICOS'),
(173, 'INGENIERÍA FINANCIERA'),
(174, 'INGENIERÍA FORESTAL'),
(175, 'INGENIERÍA GAS Y PETROQUÍMICA'),
(176, 'INGENIERÍA GEOFÍSICA'),
(177, 'INGENIERÍA GEOGRÁFICA'),
(178, 'INGENIERÍA GEOLÓGICA'),
(179, 'INGENIERÍA HIDRÁULICA'),
(180, 'INGENIERÍA HIDROLÓGICA'),
(181, 'INGENIERÍA INDUSTRIAL'),
(182, 'INGENIERÍA INFORMÁTICA'),
(183, 'INGENIERÍA INFORMÁTICA ELECTRÓNICA'),
(184, 'INGENIERÍA MECÁNICA'),
(185, 'INGENIERÍA METALÚRGICA'),
(186, 'INGENIERÍA PETROLERA'),
(187, 'INGENIERÍA PETROQUÍMICA'),
(188, 'INGENIERÍA QUÍMICA'),
(189, 'INGENIERO QUÍMICO EN PROCESOS INDUSTRIALES'),
(190, 'INGLES'),
(191, 'INGLÉS'),
(192, 'INSTALACIONES DE REDES DOMICILIARIAS DE GAS NATURAL'),
(193, 'INSTALACIONES ELECTRÓNICAS'),
(194, 'INSTALACIONES INTEGRALES DE GAS'),
(195, 'INSTALADOR A DOMICILIO DE GAS NATURAL'),
(196, 'INSTALADOR DE GAS NATURAL'),
(197, 'LABORATORIO CLÍNICO'),
(198, 'LICENCIATURA EN NEGOCIOS INTERNACIONALES'),
(199, 'LICENCIATURA EN PETROLEOS'),
(200, 'LINGÜÍSTICA E IDIOMAS'),
(201, 'LINGUÍSTICA Y CASTELLANO'),
(202, 'LINGÜÍSTICA Y LENGUAS EXTRANJERAS'),
(203, 'LITERATURA'),
(204, 'LOGÍSTICA'),
(205, 'MANEJO DE PAQUETES'),
(206, 'MANTENIMIENTO DE HARDWARE'),
(207, 'MANTENIMIENTO INDUSTRIAL'),
(208, 'MÁQUINAS HERRAMIENTAS'),
(209, 'MARKETING'),
(210, 'MARKETING Y LOGÍSTICA'),
(211, 'MARKETING Y PUBLICIDAD'),
(212, 'MATEMÁTICAS'),
(213, 'MECÁNICA'),
(214, 'MECÁNICA AUTOMOTRIZ'),
(215, 'MECÁNICA DE AUTOMOTORES'),
(216, 'MECÁNICA DE AVIACIÓN'),
(217, 'MECÁNICA GENERAL'),
(218, 'MECÁNICA INDUSTRIAL'),
(219, 'MEDICINA'),
(220, 'MEDIO AMBIENTE'),
(221, 'MERCADOTECNIA'),
(222, 'METAL MECÁNICA'),
(223, 'METALURGIA Y FUNDICIÓN'),
(224, 'MONTAJE Y MANTENIMIENTO DE EQUIPO INDUSTRIAL'),
(225, 'MOTORES A GASOLINA'),
(226, 'NUTRICIÓN Y DIETÉTICA'),
(227, 'ODONTOLOGÍA'),
(228, 'OPERADOR DE APLICACIONES'),
(229, 'OPERADOR DE APLICACIONES INFORMÁTICAS'),
(230, 'OPERADOR DE PAQUETES'),
(231, 'OPERADOR DE PAQUETES COMERCIALES'),
(232, 'OPERADOR EN COMPUTADORAS'),
(233, 'OPERADORES DE COMERCIO EXTERIOR'),
(234, 'PAQUETES CONTABLES'),
(235, 'PEDAGOGIA'),
(236, 'PETROLEOS'),
(237, 'PLOMERIA'),
(238, 'PORTUGUÉS'),
(239, 'PROCESOS DE REFINACIÓN DE PETROLEO'),
(240, 'PROCESOS DE REFINACIÓN DEL PRETRÓLEO'),
(241, 'PROCURADOR LEGAL'),
(242, 'PROCURADURÍA LEGAL'),
(243, 'PRODUCCIÓN INDUSTRIAL'),
(244, 'PROGRAMACIÓN COMERCIAL'),
(245, 'PROGRAMACIÓN Y APLICACIONES'),
(246, 'PROGRAMADOR'),
(247, 'PROGRAMADOR DE COMPUTADORAS'),
(248, 'PROGRAMADOR DE SISTEMAS'),
(249, 'PROGRAMADOR DE SOFTWARE DE OPERACIONES'),
(250, 'PROGRAMADOR EN SOFTWARE'),
(251, 'PROGRAMADOR EN SOFTWARE DE APLICACIONES'),
(252, 'PROGRAMADOR EN SOFTWARE DE APLICACIONES ATSYH'),
(253, 'PROTECCIÓN CATÓDICA'),
(254, 'PROYEC. Y ECO. DE EMPRES.'),
(255, 'PSICOLOGÍA'),
(256, 'PUBLICIDAD'),
(257, 'QUECHUA'),
(258, 'QUÍMICA'),
(259, 'QUÍMICA FARMACEÚTICA'),
(260, 'QUÍMICA INDUSTRIAL'),
(261, 'QUÍMICA Y PROCESOS'),
(262, 'RADIOLOGÍA'),
(263, 'RECURSOS HUMANOS'),
(264, 'REDES Y GAS'),
(265, 'REDES Y SISTEMAS DE COMUNICACIÓN'),
(266, 'RELACIONES INTERNACIONALES'),
(267, 'RELACIONES PÚBLICAS'),
(268, 'REPARACIÓN Y MANTENIMIENTO DE COMPUTADORAS'),
(269, 'SANEAMIENTO AMBIENTAL'),
(270, 'SECRETARIADO ADMINISTRATIVO'),
(271, 'SECRETARIADO COMERCIAL'),
(272, 'SECRETARIADO COMPUTACIONAL'),
(273, 'SECRETARIADO EJECUTIVO'),
(274, 'SECRETARIADO EJECUTIVO BILINGUE'),
(275, 'SECRETARIADO GENERAL'),
(276, 'SISTEMA DE REGULACIÓN Y CONTROL AUTOMÁTICOS'),
(277, 'SISTEMA DE TELECOMUNICACIONES'),
(278, 'SISTEMA INFORMÁTICO'),
(279, 'SISTEMAS DE REGULACIÓN Y CONTROL'),
(280, 'SISTEMAS INFORMÁTICOS'),
(281, 'SOCIOLOGÍA'),
(282, 'SOFTWARE LIBRE'),
(283, 'SOLDADURA'),
(284, 'SOLDADURA E INSTALACIONES DE GAS'),
(285, 'SOLDADURÍA'),
(286, 'SONIDO'),
(287, 'SOPORTE TÉCNICO'),
(288, 'TÉCNICAS EN APLICACIÓN'),
(289, 'TÉCNICO'),
(290, 'TÉCNICO BANCARIO'),
(291, 'TÉCNICO COMERCIAL'),
(292, 'TÉCNICO CONTABLE'),
(293, 'TÉCNICO DE FINANZAS'),
(294, 'TÉCNICO DE PROYECTOS II'),
(295, 'TÉCNICO EN APLICACIONES'),
(296, 'TÉCNICO EN GESTIÓN Y ADMINISTRACIÓN DE PEQUEÑA Y MEDIANA EMPRESA'),
(297, 'TÉCNICO EN HARDWARE'),
(298, 'TÉCNICO EN HARDWARE Y ELECTRÓNICA DIGITAL'),
(299, 'TÉCNICO EN SEGUROS'),
(300, 'TÉCNICO EN TELECOMUNICACIONES'),
(301, 'TÉCNICO EN VENTAS'),
(302, 'TECNOLOGÍAS AUDIOVISUALES'),
(303, 'TECNOLOGÍAS DE LA INFORMACIÓN APLICACIONES EN INFORMÁTICA Y SISTEMAS'),
(304, 'TECNOLOGÍAS DE LA INFORMACIÓN APLICACIONES EN INFORMATICE Y SISTEMAS'),
(305, 'TELECOMUNICACIONES'),
(306, 'TOPOGRAFÍA'),
(307, 'TOPOGRAFÍA Y GEODESIA'),
(308, 'TRABAJO SOCIAL'),
(309, 'TRABAJOS FORESTALES'),
(310, 'TURISMO'),
(311, 'OPERADOR DE MAQUINARIA PESADA'),
(312, 'TECNICO EN GASTRONOMIA'),
(313, 'ESTILISMO / COSMETOLOGIA'),
(314, 'CINEMATOGRAFIA');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tmp_intereses`
--
DROP VIEW IF EXISTS `tmp_intereses`;
CREATE TABLE IF NOT EXISTS `tmp_intereses` (
`id` int(11)
,`nombres` varchar(50)
,`primer_apellido` varchar(30)
,`segundo_apellido` varchar(30)
,`email` varchar(200)
,`areas` varchar(2000)
,`formaciones` varchar(2000)
,`avisos` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_mailing`
--

DROP TABLE IF EXISTS `tmp_mailing`;
CREATE TABLE IF NOT EXISTS `tmp_mailing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prospecto` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `avisos` varchar(500) NOT NULL,
  `fecha_interes` date NOT NULL,
  `fecha_hora_envio` datetime DEFAULT NULL,
  `enviado` tinyint(1) DEFAULT NULL,
  `abierto` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34585 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_prospecto`
--

DROP TABLE IF EXISTS `tmp_prospecto`;
CREATE TABLE IF NOT EXISTS `tmp_prospecto` (
  `id` int(11) NOT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ci` varchar(20) NOT NULL,
  `extension_ci` varchar(3) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `residencia` varchar(50) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `salario` int(11) NOT NULL,
  `areas` varchar(2000) NOT NULL,
  `formaciones` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura para la vista `tmp_intereses`
--
DROP TABLE IF EXISTS `tmp_intereses`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tmp_intereses`  AS  select `p`.`id` AS `id`,`p`.`nombres` AS `nombres`,`p`.`primer_apellido` AS `primer_apellido`,`p`.`segundo_apellido` AS `segundo_apellido`,`p`.`email` AS `email`,`p`.`areas` AS `areas`,`p`.`formaciones` AS `formaciones`,`busca_avisos`(`p`.`areas`,`p`.`formaciones`) AS `avisos` from `tmp_prospecto` `p` order by `p`.`id` ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `job_area_relacionada`
--
ALTER TABLE `job_area_relacionada`
  ADD CONSTRAINT `FK_AREA_RELACIONADA_1` FOREIGN KEY (`ID_AREA_1`) REFERENCES `job_area_tecnica` (`ID`),
  ADD CONSTRAINT `FK_AREA_RELACIONADA_2` FOREIGN KEY (`ID_AREA_2`) REFERENCES `job_area_tecnica` (`ID`);

--
-- Filtros para la tabla `job_area_tecnica_profesion`
--
ALTER TABLE `job_area_tecnica_profesion`
  ADD CONSTRAINT `FK_AREA_TEC_PRO_AREA_TEC` FOREIGN KEY (`ID_AREA_TECNICA`) REFERENCES `job_area_tecnica` (`ID`),
  ADD CONSTRAINT `FK_AREA_TEC_PRO_PROFESION` FOREIGN KEY (`ID_PROFESION`) REFERENCES `job_profesion` (`ID`);

--
-- Filtros para la tabla `job_aviso`
--
ALTER TABLE `job_aviso`
  ADD CONSTRAINT `job_aviso_fk1` FOREIGN KEY (`AREA_TECNICA_ID`) REFERENCES `job_area_tecnica` (`ID`),
  ADD CONSTRAINT `job_aviso_fk2` FOREIGN KEY (`AREA_ID`) REFERENCES `job_area` (`ID`);

--
-- Filtros para la tabla `job_curriculum`
--
ALTER TABLE `job_curriculum`
  ADD CONSTRAINT `job_curriculum_fk1` FOREIGN KEY (`ID_PERSONA`) REFERENCES `sys_person` (`ID`);

--
-- Filtros para la tabla `job_formacion_academica`
--
ALTER TABLE `job_formacion_academica`
  ADD CONSTRAINT `job_formacion_academica_fk1` FOREIGN KEY (`ID_TIPO_FORMACION`) REFERENCES `job_tipo_formacion` (`ID`),
  ADD CONSTRAINT `job_formacion_academica_fk2` FOREIGN KEY (`ID_PROFESION`) REFERENCES `job_profesion` (`ID`),
  ADD CONSTRAINT `job_formacion_academica_fk3` FOREIGN KEY (`ID_CURRICULUM`) REFERENCES `job_curriculum` (`ID`);

--
-- Filtros para la tabla `job_oficio_curriculum`
--
ALTER TABLE `job_oficio_curriculum`
  ADD CONSTRAINT `FK_OFICIO_CURRICULUM_CURRICULUM` FOREIGN KEY (`ID_CURRICULUM`) REFERENCES `job_curriculum` (`ID`),
  ADD CONSTRAINT `FK_OFICIO_CURRICULUM_OFICIO` FOREIGN KEY (`ID_OFICIO`) REFERENCES `job_oficio` (`ID`);

--
-- Filtros para la tabla `job_profesion`
--
ALTER TABLE `job_profesion`
  ADD CONSTRAINT `job_profesion_fk1` FOREIGN KEY (`ID_TIPO_FORMACION`) REFERENCES `job_tipo_formacion` (`ID`);

--
-- Filtros para la tabla `scrap_empresa`
--
ALTER TABLE `scrap_empresa`
  ADD CONSTRAINT `fk_scarp_empresa_actividad` FOREIGN KEY (`ID_ACTIVIDAD`) REFERENCES `scrap_actividad` (`ID`),
  ADD CONSTRAINT `fk_scarp_empresa_tipo_empresa` FOREIGN KEY (`ID_TIPO_EMPRESA`) REFERENCES `scrap_tipo_empresa` (`ID`),
  ADD CONSTRAINT `scarp_empresa_fk1` FOREIGN KEY (`ID_PAGINA`) REFERENCES `scrap_pagina` (`ID`);

--
-- Filtros para la tabla `sys_email_sent`
--
ALTER TABLE `sys_email_sent`
  ADD CONSTRAINT `fk_sys_email_sent_email` FOREIGN KEY (`EMAIL_ID`) REFERENCES `sys_email` (`ID`),
  ADD CONSTRAINT `fk_sys_email_sent_user` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_entity`
--
ALTER TABLE `sys_entity`
  ADD CONSTRAINT `fk_entity_entity_type` FOREIGN KEY (`ENTITY_TYPE_ID`) REFERENCES `sys_entity_type` (`ID`),
  ADD CONSTRAINT `fk_entity_location` FOREIGN KEY (`LOCATION_ID`) REFERENCES `sys_location` (`ID`);

--
-- Filtros para la tabla `sys_entity_branch`
--
ALTER TABLE `sys_entity_branch`
  ADD CONSTRAINT `fk_sys_entity_branch_entity` FOREIGN KEY (`ENTITY_ID`) REFERENCES `sys_entity` (`ID`),
  ADD CONSTRAINT `fk_sys_entity_branch_location` FOREIGN KEY (`LOCATION_ID`) REFERENCES `sys_location` (`ID`);

--
-- Filtros para la tabla `sys_entity_param`
--
ALTER TABLE `sys_entity_param`
  ADD CONSTRAINT `FK_ENTITY_PARAM_ENTITY` FOREIGN KEY (`ENTITY_ID`) REFERENCES `sys_entity` (`ID`),
  ADD CONSTRAINT `FK_ENTITY_PARAM_PARAM` FOREIGN KEY (`PARAM_ID`) REFERENCES `sys_param` (`ID`);

--
-- Filtros para la tabla `sys_entity_user`
--
ALTER TABLE `sys_entity_user`
  ADD CONSTRAINT `FK_SYS_ENTITY_USER_ENTITY` FOREIGN KEY (`ENTITY_ID`) REFERENCES `sys_entity` (`ID`),
  ADD CONSTRAINT `FK_SYS_ENTITY_USER_ROL` FOREIGN KEY (`ROL_ID`) REFERENCES `sys_rol` (`ID`),
  ADD CONSTRAINT `FK_SYS_ENTITY_USER_USER` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_image`
--
ALTER TABLE `sys_image`
  ADD CONSTRAINT `fk_sys_image_user` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_password`
--
ALTER TABLE `sys_password`
  ADD CONSTRAINT `sys_password_fk1` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`),
  ADD CONSTRAINT `sys_password_fk2` FOREIGN KEY (`PASSWORD_REQUEST_ID`) REFERENCES `sys_password_request` (`ID`);

--
-- Filtros para la tabla `sys_password_request`
--
ALTER TABLE `sys_password_request`
  ADD CONSTRAINT `fk_sys_password_request_user` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_person`
--
ALTER TABLE `sys_person`
  ADD CONSTRAINT `sys_person_fk1` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_rol_x_uri`
--
ALTER TABLE `sys_rol_x_uri`
  ADD CONSTRAINT `sys_rol_x_uri_fk1` FOREIGN KEY (`ROL_ID`) REFERENCES `sys_rol` (`ID`),
  ADD CONSTRAINT `sys_rol_x_uri_fk2` FOREIGN KEY (`URI_ID`) REFERENCES `sys_uri` (`ID`);

--
-- Filtros para la tabla `sys_uri`
--
ALTER TABLE `sys_uri`
  ADD CONSTRAINT `FK_URI_MODULE` FOREIGN KEY (`MODULE_ID`) REFERENCES `sys_module` (`ID`);

--
-- Filtros para la tabla `sys_user_param`
--
ALTER TABLE `sys_user_param`
  ADD CONSTRAINT `FK_SYS_USER_PARAM_PARAM` FOREIGN KEY (`PARAM_ID`) REFERENCES `sys_param` (`ID`),
  ADD CONSTRAINT `FK_SYS_USER_PARAM_USER` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`);

--
-- Filtros para la tabla `sys_user_x_rol`
--
ALTER TABLE `sys_user_x_rol`
  ADD CONSTRAINT `sys_user_x_rol_fk1` FOREIGN KEY (`USER_ID`) REFERENCES `sys_user` (`ID`),
  ADD CONSTRAINT `sys_user_x_rol_fk2` FOREIGN KEY (`ROL_ID`) REFERENCES `sys_rol` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
