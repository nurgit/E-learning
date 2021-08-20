<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_tests', function (Blueprint $table) {
            $table->id();
            $table->string('return_file');
            $table->float('get_mark', 8, 2)->nullable();
            $table->date('submitin_date');	
            $table->integer('test_id');
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
        Schema::dropIfExists('return_tests');
    }
}
