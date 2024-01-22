<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMenuPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_menu_permissions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            
            $table->boolean('add')->default(0);
            $table->boolean('delete')->default(0);
            $table->boolean('update')->default(0);
            
            $table->softDeletes();
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
        Schema::dropIfExists('group_menu_permissions');
    }
}
