<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->longText('describtion')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->date('date_available')->nullable();
            $table->integer('s28')->nullable();
            $table->integer('s29')->nullable();
            $table->integer('s30')->nullable();
            $table->integer('s31')->nullable();
            $table->integer('s32')->nullable();
            $table->integer('s33')->nullable();
            $table->integer('s34')->nullable();
            $table->integer('s36')->nullable();
            $table->integer('s37')->nullable();
            $table->integer('s38')->nullable();
            $table->integer('s39')->nullable();
            $table->integer('s40')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->double('qty')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->double('ordered')->nullable()->default(0);
            $table->string('new')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('category_id');
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
        Schema::dropIfExists('jeans');
    }
}
