<?php
class EntidadUsuarioService extends GenericService
{

    /**
     * @var EntidadUsuarioService
     */
    protected static $instance = null;

    public function findPk($pk)
    {
        return SysUserQuery::create()->findOneById($pk);
    }

    public function saveOrUpdate($data, $creation =true)
    {
        /** @var $object SysUser*/
        if (isset($data["pk"])) {
            $object = $this->findPk($data["pk"]);
            $this->setModificationData($object);
        } elseif($creation) {
            $object = new SysUser();
            $this->setCreationData($object);
        }
        if (is_object($object)){
            $object->setUsername(strtolower($data['username']));
            $object->setEmail(strtolower($data['email']));
            if (isset($data['firstName']) && $data['firstName'] != '') {
                $object->setFirstName(strtoupper($data['firstName']));
            }
            if (isset($data['secondName']) && $data['secondName'] != '') {
                $object->setSecondName(strtoupper($data['secondName']));
            }
            if (isset($data['firstLastname']) && $data['firstLastname'] != '') {
                $object->setFirstLastname(strtoupper($data['firstLastname']));
            }
            if (isset($data['secondLastname']) && $data['secondLastname'] != '') {
                $object->setSecondLastname(strtoupper($data['secondLastname']));
            }
            $object->setDni($data['dni']);
            $object->getBirthDate(DateUtil::mysql($data['birthday']));
            $object->setGender($data['gender']);
            $object->setAddress($data['address']);
            $object->setPrimaryPhone($data['primaryPhone']);
            $object->setCellPhone($data['cellPhone']);
                $object->save();
                return $object;
        }
        return false;
    }

    public function dataList($username, $nombre, $idSucursal, $estado)
    {
        $usuarioList = SysUserQuery::create()
            ->useConUsuarioEntidadQuery()
                ->filterByEstado(ChocalaBaseModel::DELETED, Criteria::NOT_EQUAL)
                ->filterByIdEntidad(ID_ENTITY)
            ->endUse();
        if ($estado && $estado != '') {
            $usuarioList = $usuarioList->filterByStatus($estado);
        }
        if ($idSucursal && $idSucursal != '') {
            $usuarioList = $usuarioList
                ->useConUsuarioEntidadQuery()
                ->useConUsuarioSucursalQuery()
                ->filterByIdSucursal($idSucursal)
                ->endUse()
                ->endUse();
        }
        if ($username && $username != '') {
            $usuarioList = $usuarioList->filterByUsername($username);
        }
        if ($nombre && $nombre != '') {
            $usuarioList = $usuarioList
                ->where('SysUser.FirstName' . ' LIKE ?', '%' . $nombre . '%')
                ->orWhere('SysUser.SecondName' . ' LIKE ?', '%' . $nombre . '%')
                ->orWhere('SysUser.FirstLastName' . ' LIKE ?', '%' . $nombre . '%')
                ->orWhere('SysUser.SecondLastName' . ' LIKE ?', '%' . $nombre . '%');
        }
        $usuarioList = $usuarioList->find();
        return $usuarioList;
    }

    public function enumEstado(){
        $aEstado = SysUser::statusMap('ES');
        return $aEstado;
    }
} 