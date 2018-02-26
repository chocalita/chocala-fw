<?php

namespace Base;

use \JobFormacionAcademica as ChildJobFormacionAcademica;
use \JobFormacionAcademicaQuery as ChildJobFormacionAcademicaQuery;
use \Exception;
use \PDO;
use Map\JobFormacionAcademicaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'job_formacion_academica' table.
 *
 *
 *
 * @method     ChildJobFormacionAcademicaQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildJobFormacionAcademicaQuery orderByIdCurriculum($order = Criteria::ASC) Order by the ID_CURRICULUM column
 * @method     ChildJobFormacionAcademicaQuery orderByIdTipoFormacion($order = Criteria::ASC) Order by the ID_TIPO_FORMACION column
 * @method     ChildJobFormacionAcademicaQuery orderByIdProfesion($order = Criteria::ASC) Order by the ID_PROFESION column
 * @method     ChildJobFormacionAcademicaQuery orderByIdInstitucion($order = Criteria::ASC) Order by the ID_INSTITUCION column
 * @method     ChildJobFormacionAcademicaQuery orderByNombreInstitucion($order = Criteria::ASC) Order by the NOMBRE_INSTITUCION column
 * @method     ChildJobFormacionAcademicaQuery orderByNombreEstudios($order = Criteria::ASC) Order by the NOMBRE_ESTUDIOS column
 * @method     ChildJobFormacionAcademicaQuery orderByNombreTitulo($order = Criteria::ASC) Order by the NOMBRE_TITULO column
 * @method     ChildJobFormacionAcademicaQuery orderByFechaInicio($order = Criteria::ASC) Order by the FECHA_INICIO column
 * @method     ChildJobFormacionAcademicaQuery orderByFechaFin($order = Criteria::ASC) Order by the FECHA_FIN column
 * @method     ChildJobFormacionAcademicaQuery orderByEstudiante($order = Criteria::ASC) Order by the ESTUDIANTE column
 * @method     ChildJobFormacionAcademicaQuery orderByEgresado($order = Criteria::ASC) Order by the EGRESADO column
 * @method     ChildJobFormacionAcademicaQuery orderByTituladoAcademico($order = Criteria::ASC) Order by the TITULADO_ACADEMICO column
 * @method     ChildJobFormacionAcademicaQuery orderByTituladoConvalidado($order = Criteria::ASC) Order by the TITULADO_CONVALIDADO column
 * @method     ChildJobFormacionAcademicaQuery orderByAniosCursados($order = Criteria::ASC) Order by the ANIOS_CURSADOS column
 * @method     ChildJobFormacionAcademicaQuery orderByDocumentoEgreso($order = Criteria::ASC) Order by the DOCUMENTO_EGRESO column
 * @method     ChildJobFormacionAcademicaQuery orderByDocumentoAcademico($order = Criteria::ASC) Order by the DOCUMENTO_ACADEMICO column
 * @method     ChildJobFormacionAcademicaQuery orderByDocumentoConvalidado($order = Criteria::ASC) Order by the DOCUMENTO_CONVALIDADO column
 * @method     ChildJobFormacionAcademicaQuery orderByFechaEgreso($order = Criteria::ASC) Order by the FECHA_EGRESO column
 * @method     ChildJobFormacionAcademicaQuery orderByFechaTitulacion($order = Criteria::ASC) Order by the FECHA_TITULACION column
 * @method     ChildJobFormacionAcademicaQuery orderByVerificaciones($order = Criteria::ASC) Order by the VERIFICACIONES column
 * @method     ChildJobFormacionAcademicaQuery orderByStatus($order = Criteria::ASC) Order by the STATUS column
 * @method     ChildJobFormacionAcademicaQuery orderByLastUserId($order = Criteria::ASC) Order by the LAST_USER_ID column
 * @method     ChildJobFormacionAcademicaQuery orderByCreationDate($order = Criteria::ASC) Order by the CREATION_DATE column
 * @method     ChildJobFormacionAcademicaQuery orderByModificationDate($order = Criteria::ASC) Order by the MODIFICATION_DATE column
 *
 * @method     ChildJobFormacionAcademicaQuery groupById() Group by the ID column
 * @method     ChildJobFormacionAcademicaQuery groupByIdCurriculum() Group by the ID_CURRICULUM column
 * @method     ChildJobFormacionAcademicaQuery groupByIdTipoFormacion() Group by the ID_TIPO_FORMACION column
 * @method     ChildJobFormacionAcademicaQuery groupByIdProfesion() Group by the ID_PROFESION column
 * @method     ChildJobFormacionAcademicaQuery groupByIdInstitucion() Group by the ID_INSTITUCION column
 * @method     ChildJobFormacionAcademicaQuery groupByNombreInstitucion() Group by the NOMBRE_INSTITUCION column
 * @method     ChildJobFormacionAcademicaQuery groupByNombreEstudios() Group by the NOMBRE_ESTUDIOS column
 * @method     ChildJobFormacionAcademicaQuery groupByNombreTitulo() Group by the NOMBRE_TITULO column
 * @method     ChildJobFormacionAcademicaQuery groupByFechaInicio() Group by the FECHA_INICIO column
 * @method     ChildJobFormacionAcademicaQuery groupByFechaFin() Group by the FECHA_FIN column
 * @method     ChildJobFormacionAcademicaQuery groupByEstudiante() Group by the ESTUDIANTE column
 * @method     ChildJobFormacionAcademicaQuery groupByEgresado() Group by the EGRESADO column
 * @method     ChildJobFormacionAcademicaQuery groupByTituladoAcademico() Group by the TITULADO_ACADEMICO column
 * @method     ChildJobFormacionAcademicaQuery groupByTituladoConvalidado() Group by the TITULADO_CONVALIDADO column
 * @method     ChildJobFormacionAcademicaQuery groupByAniosCursados() Group by the ANIOS_CURSADOS column
 * @method     ChildJobFormacionAcademicaQuery groupByDocumentoEgreso() Group by the DOCUMENTO_EGRESO column
 * @method     ChildJobFormacionAcademicaQuery groupByDocumentoAcademico() Group by the DOCUMENTO_ACADEMICO column
 * @method     ChildJobFormacionAcademicaQuery groupByDocumentoConvalidado() Group by the DOCUMENTO_CONVALIDADO column
 * @method     ChildJobFormacionAcademicaQuery groupByFechaEgreso() Group by the FECHA_EGRESO column
 * @method     ChildJobFormacionAcademicaQuery groupByFechaTitulacion() Group by the FECHA_TITULACION column
 * @method     ChildJobFormacionAcademicaQuery groupByVerificaciones() Group by the VERIFICACIONES column
 * @method     ChildJobFormacionAcademicaQuery groupByStatus() Group by the STATUS column
 * @method     ChildJobFormacionAcademicaQuery groupByLastUserId() Group by the LAST_USER_ID column
 * @method     ChildJobFormacionAcademicaQuery groupByCreationDate() Group by the CREATION_DATE column
 * @method     ChildJobFormacionAcademicaQuery groupByModificationDate() Group by the MODIFICATION_DATE column
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobFormacionAcademicaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobFormacionAcademicaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobFormacionAcademicaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobFormacionAcademicaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinJobTipoFormacion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobTipoFormacion relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinJobTipoFormacion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobTipoFormacion relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinJobTipoFormacion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobFormacionAcademicaQuery joinWithJobTipoFormacion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinWithJobTipoFormacion() Adds a LEFT JOIN clause and with to the query using the JobTipoFormacion relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinWithJobTipoFormacion() Adds a RIGHT JOIN clause and with to the query using the JobTipoFormacion relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinWithJobTipoFormacion() Adds a INNER JOIN clause and with to the query using the JobTipoFormacion relation
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinJobProfesion($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinJobProfesion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobProfesion relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinJobProfesion($relationAlias = null) Adds a INNER JOIN clause to the query using the JobProfesion relation
 *
 * @method     ChildJobFormacionAcademicaQuery joinWithJobProfesion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobProfesion relation
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinWithJobProfesion() Adds a LEFT JOIN clause and with to the query using the JobProfesion relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinWithJobProfesion() Adds a RIGHT JOIN clause and with to the query using the JobProfesion relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinWithJobProfesion() Adds a INNER JOIN clause and with to the query using the JobProfesion relation
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinJobCurriculum($relationAlias = null) Adds a LEFT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinJobCurriculum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JobCurriculum relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinJobCurriculum($relationAlias = null) Adds a INNER JOIN clause to the query using the JobCurriculum relation
 *
 * @method     ChildJobFormacionAcademicaQuery joinWithJobCurriculum($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the JobCurriculum relation
 *
 * @method     ChildJobFormacionAcademicaQuery leftJoinWithJobCurriculum() Adds a LEFT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildJobFormacionAcademicaQuery rightJoinWithJobCurriculum() Adds a RIGHT JOIN clause and with to the query using the JobCurriculum relation
 * @method     ChildJobFormacionAcademicaQuery innerJoinWithJobCurriculum() Adds a INNER JOIN clause and with to the query using the JobCurriculum relation
 *
 * @method     \JobTipoFormacionQuery|\JobProfesionQuery|\JobCurriculumQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJobFormacionAcademica findOne(ConnectionInterface $con = null) Return the first ChildJobFormacionAcademica matching the query
 * @method     ChildJobFormacionAcademica findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobFormacionAcademica matching the query, or a new ChildJobFormacionAcademica object populated from the query conditions when no match is found
 *
 * @method     ChildJobFormacionAcademica findOneById(int $ID) Return the first ChildJobFormacionAcademica filtered by the ID column
 * @method     ChildJobFormacionAcademica findOneByIdCurriculum(int $ID_CURRICULUM) Return the first ChildJobFormacionAcademica filtered by the ID_CURRICULUM column
 * @method     ChildJobFormacionAcademica findOneByIdTipoFormacion(int $ID_TIPO_FORMACION) Return the first ChildJobFormacionAcademica filtered by the ID_TIPO_FORMACION column
 * @method     ChildJobFormacionAcademica findOneByIdProfesion(int $ID_PROFESION) Return the first ChildJobFormacionAcademica filtered by the ID_PROFESION column
 * @method     ChildJobFormacionAcademica findOneByIdInstitucion(int $ID_INSTITUCION) Return the first ChildJobFormacionAcademica filtered by the ID_INSTITUCION column
 * @method     ChildJobFormacionAcademica findOneByNombreInstitucion(string $NOMBRE_INSTITUCION) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_INSTITUCION column
 * @method     ChildJobFormacionAcademica findOneByNombreEstudios(string $NOMBRE_ESTUDIOS) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_ESTUDIOS column
 * @method     ChildJobFormacionAcademica findOneByNombreTitulo(string $NOMBRE_TITULO) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_TITULO column
 * @method     ChildJobFormacionAcademica findOneByFechaInicio(string $FECHA_INICIO) Return the first ChildJobFormacionAcademica filtered by the FECHA_INICIO column
 * @method     ChildJobFormacionAcademica findOneByFechaFin(string $FECHA_FIN) Return the first ChildJobFormacionAcademica filtered by the FECHA_FIN column
 * @method     ChildJobFormacionAcademica findOneByEstudiante(boolean $ESTUDIANTE) Return the first ChildJobFormacionAcademica filtered by the ESTUDIANTE column
 * @method     ChildJobFormacionAcademica findOneByEgresado(boolean $EGRESADO) Return the first ChildJobFormacionAcademica filtered by the EGRESADO column
 * @method     ChildJobFormacionAcademica findOneByTituladoAcademico(boolean $TITULADO_ACADEMICO) Return the first ChildJobFormacionAcademica filtered by the TITULADO_ACADEMICO column
 * @method     ChildJobFormacionAcademica findOneByTituladoConvalidado(boolean $TITULADO_CONVALIDADO) Return the first ChildJobFormacionAcademica filtered by the TITULADO_CONVALIDADO column
 * @method     ChildJobFormacionAcademica findOneByAniosCursados(string $ANIOS_CURSADOS) Return the first ChildJobFormacionAcademica filtered by the ANIOS_CURSADOS column
 * @method     ChildJobFormacionAcademica findOneByDocumentoEgreso(string $DOCUMENTO_EGRESO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_EGRESO column
 * @method     ChildJobFormacionAcademica findOneByDocumentoAcademico(string $DOCUMENTO_ACADEMICO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_ACADEMICO column
 * @method     ChildJobFormacionAcademica findOneByDocumentoConvalidado(string $DOCUMENTO_CONVALIDADO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_CONVALIDADO column
 * @method     ChildJobFormacionAcademica findOneByFechaEgreso(string $FECHA_EGRESO) Return the first ChildJobFormacionAcademica filtered by the FECHA_EGRESO column
 * @method     ChildJobFormacionAcademica findOneByFechaTitulacion(string $FECHA_TITULACION) Return the first ChildJobFormacionAcademica filtered by the FECHA_TITULACION column
 * @method     ChildJobFormacionAcademica findOneByVerificaciones(int $VERIFICACIONES) Return the first ChildJobFormacionAcademica filtered by the VERIFICACIONES column
 * @method     ChildJobFormacionAcademica findOneByStatus(string $STATUS) Return the first ChildJobFormacionAcademica filtered by the STATUS column
 * @method     ChildJobFormacionAcademica findOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobFormacionAcademica filtered by the LAST_USER_ID column
 * @method     ChildJobFormacionAcademica findOneByCreationDate(string $CREATION_DATE) Return the first ChildJobFormacionAcademica filtered by the CREATION_DATE column
 * @method     ChildJobFormacionAcademica findOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobFormacionAcademica filtered by the MODIFICATION_DATE column *

 * @method     ChildJobFormacionAcademica requirePk($key, ConnectionInterface $con = null) Return the ChildJobFormacionAcademica by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOne(ConnectionInterface $con = null) Return the first ChildJobFormacionAcademica matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobFormacionAcademica requireOneById(int $ID) Return the first ChildJobFormacionAcademica filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByIdCurriculum(int $ID_CURRICULUM) Return the first ChildJobFormacionAcademica filtered by the ID_CURRICULUM column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByIdTipoFormacion(int $ID_TIPO_FORMACION) Return the first ChildJobFormacionAcademica filtered by the ID_TIPO_FORMACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByIdProfesion(int $ID_PROFESION) Return the first ChildJobFormacionAcademica filtered by the ID_PROFESION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByIdInstitucion(int $ID_INSTITUCION) Return the first ChildJobFormacionAcademica filtered by the ID_INSTITUCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByNombreInstitucion(string $NOMBRE_INSTITUCION) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_INSTITUCION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByNombreEstudios(string $NOMBRE_ESTUDIOS) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_ESTUDIOS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByNombreTitulo(string $NOMBRE_TITULO) Return the first ChildJobFormacionAcademica filtered by the NOMBRE_TITULO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByFechaInicio(string $FECHA_INICIO) Return the first ChildJobFormacionAcademica filtered by the FECHA_INICIO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByFechaFin(string $FECHA_FIN) Return the first ChildJobFormacionAcademica filtered by the FECHA_FIN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByEstudiante(boolean $ESTUDIANTE) Return the first ChildJobFormacionAcademica filtered by the ESTUDIANTE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByEgresado(boolean $EGRESADO) Return the first ChildJobFormacionAcademica filtered by the EGRESADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByTituladoAcademico(boolean $TITULADO_ACADEMICO) Return the first ChildJobFormacionAcademica filtered by the TITULADO_ACADEMICO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByTituladoConvalidado(boolean $TITULADO_CONVALIDADO) Return the first ChildJobFormacionAcademica filtered by the TITULADO_CONVALIDADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByAniosCursados(string $ANIOS_CURSADOS) Return the first ChildJobFormacionAcademica filtered by the ANIOS_CURSADOS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByDocumentoEgreso(string $DOCUMENTO_EGRESO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_EGRESO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByDocumentoAcademico(string $DOCUMENTO_ACADEMICO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_ACADEMICO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByDocumentoConvalidado(string $DOCUMENTO_CONVALIDADO) Return the first ChildJobFormacionAcademica filtered by the DOCUMENTO_CONVALIDADO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByFechaEgreso(string $FECHA_EGRESO) Return the first ChildJobFormacionAcademica filtered by the FECHA_EGRESO column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByFechaTitulacion(string $FECHA_TITULACION) Return the first ChildJobFormacionAcademica filtered by the FECHA_TITULACION column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByVerificaciones(int $VERIFICACIONES) Return the first ChildJobFormacionAcademica filtered by the VERIFICACIONES column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByStatus(string $STATUS) Return the first ChildJobFormacionAcademica filtered by the STATUS column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByLastUserId(int $LAST_USER_ID) Return the first ChildJobFormacionAcademica filtered by the LAST_USER_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByCreationDate(string $CREATION_DATE) Return the first ChildJobFormacionAcademica filtered by the CREATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobFormacionAcademica requireOneByModificationDate(string $MODIFICATION_DATE) Return the first ChildJobFormacionAcademica filtered by the MODIFICATION_DATE column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobFormacionAcademica[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobFormacionAcademica objects based on current ModelCriteria
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findById(int $ID) Return ChildJobFormacionAcademica objects filtered by the ID column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByIdCurriculum(int $ID_CURRICULUM) Return ChildJobFormacionAcademica objects filtered by the ID_CURRICULUM column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByIdTipoFormacion(int $ID_TIPO_FORMACION) Return ChildJobFormacionAcademica objects filtered by the ID_TIPO_FORMACION column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByIdProfesion(int $ID_PROFESION) Return ChildJobFormacionAcademica objects filtered by the ID_PROFESION column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByIdInstitucion(int $ID_INSTITUCION) Return ChildJobFormacionAcademica objects filtered by the ID_INSTITUCION column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByNombreInstitucion(string $NOMBRE_INSTITUCION) Return ChildJobFormacionAcademica objects filtered by the NOMBRE_INSTITUCION column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByNombreEstudios(string $NOMBRE_ESTUDIOS) Return ChildJobFormacionAcademica objects filtered by the NOMBRE_ESTUDIOS column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByNombreTitulo(string $NOMBRE_TITULO) Return ChildJobFormacionAcademica objects filtered by the NOMBRE_TITULO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByFechaInicio(string $FECHA_INICIO) Return ChildJobFormacionAcademica objects filtered by the FECHA_INICIO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByFechaFin(string $FECHA_FIN) Return ChildJobFormacionAcademica objects filtered by the FECHA_FIN column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByEstudiante(boolean $ESTUDIANTE) Return ChildJobFormacionAcademica objects filtered by the ESTUDIANTE column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByEgresado(boolean $EGRESADO) Return ChildJobFormacionAcademica objects filtered by the EGRESADO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByTituladoAcademico(boolean $TITULADO_ACADEMICO) Return ChildJobFormacionAcademica objects filtered by the TITULADO_ACADEMICO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByTituladoConvalidado(boolean $TITULADO_CONVALIDADO) Return ChildJobFormacionAcademica objects filtered by the TITULADO_CONVALIDADO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByAniosCursados(string $ANIOS_CURSADOS) Return ChildJobFormacionAcademica objects filtered by the ANIOS_CURSADOS column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByDocumentoEgreso(string $DOCUMENTO_EGRESO) Return ChildJobFormacionAcademica objects filtered by the DOCUMENTO_EGRESO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByDocumentoAcademico(string $DOCUMENTO_ACADEMICO) Return ChildJobFormacionAcademica objects filtered by the DOCUMENTO_ACADEMICO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByDocumentoConvalidado(string $DOCUMENTO_CONVALIDADO) Return ChildJobFormacionAcademica objects filtered by the DOCUMENTO_CONVALIDADO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByFechaEgreso(string $FECHA_EGRESO) Return ChildJobFormacionAcademica objects filtered by the FECHA_EGRESO column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByFechaTitulacion(string $FECHA_TITULACION) Return ChildJobFormacionAcademica objects filtered by the FECHA_TITULACION column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByVerificaciones(int $VERIFICACIONES) Return ChildJobFormacionAcademica objects filtered by the VERIFICACIONES column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByStatus(string $STATUS) Return ChildJobFormacionAcademica objects filtered by the STATUS column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByLastUserId(int $LAST_USER_ID) Return ChildJobFormacionAcademica objects filtered by the LAST_USER_ID column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByCreationDate(string $CREATION_DATE) Return ChildJobFormacionAcademica objects filtered by the CREATION_DATE column
 * @method     ChildJobFormacionAcademica[]|ObjectCollection findByModificationDate(string $MODIFICATION_DATE) Return ChildJobFormacionAcademica objects filtered by the MODIFICATION_DATE column
 * @method     ChildJobFormacionAcademica[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobFormacionAcademicaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JobFormacionAcademicaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\JobFormacionAcademica', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobFormacionAcademicaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobFormacionAcademicaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobFormacionAcademicaQuery) {
            return $criteria;
        }
        $query = new ChildJobFormacionAcademicaQuery();
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
     * @return ChildJobFormacionAcademica|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JobFormacionAcademicaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJobFormacionAcademica A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, ID_CURRICULUM, ID_TIPO_FORMACION, ID_PROFESION, ID_INSTITUCION, NOMBRE_INSTITUCION, NOMBRE_ESTUDIOS, NOMBRE_TITULO, FECHA_INICIO, FECHA_FIN, ESTUDIANTE, EGRESADO, TITULADO_ACADEMICO, TITULADO_CONVALIDADO, ANIOS_CURSADOS, DOCUMENTO_EGRESO, DOCUMENTO_ACADEMICO, DOCUMENTO_CONVALIDADO, FECHA_EGRESO, FECHA_TITULACION, VERIFICACIONES, STATUS, LAST_USER_ID, CREATION_DATE, MODIFICATION_DATE FROM job_formacion_academica WHERE ID = :p0';
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
            /** @var ChildJobFormacionAcademica $obj */
            $obj = new ChildJobFormacionAcademica();
            $obj->hydrate($row);
            JobFormacionAcademicaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJobFormacionAcademica|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the ID_CURRICULUM column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCurriculum(1234); // WHERE ID_CURRICULUM = 1234
     * $query->filterByIdCurriculum(array(12, 34)); // WHERE ID_CURRICULUM IN (12, 34)
     * $query->filterByIdCurriculum(array('min' => 12)); // WHERE ID_CURRICULUM > 12
     * </code>
     *
     * @see       filterByJobCurriculum()
     *
     * @param     mixed $idCurriculum The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByIdCurriculum($idCurriculum = null, $comparison = null)
    {
        if (is_array($idCurriculum)) {
            $useMinMax = false;
            if (isset($idCurriculum['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $idCurriculum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCurriculum['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $idCurriculum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $idCurriculum, $comparison);
    }

    /**
     * Filter the query on the ID_TIPO_FORMACION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTipoFormacion(1234); // WHERE ID_TIPO_FORMACION = 1234
     * $query->filterByIdTipoFormacion(array(12, 34)); // WHERE ID_TIPO_FORMACION IN (12, 34)
     * $query->filterByIdTipoFormacion(array('min' => 12)); // WHERE ID_TIPO_FORMACION > 12
     * </code>
     *
     * @see       filterByJobTipoFormacion()
     *
     * @param     mixed $idTipoFormacion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByIdTipoFormacion($idTipoFormacion = null, $comparison = null)
    {
        if (is_array($idTipoFormacion)) {
            $useMinMax = false;
            if (isset($idTipoFormacion['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTipoFormacion['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $idTipoFormacion, $comparison);
    }

    /**
     * Filter the query on the ID_PROFESION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProfesion(1234); // WHERE ID_PROFESION = 1234
     * $query->filterByIdProfesion(array(12, 34)); // WHERE ID_PROFESION IN (12, 34)
     * $query->filterByIdProfesion(array('min' => 12)); // WHERE ID_PROFESION > 12
     * </code>
     *
     * @see       filterByJobProfesion()
     *
     * @param     mixed $idProfesion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByIdProfesion($idProfesion = null, $comparison = null)
    {
        if (is_array($idProfesion)) {
            $useMinMax = false;
            if (isset($idProfesion['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $idProfesion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProfesion['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $idProfesion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $idProfesion, $comparison);
    }

    /**
     * Filter the query on the ID_INSTITUCION column
     *
     * Example usage:
     * <code>
     * $query->filterByIdInstitucion(1234); // WHERE ID_INSTITUCION = 1234
     * $query->filterByIdInstitucion(array(12, 34)); // WHERE ID_INSTITUCION IN (12, 34)
     * $query->filterByIdInstitucion(array('min' => 12)); // WHERE ID_INSTITUCION > 12
     * </code>
     *
     * @param     mixed $idInstitucion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByIdInstitucion($idInstitucion = null, $comparison = null)
    {
        if (is_array($idInstitucion)) {
            $useMinMax = false;
            if (isset($idInstitucion['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION, $idInstitucion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idInstitucion['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION, $idInstitucion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_INSTITUCION, $idInstitucion, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_INSTITUCION column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreInstitucion('fooValue');   // WHERE NOMBRE_INSTITUCION = 'fooValue'
     * $query->filterByNombreInstitucion('%fooValue%', Criteria::LIKE); // WHERE NOMBRE_INSTITUCION LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreInstitucion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByNombreInstitucion($nombreInstitucion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreInstitucion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_NOMBRE_INSTITUCION, $nombreInstitucion, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_ESTUDIOS column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreEstudios('fooValue');   // WHERE NOMBRE_ESTUDIOS = 'fooValue'
     * $query->filterByNombreEstudios('%fooValue%', Criteria::LIKE); // WHERE NOMBRE_ESTUDIOS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreEstudios The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByNombreEstudios($nombreEstudios = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreEstudios)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_NOMBRE_ESTUDIOS, $nombreEstudios, $comparison);
    }

    /**
     * Filter the query on the NOMBRE_TITULO column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreTitulo('fooValue');   // WHERE NOMBRE_TITULO = 'fooValue'
     * $query->filterByNombreTitulo('%fooValue%', Criteria::LIKE); // WHERE NOMBRE_TITULO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreTitulo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByNombreTitulo($nombreTitulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreTitulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_NOMBRE_TITULO, $nombreTitulo, $comparison);
    }

    /**
     * Filter the query on the FECHA_INICIO column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaInicio('2011-03-14'); // WHERE FECHA_INICIO = '2011-03-14'
     * $query->filterByFechaInicio('now'); // WHERE FECHA_INICIO = '2011-03-14'
     * $query->filterByFechaInicio(array('max' => 'yesterday')); // WHERE FECHA_INICIO > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaInicio The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByFechaInicio($fechaInicio = null, $comparison = null)
    {
        if (is_array($fechaInicio)) {
            $useMinMax = false;
            if (isset($fechaInicio['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_INICIO, $fechaInicio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaInicio['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_INICIO, $fechaInicio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_INICIO, $fechaInicio, $comparison);
    }

    /**
     * Filter the query on the FECHA_FIN column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaFin('2011-03-14'); // WHERE FECHA_FIN = '2011-03-14'
     * $query->filterByFechaFin('now'); // WHERE FECHA_FIN = '2011-03-14'
     * $query->filterByFechaFin(array('max' => 'yesterday')); // WHERE FECHA_FIN > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaFin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByFechaFin($fechaFin = null, $comparison = null)
    {
        if (is_array($fechaFin)) {
            $useMinMax = false;
            if (isset($fechaFin['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_FIN, $fechaFin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaFin['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_FIN, $fechaFin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_FIN, $fechaFin, $comparison);
    }

    /**
     * Filter the query on the ESTUDIANTE column
     *
     * Example usage:
     * <code>
     * $query->filterByEstudiante(true); // WHERE ESTUDIANTE = true
     * $query->filterByEstudiante('yes'); // WHERE ESTUDIANTE = true
     * </code>
     *
     * @param     boolean|string $estudiante The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByEstudiante($estudiante = null, $comparison = null)
    {
        if (is_string($estudiante)) {
            $estudiante = in_array(strtolower($estudiante), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ESTUDIANTE, $estudiante, $comparison);
    }

    /**
     * Filter the query on the EGRESADO column
     *
     * Example usage:
     * <code>
     * $query->filterByEgresado(true); // WHERE EGRESADO = true
     * $query->filterByEgresado('yes'); // WHERE EGRESADO = true
     * </code>
     *
     * @param     boolean|string $egresado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByEgresado($egresado = null, $comparison = null)
    {
        if (is_string($egresado)) {
            $egresado = in_array(strtolower($egresado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_EGRESADO, $egresado, $comparison);
    }

    /**
     * Filter the query on the TITULADO_ACADEMICO column
     *
     * Example usage:
     * <code>
     * $query->filterByTituladoAcademico(true); // WHERE TITULADO_ACADEMICO = true
     * $query->filterByTituladoAcademico('yes'); // WHERE TITULADO_ACADEMICO = true
     * </code>
     *
     * @param     boolean|string $tituladoAcademico The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByTituladoAcademico($tituladoAcademico = null, $comparison = null)
    {
        if (is_string($tituladoAcademico)) {
            $tituladoAcademico = in_array(strtolower($tituladoAcademico), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_TITULADO_ACADEMICO, $tituladoAcademico, $comparison);
    }

    /**
     * Filter the query on the TITULADO_CONVALIDADO column
     *
     * Example usage:
     * <code>
     * $query->filterByTituladoConvalidado(true); // WHERE TITULADO_CONVALIDADO = true
     * $query->filterByTituladoConvalidado('yes'); // WHERE TITULADO_CONVALIDADO = true
     * </code>
     *
     * @param     boolean|string $tituladoConvalidado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByTituladoConvalidado($tituladoConvalidado = null, $comparison = null)
    {
        if (is_string($tituladoConvalidado)) {
            $tituladoConvalidado = in_array(strtolower($tituladoConvalidado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_TITULADO_CONVALIDADO, $tituladoConvalidado, $comparison);
    }

    /**
     * Filter the query on the ANIOS_CURSADOS column
     *
     * Example usage:
     * <code>
     * $query->filterByAniosCursados('fooValue');   // WHERE ANIOS_CURSADOS = 'fooValue'
     * $query->filterByAniosCursados('%fooValue%', Criteria::LIKE); // WHERE ANIOS_CURSADOS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $aniosCursados The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByAniosCursados($aniosCursados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($aniosCursados)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ANIOS_CURSADOS, $aniosCursados, $comparison);
    }

    /**
     * Filter the query on the DOCUMENTO_EGRESO column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentoEgreso('fooValue');   // WHERE DOCUMENTO_EGRESO = 'fooValue'
     * $query->filterByDocumentoEgreso('%fooValue%', Criteria::LIKE); // WHERE DOCUMENTO_EGRESO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documentoEgreso The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByDocumentoEgreso($documentoEgreso = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentoEgreso)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_DOCUMENTO_EGRESO, $documentoEgreso, $comparison);
    }

    /**
     * Filter the query on the DOCUMENTO_ACADEMICO column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentoAcademico('fooValue');   // WHERE DOCUMENTO_ACADEMICO = 'fooValue'
     * $query->filterByDocumentoAcademico('%fooValue%', Criteria::LIKE); // WHERE DOCUMENTO_ACADEMICO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documentoAcademico The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByDocumentoAcademico($documentoAcademico = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentoAcademico)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_DOCUMENTO_ACADEMICO, $documentoAcademico, $comparison);
    }

    /**
     * Filter the query on the DOCUMENTO_CONVALIDADO column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentoConvalidado('fooValue');   // WHERE DOCUMENTO_CONVALIDADO = 'fooValue'
     * $query->filterByDocumentoConvalidado('%fooValue%', Criteria::LIKE); // WHERE DOCUMENTO_CONVALIDADO LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documentoConvalidado The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByDocumentoConvalidado($documentoConvalidado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentoConvalidado)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_DOCUMENTO_CONVALIDADO, $documentoConvalidado, $comparison);
    }

    /**
     * Filter the query on the FECHA_EGRESO column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaEgreso('2011-03-14'); // WHERE FECHA_EGRESO = '2011-03-14'
     * $query->filterByFechaEgreso('now'); // WHERE FECHA_EGRESO = '2011-03-14'
     * $query->filterByFechaEgreso(array('max' => 'yesterday')); // WHERE FECHA_EGRESO > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaEgreso The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByFechaEgreso($fechaEgreso = null, $comparison = null)
    {
        if (is_array($fechaEgreso)) {
            $useMinMax = false;
            if (isset($fechaEgreso['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO, $fechaEgreso['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaEgreso['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO, $fechaEgreso['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_EGRESO, $fechaEgreso, $comparison);
    }

    /**
     * Filter the query on the FECHA_TITULACION column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaTitulacion('2011-03-14'); // WHERE FECHA_TITULACION = '2011-03-14'
     * $query->filterByFechaTitulacion('now'); // WHERE FECHA_TITULACION = '2011-03-14'
     * $query->filterByFechaTitulacion(array('max' => 'yesterday')); // WHERE FECHA_TITULACION > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaTitulacion The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByFechaTitulacion($fechaTitulacion = null, $comparison = null)
    {
        if (is_array($fechaTitulacion)) {
            $useMinMax = false;
            if (isset($fechaTitulacion['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION, $fechaTitulacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaTitulacion['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION, $fechaTitulacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_FECHA_TITULACION, $fechaTitulacion, $comparison);
    }

    /**
     * Filter the query on the VERIFICACIONES column
     *
     * Example usage:
     * <code>
     * $query->filterByVerificaciones(1234); // WHERE VERIFICACIONES = 1234
     * $query->filterByVerificaciones(array(12, 34)); // WHERE VERIFICACIONES IN (12, 34)
     * $query->filterByVerificaciones(array('min' => 12)); // WHERE VERIFICACIONES > 12
     * </code>
     *
     * @param     mixed $verificaciones The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByVerificaciones($verificaciones = null, $comparison = null)
    {
        if (is_array($verificaciones)) {
            $useMinMax = false;
            if (isset($verificaciones['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_VERIFICACIONES, $verificaciones['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verificaciones['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_VERIFICACIONES, $verificaciones['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_VERIFICACIONES, $verificaciones, $comparison);
    }

    /**
     * Filter the query on the STATUS column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE STATUS = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE STATUS LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the LAST_USER_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUserId(1234); // WHERE LAST_USER_ID = 1234
     * $query->filterByLastUserId(array(12, 34)); // WHERE LAST_USER_ID IN (12, 34)
     * $query->filterByLastUserId(array('min' => 12)); // WHERE LAST_USER_ID > 12
     * </code>
     *
     * @param     mixed $lastUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByLastUserId($lastUserId = null, $comparison = null)
    {
        if (is_array($lastUserId)) {
            $useMinMax = false;
            if (isset($lastUserId['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_LAST_USER_ID, $lastUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUserId['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_LAST_USER_ID, $lastUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_LAST_USER_ID, $lastUserId, $comparison);
    }

    /**
     * Filter the query on the CREATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE CREATION_DATE = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE CREATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the MODIFICATION_DATE column
     *
     * Example usage:
     * <code>
     * $query->filterByModificationDate('2011-03-14'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate('now'); // WHERE MODIFICATION_DATE = '2011-03-14'
     * $query->filterByModificationDate(array('max' => 'yesterday')); // WHERE MODIFICATION_DATE > '2011-03-13'
     * </code>
     *
     * @param     mixed $modificationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByModificationDate($modificationDate = null, $comparison = null)
    {
        if (is_array($modificationDate)) {
            $useMinMax = false;
            if (isset($modificationDate['min'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE, $modificationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modificationDate['max'])) {
                $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE, $modificationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_MODIFICATION_DATE, $modificationDate, $comparison);
    }

    /**
     * Filter the query by a related \JobTipoFormacion object
     *
     * @param \JobTipoFormacion|ObjectCollection $jobTipoFormacion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByJobTipoFormacion($jobTipoFormacion, $comparison = null)
    {
        if ($jobTipoFormacion instanceof \JobTipoFormacion) {
            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $jobTipoFormacion->getId(), $comparison);
        } elseif ($jobTipoFormacion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_TIPO_FORMACION, $jobTipoFormacion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobTipoFormacion() only accepts arguments of type \JobTipoFormacion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobTipoFormacion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function joinJobTipoFormacion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobTipoFormacion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'JobTipoFormacion');
        }

        return $this;
    }

    /**
     * Use the JobTipoFormacion relation JobTipoFormacion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobTipoFormacionQuery A secondary query class using the current class as primary query
     */
    public function useJobTipoFormacionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobTipoFormacion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobTipoFormacion', '\JobTipoFormacionQuery');
    }

    /**
     * Filter the query by a related \JobProfesion object
     *
     * @param \JobProfesion|ObjectCollection $jobProfesion The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByJobProfesion($jobProfesion, $comparison = null)
    {
        if ($jobProfesion instanceof \JobProfesion) {
            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $jobProfesion->getId(), $comparison);
        } elseif ($jobProfesion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_PROFESION, $jobProfesion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobProfesion() only accepts arguments of type \JobProfesion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobProfesion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function joinJobProfesion($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobProfesion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'JobProfesion');
        }

        return $this;
    }

    /**
     * Use the JobProfesion relation JobProfesion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobProfesionQuery A secondary query class using the current class as primary query
     */
    public function useJobProfesionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJobProfesion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobProfesion', '\JobProfesionQuery');
    }

    /**
     * Filter the query by a related \JobCurriculum object
     *
     * @param \JobCurriculum|ObjectCollection $jobCurriculum The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function filterByJobCurriculum($jobCurriculum, $comparison = null)
    {
        if ($jobCurriculum instanceof \JobCurriculum) {
            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $jobCurriculum->getId(), $comparison);
        } elseif ($jobCurriculum instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID_CURRICULUM, $jobCurriculum->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJobCurriculum() only accepts arguments of type \JobCurriculum or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JobCurriculum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function joinJobCurriculum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JobCurriculum');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'JobCurriculum');
        }

        return $this;
    }

    /**
     * Use the JobCurriculum relation JobCurriculum object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JobCurriculumQuery A secondary query class using the current class as primary query
     */
    public function useJobCurriculumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJobCurriculum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JobCurriculum', '\JobCurriculumQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobFormacionAcademica $jobFormacionAcademica Object to remove from the list of results
     *
     * @return $this|ChildJobFormacionAcademicaQuery The current query, for fluid interface
     */
    public function prune($jobFormacionAcademica = null)
    {
        if ($jobFormacionAcademica) {
            $this->addUsingAlias(JobFormacionAcademicaTableMap::COL_ID, $jobFormacionAcademica->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job_formacion_academica table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobFormacionAcademicaTableMap::clearInstancePool();
            JobFormacionAcademicaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobFormacionAcademicaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobFormacionAcademicaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobFormacionAcademicaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobFormacionAcademicaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobFormacionAcademicaQuery
