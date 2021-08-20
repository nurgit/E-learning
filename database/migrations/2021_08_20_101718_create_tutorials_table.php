<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('tutorial_name')->nullable();
            $table->string('subject')->nullable();
            $table->string('details')->nullable();
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->date('date');	
            $table->integer('admin_id');
            $table->integer('status')->default(1);//0=inactive ,1= active 
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
        Schema::dropIfExists('tutorials');
    }
}
