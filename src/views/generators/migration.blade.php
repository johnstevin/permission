<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PermissionSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for storing roles
        Schema::create('{{ $rolesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('hierarchyId')->nullable();
            $table->bigInteger('enabled')->default(0)->comment('0：禁用，1：启用');
            $table->integer('version')->default(0);
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('{{ $roleUserTable }}', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('{{ $userKeyName }}')->on('{{ $usersTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('{{ $permissionsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('资源名称');
            $table->string('url')->comment('资源url');
            $table->string('type')->comment('资源类型');
            $table->integer('priority')->default(0)->comment('优先级');
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('enabled')->default(0)->comment('0：禁用，1：启用');
            $table->integer('version')->default(0);
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('{{ $permissionRoleTable }}', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('{{ $permissionsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('{{ $rolesGroupsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->integer('parent_id')->default(0);
            $table->integer('priority')->default(0)->comment('优先级');
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('enabled')->default(0)->comment('0：禁用，1：启用');
            $table->integer('version')->default(0);
            $table->timestamps();
        });

        Schema::create('{{ $rolesGroupRoleTable }}', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('roles_group_id')->unsigned();

            $table->foreign('roles_group_id')->references('id')->on('{{ $rolesGroupsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['roles_group_id', 'role_id']);
        });

        Schema::create('{{ $permissionsGroupsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->integer('parent_id')->default(0);
            $table->integer('priority')->default(0)->comment('优先级');
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('enabled')->default(0)->comment('0：禁用，1：启用');
            $table->integer('version')->default(0);
            $table->timestamps();
        });

        Schema::create('{{ $permissionsGroupPermissionTable }}', function (Blueprint $table) {
            $table->integer('perms_group_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->foreign('perms_group_id')->references('id')->on('{{ $permissionsGroupsTable }}')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('{{ $permissionsTable }}')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'perms_group_id']);
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{{ $permissionRoleTable }}');
        Schema::drop('{{ $permissionsTable }}');
        Schema::drop('{{ $roleUserTable }}');
        Schema::drop('{{ $rolesTable }}');
        Schema::drop('{{ $rolesGroupRoleTable }}');
        Schema::drop('{{ $rolesGroupsTable }}');
        Schema::drop('{{ $permissionsGroupsTable }}');
        Schema::drop('{{ $permissionsGroupPermissionTable }}');
    }
}
