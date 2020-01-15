<?php
/**
 * Description of EmpresaDirectorioService
 *
 * @author ypra
 */
class EmpresaDirectorioService extends GenericService
{

    /**
     * @var EmpresaDirectorioService
     */
    protected static $instance = null;

    /**
     * @param bool $noDeletes
     * @return ScrapEmpresaQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return ScrapEmpresaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|ScrapEmpresa
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
     * @param array $filters
     * @return mixed
     */
    public function dataList($filters=[])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['idPagina']))
                ->filterByIdPagina($filters['idPagina'])
            ->_endif()
            ->_if(isset($filters['idActividad']))
                ->filterByIdActividad($filters['idActividad'])
            ->_endif()
            ->_if(isset($filters['idTipoEmpresa']))
                ->filterByIdTipoEmpresa($filters['idTipoEmpresa'])
            ->_endif()
            ->_if(isset($filters['idEmpresa']))
                ->filterByIdEmpresa('%'.$filters['idEmpresa'].'%', Criteria::LIKE)
            ->_endif()
            ->_if(isset($filters['nombre']))
                ->filterByNombre('%'.$filters['nombre'].'%', Criteria::LIKE)
            ->_endif()
            ->_if(isset($filters['departamento']))
                ->useScrapPaginaQuery()
                    ->filterByDepartamento($filters['departamento'])
                ->endUse()
            ->_endif()
            ->orderByNombre()
            ->orderByNit()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }


    /**
     * @param array $data
     * @param ScrapPagina|null $pagina
     * @return array|mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$pagina = null)
    {
        if(!is_object($pagina)){
            $pagina = new ScrapPagina();
        }
        $pagina->fromArray($data);
        $results['success'] = $pagina->validate();
        if ($results['success']) {
            $pagina->save();
        }
        $results['object'] = $pagina;
        $results['errors'] = $pagina->getErrorsMap();
        return $results;
    }

    /**
     * @param string $idEmpresa
     * @return ScrapEmpresa
     */
    public function findByIdEmpresa($idEmpresa)
    {
        return $this->validsQuery()->findOneByIdEmpresa($idEmpresa);
    }

    /**
     * @param string $departamento
     * @return int
     */
    public function countFromDepartamento($departamento)
    {
        return $this->validsQuery()
                ->useScrapPaginaQuery()
                    ->filterByDepartamento($departamento)
                ->endUse()
                ->filterByLeido(true)
            ->count();
    }

}