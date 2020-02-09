<?php

/**
 * @author ypra
 * Date: 25/9/2018
 * Time: 10:51 PM
 *
 */
class EventUserController extends AdminWebController
{

    /**
     * @service EventUserService Injected service
     * @var EventUserService
     */
    protected $eventUserService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
        $filters['_max'] = $filters['_max'] ?: 10;
        $eventUserPager = $this->eventUserService->dataList($filters);
        $this->set('eventUserPager', $eventUserPager);
    }

    public function show()
    {
        $eventUser = $this->eventUserService->findPk($this->id);
        $this->set('eventUser', $eventUser);
    }

    public function create()
    {
        if (PageControl::canCreate()) {
            $eventUser = new SysEvent();
            $this->set('eventUser', $eventUser);
            $this->set('types', $this->eventUserService->types());
            $this->set('levels', $this->eventUserService->levels());
        }
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if (PageControl::canCreate()) {
            $results = $this->eventUserService->insertOrUpdate(Req::all());
            $this->set('event', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        $this->view->changeLayout('ajax');
        $this->render("Operaci[on no permitida");
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $this->set('success', false);
            $this->set('errors', []);
        }
        $this->renderAsJSON();
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $this->set('success', false);
            $this->set('errors', []);
        }
    }

}