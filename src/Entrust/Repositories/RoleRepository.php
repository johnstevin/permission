<?php

namespace LWJ\Permission\Repositories;

use LWJ\Permission\Contracts\RepositoryInterface;


interface RoleRepository extends RepositoryInterface
{

    public function getModelName();

    public function getRelationName();

    public function getShortRelationName();
}
