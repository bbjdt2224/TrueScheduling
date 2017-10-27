<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFutureEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('future_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->default("666");
            $table->text('days');
            $table->text('times');
            $table->string('name')->default(" ");
            $table->string('description');
            $table->text('responded')->nullable();
            $table->text('results')->nullable();
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
        Schema::dropIfExists('future_events');
    }
}
