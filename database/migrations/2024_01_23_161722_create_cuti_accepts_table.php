<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiAcceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti_accepts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cuti_form_id');
            $table->foreign('cuti_form_id')->references('id')->on('cuti_forms')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->string('comment');
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
        Schema::dropIfExists('cuti_accepts');
    }
}
