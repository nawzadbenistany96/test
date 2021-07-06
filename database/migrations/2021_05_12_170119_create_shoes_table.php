<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->longText('describtion')->nullable();
            $table->string('color')->nullable();
            $table->string('new')->nullable();
            $table->double('s-35')->nullable()->default(0);
            $table->double('s-36')->nullable()->default(0);
            $table->double('s-37')->nullable()->default(0);
            $table->double('s-38')->nullable()->default(0);
            $table->double('s-39')->nullable()->default(0);
            $table->double('s-40')->nullable()->default(0);
            $table->double('s-41')->nullable()->default(0);
            $table->double('s-42')->nullable()->default(0);
            $table->double('s-43')->nullable()->default(0);
            $table->double('s-44')->nullable()->default(0);
            $table->double('s-45')->nullable()->default(0);
            $table->double('price')->nullable()->default(0);
            $table->double('qty')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->double('ordered')->nullable()->default(0);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('shoes');
    }
}
