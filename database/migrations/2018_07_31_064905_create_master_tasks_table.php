<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('group_managements_id')->nullable();
            $table->integer('task_managements_id')->nullable();
            $table->boolean('is_active')->nullable()->dafault(0)->comment="0-Inactive, 1-Active";
            $table->integer('users_id')->nullable();
            $table->datetime('completed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('master_tasks');
    }
}
