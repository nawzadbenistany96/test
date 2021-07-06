<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('storage_capacity')->nullable();
            $table->string('os')->nullable();
            $table->string('simcard')->nullable();
            $table->string('color')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->longText('describtion')->nullable();
            $table->string('connectivity')->nullable();
            $table->string('status')->nullable();
            $table->date('date_available')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->double('qty')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->string('new')->nullable();
            $table->double('ordered')->nullable()->default(0);
            $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('phones');
    }
}
