<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('permission_role', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });

        Schema::table('role_user', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::table('roles', function($table) {
            $table->foreign('created_by_user_id')->references('id')->on('users');
        });

        Schema::table('permissions', function($table) {
            $table->foreign('permission_group_id')->references('id')->on('permissions_group');
        });

    }

}
