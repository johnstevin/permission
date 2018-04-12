<?php namespace LWJ\Permission\Gateways;

interface ManyToManyGatewayInterface
{
  
    public function getModelName();

    public function getRelationName();

    public function getShortRelationName();
}
