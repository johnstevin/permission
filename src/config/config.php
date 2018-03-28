<?php

return [

    'role' => 'App\Role',

    'roles_table' => 'security_roles',

    'role_foreign_key' => 'role_id',

    'user' => 'App\User',

    'users_table' => 'users',

    'role_user_table' => 'security_role_user',

    'user_foreign_key' => 'user_id',

    'permission' => 'App\Permission',

    'permissions_table' => 'security_permissions',

    'permission_role_table' => 'security_permission_role',

    'permission_foreign_key' => 'permission_id',
];
