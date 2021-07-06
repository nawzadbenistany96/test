<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTshirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tshirts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->longText('describtion')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->date('date_available')->nullable();
            $table->double('small')->nullable()->default(0);
            $table->double('medium')->nullable()->default(0);
            $table->double('large')->nullable()->default(0);
            $table->double('xlarge')->nullable()->default(0);
            $table->double('xxlarge')->nullable()->default(0);
            $table->double('price')->default(0);
            $table->double('qty')->default(0);
            $table->double('discount')->default(0);
            $table->double('ordered')->default(0);
            $table->string('status')->nullable();
            $table->string('new')->nullable();
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
        Schema::dropIfExists('tshirts');
    }
}
