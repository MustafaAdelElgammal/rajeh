<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('mobile');
            $table->integer('mobile_code');
            $table->string('password');
            $table->bigInteger('cat_id')->unsigned();
            $table->enum('workday_from',['sat','sun','mon','tue','wed','thu','fri'])->default('sun');
            $table->enum('workday_to',['sat','sun','mon','tue','wed','thu','fri'])->default('sun');
            $table->string('trading_license')->nullable();
            $table->string('image')->nullable();
            $table->integer('avg_rate')->default(0);
            $table->string('device_token')->nullable();
            $table->timestamp('mobile_verify_at')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
