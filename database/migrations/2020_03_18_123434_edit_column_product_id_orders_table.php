<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnProductIdOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('product_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('product_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('product_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            //
            $table->unsignedInteger('product_id')->nullable();
        });
    }
}
