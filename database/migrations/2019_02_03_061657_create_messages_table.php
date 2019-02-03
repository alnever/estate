<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reason_id')->nullable();
            $table->integer('estate_id')->nullable();
            $table->string('email');
            $table->text('message');
            $table->timestamps();

            $table->foreign('reason_id')
                ->references('id')
                ->on('reasons')
                ->onDelete('set null');
            $table->foreign('estate_id')
                ->references('id')
                ->on('estates')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
