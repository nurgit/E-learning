<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quzs', function (Blueprint $table) {
            $table->id();
            $table->string('quz_name')->nullable();
            $table->string('instruction')->nullable();
            $table->string('file')->nullable();
            $table->float('mark', 8, 2)->nullable();
            $table->date('date');	
            $table->integer('course_teacher_id');
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
        Schema::dropIfExists('quzs');
    }
}
