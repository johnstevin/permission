<?php

return [

    'role' => 'App\Role',

    'roles_table' => 'security_roles',

    'role_foreign_key' => 'role_id',

    'roles_groups_table'  => 'security_role_groups',

    'roles_group_foreign_key'  => 'roles_group_id',

    'roles_group_role_table'  => 'security_roles_group_role',

    'user' => 'App\User',

    'users_table' => 'users',

    'role_user_table' => 'security_role_user',

    'user_foreign_key' => 'user_id',

    'permission' => 'App\Permission',

    'permissions_table' => 'security_permissions',

    'permission_role_table' => 'security_permission_role',

    'permission_foreign_key' => 'permission_id',

    'permissions_groups_table'  => 'security_permissions_groups',

    'permissions_group_foreign_key'  => 'perms_group_id',

    'permissions_group_permission_table'  => 'security_permissions_group_permission',

];
