<?php
/**
 * Description of DirectorioDBController
 *
 * @author ypra
 */
class DirectorioDBController extends WebController
{

    /**
     * @var DirectorioDBService Injected service
     * @service DirectorioDBService
     */
    protected $directorioDBService;

    public function index()
    {
        $this->redirectTo(['action' => 'resume']);
    }

    public function resume()
    {
        $resultsDpto = $this->directorioDBService->resumeDpto();
        $resultsTps = $this->directorioDBService->resumeTPS();
        $this->set('resultsDpto', $resultsDpto);
        $this->set('resultsTps', $resultsTps);
    }

    public function mailing()
    {
        $this->directorioDBService->mailing();
        $this->render("FINISHED!");
//        $resultsDpto = $this->directorioDBService->resumeDpto();
//        $resultsTps = $this->directorioDBService->resumeTPS();
//        $this->set('resultsDpto', $resultsDpto);
//        $this->set('resultsTps', $resultsTps);
//        print_r($results)
//        exit();
    }

}