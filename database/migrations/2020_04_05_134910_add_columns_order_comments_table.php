<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOrderCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_comments', function (Blueprint $table) {
            //
            $table->enum('from_type',['provider','client'])->default('provider');
            $table->enum('to_type',['provider','client'])->default('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_comments', function (Blueprint $table) {
            //
            $table->dropColumn('from_type');
            $table->dropColumn('to_type');
        });
    }
}
