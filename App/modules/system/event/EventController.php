<?php

/**
 *
 * @author ypra
 * Date: 25/9/2018
 * Time: 9:38 PM
 */
class EventController extends AdminWebController
{

    /**
     * @service EventService Injected service
     * @var EventService
     */
    protected $eventService;

    public function index()
    {
        $this->redirectTo(['action' => 'dataList']);
    }

    public function dataList()
    {
        $filters = Req::all();
        $filters['_page'] = $filters['_page'] ?: 1;
        $filters['_max'] = $filters['_max'] ?: 10;
        $eventPager = $this->eventService->dataList($filters);
        $this->set('eventPager', $eventPager);
    }

    public function show()
    {
        $event = $this->eventService->findPk($this->id);
        $this->set('event', $event);
    }

    public function create()
    {
        if (PageControl::canCreate()) {
            $event = new SysEvent();
            $this->set('event', $event);
            $this->set('types', $this->eventService->types());
            $this->set('levels', $this->eventService->levels());
        }
        $this->view->changeLayout('ajax');
    }

    public function save()
    {
        if (PageControl::canCreate()) {
            $results = $this->eventService->insertOrUpdate(Req::all());
            $this->set('event', $results['object']);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function edit()
    {
        if (PageControl::canUpdate()) {
            $event = $this->eventService->findPk($this->id);
            $this->set('event', $event);
            $this->set('types', $this->eventService->types());
            $this->set('levels', $this->eventService->levels());
        }
        $this->view->changeLayout('ajax');
    }

    public function update()
    {
        if (PageControl::canUpdate()) {
            $event = $this->eventService->findPk($this->id);
            $results = $this->eventService->insertOrUpdate(Req::all(), $event);
            $this->set('event', $event);
            $this->set('success', $results['success']);
            $this->set('errors', $results['errors']);
        }
        $this->renderAsJSON();
    }

    public function delete()
    {
        if (PageControl::canDelete()) {
            $event = $this->eventService->findPk($this->id);
            try {
                $event->delete();
                $this->redirectTo(['action' => 'dataList']);
            } catch (Exception $e) {
                $this->redirectTo(['action' => 'show',
                    'id' => $event->getPrimaryKey()]);
            }
        }
    }

}