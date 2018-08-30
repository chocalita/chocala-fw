<?php
Chocala::import('Model.utils.simple_html_dom');

/**
 * Description of CronsService
 *
 * @author ypra
 */
class CronsService extends GenericService
{

    const URL_BASE = "http://www.fundempresa.org.bo/directorio/";
//    const URL_BASE = "http://www.fundempresa.org.bo/directorio/Inicio/MostrarEmpresa";

    const DIR_PAGINAS = "paginasDepartamentos";

    const DIR_EMPRESAS = "paginasEmpresas";

    /**
     * @var PaginaDirectorioService
     */
    protected static $instance = null;

    /**
     * @var EmpresaDirectorioService Injected service
     * @service recursos.empresaDirectorio.EmpresaDirectorioService
     */
    public $empresaDirectorioService;

    /**
     * @var ActividadDirectorioService Injected service
     * @service recursos.actividadDirectorio.ActividadDirectorioService
     */
    public $actividadDirectorioService;

    /**
     * @return string
     */
    public static function paginasDepartamentosDir()
    {
        return PUBLIC_DIR.self::DIR_PAGINAS.DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public static function paginasEmpresasDir()
    {
        return PUBLIC_DIR.self::DIR_EMPRESAS.DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $depto
     * @param int $numPag
     * @return string
     */
    public static function fileNamePaginaDepartamento($depto, $numPag)
    {
        return self::paginasDepartamentosDir().$depto.'_'.$numPag.'.html';
    }

    /**
     * @param string $idEmpresa
     * @return string
     */
    public static function fileNamePaginaEmpresa($idEmpresa)
    {
        return self::paginasEmpresasDir().$idEmpresa.'.html';
    }

    /**
     * @param ScrapPagina $pagina
     * @return null|string
     */
    public static function readPaginaDepartamento(ScrapPagina $pagina)
    {
        $filePath = self::fileNamePaginaDepartamento($pagina->getDepartamento(), $pagina->getNumero());
        if(file_exists($filePath)){
            return file_get_contents($filePath);
        }
        return null;
    }

    /**
     * @param ScrapEmpresa $empresa
     * @return null|string
     */
    public static function readPaginaEmpresa(ScrapEmpresa $empresa)
    {
        $filePath = self::fileNamePaginaEmpresa($empresa->getIdEmpresa());
        if(file_exists($filePath)){
            return file_get_contents($filePath);
        }
        return null;
    }

    /**
     * @param ScrapPagina $pagina
     * @param string $content
     * @return int
     */
    public static function writePaginaDepartamento(ScrapPagina $pagina, $content)
    {
        return file_put_contents(self::fileNamePaginaDepartamento($pagina->getDepartamento(), $pagina->getNumero()),
            $content);
    }

    /**
     * @param ScrapEmpresa $empresa
     * @param string $content
     * @return int
     */
    public static function writePaginaEmpresa(ScrapEmpresa $empresa, $content)
    {
        return file_put_contents(self::fileNamePaginaEmpresa($empresa->getIdEmpresa()), $content);
    }

    /**
     * @param bool $noDeletes
     * @return ScrapPaginaQuery
     */
    public function validsQuery($noDeletes=true)
    {
        return ScrapPaginaQuery::createValids($noDeletes);
    }

    /**
     * Listado de departamentos
     * @return array
     */
    public static function departamentos()
    {
        return [
            '01' => 'CHUQUISACA',
            '02' => 'LA PAZ',
            '03' => 'COCHABAMBA',
            '04' => 'ORURO',
            '05' => 'POTOSI',
            '06' => 'TARIJA',
            '07' => 'SANTA CRUZ',
            '08' => 'BENI',
            '09' => 'PANDO',
            '70' => 'SANTA CRUZ'
        ];
    }

    /**
     * @param $pk
     * @return array|mixed|ScrapPagina
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $rol = $this->validsQuery()->findPk($pk);
        if (!is_object($rol)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
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
                ->_if(isset($filters['departamento']))
                    ->filterByDepartamento($filters['departamento'])
                ->_endif()
                ->_if(isset($filters['numero']))
                    ->filterByNumero($filters['numero'])
                ->_endif()
                ->orderByDepartamento()
            ->orderByNumero()
        ;
        $_page = $filters['_page']?: 1;
        $_max = $filters['_max']?: $query->count();
        return $query->paginate($_page, $_max);
    }

}