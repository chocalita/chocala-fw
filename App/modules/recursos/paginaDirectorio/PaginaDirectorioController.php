<?php
Chocala::import('Model.utils.simple_html_dom');
/**
 * Description of PaginaDirectorioController
 *
 * @author ypra
 */
class PaginaDirectorioController extends AdminWebController
{

    /**
     * @var PaginaDirectorioService Injected service
     * @service PaginaDirectorioService
     */
    protected $paginaDirectorioService;

    public function index()
    {
        $departamentos = $this->paginaDirectorioService->departamentos();
        $resumenData = $this->paginaDirectorioService->resumen();
        $this->set('departamentos', $departamentos);
        $this->set('resumenData', $resumenData);
    }

    public function readPages()
    {
        $depto = Req::_('Departamento');
        $tiempo = Req::_('Tiempo');
        $departamentos = $this->paginaDirectorioService->departamentos();
        if(array_key_exists($depto, $departamentos)){
            $this->paginaDirectorioService->leerDepartamentoTimeout($depto, $tiempo);
        }
        $this->redirectTo(['action' => 'index', 'params' => ['Departamento' => $depto]]);
    }

    public function test()
    {
//        $this->paginaDirectorioService->leerDepartamentoTimeout('02', 20);
        $empresa = ScrapEmpresaQuery::createValids()->findOneByIdEmpresa('3cf74613018208cb3a762093812095ae');
        $this->paginaDirectorioService->scrapEmpresa($empresa);
        $this->render("FINALIZADO");
    }

}