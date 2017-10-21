<?php
Chocala::import('Model.utils.simple_html_dom');

/**
 * Description of PaginaDirectorioService
 *
 * @author ypra
 */
class PaginaDirectorioService extends GenericService
{

    const URL_BASE = "http://www.fundempresa.org.bo/directorio/";

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
     * @param string $departamento
     * @param int $numero
     * @return ScrapPagina
     */
    public function fromDepartamentoAndNumero($departamento, $numero)
    {
        return $this->validsQuery()->filterByDepartamento($departamento)->findOneByNumero($numero);
    }

    /**
     * Retorna un array de información de los departamentos, cada fila contiene el hash:
     * codigo, nombre, cantidad, numPaginas
     *
     * @return array
     */
    public function resumen()
    {
        $resumen = [];
        foreach (self::departamentos() as $kDepto => $vDepto){
            $infoDepto = ['codigo' => $kDepto, 'nombre' => $vDepto];
            $infoDepto['cantidad'] = $this->empresaDirectorioService->countFromDepartamento($kDepto);
            $infoDepto['numPaginas'] = $this->validsQuery()
                    ->filterByDepartamento($kDepto)
                    ->filterByLeido(true)
                ->count();
            $resumen[] = $infoDepto;
        }
        return $resumen;
    }

    /**
     * @param $depto
     * @param $segundos
     */
    public function leerDepartamentoTimeout($depto, $segundos)
    {
        // Tiempo final
        $finish = time() + $segundos - 2;

        $numPage = 1;
        $page = $this->validsQuery()
                ->filterByDepartamento($depto)
                ->filterByLeido(false)
                ->orderByNumero()
            ->findOne();
        if(is_object($page)){
            $numPage = $page->getNumero();
        }else{
            $lastPage = $this->validsQuery()
                    ->filterByDepartamento($depto)
                    ->filterByLeido(true)
                    ->orderByNumero(Criteria::DESC)
                ->findOne();
            if(is_object($lastPage)){
                $numPage = $lastPage->getNumero() + 1;
            }
        }
        do{
            $pagina = $this->scrapPaginaDepartamento($numPage, $depto);
            $empresasNoLeidas = $pagina->empresasNoLeidas();
            $pagina->getScrapEmpresas();
        //Time is out?
            $empresasIterator = $empresasNoLeidas->getIterator();
            $empresasNoLeidas->getFirst();
            $timeout = time() >= $finish;
            while ($empresasIterator->valid() && !$timeout){
                $empresa = $empresasIterator->current();
                $this->scrapEmpresa($empresa);
                $empresasIterator->next();
            //Time is out
                $timeout = time() >= $finish;
            }
            $pagina->reload();
            $pagina->setLeido($pagina->empresasNoLeidas()->isEmpty());
            $pagina->save();
            $numPage++;
        }while (!$timeout);

    }

    /**
     * @param int $numPage
     * @param string $depto
     * @return ScrapPagina
     */
    public function scrapPaginaDepartamento($numPage, $depto)
    {
        $con = \Propel\Runtime\Propel::getConnection();
        $htmlPage = "";
        $pagina = $this->fromDepartamentoAndNumero($depto, $numPage);
        if(is_object($pagina)){
            $htmlPage = self::readPaginaDepartamento($pagina);
//            $htmlPage = stream_get_contents($pagina->getHtml(), -1, 0);
        }else{
            $pagina = new ScrapPagina();
            $pagina->setNumero($numPage);
            $pagina->setDepartamento($depto);
        }

        if($htmlPage == ''){
            $urlPaginaDpto = "listado-de-empresas.php?page=$numPage&depto=$depto";
//            $htmlPage = file_get_contents(self::URL_BASE.$urlPaginaDpto);
            $handler = curl_init(self::URL_BASE.$urlPaginaDpto);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $htmlPage = curl_exec ($handler);
            curl_close($handler);
            self::writePaginaDepartamento($pagina, $htmlPage);
        }

        if(!$pagina->getLeido()){
            $htmlDom = simple_html_dom::str_get_html($htmlPage);
            $nodes = $htmlDom->find('div[class=empresas]');
            foreach ($nodes as $node){
//            echo $node->plaintext . '<br />';
                $names = $node->find('span[class=bold]');
                $links = $node->find('a');
                $nombre = trim($names[0]->plaintext);
                $lenght = strlen($nombre);
                $lastPos = strpos($nombre, '"', 1)+1;
                if($lenght == $lastPos){
                    $nombre = trim(str_replace('"', '', str_replace('" ', '', $nombre)));
                }
                $parts1 = explode("id=",$links[0]->href);
                $parts2 = explode("&",$parts1[1]);
                $idEmpresa = trim($parts2[0]);
                $empresa = $this->empresaDirectorioService->findByIdEmpresa($idEmpresa);
                if(!is_object($empresa)){
                    $empresa = new ScrapEmpresa();
                }
                $empresa->setNombre($nombre);
                $empresa->setIdEmpresa($idEmpresa);
                $pagina->addScrapEmpresa($empresa);
            }
        }
        $pagina->save($con);
        $con->commit();
        return $pagina;
    }

    /**
     * @param ScrapEmpresa $empresa
     * @return ScrapEmpresa
     */
    public function scrapEmpresa(ScrapEmpresa $empresa)
    {
       $urlPaginaEmpresa = "ver-mas.php?id=".$empresa->getIdEmpresa();
        if(!$empresa->getLeido()){
            $htmlPage = self::readPaginaEmpresa($empresa);
            if($htmlPage == ''){
                $htmlPage = file_get_contents(self::URL_BASE.$urlPaginaEmpresa);
                self::writePaginaEmpresa($empresa, $htmlPage);
            }
            $htmlDom = simple_html_dom::str_get_html($htmlPage);
            $nodesA = $htmlDom->find('div[class=empresaDescripcion2]');
            $nodesB = $htmlDom->find('div[class=empresaDescripcion2b]');
            $nodes = array_merge($nodesA, $nodesB);
            $arrDatos = [];
            foreach ($nodes as $node){
                $campos = $node->find('span[class=color2]');
                $campo = trim($campos[0]->plaintext);
                $datos = $node->find('div[class=empresaData]');
                $dato = trim($datos[0]->plaintext);
                if($dato == 'Informaci&oacute;n no registrada' || $dato == 'Información no registrada'){
                    $dato = null;
                }
                switch ($campo){
                    case 'N&uacute;mero de NIT:':
                        $arrDatos['Nit'] = $dato;
                        break;
                    case 'Correo electr&oacute;nico:':
                        $arrDatos['Email'] = $dato;
                        break;
                    case 'Actividad:':
                        $arrDatos['Actividad'] = $dato;
                        break;
                    case 'Matr&iacute;cula de Comercio:':
                        $arrDatos['Matricula'] = $dato;
                        break;
                    case 'Licencia de Funcionamiento:':
                        $arrDatos['Licencia'] = $dato;
                        break;
                    case 'Municipio:':
                        $arrDatos['Municipio'] = $dato;
                        break;
                    case 'Direcci&oacute;n:':
                        $arrDatos['Direccion'] = $dato;
                        break;
                    case 'Tel&eacute;fono:':
                        $arrDatos['Telefono'] = $dato;
                        break;
                    case 'Fax:':
                        $arrDatos['Fax'] = $dato;
                        break;
                    case 'Actividad general:':
                        $arrDatos['ACT_GEN'] = $dato;
                        break;
                    case 'Actividad primaria:':
                        $arrDatos['ACT_PRI'] = $dato;
                        break;
                    case 'Actividad espec&iacute;fica:':
                        $arrDatos['ACT_ESP'] = $dato;
                        break;
                    default:
                        break;
                }
            }
            $partsEsp = explode("-",$arrDatos['ACT_ESP'], 2);
            $codActEsp = trim($partsEsp[0]);
            $actividad = $this->actividadDirectorioService->findByNivelAndCodigo(3, $codActEsp);
            if(!is_object($actividad)){
                $partsPri = explode("-",$arrDatos['ACT_PRI'], 2);
                $codActPri = trim($partsPri[0]);
                $actividadPri = $this->actividadDirectorioService->findByNivelAndCodigo(2, $codActPri);
                if(!is_object($actividadPri)){
                    $actividadGen = $this->actividadDirectorioService->findByNivelAndNombre(1, $arrDatos['ACT_GEN']);
                    if(!is_object($actividadGen)){
                        $actividadGen = new ScrapActividad();
                        $actividadGen->setCodigo('G'.($this->actividadDirectorioService->countNivel(1)+1));
                        $actividadGen->setNivel(1);
                        $actividadGen->setNombre($arrDatos['ACT_GEN']?: '-');
                        $actividadGen->save();
                    }
                    $actividadPri = new ScrapActividad();
                    $actividadPri->setCodigo($codActPri);
                    $actividadPri->setCodigoPrincipal($actividadGen->getCodigo());
                    $actividadPri->setNivel(2);
                    $actividadPri->setNombre(trim($partsPri[1]));
                    $actividadPri->save();

                }
                $actividad = new ScrapActividad();
                $actividad->setCodigo($codActEsp);
                $actividad->setCodigoPrincipal($actividadPri->getCodigo());
                $actividad->setNivel(3);
                $actividad->setNombre(trim($partsEsp[1]));
                $actividad->save();
            }
            $arrDatos['IdActividad'] = $actividad->getId();
            $empresa->fromArray($arrDatos);
            $empresa->setLeido(true);
            $empresa->save();
        }
        return $empresa;
    }

    public function spider()
    {
        $data = file_get_contents("http://www.fundempresa.org.bo/directorio/listado-de-empresas.php?page=1&rubro=&depto=02&seccion=&division=&clase=&searchSW=1&radio=1&");
        file_put_contents(PUBLIC_DIR.'fundempresa-2.html', $data);
//        preg_match('|<!--BEGIN LISTADO-->(.*?)<!--END LISTADO-->|is', $data, $cap);
        preg_match('|<div class="empresas">(.*?)</span>(.*?)</div>|is', $data, $cap);
        preg_match_all('|<div class="empresas">(.*?)</span>(.*?)</div>|is', $data, $cap);
        $i=0;
        foreach ($cap[0] as $text){
            $i++;
            echo "<br /> BLOQUE $i <br />";
            echo $text;

        }
        print_r($cap); exit();
        $this->render($data);
    }

}