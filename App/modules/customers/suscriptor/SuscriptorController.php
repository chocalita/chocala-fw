<?php
/**
 * Description of SuscriptorController
 *
 * @author ypra
 */
class SuscriptorController extends AdminWebController
{

    /**
     * @var SuscriptorService Injected service
     * @service SuscriptorService
     */
    protected $suscriptorService;

    /**
     * @var FormacionReferenciaService Injected service
     * @service recursos.formacionReferencia.FormacionReferenciaService
     */
    protected $formacionReferenciaService;

    /**
     * @var AreaReferenciaService Injected service
     * @service recursos.areaReferencia.AreaReferenciaService
     */
    protected $areaReferenciaService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
//        $filters['_max'] = $filters['_max']?: 20;  //comment for all results
        $suscriptorPager = $this->suscriptorService->dataList($filters);
        $this->set('suscriptorPager', $suscriptorPager);
    }

    public function show()
    {
        $area = $this->objectIfExist();
        $this->set('area', $area);
    }

    public function mailing()
    {
        $this->suscriptorService->mailing(10);
        $this->render("<strong>MAILING FINALIZADO</strong>");
    }

    public function mailingOld()
    {
        $emailService = EmailService::instance();
        $email = $emailService->findByCode(JobSuscriptor::EMAIL_NOTIFICATION_SUBSCRIBE);

        $dt = new DateTime();
        $dt->modify("-5Day");
        $mailSents = SysEmailSentQuery::create()
            ->filterBySysEmail($email)
            ->filterByShippingDate($dt, Criteria::GREATER_EQUAL)
            ->find();

        echo sizeof($mailSents)."<br />";
        print_r($mailSents);
        exit();

        $suscriptores = JobSuscriptorQuery::create()->find();
        foreach ($suscriptores as $suscriptor) {
            $formacionTmp = TmpFormacionQuery::create()->findPk($suscriptor->getIdTmpFormacion());
            $avisosDetallados = [];
            $avisosDirectos = JobAvisoQuery::create()
                    ->filterVigentes(new DateTime())
                    ->filterByFormacionesReferencia("%" . $formacionTmp->getNombre() . "%", Criteria::LIKE)
                ->find();
            $avisosDirectosIds = [];
            foreach ($avisosDirectos as $avisoDirecto) {
                $avisosDirectosIds[] = $avisoDirecto->getId();
                if (sizeof($avisosDetallados) <= 7) {
                    $avisosDetallados[] = $avisoDirecto;
                }
            }
            $avisosRelacionadosIds = [];
            if (sizeof($avisosDetallados) <= 7) {
                foreach ($formacionTmp->listaFormacionesReferencia() as $formacionReferencia) {
                    $avisosRelacionados = JobAvisoQuery::create()
                        ->filterVigentes(new DateTime())
                        ->filterByFormacionesReferencia("%" . $formacionReferencia . "%", Criteria::LIKE)
                        ->find();
                    foreach ($avisosRelacionados as $avisoRelacionado) {
                        if (!in_array($avisoRelacionado->getId(), $avisosDirectosIds)) {
                            $avisosRelacionadosIds[] = $avisoRelacionado->getId();
                        }
                    }
                }
            }
            $avisosComplementarios = JobAvisoQuery::create()
                ->filterVigentes(new DateTime())
                ->filterById($avisosRelacionadosIds, Criteria::IN)
                ->find();
            foreach ($avisosComplementarios as $avisoComplementario) {
                if (sizeof($avisosDetallados) <= 7) {
                    $avisosDetallados[] = $avisoComplementario;
                }
            }

            if (sizeof($avisosDetallados) > 1) {

                echo sizeof($avisosDirectosIds) . " y " . sizeof($avisosComplementarios) . " - " . $formacionTmp->getNombre() . " ( " . sizeof($formacionTmp->listaFormacionesReferencia()) . " ) - " . $suscriptor->getNombreSimple() . "<br />";
                $nombreSplit = explode(" ", trim($suscriptor->getNombreSimple()));
                $formacion = htmlspecialchars(ucwords(strtolower($formacionTmp->getNombre())));
                $nombre = htmlspecialchars(ucfirst(strtolower($nombreSplit[0])));
                $fraseDetalle = sizeof($avisosDirectosIds) > 1 ?
                    'Encontramos por lo menos ' . sizeof($avisosDirectosIds) . ' requerimientos de personal relacionados a tus intereses de trabajo como <strong>' .
                    $formacion . '</strong>, te detallamos algunos que te podrian resultar útiles' :
                    'En estos dias no tuvimos muchos requerimientos de personal relacionados a <strong>' . $formacion . '</strong>, sin embargo, ' .
                    ' a continuación te presentamos algunas opciones que podrian servirte de referencia';
                echo $formacion . " - " . $nombre . "<br />";
                $listDetallado = "<ul>";
                foreach ($avisosDetallados as $avisoDetallado) {
                    $listDetallado .= '<li><a href="' . WEB_ROOT . 'bolsa/trabajo/empleo/' . $avisoDetallado->getId() . '">' . htmlspecialchars($avisoDetallado->getCargo()) . '</a></li>';
                }
                $listDetallado .= "</ul>";
                echo $listDetallado;


                $hash = SpecialStrings::generateHash(20);

                $emailMap = [
                    'TrackingHash' => $hash,
                    'To' => [
                        ['Email' => $suscriptor->getEmail(), 'Name' => ucwords(strtolower($suscriptor->getNombreSimple()))],
                    ],
                ];
                $emailVars = [
                    '~NOMBRE~' => $nombre,
                    '~FRASE_DETALLE~' => $fraseDetalle,
                    '~DETALLE_AVISOS~' => $listDetallado,
                ];
                $emailSender = EmailSender::instanceFrom($email);
                $emailSent = $emailSender->sendMail($emailMap, $emailVars);
                $results['email'] = $emailSent->getToEmail();
            }
//            break;
        }
        exit();
    }

    public function create()
    {
        $areaReferenciaList = $this->areaReferenciaService->dataList();
        $formacionReferenciaList = $this->formacionReferenciaService->dataList();
        $this->set('areaReferenciaList', $areaReferenciaList);
        $this->set('formacionReferenciaList', $formacionReferenciaList);
    }

    public function save()
    {
        if (PageControl::canCreate()) {
            $data = Req::all();
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            $results = $this->formacionReferenciaService->insertOrUpdate($data);
            $this->set('formacionReferencia', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if (PageControl::canUpdate()) {
            $formacionReferencia = $this->objectIfExist();
            $areaReferenciaList = $this->areaReferenciaService->dataList();
            $formacionReferenciaList = $this->formacionReferenciaService->dataList();
            $this->set('formacionTmp', $formacionReferencia);
            $this->set('areaReferenciaList', $areaReferenciaList);
            $this->set('formacionReferenciaList', $formacionReferenciaList);
        }
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $formacionTmp = $this->objectIfExist();
            $data['AreasReferencia'] = Req::has('AreaReferencia') ?
                implode(";", Req::_('AreaReferencia')) : '';
            $data['FormacionesReferencia'] = Req::has('FormacionReferencia') ?
                implode(";", Req::_('FormacionReferencia')) : '';
            $results = $this->formacionReferenciaService->insertOrUpdate($data, $formacionTmp);
            $this->set('formacionReferencia', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function objectIfExist()
    {
        try {
            return $this->formacionReferenciaService->findPk($this->id);
        } catch (ChocalaException $che) {
            HttpManager::responseAs404();
        }
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $area = $this->objectIfExist();
            $this->areaService->delete($area);
        }
        $this->redirectTo(['action' => 'dataList']);
    }

}