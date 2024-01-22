<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('dynmicdate')->nullable();
            $table->string('email')->nullable();
            $table->text('activitytype')->nullable();
            $table->text('note')->nullable();
            $table->text('followtype')->nullable();
            $table->string('isintrest')->default(0);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('sheets');
    }
}
