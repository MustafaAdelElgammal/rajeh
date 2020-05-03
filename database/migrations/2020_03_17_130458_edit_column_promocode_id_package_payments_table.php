<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnPromocodeIdPackagePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_payments', function (Blueprint $table) {
            //
            $table->dropColumn('promocode_id');
        });

        Schema::table('package_payments', function (Blueprint $table) {
            //
            $table->bigInteger('promocode_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_payments', function (Blueprint $table) {
            //
            $table->dropColumn('promocode_id');
        });

        Schema::table('package_payments', function (Blueprint $table) {
            //
            $table->bigInteger('promocode_id')->unsigned();
        });
    }
}
