<?php
Chocala::import("Model.utils.EmailSender");
Chocala::import("Modules.system.email.EmailService");
Chocala::import("Modules.customers.aviso.AvisoService");

/**
 * Description of SuscriptorService
 *
 * @author ypra
 */
class SuscriptorService extends GenericService
{

    const DEFAULT_INTERVAL_NOTIFICATION_DAYS = 11;

    /**
     * @var SuscriptorService
     */
    protected static $instance = null;

    /**
     * @return JobSuscriptorQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobSuscriptorQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|JobSuscriptor
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $suscriptor = $this->validsQuery()->findPk($pk);
        if (!is_object($suscriptor)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $suscriptor;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|JobSuscriptor[]
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['code']))
                ->filterByDescripcion('%' . $filters['descripcion'] . '%', Criteria::ILIKE)
            ->_endif();
        //$query = nul;
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param JobSuscriptor|null $suscriptor
     * @return array mixed
     */
    public function insertOrUpdate($data, &$suscriptor = null)
    {
        if (!is_object($suscriptor)) {
            $suscriptor = new JobSuscriptor();
            $this->prepareInsert($suscriptor);
        } else {
            $this->prepareUpdate($suscriptor);
        }
        $suscriptor->fromArray($data);
//        $area = JobAreaQuery::create()->findPk($data['AreaId']);
//        $suscriptor->setJobArea($area);
        $results['success'] = $suscriptor->validate();
        if ($results['success']) {
            $suscriptor->save();
        }
        $results['object'] = $suscriptor;
        $results['errors'] = $suscriptor->getErrorsMap();
        return $results;
    }

    public function prepareInsert($object)
    {
        parent::prepareInsert($object);
        $object->setStatus('INICIADO');
    }

    public function insertAndNotify(array $data)
    {
        $results = $this->insertOrUpdate($data);
        if ($results['success']) {
            $suscriptor = $results['object'];
            $hash = SpecialStrings::generateHash(20);
            $email = EmailService::instance()->findByCode(JobSuscriptor::EMAIL_SUBSCRIPTION_INITIAL);
            $emailMap = [
                'TrackingHash' => $hash,
                'To' => [
                    ['Email' => $suscriptor->getEmail(), 'Name' => $suscriptor->getNombreSimple()],
                ],
            ];
            $emailVars = [
                '~NOMBRE_SIMPLE~' => $suscriptor->getNombreSimple(),
                '~FORMACION~' => htmlspecialchars(ucwords(strtolower($suscriptor->getTmpFormacion()->getNombre()))),
            ];
            $emailSent = EmailSender::instanceFrom($email)->sendMail($emailMap, $emailVars);
            $results['email'] = $emailSent->getToEmail();
        }
        return $results;
    }

    public function enviarAmigo(array $data, JobAviso $aviso)
    {
        $results = ['success' => true, 'errors' => []];
        if ($results['success']) {
            if (!Validation::isMinLength($data['remitente'], 3)) {
                $results['success'] = false;
                array_push($results['errors'],
                    ['field' => 'remitente', 'message' => 'Debe ingresar un nombre de remitente válido']
                );
            }
            if (!Validation::isMinLength($data['nombre'], 3)) {
                $results['success'] = false;
                array_push($results['errors'],
                    ['field' => 'nombre', 'message' => 'Debe ingresar un nombre de amigo válido']
                );
            }
            if (!Validation::isEmail($data['email'])) {
                $results['success'] = false;
                array_push($results['errors'],
                    ['field' => 'email', 'message' => 'Debe ingresar un email válido']
                );
            }
            if (!Validation::isMinLength($data['captcha'], 4)
                || !AvisoService::instance()->verifyCaptcha($data['captcha'])) {
                $results['success'] = false;
                array_push($results['errors'],
                    ['field' => 'captcha', 'message' => 'Verificación incorrecta, intenta otra vez']
                );
            }
            if ($results['success']) {
                $linkAviso = WEB_ROOT . 'bolsa/trabajo/index/?verAviso=' . $aviso->getId();

                $hash = SpecialStrings::generateHash(20);
                $email = EmailService::instance()->findByCode(JobSuscriptor::J_EMAIL_NOTIFICATION_DISELO);
                $emailMap = [
                    'TrackingHash' => $hash,
                    'To' => [
                        ['Email' => $data['email'], 'Name' => $data['nombre']],
                    ],
                ];
                $emailVars = [
                    '~REMITENTE~' => ucwords($data['remitente']),
                    '~NOMBRE~' => ucwords($data['nombre']),
                    '~CARGO~' => htmlspecialchars($aviso->getCargo()),
                    '~NOMBRE_EMPRESA~' => htmlspecialchars($aviso->getNombreEmpresa()),
                    '~LINK_AVISO~' => $linkAviso,
                ];
                $emailSent = EmailSender::instanceFrom($email)->sendMail($emailMap, $emailVars);
                $results['email'] = $emailSent->getToEmail();
            }
        }
        return $results;
    }

    /**
     * @param int $days
     * @param null $dateBase
     * @return \Propel\Runtime\Collection\ObjectCollection|SysEmailSent[]
     */
    public function notificacionesRecientes($days , $dateBase = null)
    {
        if ($dateBase == '') {
            $dateBase = new DateUtil();
        }
        $dateBase = new DateUtil($dateBase->format('Y-m-d'));
        if ($days > 0) {
            $dateBase = $dateBase->modify("-${days} days");
        }
        echo "<br />dateBase -> ".$dateBase->format("d/M/y");
        $email = EmailService::instance()->findByCode(JobSuscriptor::EMAIL_NOTIFICATION_SUBSCRIBE);
        return SysEmailSentQuery::create()
                ->filterBySysEmail($email)
                ->filterByShippingDate($dateBase, Criteria::GREATER_EQUAL)
            ->find();
    }

    /**
     * @param int $days
     * @param null $dateBase
     * @return JobSuscriptor[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function suscriptoresNotificados($days, $dateBase = null)
    {
        $notificacionesRecientes = $this->notificacionesRecientes($days, $dateBase);
        echo "<br />Notificaciones recientes -> " .  $notificacionesRecientes->count();
        $emails = array_map(function ($item) { return $item->emailOnly(); }, $notificacionesRecientes->getArrayCopy());
        return $this->validsQuery()
                ->filterByEmail($emails, Criteria::IN)
            ->find();
    }

    /**
     * @return array
     */
    public function avisosFormacionesArray()
    {
        $results = [];
        foreach (AvisoService::instance()->listVigencia() as $aviso) {
            foreach ($aviso->listaFormacionesReferencia() as $formacionReferencia) {
                $results[$formacionReferencia] = [$aviso->getId() => $aviso];
            }
        }
        return $results;
    }

    public function mailing()
    {
        $maxToSend = EmailSender::maxBatchSizeToSend();
        $email = EmailService::instance()->findByCode(JobSuscriptor::EMAIL_NOTIFICATION_SUBSCRIBE);
        $nSent = 0;
        $suscriptoresNotificados = $this->suscriptoresNotificados(self::DEFAULT_INTERVAL_NOTIFICATION_DAYS);
        echo "<br /> Notificados -> " . $suscriptoresNotificados->count();
        $idsNotificados = array_map(function ($item) { return $item->getId(); }
            , $suscriptoresNotificados->getArrayCopy());
        $suscriptoresPosibles = $this->validsQuery()
                ->filterById($idsNotificados, Criteria::NOT_IN)
            ->find();
        echo "Posibles -> " . $suscriptoresPosibles->count();
        $avisosFormacionesArray = $this->avisosFormacionesArray();
        foreach ($suscriptoresPosibles as $suscriptorPosible) {
            $avisosDirectos = [];
            $avisosDirectosIds = [];
            $avisosComplementarios = [];
            $avisosComplementariosIds = [];
            $nombreFormacionDirecta = $suscriptorPosible->getTmpFormacion()->getNombre();

            if (isset($avisosFormacionesArray[$nombreFormacionDirecta])) {
                foreach ($avisosFormacionesArray[$nombreFormacionDirecta] as $avisoId => $aviso) {
                    $avisosDirectosIds[] = $avisoId;
                    $avisosDirectos[] = $aviso;
                }
            }

            $avisosDetallados = $avisosDirectos;

            foreach ($suscriptorPosible->getTmpFormacion()->listaFormacionesReferencia() as
                     $nombreFormacionReferencia) {
                if (isset($avisosFormacionesArray[$nombreFormacionReferencia])) {
                    foreach ($avisosFormacionesArray[$nombreFormacionReferencia] as $avisoId => $aviso) {
                        if (!in_array($avisoId, $avisosDirectosIds) && !in_array($avisoId, $avisosComplementariosIds)) {
                            $avisosComplementariosIds[] = $avisoId;
                            $avisosComplementarios[] = $aviso;
                        }
                    }
                }
            }

            foreach ($avisosComplementarios as $avisoComplementario) {
                if (sizeof($avisosDetallados) < 7) {
                    $avisosDetallados[] = $avisoComplementario;
                }
            }

            $totalRelacionados = sizeof($avisosDirectos) + sizeof($avisosComplementarios);

            if ($totalRelacionados > 1) {
                $nombreSplit = explode(" ", trim($suscriptorPosible->getNombreSimple()));
                $nombre = htmlspecialchars(ucfirst(strtolower($nombreSplit[0])));
                $nombreFormacionDirecta = htmlspecialchars($nombreFormacionDirecta);

                $fraseDetalle = sizeof($avisosDirectos) > 1 ?
                    'Encontramos por lo menos ' . $totalRelacionados . ' requerimientos de personal relacionados a tus intereses de trabajo como <strong>' .
                    $nombreFormacionDirecta . '</strong>, te detallamos algunos que te podrian resultar útiles' :
                    'En estos dias no tuvimos muchos requerimientos de personal relacionados a <strong>' . $nombreFormacionDirecta . '</strong>, sin embargo, ' .
                    'a continuación te presentamos algunas opciones que podrian servirte de referencia';

                $listDetallado = "<ul>";
                foreach ($avisosDetallados as $avisoDetallado) {
                    $listDetallado .= '<li><a href="' . WEB_ROOT . 'bolsa/trabajo/empleo/' . $avisoDetallado->getId() . '">' . htmlspecialchars($avisoDetallado->getCargo()) . '</a></li>';
                }
                $listDetallado .= "</ul>";

                echo $nombreFormacionDirecta . " - {$nombre} / {$suscriptorPosible->getEmail()} <br />";
                echo $listDetallado;

                $hash = SpecialStrings::generateHash(20);
                $emailMap = [
                    'TrackingHash' => $hash,
                    'To' => [
                        ['Email' => $suscriptorPosible->getEmail(), 'Name' => $nombre],
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
                $nSent++;
                if ($maxToSend > 0 && $nSent == $maxToSend) {
                    break;
                }
            }
        }
    }

}