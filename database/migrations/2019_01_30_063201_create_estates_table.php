<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estate_type_id')->unsigned();
            $table->integer('goal_id')->unsigned();
            $table->integer('stage_id')->unsigned()->default(1);
            // object information
            $table->string('address')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('floor')->nullable();
            $table->text('object_info')->nullable();
            // owner information
            $table->decimal('price',12,2)->default(0);
            $table->decimal('min_price',12,2)->default(0);
            $table->text('owner_info')->nullable();
            // stage info
            $table->integer('publisher_id')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('realtor_id')->nullable();
            $table->timestamp('process_at')->nullable();
            $table->timestamp('sold_at')->nullable();
            $table->decimal('final_price',12,2)->default(0);
            $table->text('final_info')->nullable();
            //foreign keys
            $table->foreign('estate_type_id')->references('id')->on('estate_types');
            $table->foreign('goal_id')->references('id')->on('goals');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('realtor_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('estates');
    }
}
