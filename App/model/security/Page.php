<?php
/**
 * Final node of Modules (PAGE)
 * COMPOSITE Pattern
 * @author ypra
 */
class Page
{

    /**
     * SysUri object for this page
     * @var SysUri
     */
    private $uriObject = null;

    /**
     * URI direction for this page
     * @var string
     */
    private $uri = null;

    /**
     * Title from this page presentation
     * @var string
     */
    private $title = null;

    /**
     * Type of access for users
     * @var string
     */
    private $access = 'PRIVATE';

    /**
     * Type of page
     * @var string
     */
    private $type = 'SECTION';

    /**
     * Description of the page
     * @var string
     */
    private $description = null;

    /**
     * Module from this page
     * @var Module
     */
    private $module = null;

    /**
     * Permission for create data in the page
     * @var bool
     */
    private $autCreate = false;

    /**
     * Permission for read the page
     * @var bool
     */
    private $autRead = false;

    /**
     * Permission for update datas in the page
     * @var bool
     */
    private $autUpdate = false;

    /**
     * Permission for delete datas in the page
     * @var bool
     */
    private $autDelete = false;

    /**
     *
     * @var array
     */
    private $rolesArray = array();

    /**
     *
     * @return SysUri
     */
    public function URIObject()
    {
        return $this->uriObject;

    }

    /**
     *
     * @return string
     */
    public function URI()
    {
        return $this->uri;

    }

    /**
     *
     * @param string $URI
     * @return void
     */
    public function setURI($URI)
    {
        $this->uri = $URI;
    }

    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;

    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;

    }

    /**
     *
     * @param atring $access 
     * @return void 
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;

    }

    /**
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set the module that is propietary of this page
     * @param IModule $module
     */
    public function setModule(IModule $module)
    {
        $this->module = $module;
    }

    /**
     * Returns the correspondent module to this page
     * @return Module
     */
    public function module()
    {
        return $this->module;
    }

    /**
     *
     * @return bool
     */
    public function autRead()
    {
        return $this->autRead;

    }

    /**
     *
     * @param string $autRead
     * @return void
     */
    public function setAutRead($autRead)
    {
        $this->autRead = $autRead;
    }

    /**
     *
     * @return bool
     */
    public function autCreate()
    {
        return $this->autCreate;

    }

    /**
     *
     * @param boolean $autCreate
     * @return void
     */
    public function setAutCreate($autCreate)
    {
        $this->autCreate = $autCreate;
    }

    /**
     *
     * @return bool
     */
    public function autUpdate()
    {
        return $this->autUpdate;

    }

    /**
     *
     * @param boolean $autUpdate
     * @return void
     */
    public function setAutUpdate($autUpdate)
    {
        $this->autUpdate = $autUpdate;
    }

    /**
     *
     * @return bool
     */
    public function autDelete()
    {
        return $this->autDelete;

    }

    /**
     *
     * @param boolean $autDelete
     * @return void
     */
    public function setAutDelete($autDelete)
    {
        $this->autDelete = $autDelete;
    }

    /**
     *
     * @return array
     */
    public function functionalities()
    {
        return $this->functionalities;
    }

    /**
     *
     * @return array
     */
    public function rolesArray()
    {
        return $this->rolesArray;
    }

    public function __construct() {
        
    }

    /**
     *
     * @param int $id
     * @param array $auts
     */
    public function addRole($id, $auts)
    {
        $this->rolesArray[$id] = $auts;
    }

    /**
     *
     * @param int $id
     */
    public function deleteRole($id)
    {
        unset($this->rolesArray[$id]);
    }

    /**
     *
     * @return array [null]
     */
    public function components()
    {
        return null;
    }

    /**
     * 
     * @param mixed $uri A string or an array of strings
     * @param SysUser $sysUser
     * @return Page
     */
    public static function createFrom($uri=null, SysUser $sysUser=null)
    {
        $uris = is_array($uri)? $uri: array(is_string($uri)? $uri: null);
        $sysUri = SysUriQuery::create()
                /*
                ->_if(ChocalaVars::asBoolean(Configs::value('app.run.modular')))
                ->_else()
                    ->filterByUri($uris, Criterio::IN)
                    ->withColumn("LENGTH(SysUri.uri)", "UriLenght")
                    ->orderBy("UriLenght", "desc")
                ->_endif()
                */
                ->filterByUri($uris, Criteria::IN)
                ->withColumn("LENGTH(SysUri.uri)", "UriLenght")
                ->orderBy("UriLenght", "desc")
            ->findOne();
        $page = new self();
        if(is_object($sysUri)){
            $page->uriObject = $sysUri;
            $page->uri = $sysUri->getUri();
            $page->title = $sysUri->getTitle();
            $page->access = $sysUri->getAccess();
            $page->type = $sysUri->getType();
            $page->description = $sysUri->getDescription();
            if($sysUri->getAccess()==PageConfigs::ACCESS_PUBLIC){
                $page->autRead = true;
                $page->autCreate = true;
                $page->autUpdate = true;
                $page->autDelete = true;
            }elseif($sysUri->getAccess()==PageConfigs::ACCESS_PROTECTED){
                if(is_object($sysUser)){
                    $page->autRead = true;
                    $page->autCreate = true;
                    $page->autUpdate = true;
                    $page->autDelete = true;
                }
            }elseif(is_object($sysUser)){
                $sysRolXUri = SysRolXUriQuery::create()
                        ->filterBySysUri($sysUri)
                        ->useSysRolQuery()
                            ->useSysUserXRolQuery()
                                ->filterBySysUser($sysUser)
                            ->endUse()
                        ->endUse()
                    ->find();
                if(!$sysRolXUri->isEmpty()){
                    $objs = $sysRolXUri->getData();
                    $readAuts = array_filter($objs, function($obj){
                        return $obj->getAutRead();
                    });
                    $page->autRead = !empty($readAuts);
                    $createAuts = array_filter($objs, function($obj){
                        return $obj->getAutCreate();
                    });
                    $page->autCreate = !empty($createAuts);
                    $updateAuts = array_filter($objs, function($obj){
                        return $obj->getAutUpdate();
                    });
                    $page->autUpdate = !empty($updateAuts);
                    $deleteAuts = array_filter($objs, function($obj){
                        return $obj->getAutDelete();
                    });
                    $page->autDelete = !empty($deleteAuts);
                }
            }
        }else{
            /*
            $page->setURI(PageConfigs::NO_PAGE);
            $page->setTitle(PageConfigs::NO_PAGE_TITLE);
            $page->setAccess(PageConfigs::ACCESS_PROTECTED);
            $page->setType(PageConfigs::TYPE_SECTION);
            $page->setDescription(PageConfigs::NO_PAGE_TITLE);
             */
            $page->autRead = true;
        }
        $page->module = null;
        $page->rolesArray = array();
        return $page;
    }

}