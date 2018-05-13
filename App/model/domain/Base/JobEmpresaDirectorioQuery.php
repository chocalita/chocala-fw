<?php

namespace Base;

use \JobEmpresaDirectorio as ChildJobEmpresaDirectorio;
use \JobEmpresaDirectorioQuery as ChildJobEmpresaDirectorioQuery;
use \Exception;
use \PDO;
use Map\JobEmpresaDirectorioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_empresa_directorio' table.
 *
 *
 *
 * @method     ChildJobEmpresaDirectorioQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobEmpresaDirectorioQuery orderByIdMatricula($order = Criteria::ASC) Order by the ID_MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery orderByMatricula($order = Criteria::ASC) Order by the MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery orderByInfo($order = Criteria::ASC) Order by the INFO column
 * @method     ChildJobEmpresaDirectorioQuery orderByRazon($order = Criteria::ASC) Order by the RAZON column
 * @method     ChildJobEmpresaDirectorioQuery orderByTps($order = Criteria::ASC) Order by the TPS column
 * @method     ChildJobEmpresaDirectorioQuery orderByDpto($order = Criteria::ASC) Order by the DPTO column
 * @method     ChildJobEmpresaDirectorioQuery orderByMunicipio($order = Criteria::ASC) Order by the MUNICIPIO column
 * @method     ChildJobEmpresaDirectorioQuery orderByDireccion($order = Criteria::ASC) Order by the DIRECCION column
 * @method     ChildJobEmpresaDirectorioQuery orderByFono($order = Criteria::ASC) Order by the FONO column
 * @method     ChildJobEmpresaDirectorioQuery orderByFono2($order = Criteria::ASC) Order by the FONO2 column
 * @method     ChildJobEmpresaDirectorioQuery orderByFechaMatricula($order = Criteria::ASC) Order by the FECHA_MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery orderByFechaRenovacion($order = Criteria::ASC) Order by the FECHA_RENOVACION column
 * @method     ChildJobEmpresaDirectorioQuery orderByUltRenov($order = Criteria::ASC) Order by the ULT_RENOV column
 * @method     ChildJobEmpresaDirectorioQuery orderByEstMat($order = Criteria::ASC) Order by the EST_MAT column
 * @method     ChildJobEmpresaDirectorioQuery orderByCierre($order = Criteria::ASC) Order by the CIERRE column
 * @method     ChildJobEmpresaDirectorioQuery orderByIdClase($order = Criteria::ASC) Order by the ID_CLASE column
 * @method     ChildJobEmpresaDirectorioQuery orderByNumId($order = Criteria::ASC) Order by the NUM_ID column
 * @method     ChildJobEmpresaDirectorioQuery orderByNombre($order = Criteria::ASC) Order by the NOMBRE column
 * @method     ChildJobEmpresaDirectorioQuery orderByCtrAct($order = Criteria::ASC) Order by the CTR_ACT column
 * @method     ChildJobEmpresaDirectorioQuery orderByIdReg($order = Criteria::ASC) Order by the ID_REG column
 * @method     ChildJobEmpresaDirectorioQuery orderByVisible($order = Criteria::ASC) Order by the VISIBLE column
 * @method     ChildJobEmpresaDirectorioQuery orderByFax($order = Criteria::ASC) Order by the FAX column
 * @method     ChildJobEmpresaDirectorioQuery orderByMail($order = Criteria::ASC) Order by the MAIL column
 * @method     ChildJobEmpresaDirectorioQuery orderByActividad($order = Criteria::ASC) Order by the ACTIVIDAD column
 * @method     ChildJobEmpresaDirectorioQuery orderByLicencia($order = Criteria::ASC) Order by the LICENCIA column
 * @method     ChildJobEmpresaDirectorioQuery orderByContacto($order = Criteria::ASC) Order by the CONTACTO column
 * @method     ChildJobEmpresaDirectorioQuery orderBySeccion($order = Criteria::ASC) Order by the SECCION column
 * @method     ChildJobEmpresaDirectorioQuery orderByDivision($order = Criteria::ASC) Order by the DIVISION column
 * @method     ChildJobEmpresaDirectorioQuery orderByClase($order = Criteria::ASC) Order by the CLASE column
 * @method     ChildJobEmpresaDirectorioQuery orderByGrupo($order = Criteria::ASC) Order by the GRUPO column
 * @method     ChildJobEmpresaDirectorioQuery orderByDes1($order = Criteria::ASC) Order by the DES1 column
 * @method     ChildJobEmpresaDirectorioQuery orderByDes2($order = Criteria::ASC) Order by the DES2 column
 * @method     ChildJobEmpresaDirectorioQuery orderByDes3($order = Criteria::ASC) Order by the DES3 column
 * @method     ChildJobEmpresaDirectorioQuery orderByDes4($order = Criteria::ASC) Order by the DES4 column
 *
 * @method     ChildJobEmpresaDirectorioQuery groupById() Group by the ID column
 * @method     ChildJobEmpresaDirectorioQuery groupByIdMatricula() Group by the ID_MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery groupByMatricula() Group by the MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery groupByInfo() Group by the INFO column
 * @method     ChildJobEmpresaDirectorioQuery groupByRazon() Group by the RAZON column
 * @method     ChildJobEmpresaDirectorioQuery groupByTps() Group by the TPS column
 * @method     ChildJobEmpresaDirectorioQuery groupByDpto() Group by the DPTO column
 * @method     ChildJobEmpresaDirectorioQuery groupByMunicipio() Group by the MUNICIPIO column
 * @method     ChildJobEmpresaDirectorioQuery groupByDireccion() Group by the DIRECCION column
 * @method     ChildJobEmpresaDirectorioQuery groupByFono() Group by the FONO column
 * @method     ChildJobEmpresaDirectorioQuery groupByFono2() Group by the FONO2 column
 * @method     ChildJobEmpresaDirectorioQuery groupByFechaMatricula() Group by the FECHA_MATRICULA column
 * @method     ChildJobEmpresaDirectorioQuery groupByFechaRenovacion() Group by the FECHA_RENOVACION column
 * @method     ChildJobEmpresaDirectorioQuery groupByUltRenov() Group by the ULT_RENOV column
 * @method     ChildJobEmpresaDirectorioQuery groupByEstMat() Group by the EST_MAT column
 * @method     ChildJobEmpresaDirectorioQuery groupByCierre() Group by the CIERRE column
 * @method     ChildJobEmpresaDirectorioQuery groupByIdClase() Group by the ID_CLASE column
 * @method     ChildJobEmpresaDirectorioQuery groupByNumId() Group by the NUM_ID column
 * @method     ChildJobEmpresaDirectorioQuery groupByNombre() Group by the NOMBRE column
 * @method     ChildJobEmpresaDirectorioQuery groupByCtrAct() Group by the CTR_ACT column
 * @method     ChildJobEmpresaDirectorioQuery groupByIdReg() Group by the ID_REG column
 * @method     ChildJobEmpresaDirectorioQuery groupByVisible() Group by the VISIBLE column
 * @method     ChildJobEmpresaDirectorioQuery groupByFax() Group by the FAX column
 * @method     ChildJobEmpresaDirectorioQuery groupByMail() Group by the MAIL column
 * @method     ChildJobEmpresaDirectorioQuery groupByActividad() Group by the ACTIVIDAD column
 * @method     ChildJobEmpresaDirectorioQuery groupByLicencia() Group by the LICENCIA column
 * @method     ChildJobEmpresaDirectorioQuery groupByContacto() Group by the CONTACTO column
 * @method     ChildJobEmpresaDirectorioQuery groupBySeccion() Group by the SECCION column
 * @method     ChildJobEmpresaDirectorioQuery groupByDivision() Group by the DIVISION column
 * @method     ChildJobEmpresaDirectorioQuery groupByClase() Group by the CLASE column
 * @method     ChildJobEmpresaDirectorioQuery groupByGrupo() Group by the GRUPO column
 * @method     ChildJobEmpresaDirectorioQuery groupByDes1() Group by the DES1 column
 * @method     ChildJobEmpresaDirectorioQuery groupByDes2() Group by the DES2 column
 * @method     ChildJobEmpresaDirectorioQuery groupByDes3() Group by the DES3 column
 * @method     ChildJobEmpresaDirectorioQuery groupByDes4() Group by the DES4 column
 *
 * @method     ChildJobEmpresaDirectorioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobEmpresaDirectorioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobEmpresaDirectorioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobEmpresaDirectorioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobEmpresaDirectorioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobEmpresaDirectorioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobEmpresaDirectorio findOne(ConnectionInterface $con = null) Return the first ChildJobEmpresaDirectorio matching the query
 * @method     ChildJobEmpresaDirectorio findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobEmpresaDirectorio matching the query, or a new ChildJobEmpresaDirectorio object populated from the query conditions when no match is found
 *
 * @method     ChildJobEmpresaDirectorio findOneById(int $ID) Return the first ChildJobEmpresaDirectorio filtered by the ID column
 * @method     ChildJobEmpresaDirectorio findOneByIdMatricula(int $ID_MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the ID_MATRICULA column
 * @method     ChildJobEmpresaDirectorio findOneByMatricula(string $MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the MATRICULA column
 * @method     ChildJobEmpresaDirectorio findOneByInfo(string $INFO) Return the first ChildJobEmpresaDirectorio filtered by the INFO column
 * @method     ChildJobEmpresaDirectorio findOneByRazon(string $RAZON) Return the first ChildJobEmpresaDirectorio filtered by the RAZON column
 * @method     ChildJobEmpresaDirectorio findOneByTps(string $TPS) Return the first ChildJobEmpresaDirectorio filtered by the TPS column
 * @method     ChildJobEmpresaDirectorio findOneByDpto(string $DPTO) Return the first ChildJobEmpresaDirectorio filtered by the DPTO column
 * @method     ChildJobEmpresaDirectorio findOneByMunicipio(string $MUNICIPIO) Return the first ChildJobEmpresaDirectorio filtered by the MUNICIPIO column
 * @method     ChildJobEmpresaDirectorio findOneByDireccion(string $DIRECCION) Return the first ChildJobEmpresaDirectorio filtered by the DIRECCION column
 * @method     ChildJobEmpresaDirectorio findOneByFono(string $FONO) Return the first ChildJobEmpresaDirectorio filtered by the FONO column
 * @method     ChildJobEmpresaDirectorio findOneByFono2(string $FONO2) Return the first ChildJobEmpresaDirectorio filtered by the FONO2 column
 * @method     ChildJobEmpresaDirectorio findOneByFechaMatricula(string $FECHA_MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the FECHA_MATRICULA column
 * @method     ChildJobEmpresaDirectorio findOneByFechaRenovacion(string $FECHA_RENOVACION) Return the first ChildJobEmpresaDirectorio filtered by the FECHA_RENOVACION column
 * @method     ChildJobEmpresaDirectorio findOneByUltRenov(int $ULT_RENOV) Return the first ChildJobEmpresaDirectorio filtered by the ULT_RENOV column
 * @method     ChildJobEmpresaDirectorio findOneByEstMat(string $EST_MAT) Return the first ChildJobEmpresaDirectorio filtered by the EST_MAT column
 * @method     ChildJobEmpresaDirectorio findOneByCierre(int $CIERRE) Return the first ChildJobEmpresaDirectorio filtered by the CIERRE column
 * @method     ChildJobEmpresaDirectorio findOneByIdClase(string $ID_CLASE) Return the first ChildJobEmpresaDirectorio filtered by the ID_CLASE column
 * @method     ChildJobEmpresaDirectorio findOneByNumId(string $NUM_ID) Return the first ChildJobEmpresaDirectorio filtered by the NUM_ID column
 * @method     ChildJobEmpresaDirectorio findOneByNombre(string $NOMBRE) Return the first ChildJobEmpresaDirectorio filtered by the NOMBRE column
 * @method     ChildJobEmpresaDirectorio findOneByCtrAct(string $CTR_ACT) Return the first ChildJobEmpresaDirectorio filtered by the CTR_ACT column
 * @method     ChildJobEmpresaDirectorio findOneByIdReg(string $ID_REG) Return the first ChildJobEmpresaDirectorio filtered by the ID_REG column
 * @method     ChildJobEmpresaDirectorio findOneByVisible(string $VISIBLE) Return the first ChildJobEmpresaDirectorio filtered by the VISIBLE column
 * @method     ChildJobEmpresaDirectorio findOneByFax(string $FAX) Return the first ChildJobEmpresaDirectorio filtered by the FAX column
 * @method     ChildJobEmpresaDirectorio findOneByMail(string $MAIL) Return the first ChildJobEmpresaDirectorio filtered by the MAIL column
 * @method     ChildJobEmpresaDirectorio findOneByActividad(string $ACTIVIDAD) Return the first ChildJobEmpresaDirectorio filtered by the ACTIVIDAD column
 * @method     ChildJobEmpresaDirectorio findOneByLicencia(string $LICENCIA) Return the first ChildJobEmpresaDirectorio filtered by the LICENCIA column
 * @method     ChildJobEmpresaDirectorio findOneByContacto(string $CONTACTO) Return the first ChildJobEmpresaDirectorio filtered by the CONTACTO column
 * @method     ChildJobEmpresaDirectorio findOneBySeccion(string $SECCION) Return the first ChildJobEmpresaDirectorio filtered by the SECCION column
 * @method     ChildJobEmpresaDirectorio findOneByDivision(int $DIVISION) Return the first ChildJobEmpresaDirectorio filtered by the DIVISION column
 * @method     ChildJobEmpresaDirectorio findOneByClase(int $CLASE) Return the first ChildJobEmpresaDirectorio filtered by the CLASE column
 * @method     ChildJobEmpresaDirectorio findOneByGrupo(int $GRUPO) Return the first ChildJobEmpresaDirectorio filtered by the GRUPO column
 * @method     ChildJobEmpresaDirectorio findOneByDes1(string $DES1) Return the first ChildJobEmpresaDirectorio filtered by the DES1 column
 * @method     ChildJobEmpresaDirectorio findOneByDes2(string $DES2) Return the first ChildJobEmpresaDirectorio filtered by the DES2 column
 * @method     ChildJobEmpresaDirectorio findOneByDes3(string $DES3) Return the first ChildJobEmpresaDirectorio filtered by the DES3 column
 * @method     ChildJobEmpresaDirectorio findOneByDes4(string $DES4) Return the first ChildJobEmpresaDirectorio filtered by the DES4 column *

 * @method     ChildJobEmpresaDirectorio requirePk($key, ConnectionInterface $con = null) Return the ChildJobEmpresaDirectorio by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOne(ConnectionInterface $con = null) Return the first ChildJobEmpresaDirectorio matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEmpresaDirectorio requireOneById(int $ID) Return the first ChildJobEmpresaDirectorio filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByIdMatricula(int $ID_MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the ID_MATRICULA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByMatricula(string $MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the MATRICULA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByInfo(string $INFO) Return the first ChildJobEmpresaDirectorio filtered by the INFO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByRazon(string $RAZON) Return the first ChildJobEmpresaDirectorio filtered by the RAZON column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByTps(string $TPS) Return the first ChildJobEmpresaDirectorio filtered by the TPS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDpto(string $DPTO) Return the first ChildJobEmpresaDirectorio filtered by the DPTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByMunicipio(string $MUNICIPIO) Return the first ChildJobEmpresaDirectorio filtered by the MUNICIPIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDireccion(string $DIRECCION) Return the first ChildJobEmpresaDirectorio filtered by the DIRECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByFono(string $FONO) Return the first ChildJobEmpresaDirectorio filtered by the FONO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByFono2(string $FONO2) Return the first ChildJobEmpresaDirectorio filtered by the FONO2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByFechaMatricula(string $FECHA_MATRICULA) Return the first ChildJobEmpresaDirectorio filtered by the FECHA_MATRICULA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByFechaRenovacion(string $FECHA_RENOVACION) Return the first ChildJobEmpresaDirectorio filtered by the FECHA_RENOVACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByUltRenov(int $ULT_RENOV) Return the first ChildJobEmpresaDirectorio filtered by the ULT_RENOV column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByEstMat(string $EST_MAT) Return the first ChildJobEmpresaDirectorio filtered by the EST_MAT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByCierre(int $CIERRE) Return the first ChildJobEmpresaDirectorio filtered by the CIERRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByIdClase(string $ID_CLASE) Return the first ChildJobEmpresaDirectorio filtered by the ID_CLASE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByNumId(string $NUM_ID) Return the first ChildJobEmpresaDirectorio filtered by the NUM_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByNombre(string $NOMBRE) Return the first ChildJobEmpresaDirectorio filtered by the NOMBRE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByCtrAct(string $CTR_ACT) Return the first ChildJobEmpresaDirectorio filtered by the CTR_ACT column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByIdReg(string $ID_REG) Return the first ChildJobEmpresaDirectorio filtered by the ID_REG column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByVisible(string $VISIBLE) Return the first ChildJobEmpresaDirectorio filtered by the VISIBLE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByFax(string $FAX) Return the first ChildJobEmpresaDirectorio filtered by the FAX column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByMail(string $MAIL) Return the first ChildJobEmpresaDirectorio filtered by the MAIL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByActividad(string $ACTIVIDAD) Return the first ChildJobEmpresaDirectorio filtered by the ACTIVIDAD column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByLicencia(string $LICENCIA) Return the first ChildJobEmpresaDirectorio filtered by the LICENCIA column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByContacto(string $CONTACTO) Return the first ChildJobEmpresaDirectorio filtered by the CONTACTO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneBySeccion(string $SECCION) Return the first ChildJobEmpresaDirectorio filtered by the SECCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDivision(int $DIVISION) Return the first ChildJobEmpresaDirectorio filtered by the DIVISION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByClase(int $CLASE) Return the first ChildJobEmpresaDirectorio filtered by the CLASE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByGrupo(int $GRUPO) Return the first ChildJobEmpresaDirectorio filtered by the GRUPO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDes1(string $DES1) Return the first ChildJobEmpresaDirectorio filtered by the DES1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDes2(string $DES2) Return the first ChildJobEmpresaDirectorio filtered by the DES2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDes3(string $DES3) Return the first ChildJobEmpresaDirectorio filtered by the DES3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobEmpresaDirectorio requireOneByDes4(string $DES4) Return the first ChildJobEmpresaDirectorio filtered by the DES4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobEmpresaDirectorio objects based on current ModelCriteria
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findById(int $ID) Return ChildJobEmpresaDirectorio objects filtered by the ID column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByIdMatricula(int $ID_MATRICULA) Return ChildJobEmpresaDirectorio objects filtered by the ID_MATRICULA column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByMatricula(string $MATRICULA) Return ChildJobEmpresaDirectorio objects filtered by the MATRICULA column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByInfo(string $INFO) Return ChildJobEmpresaDirectorio objects filtered by the INFO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByRazon(string $RAZON) Return ChildJobEmpresaDirectorio objects filtered by the RAZON column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByTps(string $TPS) Return ChildJobEmpresaDirectorio objects filtered by the TPS column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDpto(string $DPTO) Return ChildJobEmpresaDirectorio objects filtered by the DPTO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByMunicipio(string $MUNICIPIO) Return ChildJobEmpresaDirectorio objects filtered by the MUNICIPIO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDireccion(string $DIRECCION) Return ChildJobEmpresaDirectorio objects filtered by the DIRECCION column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByFono(string $FONO) Return ChildJobEmpresaDirectorio objects filtered by the FONO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByFono2(string $FONO2) Return ChildJobEmpresaDirectorio objects filtered by the FONO2 column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByFechaMatricula(string $FECHA_MATRICULA) Return ChildJobEmpresaDirectorio objects filtered by the FECHA_MATRICULA column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByFechaRenovacion(string $FECHA_RENOVACION) Return ChildJobEmpresaDirectorio objects filtered by the FECHA_RENOVACION column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByUltRenov(int $ULT_RENOV) Return ChildJobEmpresaDirectorio objects filtered by the ULT_RENOV column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByEstMat(string $EST_MAT) Return ChildJobEmpresaDirectorio objects filtered by the EST_MAT column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByCierre(int $CIERRE) Return ChildJobEmpresaDirectorio objects filtered by the CIERRE column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByIdClase(string $ID_CLASE) Return ChildJobEmpresaDirectorio objects filtered by the ID_CLASE column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByNumId(string $NUM_ID) Return ChildJobEmpresaDirectorio objects filtered by the NUM_ID column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByNombre(string $NOMBRE) Return ChildJobEmpresaDirectorio objects filtered by the NOMBRE column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByCtrAct(string $CTR_ACT) Return ChildJobEmpresaDirectorio objects filtered by the CTR_ACT column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByIdReg(string $ID_REG) Return ChildJobEmpresaDirectorio objects filtered by the ID_REG column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByVisible(string $VISIBLE) Return ChildJobEmpresaDirectorio objects filtered by the VISIBLE column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByFax(string $FAX) Return ChildJobEmpresaDirectorio objects filtered by the FAX column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByMail(string $MAIL) Return ChildJobEmpresaDirectorio objects filtered by the MAIL column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByActividad(string $ACTIVIDAD) Return ChildJobEmpresaDirectorio objects filtered by the ACTIVIDAD column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByLicencia(string $LICENCIA) Return ChildJobEmpresaDirectorio objects filtered by the LICENCIA column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByContacto(string $CONTACTO) Return ChildJobEmpresaDirectorio objects filtered by the CONTACTO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findBySeccion(string $SECCION) Return ChildJobEmpresaDirectorio objects filtered by the SECCION column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDivision(int $DIVISION) Return ChildJobEmpresaDirectorio objects filtered by the DIVISION column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByClase(int $CLASE) Return ChildJobEmpresaDirectorio objects filtered by the CLASE column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByGrupo(int $GRUPO) Return ChildJobEmpresaDirectorio objects filtered by the GRUPO column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDes1(string $DES1) Return ChildJobEmpresaDirectorio objects filtered by the DES1 column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDes2(string $DES2) Return ChildJobEmpresaDirectorio objects filtered by the DES2 column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDes3(string $DES3) Return ChildJobEmpresaDirectorio objects filtered by the DES3 column
 * @method     ChildJobEmpresaDirectorio[]|ObjectCollection findByDes4(string $DES4) Return ChildJobEmpresaDirectorio objects filtered by the DES4 column
 * @method     ChildJobEmpresaDirectorio[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobEmpresaDirectorioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobEmpresaDirectorioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobEmpresaDirectorio', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobEmpresaDirectorioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobEmpresaDirectorioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobEmpresaDirectorioQuery) {
            return $criteria;
        }
        $query = new ChildJobEmpresaDirectorioQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildJobEmpresaDirectorio|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobEmpresaDirectorioTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobEmpresaDirectorio A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_MATRICULA, MATRICULA, INFO, RAZON, TPS, DPTO, MUNICIPIO, DIRECCION, FONO, FONO2, FECHA_MATRICULA, FECHA_RENOVACION, ULT_RENOV, EST_MAT, CIERRE, ID_CLASE, NUM_ID, NOMBRE, CTR_ACT, ID_REG, VISIBLE, FAX, MAIL, ACTIVIDAD, LICENCIA, CONTACTO, SECCION, DIVISION, CLASE, GRUPO, DES1, DES2, DES3, DES4 FROM job_empresa_directorio WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildJobEmpresaDirectorio $obj */
            $obj = new ChildJobEmpresaDirectorio();
            $obj->hydrate($row);
            JobEmpresaDirectorioTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildJobEmpresaDirectorio|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_MATRICULA column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMatricula(1234); // WHERE ID_MATRICULA = 1234
     * $query->filterByIdMatricula(array(12, 34)); // WHERE ID_MATRICULA IN (12, 34)
     * $query->filterByIdMatricula(array('min' => 12)); // WHERE ID_MATRICULA > 12
     * </code>
     *
     * @param     mixed $idMatricula The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByIdMatricula($idMatricula = null, $comparison = null)
    {
        if (is_array($idMatricula)) {
            $useMinMax = false;
            if (isset($idMatricula['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA, $idMatricula['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMatricula['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA, $idMatricula['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID_MATRICULA, $idMatricula, $comparison);
    }

    /**
     * Filter the query on the MATRICULA column
     *
     * Example usage:
     * <code>
     * $query->filterByMatricula('fooValue');   // WHERE MATRICULA = 'fooValue'
     * $query->filterByMatricula('%fooValue%', Criteria::LIKE); // WHERE MATRICULA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $matricula The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByMatricula($matricula = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($matricula)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_MATRICULA, $matricula, $comparison);
    }

    /**
     * Filter the query on the INFO column
     *
     * Example usage:
     * <code>
     * $query->filterByInfo('fooValue');   // WHERE INFO = 'fooValue'
     * $query->filterByInfo('%fooValue%', Criteria::LIKE); // WHERE INFO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $info The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByInfo($info = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($info)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_INFO, $info, $comparison);
    }

    /**
     * Filter the query on the RAZON column
     *
     * Example usage:
     * <code>
     * $query->filterByRazon('fooValue');   // WHERE RAZON = 'fooValue'
     * $query->filterByRazon('%fooValue%', Criteria::LIKE); // WHERE RAZON LIKE '%fooValue%'
     * </code>
     *
     * @param     string $razon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByRazon($razon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($razon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_RAZON, $razon, $comparison);
    }

    /**
     * Filter the query on the TPS column
     *
     * Example usage:
     * <code>
     * $query->filterByTps('fooValue');   // WHERE TPS = 'fooValue'
     * $query->filterByTps('%fooValue%', Criteria::LIKE); // WHERE TPS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tps The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByTps($tps = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tps)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_TPS, $tps, $comparison);
    }

    /**
     * Filter the query on the DPTO column
     *
     * Example usage:
     * <code>
     * $query->filterByDpto('fooValue');   // WHERE DPTO = 'fooValue'
     * $query->filterByDpto('%fooValue%', Criteria::LIKE); // WHERE DPTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dpto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDpto($dpto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dpto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DPTO, $dpto, $comparison);
    }

    /**
     * Filter the query on the MUNICIPIO column
     *
     * Example usage:
     * <code>
     * $query->filterByMunicipio('fooValue');   // WHERE MUNICIPIO = 'fooValue'
     * $query->filterByMunicipio('%fooValue%', Criteria::LIKE); // WHERE MUNICIPIO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $municipio The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByMunicipio($municipio = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($municipio)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_MUNICIPIO, $municipio, $comparison);
    }

    /**
     * Filter the query on the DIRECCION column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE DIRECCION = 'fooValue'
     * $query->filterByDireccion('%fooValue%', Criteria::LIKE); // WHERE DIRECCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the FONO column
     *
     * Example usage:
     * <code>
     * $query->filterByFono('fooValue');   // WHERE FONO = 'fooValue'
     * $query->filterByFono('%fooValue%', Criteria::LIKE); // WHERE FONO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fono The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByFono($fono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fono)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FONO, $fono, $comparison);
    }

    /**
     * Filter the query on the FONO2 column
     *
     * Example usage:
     * <code>
     * $query->filterByFono2('fooValue');   // WHERE FONO2 = 'fooValue'
     * $query->filterByFono2('%fooValue%', Criteria::LIKE); // WHERE FONO2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fono2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByFono2($fono2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fono2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FONO2, $fono2, $comparison);
    }

    /**
     * Filter the query on the FECHA_MATRICULA column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaMatricula('2011-03-14'); // WHERE FECHA_MATRICULA = '2011-03-14'
     * $query->filterByFechaMatricula('now'); // WHERE FECHA_MATRICULA = '2011-03-14'
     * $query->filterByFechaMatricula(array('max' => 'yesterday')); // WHERE FECHA_MATRICULA > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaMatricula The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByFechaMatricula($fechaMatricula = null, $comparison = null)
    {
        if (is_array($fechaMatricula)) {
            $useMinMax = false;
            if (isset($fechaMatricula['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA, $fechaMatricula['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaMatricula['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA, $fechaMatricula['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_MATRICULA, $fechaMatricula, $comparison);
    }

    /**
     * Filter the query on the FECHA_RENOVACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaRenovacion('2011-03-14'); // WHERE FECHA_RENOVACION = '2011-03-14'
     * $query->filterByFechaRenovacion('now'); // WHERE FECHA_RENOVACION = '2011-03-14'
     * $query->filterByFechaRenovacion(array('max' => 'yesterday')); // WHERE FECHA_RENOVACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaRenovacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByFechaRenovacion($fechaRenovacion = null, $comparison = null)
    {
        if (is_array($fechaRenovacion)) {
            $useMinMax = false;
            if (isset($fechaRenovacion['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION, $fechaRenovacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaRenovacion['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION, $fechaRenovacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FECHA_RENOVACION, $fechaRenovacion, $comparison);
    }

    /**
     * Filter the query on the ULT_RENOV column
     *
     * Example usage:
     * <code>
     * $query->filterByUltRenov(1234); // WHERE ULT_RENOV = 1234
     * $query->filterByUltRenov(array(12, 34)); // WHERE ULT_RENOV IN (12, 34)
     * $query->filterByUltRenov(array('min' => 12)); // WHERE ULT_RENOV > 12
     * </code>
     *
     * @param     mixed $ultRenov The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByUltRenov($ultRenov = null, $comparison = null)
    {
        if (is_array($ultRenov)) {
            $useMinMax = false;
            if (isset($ultRenov['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ULT_RENOV, $ultRenov['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ultRenov['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ULT_RENOV, $ultRenov['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ULT_RENOV, $ultRenov, $comparison);
    }

    /**
     * Filter the query on the EST_MAT column
     *
     * Example usage:
     * <code>
     * $query->filterByEstMat('fooValue');   // WHERE EST_MAT = 'fooValue'
     * $query->filterByEstMat('%fooValue%', Criteria::LIKE); // WHERE EST_MAT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estMat The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByEstMat($estMat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estMat)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_EST_MAT, $estMat, $comparison);
    }

    /**
     * Filter the query on the CIERRE column
     *
     * Example usage:
     * <code>
     * $query->filterByCierre(1234); // WHERE CIERRE = 1234
     * $query->filterByCierre(array(12, 34)); // WHERE CIERRE IN (12, 34)
     * $query->filterByCierre(array('min' => 12)); // WHERE CIERRE > 12
     * </code>
     *
     * @param     mixed $cierre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByCierre($cierre = null, $comparison = null)
    {
        if (is_array($cierre)) {
            $useMinMax = false;
            if (isset($cierre['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CIERRE, $cierre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cierre['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CIERRE, $cierre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CIERRE, $cierre, $comparison);
    }

    /**
     * Filter the query on the ID_CLASE column
     *
     * Example usage:
     * <code>
     * $query->filterByIdClase('fooValue');   // WHERE ID_CLASE = 'fooValue'
     * $query->filterByIdClase('%fooValue%', Criteria::LIKE); // WHERE ID_CLASE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idClase The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByIdClase($idClase = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idClase)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID_CLASE, $idClase, $comparison);
    }

    /**
     * Filter the query on the NUM_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByNumId('fooValue');   // WHERE NUM_ID = 'fooValue'
     * $query->filterByNumId('%fooValue%', Criteria::LIKE); // WHERE NUM_ID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByNumId($numId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_NUM_ID, $numId, $comparison);
    }

    /**
     * Filter the query on the NOMBRE column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE NOMBRE = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE NOMBRE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the CTR_ACT column
     *
     * Example usage:
     * <code>
     * $query->filterByCtrAct('fooValue');   // WHERE CTR_ACT = 'fooValue'
     * $query->filterByCtrAct('%fooValue%', Criteria::LIKE); // WHERE CTR_ACT LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ctrAct The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByCtrAct($ctrAct = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ctrAct)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CTR_ACT, $ctrAct, $comparison);
    }

    /**
     * Filter the query on the ID_REG column
     *
     * Example usage:
     * <code>
     * $query->filterByIdReg('fooValue');   // WHERE ID_REG = 'fooValue'
     * $query->filterByIdReg('%fooValue%', Criteria::LIKE); // WHERE ID_REG LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idReg The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByIdReg($idReg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idReg)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID_REG, $idReg, $comparison);
    }

    /**
     * Filter the query on the VISIBLE column
     *
     * Example usage:
     * <code>
     * $query->filterByVisible('fooValue');   // WHERE VISIBLE = 'fooValue'
     * $query->filterByVisible('%fooValue%', Criteria::LIKE); // WHERE VISIBLE LIKE '%fooValue%'
     * </code>
     *
     * @param     string $visible The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visible)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_VISIBLE, $visible, $comparison);
    }

    /**
     * Filter the query on the FAX column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE FAX = 'fooValue'
     * $query->filterByFax('%fooValue%', Criteria::LIKE); // WHERE FAX LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_FAX, $fax, $comparison);
    }

    /**
     * Filter the query on the MAIL column
     *
     * Example usage:
     * <code>
     * $query->filterByMail('fooValue');   // WHERE MAIL = 'fooValue'
     * $query->filterByMail('%fooValue%', Criteria::LIKE); // WHERE MAIL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByMail($mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_MAIL, $mail, $comparison);
    }

    /**
     * Filter the query on the ACTIVIDAD column
     *
     * Example usage:
     * <code>
     * $query->filterByActividad('fooValue');   // WHERE ACTIVIDAD = 'fooValue'
     * $query->filterByActividad('%fooValue%', Criteria::LIKE); // WHERE ACTIVIDAD LIKE '%fooValue%'
     * </code>
     *
     * @param     string $actividad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByActividad($actividad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actividad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ACTIVIDAD, $actividad, $comparison);
    }

    /**
     * Filter the query on the LICENCIA column
     *
     * Example usage:
     * <code>
     * $query->filterByLicencia('fooValue');   // WHERE LICENCIA = 'fooValue'
     * $query->filterByLicencia('%fooValue%', Criteria::LIKE); // WHERE LICENCIA LIKE '%fooValue%'
     * </code>
     *
     * @param     string $licencia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByLicencia($licencia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($licencia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_LICENCIA, $licencia, $comparison);
    }

    /**
     * Filter the query on the CONTACTO column
     *
     * Example usage:
     * <code>
     * $query->filterByContacto('fooValue');   // WHERE CONTACTO = 'fooValue'
     * $query->filterByContacto('%fooValue%', Criteria::LIKE); // WHERE CONTACTO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contacto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByContacto($contacto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contacto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CONTACTO, $contacto, $comparison);
    }

    /**
     * Filter the query on the SECCION column
     *
     * Example usage:
     * <code>
     * $query->filterBySeccion('fooValue');   // WHERE SECCION = 'fooValue'
     * $query->filterBySeccion('%fooValue%', Criteria::LIKE); // WHERE SECCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seccion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterBySeccion($seccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seccion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_SECCION, $seccion, $comparison);
    }

    /**
     * Filter the query on the DIVISION column
     *
     * Example usage:
     * <code>
     * $query->filterByDivision(1234); // WHERE DIVISION = 1234
     * $query->filterByDivision(array(12, 34)); // WHERE DIVISION IN (12, 34)
     * $query->filterByDivision(array('min' => 12)); // WHERE DIVISION > 12
     * </code>
     *
     * @param     mixed $division The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDivision($division = null, $comparison = null)
    {
        if (is_array($division)) {
            $useMinMax = false;
            if (isset($division['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DIVISION, $division['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($division['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DIVISION, $division['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DIVISION, $division, $comparison);
    }

    /**
     * Filter the query on the CLASE column
     *
     * Example usage:
     * <code>
     * $query->filterByClase(1234); // WHERE CLASE = 1234
     * $query->filterByClase(array(12, 34)); // WHERE CLASE IN (12, 34)
     * $query->filterByClase(array('min' => 12)); // WHERE CLASE > 12
     * </code>
     *
     * @param     mixed $clase The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByClase($clase = null, $comparison = null)
    {
        if (is_array($clase)) {
            $useMinMax = false;
            if (isset($clase['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CLASE, $clase['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clase['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CLASE, $clase['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_CLASE, $clase, $comparison);
    }

    /**
     * Filter the query on the GRUPO column
     *
     * Example usage:
     * <code>
     * $query->filterByGrupo(1234); // WHERE GRUPO = 1234
     * $query->filterByGrupo(array(12, 34)); // WHERE GRUPO IN (12, 34)
     * $query->filterByGrupo(array('min' => 12)); // WHERE GRUPO > 12
     * </code>
     *
     * @param     mixed $grupo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByGrupo($grupo = null, $comparison = null)
    {
        if (is_array($grupo)) {
            $useMinMax = false;
            if (isset($grupo['min'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_GRUPO, $grupo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grupo['max'])) {
                $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_GRUPO, $grupo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_GRUPO, $grupo, $comparison);
    }

    /**
     * Filter the query on the DES1 column
     *
     * Example usage:
     * <code>
     * $query->filterByDes1('fooValue');   // WHERE DES1 = 'fooValue'
     * $query->filterByDes1('%fooValue%', Criteria::LIKE); // WHERE DES1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $des1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDes1($des1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($des1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DES1, $des1, $comparison);
    }

    /**
     * Filter the query on the DES2 column
     *
     * Example usage:
     * <code>
     * $query->filterByDes2('fooValue');   // WHERE DES2 = 'fooValue'
     * $query->filterByDes2('%fooValue%', Criteria::LIKE); // WHERE DES2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $des2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDes2($des2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($des2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DES2, $des2, $comparison);
    }

    /**
     * Filter the query on the DES3 column
     *
     * Example usage:
     * <code>
     * $query->filterByDes3('fooValue');   // WHERE DES3 = 'fooValue'
     * $query->filterByDes3('%fooValue%', Criteria::LIKE); // WHERE DES3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $des3 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDes3($des3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($des3)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DES3, $des3, $comparison);
    }

    /**
     * Filter the query on the DES4 column
     *
     * Example usage:
     * <code>
     * $query->filterByDes4('fooValue');   // WHERE DES4 = 'fooValue'
     * $query->filterByDes4('%fooValue%', Criteria::LIKE); // WHERE DES4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $des4 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function filterByDes4($des4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($des4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_DES4, $des4, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobEmpresaDirectorio $jobEmpresaDirectorio Object to remove from the list of results
     *
     * @return $this|ChildJobEmpresaDirectorioQuery The current query, for fluid interface
     */
    public function prune($jobEmpresaDirectorio = null)
    {
        if ($jobEmpresaDirectorio) {
            $this->addUsingAlias(JobEmpresaDirectorioTableMap::COL_ID, $jobEmpresaDirectorio->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_empresa_directorio table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobEmpresaDirectorioTableMap::clearInstancePool();
            JobEmpresaDirectorioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobEmpresaDirectorioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobEmpresaDirectorioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobEmpresaDirectorioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobEmpresaDirectorioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobEmpresaDirectorioQuery
