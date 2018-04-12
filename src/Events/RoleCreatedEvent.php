<?php namespace LWJ\Permission\Events;

use LWJ\Permission\Traits\SetRoleModelTrait;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class RoleCreatedEvent implements EventInterface
{

    use SerializesModels, SetRoleModelTrait;
}
