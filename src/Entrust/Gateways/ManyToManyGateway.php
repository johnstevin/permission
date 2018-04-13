<?php namespace LWJ\Permission\Gateways;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Config\Repository as Config;
use Illuminate\Events\Dispatcher;

abstract class ManyToManyGateway
{

    protected $repository;
    protected $config;
    protected $dispatcher;

    public function __construct(Config $config, BaseRepository $repository, Dispatcher $dispatcher)
    {
        $this->config = $config;
        $this->repository = $repository;
        $this->dispatcher = $dispatcher;
    }

    public function create($request)
    {
        $model = $this->repository->create($request->all());
        $model->{$this->getShortRelationName()}()->sync($request->get($this->getRelationName(), []));
        $event_class = "LWJ\Permission\Events\\".ucwords($this->getModelName()).'CreatedEvent';
        $event = new $event_class;
        $this->dispatcher->fire($event->setModel($model));
        return $model;
    }

    public function find($id)
    {
        return $this->repository->with($this->getShortRelationName())->find($id);
    }

    public function update($request, $id)
    {
        $model = $this->repository->update($request->all(), $id);
        $event_class = "LWJ\Permission\Events\\".ucwords($this->getModelName()).'UpdatedEvent';
        $event = new $event_class;
        $this->dispatcher->fire($event->setModel($model));
        return $model;
    }
}
