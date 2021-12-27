<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {

            $table->uuid('id')->primary()->unique();
            $table->string('title')->nullable();
            $table->uuid('permission_group_id');
            $table->integer('sort_order')->default(999999);
            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('permission_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
