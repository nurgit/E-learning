<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_notes', function (Blueprint $table) {
            $table->id();

            $table->string('note_name')->nullable();;
            $table->string('note')->nullable();
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->date('date');	
            $table->integer('Course_teacher_id');
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
        Schema::dropIfExists('lecture_notes');
    }
}
