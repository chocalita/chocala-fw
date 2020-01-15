<?php

/**
 * Description of EmpresaDirectorioService
 *
 * @author ypra
 */
class ActividadDirectorioService extends GenericService
{

    /**
     * @var ActividadDirectorioService
     */
    protected static $instance = null;

    /**
     * @param bool $noDeletes
     * @return ScrapActividadQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return ScrapActividadQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|ScrapActividad
     * @throws NotFoundException
     */
    public function findPk($pk)
    {
        $rol = $this->validsQuery()->findPk($pk);
        if (!is_object($rol)) {
            throw new NotFoundException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $rol;
    }

    /**
     * @param int $nivel
     * @param string $codigo
     * @return ScrapActividad
     */
    public function findByNivelAndCodigo($nivel, $codigo)
    {
        return $this->validsQuery()->filterByNivel($nivel)->filterByCodigo($codigo)->findOne();
    }

    /**
     * @param int $nivel
     * @param string $nombre
     * @return ScrapActividad
     */
    public function findByNivelAndNombre($nivel, $nombre)
    {
        return $this->validsQuery()->filterByNivel($nivel)->filterByNombre($nombre)->findOne();
    }

    /**
     * @param int $nivel
     * @return int
     */
    public function countNivel($nivel)
    {
        return $this->validsQuery()->filterByNivel($nivel)->count();
    }

}