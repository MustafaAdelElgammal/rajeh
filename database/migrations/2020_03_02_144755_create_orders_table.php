<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('sub_service_id');
            $table->unsignedInteger('product_id');
            $table->text('bulding_type_id');
            $table->text('desc')->nullable();
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->unsignedInteger('time_period_id');
            $table->double('price')->default(0);
            $table->double('tax')->default(0);
            $table->double('delivery')->default(0);
            $table->enum('status',['new','priced','accepted','working','done','rejected','canceled']);
            $table->string('payment_type')->default('cash');
            $table->string('reject_reason')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
