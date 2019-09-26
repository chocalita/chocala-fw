<?php

/**
 * Description of SicoesController
 *
 * @author ypra
 * @date 5/5/2019
 * @time 14:38
 */
class SicoesController extends AdminWebController
{


    /**
     * @var SicoesService Injected service
     * @service customers.sicoes.SicoesService
     */
    protected $sicoesService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $this->sicoesService->asas();
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
//        $listVigentes = $this->avisoService->listVigentes();
//        $listNoVigentes = $this->avisoService->listVigentes(false);
        $sicoesPager = $this->sicoesService->dataList($filters);
        $this->set('sicoesPager', $sicoesPager);
//        $this->set('listVigentes', $listVigentes);
//        $this->set('listNoVigentes', $listNoVigentes);
    }

}