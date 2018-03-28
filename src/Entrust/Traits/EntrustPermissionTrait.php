<?php namespace LWJ\Permission\Traits;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package LWJ\Permission
 */

use Illuminate\Support\Facades\Config;

trait EntrustPermissionTrait
{
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('permission.role'), Config::get('permission.permission_role_table'), Config::get('permission.permission_foreign_key'), Config::get('permission.role_foreign_key'));
    }

    /**
     * Boot the permission model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the permission model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($permission) {
            if (!method_exists(Config::get('permission.permission'), 'bootSoftDeletes')) {
                $permission->roles()->sync([]);
            }

            return true;
        });
    }
}
