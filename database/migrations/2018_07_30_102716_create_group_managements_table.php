<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->nullable()->dafault(0)->comment="0-Inactive, 1-Active";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_managements');
    }
}
