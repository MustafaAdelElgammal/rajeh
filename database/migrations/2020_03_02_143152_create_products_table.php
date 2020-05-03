<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sub_service_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->boolean('is_featured')->defualt(0);
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
        Schema::dropIfExists('products');
    }
}
