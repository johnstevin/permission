<?php namespace LWJ\Permission\Gateways;

use LWJ\Permission\Repositories\RoleRepository;
use Illuminate\Config\Repository as Config;
use Illuminate\Events\Dispatcher;

class RoleGateway extends ManyToManyGateway implements ManyToManyGatewayInterface
{

    public function __construct(Config $config, RoleRepository $repository, Dispatcher $dispatcher)
    {
        parent::__construct($config, $repository, $dispatcher);
    }
}
