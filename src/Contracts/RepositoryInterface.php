<?php namespace LWJ\Permission\Contracts;

interface RepositoryInterface {

    public function getModelName();

    public function getRelationName();

    public function getShortRelationName();

}
