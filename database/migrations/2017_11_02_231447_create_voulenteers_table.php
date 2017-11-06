<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoulenteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voulenteers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->default("666");
            $table->text('days');
            $table->text('times');
            $table->integer('number')->default("0");
            $table->string('name')->default(" ");
            $table->string('description')->nullable();
            $table->string('voulenteers')->nullable();
            $table->integer('creator')->default('0');
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
        Schema::dropIfExists('voulenteers');
    }
}
