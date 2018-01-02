<?php

/**
 * @author ypra
 * Date: 02/12/2017
 * Time: 10:19 PM
 *
 */
class EmpresaSuscritaService extends GenericService
{

    /**
     * @var EmpresaSuscritaService
     */
    protected static $instance = null;

    /**
     * @param bool $noDeletes
     * @return JobEmpresaSuscritaQuery
     */
    public function validsQuery($noDeletes = true)
    {
        return JobEmpresaSuscritaQuery::createValids($noDeletes);
    }

    /**
     * @param $pk
     * @return array|mixed|JobEntidadSuscrita
     * @throws ChocalaException
     */
    public function findPk($pk)
    {
        $empresaSuscrita = $this->validsQuery()->findPk($pk);
        if (!is_object($empresaSuscrita)) {
            throw new ChocalaException(ChocalaErrors::INVALID_RESOURCE);
        }
        return $empresaSuscrita;
    }

    /**
     * @param array $filters
     * @return \Propel\Runtime\Util\PropelModelPager|JobEntidadSuscrita[]
     */
    public function dataList($filters = [])
    {
        $query = $this->validsQuery()
            ->_if(isset($filters['nit']))
            ->filterByNit('%' . $filters['nit'] . '%', Criteria::ILIKE)
            ->_endif()
            ->_if(isset($filters['nombre']))
            ->filterByNombre('%' . $filters['nombre'] . '%', Criteria::ILIKE)
            ->_endif()
            ->orderByNombre();
        $_page = $filters['_page'] ?: 1;
        $_max = $filters['_max'] ?: $query->count();
        return $query->paginate($_page, $_max);
    }

    /**
     * @param array $data
     * @param JobEmpresaSuscrita|null $empresaSuscrita
     * @return array mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function insertOrUpdate($data, &$empresaSuscrita = null)
    {
        if (!is_object($empresaSuscrita)) {
            $empresaSuscrita = new JobEmpresaSuscrita();
        }
        $empresaSuscrita->fromArray($data);
        $results['success'] = $empresaSuscrita->validate();
        if ($results['success']) {
            $empresaSuscrita->save();
        }
        $results['object'] = $empresaSuscrita;
        $results['errors'] = $empresaSuscrita->getErrorsMap();
        return $results;
    }


    public function insertAndNotify(array $data)
    {
        $results = $this->insertOrUpdate($data);
        if ($results['success']) {
            $empresaSuscrita = $results['object'];
            $hash = SpecialStrings::generateHash(20);
            $email = EmailService::instance()->findByCode(JobEmpresaSuscrita::EMAIL_SUBSCRIPTION);
//            $tmpArea = TmpAreaQuery::create()->findPk($suscriptor->getIdTmpArea());
//            print_r($suscriptor);
//            echo "\n Codigo : ";
//            echo $suscriptor->getIdTmpArea()."\n";
//            print_r($tmpArea); exit();
            $emailMap = [
                'TrackingHash' => $hash,
                'To' => [
                    ['Email' => $empresaSuscrita->getEmail(), 'Name' => $empresaSuscrita->getNombreSimple()],
                ],
            ];
            $emailVars = [
                '~NOMBRE_SIMPLE~' => $empresaSuscrita->getNombreSimple(),
                '~FORMACION~' => htmlspecialchars(ucwords(strtolower($empresaSuscrita->getTmpFormacion()->getNombre()))),
            ];
            $emailSent = EmailSender::instanceFrom($email)->sendMail($emailMap, $emailVars);
            $results['email'] = $emailSent->getToEmail();
        }
        return $results;
    }


    public static function logoFileExist($pkEntidad = ID_ENTITY)
    {
        return file_exists(PUBLIC_DIR . "images/imgEntidad/" . $pkEntidad . ".jpg");
    }

    public static function logoSrc($pkEntidad = ID_ENTITY)
    {
        if (!self::logoFileExist($pkEntidad)) {
            return IMG_WEB . "imgEntidad/empresa_default.jpg";
        } else {
            return IMG_WEB . "imgEntidad/" . $pkEntidad . ".jpg";
        }
    }

}