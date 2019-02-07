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
            $table->integer('stage_id')->unsigned()->default(0);
            $table->integer('realtor_id')->nullable();
            // frontend information
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            // object information
            $table->string('address')->nullable();
            $table->integer('rooms')->nullable();
            $table->string('floor')->nullable();
            // square information
            $table->decimal('total_square',12,2)->default(0);
            $table->decimal('living_square',12,2)->default(0);
            $table->decimal('kitchen_square',12,2)->default(0);
            // facilities
            $table->string('bathroom')->nullable();
            $table->string('balcony')->nullable();
            $table->string('loggia')->nullable();
            $table->text('condition')->nullable();
            // owner information
            $table->decimal('price',12,2)->default(0);
            $table->decimal('min_price',12,2)->default(0);
            $table->decimal('final_price',12,2)->default(0);
            // comments
            $table->text('object_info')->nullable();
            $table->text('final_info')->nullable();
            $table->text('owner_info')->nullable();
            // stage info
            $table->integer('publisher_id')->nullable();
            $table->timestamp('sold_at')->nullable();
            //foreign keys
            $table->foreign('estate_type_id')->references('id')->on('estate_types');
            $table->foreign('goal_id')->references('id')->on('goals');
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('realtor_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
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
