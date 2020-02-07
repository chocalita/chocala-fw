-- DROP DATABASE jobs;
-- CREATE DATABASE jobs CHARACTER SET utf8 COLLATE utf8_general_ci;

-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2017 a las 22:29:29
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
(5, 'IND', 'Industria', 'Plantas y Fábricas insdustriales', 'ACTIVE', 0, '2016-08-27 01:48:40', NULL),
(6, 'ejem', 'ejemplo', 'jlajdfsadfasdf', 'DELETED', 1, '2016-08-29 03:53:07', NULL);

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
(1, NULL, 1, 'ingenieria', NULL, 'ing en ...', 'INACTIVE', 1, '2016-08-29 03:53:54', '2016-08-29 04:00:00');

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
  `LOCALIZACION_ID` int(11) DEFAULT NULL,
  `CARGO` varchar(50) DEFAULT NULL,
  `DESCRIPCION` text NOT NULL,
  `NOMBRE_EMPRESA` varchar(500) DEFAULT NULL,
  `DIRECCION` varchar(200) DEFAULT NULL,
  `TELEFONO_CONTACTO` int(11) DEFAULT NULL,
  `CORREO_CONTACTO` varchar(20) DEFAULT NULL,
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
  `STATUS` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `LAST_USER_ID` varchar(20) NOT NULL DEFAULT '0',
  `CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFICATION_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FORMACION_ACADEMICA_ID` (`NIVEL_FORMACION`),
  KEY `AREA_ID` (`AREA_ID`),
  KEY `AREA_TECNICA_ID` (`AREA_TECNICA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `job_aviso`
--

INSERT INTO `job_aviso` (`ID`, `AREA_ID`, `AREA_TECNICA_ID`, `LOCALIZACION_ID`, `CARGO`, `DESCRIPCION`, `NOMBRE_EMPRESA`, `DIRECCION`, `TELEFONO_CONTACTO`, `CORREO_CONTACTO`, `FECHA_PUBLICACION`, `FECHA_VENCIMIENTO`, `REQUISITO`, `ANIOS_EXPERIENCIA`, `NIVEL_FORMACION`, `SALARIO`, `PROFESION`, `FUENTE`, `TIENE_IMAGEN`, `MIMETYPE`, `STATUS`, `LAST_USER_ID`, `CREATION_DATE`, `MODIFICATION_DATE`) VALUES
(1, 5, NULL, NULL, 'Secretaria Ejecutiva', 'Se requiere Secretaria Ejecutiva, tambien se aceptan pasantías de las carreras Administración de Empresas o Ingeniería Comercial, sueldo atractivo', 'Empresa Constructora / Bienes Raices', 'Miraflores, Edif. Olimpia 1er piso Of. 103, frente al estadium', 2228335, '', '2016-06-29', '2016-07-01', '- Secretaria Ejecutiva\r\nOptativo:\r\n- Estudiante Administración de Empresas\r\n- Estudiante Ingenieria Comercial', 0, 'TECNICO', NULL, NULL, 'Extra', 0, NULL, 'ACTIVE', '1', '2016-06-29 08:00:00', '2016-06-29 08:00:00'),
(2, 5, NULL, NULL, 'Personal de Seguridad', 'Se requiere personal de seguridad física en horarios de 12h y 24h, desarrollo de actividades en Zona Sur y El Alto', 'Empresa de Seguridad Física', 'Av. Landaeta #547-A casi esq. Crespo, Zona San Pedro', 78846046, '', '2016-06-29', '2016-06-04', 'Personas con o sin experiencia en trabajos de seguridad', 0, 'SIN FORMACION', NULL, NULL, 'Extra', 0, NULL, 'ACTIVE', '1', '2016-06-29 08:00:00', '2016-06-29 08:00:00'),
(3, 5, NULL, NULL, 'Auxiliar de contabilidad', 'Auxiliar de contabilidad recien egresad@', 'Catering', 'Av. Buenos Aires', 76565749, '', '2016-06-29', '2016-07-04', 'Egresad@', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-31 11:00:00', NULL),
(4, 5, NULL, NULL, 'Encargado de Almacen', 'Se requiere encarado de almacen, preferibelemente con experiencia.', 'Empresa Comercial', 'Ciudad de El Alto', 2852222, '', '2016-06-03', '2016-06-08', '- Manejo de invetarios\r\n- Control de almacenes', 1, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(5, 5, NULL, NULL, 'Diseñadora uñas', 'Se requiere diseñadoras de uñas y estilistas con experiencia.', 'Spa Oliver', NULL, 73250877, '', '2016-06-03', '2016-06-10', 'Formación en areas de belleza integral.', 1, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(6, 5, NULL, NULL, 'Ingeniero en Alimentos Junior', 'Heladeria requiere ingeniero alimentos junior /químico enviar C.V. y pretensión salarial.', 'Querubines y Diablitos', NULL, 71526672, 'querubinesydiablitos', '2016-06-03', '2016-06-11', 'Imgeniero en Alimentos / Ingeniero Químico', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', '2016-06-03 11:00:00'),
(7, 5, NULL, NULL, 'Auxiliar Contable', 'Se requiere para El alto auxiliar contable con conocimiento en inventarios.', 'El Provenir', NULL, 0, 'admin@elporvenir-bo.', '2016-06-03', '2016-06-08', 'Contabiidad General', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(9, 5, NULL, NULL, 'Almacenero', 'Empresa importadora requiere los servicios de un almacenero para El Alto con conocimientos de kardex enviar curriculum y carta con pretensión salarial.', 'Empresa Importadora', 'Calle Alto de la Alienza Nro: 608 (casi esquina Ingavi)', 0, '', '2016-06-03', '2016-06-09', 'Conocimiento en manejo de almacenes e inventarios.', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(10, 5, NULL, NULL, 'Ingeniero Civil Junior', 'Empresa constructora requiere ingeniero civil junior con registro para residente de obra', 'Empresa Constructora', NULL, 76681226, '', '2016-06-03', '2016-06-12', 'Egresado o Licenciado en Ingenieria Civil', 0, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(11, 5, NULL, NULL, 'Secretaria Recepcionista', 'Se requiere una secretaria recepcionista con conocimientos de enfermeria.\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Secretaria Ejecutiva\r\nEnfermeria básica', 0, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(12, 5, NULL, NULL, 'Personal de Mantenimiento - Camillero', 'Se requiere un camillero / asistente de mantenimientos\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Formación bachiller', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', NULL),
(13, 5, NULL, NULL, 'Médico Radiólogo', 'Se requiere un médico Radiólogo, especialidad ecografista.\r\nPresentarse con curriculum vitae en horarios de oficina de horas 14:00 a 16:00 pm. ', 'Clinica AMID', 'calle Claudio Sanjinés No. 1558 Miraflores bajo', 0, '', '2016-06-03', '2016-06-18', 'Medico Radiólogo', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, 'ACTIVE', '1', '2016-06-03 11:00:00', '2016-06-13 11:00:00'),
(14, 5, NULL, NULL, 'Docente de Plomeria', 'Instituto Tecnologico Mariscal Sucre requiere docente de plomeria, de preferencia con certificaciones ministeriales', 'Instituto Tecnologico Mariscal Sucre', 'Calle Chuquizaca # 697esquina Paza Alonso de Mendoza', 2451191, 'itmsucre@gmail.com', '2016-06-13', '2016-06-18', '- Experiencia laboral certificada mínima de 4 años\r\n- Certificaciones ministeriales', 3, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-13 11:00:00', NULL),
(16, 5, NULL, NULL, 'Encargado de Ventas', 'Se solicita personal para el área de ventas ofrece buen sueldo estabilidad laboral, seguro y aporte AFP''S ', '24 HS', NULL, 76799508, '', '2016-06-13', '2016-06-21', 'Experiencia en Ventas', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-13 11:00:00', NULL),
(17, 5, NULL, NULL, 'Contador/Auditor', 'Se require Contadores y Auditores ', 'Consultora Caft SRL', NULL, 2200287, '', '2016-06-13', '2016-06-15', '- Experiencia profesional de 2 años\r\n- Conocimientos de contabilidad de costos', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-06-13 11:00:00', NULL),
(18, 5, NULL, NULL, 'Ortodoncista', 'Se requiere Ortodoncista, preferentemente especializado en odontopediatria', 'Clínica Bolivia Dent', NULL, 2825588, 'clinicaboliviadent@g', '2016-06-20', '2016-06-30', '- Licenciatura en Odontología\r\n- Especialidad en Ortodoncia\r\n- Deseable especialidad en odontopediatria', 2, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-21 11:00:00', NULL),
(20, 5, NULL, NULL, 'Pastelero', 'Pastelero/Repostero, con buenas habilidades en decoración', 'Restaurante Madagascar', 'Av/Raul Salmon #21 Ceja El Alto', 2825107, '', '2016-06-21', '2016-07-02', '- Certificación de trabajos en reposteria/pasteleria\r\n- Certtificación de formación en areas gastronómicas (deseable)', 4, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-21 11:00:00', NULL),
(21, 5, NULL, NULL, 'Ejecutivos de Venta', 'Empresa de Servicios Publicitarios requiere ejecutivos de ventas con experiencia en el rubro', 'Imago', NULL, 76339393, 'rroman@imago.com.bo', '2016-06-21', '2016-07-08', 'Experiencia en ventas y/o marketing', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-21 11:00:00', NULL),
(22, 5, NULL, NULL, 'Chofer de Cisterna', 'Se requiere chófer para cisterna, con licencia categoria "C" con experiencia y garantías interesados presentar hoja de vida en la gasolinera Volcan ubicada en la Av.Montes Esq. Pando ', 'Estación de Servicios Volcan S.R.L', 'Av.Montes Esq. Pando', 0, '', '2016-06-21', '2016-07-06', 'Licencia de Conducir Categoría "C"\r\nExperiencia en manejo de cisterna\r\nGarantias personasles y financieras', 0, 'BACHILLER', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2016-06-21 11:00:00', NULL),
(23, 5, NULL, NULL, 'Regente Farmaceútico', 'Se precisa regente farmaceutico con registro en colegio/sociedad de profesionales de area farmacológica.', 'BESCOS S.R.L. ', 'c/Capitán Ravelo #2124 frente al Hotel Camino Real.', 2442766, '', '2016-06-21', '2016-07-09', '- Titulo en Prov. Nal. en Farmacología o ramas afines\r\n- Registro Profesional en colegio de farmacólogos\r\n- Experiencia laboral mínima de 7 años en el área', 0, 'LICENCIATURA', NULL, NULL, '', 0, NULL, 'ACTIVE', '1', '2016-06-21 11:00:00', '2016-06-21 11:00:00'),
(24, 5, NULL, NULL, 'Data Analyst', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'eoc enterprice', 'santa Cruz', 78955556, 'a@mail.com', '2016-06-21', '2016-07-09', ' Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, 'ACTIVE', '1', '2016-09-01 11:00:00', NULL),
(25, 5, NULL, NULL, 'infromatica', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'OEC ENTERPRICE', 'SANTA CRUZ', 78565645, 'a@mail.com', '2016-09-01', '2016-09-25', 'Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, 'ACTIVE', '1', '2016-09-01 11:00:00', NULL),
(26, 5, NULL, NULL, 'infromatica', 'Data Analyst   Job Description:   Data Analyst is responsible for the collection, analysis and reporting of sales & process related data in an on-going effort to increase overall sales productivity.   Data Analyst must collect records and evaluate performance based on quotas while takin...', 'OEC ENTERPRICE', 'SANTA CRUZ', 78565645, 'a@mail.com', '2016-09-01', '2016-09-25', 'Data Analyst must collect records and evaluate performance based on quotas while takin', 2, 'LICENCIATURA', NULL, NULL, 'El Deber', 0, NULL, 'ACTIVE', '1', '2016-09-01 11:00:00', NULL),
(27, 5, NULL, NULL, 'Contador / Auditor ', 'Empresa en el Turrode cconstrucción requiere incorporar un contador o auditor a tiempo completo, enviar hoja de vida indicando propulsión salarial  ', 'Empresa Constructora ', 'El Alto', 0, 'bqconstruc@gmail.com', '2016-12-18', '2016-12-22', 'Licenciatura en contaduría publica  o auditoría ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-12-18 12:00:00', NULL),
(28, 5, NULL, NULL, 'Admistrador ', 'Administrador ', 'constructora', 'El Alto', 0, 'bqconstructor@gmail.', '2016-12-18', '2016-12-22', 'Licenciatura en administración de empresas o ramas afines  ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-12-18 12:00:00', NULL),
(29, 5, NULL, NULL, 'Secretaria ', 'Responsabilidad, iniciativa, organizacion, disponibilidad y capacidad de trabajo bbajoppresión ', 'Protel', NULL, 0, 'recursos.humanos@pro', '2016-12-18', '2016-12-30', 'Buena comunicación oral y escrita / manejo de paquetes de ccomputación  ', 2, 'TECNICO', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-12-18 12:00:00', NULL),
(30, 5, NULL, NULL, 'Comunicador Social', 'Que tenga manejo de redes sociales, ccoordinación con medios de ccomunicación, capacidad de relacionamiento ', 'Emaverde', 'La Paz', 0, '', '2016-12-18', '2016-12-24', 'Los Interesados deberán dejar su currículum vítae(fotocopias), indicando su pretension salarial  en un sobre cerrado hasta las 19:00 pm del día viernes 24 delpresente en el edificio EMAVERDE planta baja ubicado en la calle Francisco Bedegral N° 816 zona bajo sopocachi ', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-12-18 12:00:00', NULL),
(31, 5, NULL, NULL, 'Ingeniero Civil ', 'Ingeniero Civil ', 'CONSTRUCTORA', NULL, 0, 'requerimientopersona', '2016-12-18', '2017-01-06', 'Que tenga conocimiento en construcciónde de puentes en volados sucesivos, carreteras y topografías ', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2016-12-19 12:00:00', NULL),
(32, 5, NULL, NULL, 'INGENIERO ELECTRICO', 'Predisposición para viajes, al interior y área rural del país. Enviar Hoja de Vida.', 'ARCON BOLIVIA', NULL, 73235485, 'rrhh@arconbolivia.co', '2017-01-08', '2017-01-14', 'Titulado con experiencia en acometidas electricas, tableros, puestos de transformación. \r\nDisponibilidad de viajes por el interior del país.', 2, 'LICENCIATURA', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2017-01-09 12:00:00', NULL),
(33, 5, NULL, NULL, 'SECRETARIA / CONTADORA', 'Se requiere Secretaria Titulada con conocimientos de contabilidad.\r\nPuesto de trabajo en la Zona Sur', 'ARCON BOLIVIA', NULL, 73235485, 'rrhh@arconbolivia.co', '2017-01-08', '2017-01-13', 'Títulada Técnico Medio/Superior, ', 1, 'TECNICO', NULL, NULL, ' El Diario', 0, NULL, 'ACTIVE', '1', '2017-01-09 12:00:00', NULL),
(34, 5, NULL, NULL, 'cargo', 'puesto 1 vacante', 'empresa 1', 'direccion numero 1', 777777123, 'hola@mail.com', '2017-01-15', '2017-01-20', 'muchos requisitos', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 0, NULL, 'ACTIVE', '1', '2017-01-15 04:00:00', NULL),
(35, 5, NULL, NULL, 'Contador General', '*Ver Imagen', 'Empresa Financiera de Servicios Complementarios', NULL, 0, NULL, '2017-02-12', '2017-02-18', '- Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(36, 5, NULL, NULL, 'Auxiliar Contable', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(37, 5, NULL, NULL, 'Liocenciada en Enfermeria', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 3, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(38, 5, NULL, NULL, 'Cajero(as)', '*Ver Imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(39, 5, NULL, NULL, 'Atención al Cliente', '- Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '- Ver imagen', 0, 'BACHILLER', NULL, NULL, '', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(40, 5, NULL, NULL, 'Asistente Administrativo', '*Ver Imagen', 'Aldeas Infantiles SOS', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver Imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(41, 5, NULL, NULL, 'Facturador/a', '*Ver imagen', 'Empresa Farmaceutica', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(42, 5, NULL, NULL, 'Ingeniero Civil', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-19', '2017-02-19', '*Ver imagen', 8, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(43, 5, NULL, NULL, 'Ingeniero Ambiental', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-19', '2017-02-12', '*Ver imagen', 8, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(44, 5, NULL, NULL, 'Ingeniero Mecanico', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 6, 'LICENCIATURA', NULL, NULL, 'La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', '2017-02-12 04:00:00'),
(45, 5, NULL, NULL, 'Sociologo/Abogado', '*Ver imagen', 'Enki', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(46, 5, NULL, NULL, 'Analista Programador', '*Ver imagen', 'BMSC', NULL, 0, NULL, '2017-02-12', '2017-02-19', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(47, 5, NULL, NULL, 'Asistente de Desarrollo Tecnológico (Sistemas)', '*Ver imagen', 'FUNDEMPRESA', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(48, 5, NULL, NULL, 'Asistente Comercial', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 0, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(49, 5, NULL, NULL, 'Asesor de Negocios MyPE', '*Ver imagen', 'Banco Económico', '*Ver imagen', 0, NULL, '2017-02-12', '2017-02-21', '*Ver imagen', 2, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(50, 5, NULL, NULL, 'Contador/a General', '*Ver imagen', 'Empresa Farmaceutica', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, '', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', '2017-02-12 04:00:00'),
(51, 5, NULL, NULL, 'Economista', '*Ver imagen', 'Entidad Descentralizada', NULL, 0, NULL, '2017-02-12', '2017-02-18', '*Ver imagen', 4, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(52, 5, NULL, NULL, 'Ingeniero de Sistemas', '*Ver Imagen', 'PROCOSI', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver Imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(53, 5, NULL, NULL, 'Jefe de Mantenimiento', '*Ver imagen', 'Industria Copacabana S.A.', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 5, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(54, 5, NULL, NULL, 'Responsable Técnico Apicultor', '*Ver imagen', 'Pacha Trek', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 2, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(55, 5, NULL, NULL, 'Mercadeo y Posicionamiento', '*Ver imagen', 'Pacha Trek', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 4, 'TECNICO', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(56, 5, NULL, NULL, 'Supervisor de Atención al Cliente', '*Ver imagen', 'Hotel Camino Real', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 4, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(57, 5, NULL, NULL, 'Médico', '*Ver imagen', 'Pro mujer', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 1, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(58, 5, NULL, NULL, 'Impulsador/a Vendedor/a', '*Ver imagen', 'Foodwell', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(59, 5, NULL, NULL, 'Asistente de Limpieza', '*Ver imagen', 'Empresa de Sector', NULL, 77293959, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(60, 5, NULL, NULL, 'Reponedor/a - Impulsador/a', '*Ver imagen', 'Empresa de Sector', NULL, 2910750, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'SIN FORMACION', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(61, 5, NULL, NULL, 'Promotor/a de Ventas', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-17', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(62, 5, NULL, NULL, 'Mensajero', '*Ver imagen', 'Empresa de Sector', NULL, 0, NULL, '2017-02-12', '2017-02-15', '*Ver imagen', 0, 'BACHILLER', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL),
(63, 5, NULL, NULL, 'Responsable de Fidelización de Donantes', '*Ver imagen', 'Aldeas Infantiles SOS', NULL, 0, NULL, '2017-02-12', '2017-02-16', '*Ver imagen', 0, 'LICENCIATURA', NULL, NULL, ' La Razón', 1, NULL, 'ACTIVE', '1', '2017-02-12 04:00:00', NULL);

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
(1, 'X_EMAIL_ACCOUNT_CREATION', 'Creación de Cuenta de Usuario', 'Email de envío de acceso como nuevo usuario del sistema.', 'info@mysite.com', 'System Info', NULL, 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Creación de su Nueva Cuenta de Usuario', '<span style="font-family: Arial;">Hola ~NOMBRE~, te informamos que tu cuenta en el sistema fue creada exitosamente.<br><br>Para acceder debes ingresar al siguiente enlace:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="~ACCESS_LINK~"><span style="font-family: Arial;">~ACCESS_LINK~</span></a><br><br>Tienes un password temporal que deberás cambiar al acceder al sistema, este password es: ~PASSWORD~ <br><br>Agradecemos tu confianza y esperamos brindarte una experiencia agradable.<br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><span style="font-style: italic;"></span>', NULL, 'generic', 0, '2016-03-08 06:19:49', '0000-00-00 00:00:00'),
(2, 'X_EMAIL_PASSWORD_REQUEST', 'Recuperación de Acceso', 'Es el correo de recuperación de accesos al sistema', 'info@mysite.com', 'My Site Info', NULL, 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<span style="font-family: Arial;">Hola ~NOMBRE~, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="~RESET_LINK~"><span style="font-family: Arial;">~RESET_LINK~</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>', NULL, 'generic', 0, '2016-03-09 00:57:39', '0000-00-00 00:00:00'),
(3, 'X_EMAIL_SUBSCRIPTION', 'Suscripción de Usuario', 'Correo de bienvenida al sistema.\r\n\r\nEquipo ISAXBO', 'info@mysite.com', 'My Site Info', NULL, NULL, 'Bienvenida al Sistema', 'Email de envío de acceso como nuevo usuario del sistema', NULL, 'generic', 0, '2016-04-10 00:19:16', '0000-00-00 00:00:00');

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
  `OPENING_DATE` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  KEY `EMAIL_ID` (`EMAIL_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_email_sent`
--

INSERT INTO `sys_email_sent` (`ID`, `EMAIL_ID`, `USER_ID`, `SENDER_ID`, `HASH_STRING`, `FROM_NAME`, `FROM_EMAIL`, `TO_EMAIL`, `CC`, `BCC`, `SUBJECT`, `CONTENT`, `IS_SUCCESS`, `SHIPPING_DATE`, `OPENING_DATE`) VALUES
(1, 2, 1, 1, 'd9M6J6TeSPHHer39L8ZC', 'My Site Info', 'info@mysite.com', 'yecid@mysite.com<YECID>', '<>', 'yecid.pra@gmail.com<>;yecid_pra@hotmail.com<>', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola YECID, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/resetPassword/d9M6J6TeSPHHer39L8ZC"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/resetPassword/d9M6J6TeSPHHer39L8ZC</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/d9M6J6TeSPHHer39L8ZC" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 05:53:13', '2016-04-08 07:19:27'),
(2, 2, 1, 1, 'cocUspciWcSFo3SiTSAy', 'My Site Info', 'info@mysite.com', 'yecid@mysite.com<YECID>', '<>', 'yecid.pra@gmail.com<>;yecid_pra@hotmail.com<>', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola YECID, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/resetPassword/cocUspciWcSFo3SiTSAy"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/resetPassword/cocUspciWcSFo3SiTSAy</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/cocUspciWcSFo3SiTSAy" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 05:54:45', '2016-04-08 03:40:01'),
(3, 2, 3, 1, 'Cxmf6fy2sCzyDcD7RWra', 'My Site Info', 'info@mysite.com', 'miema@site.com<JAVIER>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Su solicitud de recuperación de contraseña', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Su solicitud de recuperación de contraseña</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola JAVIER, hemos recibido una solicitud de recuperación de contraseña en nuestro sistema.<br><br>Por favor accede al siguiente enlace para recuperar tu acceso al sistema:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://192.168.43.233/jobs/App/public/main/system/resetPassword/Cxmf6fy2sCzyDcD7RWra"><span style="font-family: Arial;">http://192.168.43.233/jobs/App/public/main/system/resetPassword/Cxmf6fy2sCzyDcD7RWra</span></a><br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><br>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://192.168.43.233/jobs/App/public/main/system/emailTracking/Cxmf6fy2sCzyDcD7RWra" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-07 06:27:17', '0000-00-00 00:00:00'),
(4, 1, 4, 1, 'gv5oPrLYt8TwqziLruotUPAtC2wPrS', 'System Info', 'info@mysite.com', 'miemail@dominio.com<MATIAS>', '', 'yecid.pra@gmail.com;yecid_pra@hotmail.com', 'Creación de su Nueva Cuenta de Usuario', '<html>\r\n<head>\r\n    <meta name="generator" content="Chocala Framework" />\r\n    <title>Creación de su Nueva Cuenta de Usuario</title>\r\n</head>\r\n<body>\r\n<div style="font-size: 13px; margin: 5px; padding: 10px; text-align: center;">\r\n    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; margin: 0 auto; text-align: left;">\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;" width="100%">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/head.jpg" alt="Mi contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n        <tr><td style="border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3; color: #222222; font-family: ''Calibri'', Arial; padding: 5px 10px;">\r\n                <span style="font-family: Arial;">Hola MATIAS, te informamos que tu cuenta en el sistema fue creada exitosamente.<br><br>Para acceder debes ingresar al siguiente enlace:<br><br></span><span style="font-family: Arial;"><a target="_blank" href="http://localhost/jobs/App/public/main/system/access/"><span style="font-family: Arial;">http://localhost/jobs/App/public/main/system/access/</span></a><br><br>Tienes un password temporal que deberás cambiar al acceder al sistema, este password es: jpJ6VNZx <br><br>Agradecemos tu confianza y esperamos brindarte una experiencia agradable.<br><br>Saludos<br><span style="font-style: italic;"><br>El equipo ISAXBO</span></span><span style="font-style: italic;"></span>\r\n            </td>\r\n        </tr>\r\n<!--        <tr><td style="color: #E36C0A; font-family: ''Calibri'', Arial; font-size: 0.9em; font-style: italic; font-weight: bold;">-->\r\n<!--                <img src="--><?//=IMG_WEB;?><!--email/foot.jpg" alt="Mi Contador" title="" border="0" />-->\r\n<!--            </td>-->\r\n<!--        </tr>-->\r\n    </table>\r\n    <img class="changeTrackingSrc" src="http://localhost/jobs/App/public/main/system/emailTracking/gv5oPrLYt8TwqziLruotUPAtC2wPrS" alt="" title="">\r\n</div>\r\n</body>\r\n</html>', 0, '2016-04-10 01:12:07', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;

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
(10, 'GLOBAL', 'JOB_FUENTES', 'Fuentes de avisos', 'STRING', 'El Deber; El Diario; La Razón', 'El Deber;El Diario;Extra;La Razón', 'Fuentes de avisos', 0, 0, '2016-05-26 18:12:02', NULL);

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
  `RESTORED_IP` varchar(30) NOT NULL,
  `ACCEDED_TIMES` int(11) NOT NULL DEFAULT '0',
  `REQUESTED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RESTORED_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Volcado de datos para la tabla `sys_password_request`
--

INSERT INTO `sys_password_request` (`ID`, `USER_ID`, `EMAIL`, `HASH_STRING`, `ACTIVE`, `LIFE_TIME`, `REQUEST_IP`, `RESTORED_IP`, `ACCEDED_TIMES`, `REQUESTED_DATE`, `RESTORED_DATE`) VALUES
(1, 1, 'yecid@mysite.com', 'd9M6J6TeSPHHer39L8ZC', 1, 24, '::1', '', 0, '2016-04-07 05:53:13', NULL),
(2, 1, 'yecid@mysite.com', 'cocUspciWcSFo3SiTSAy', 1, 24, '::1', '', 0, '2016-04-07 05:54:45', NULL),
(3, 3, 'miema@site.com', 'Cxmf6fy2sCzyDcD7RWra', 1, 24, '192.168.43.1', '', 0, '2016-04-07 06:27:17', NULL);

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
