<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('calls', function (Blueprint $table) {

            $table->id('call_id');
            $table->unsignedBigInteger('queue_id')->nullable();
            $table->foreign('queue_id')->references('queue_id')->on('queues');

            $table->unsignedBigInteger('counter_id')->nullable();
            $table->foreign('counter_id')->references('id')->on('counters');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

        
            $table->timestamps();

        });
        // Schema::table('calls', function(Blueprint $table)
        // {

        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // $table->engine = 'InnoDB';
          

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calls');
    }
}
