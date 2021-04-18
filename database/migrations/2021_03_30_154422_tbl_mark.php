<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblMark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mark', function (Blueprint $table) {
            $table->increments('mark_id');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->integer('user_id_coor');
            $table->float('mark');
            $table->string('mark_status');
            $table->string('mark_comment');
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
        Schema::dropIfExists('tbl_mark');
    }
}
