<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustmorSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custmor_supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('user_type',['client','provider'])->default('client');
            $table->bigInteger('from_id')->unsigned()->default(0);
            $table->bigInteger('to_id')->unsigned()->default(0);
            $table->longText('message');
            $table->boolean('is_read')->default(0);
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('custmor_supports');
    }
}
