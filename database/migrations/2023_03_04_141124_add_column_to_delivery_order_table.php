<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDeliveryOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->string('quantity')->after('esewa_status')->nullable();
            $table->string('price')->after('quantity')->nullable();
            $table->integer('package_id')->nullable()->after('price');
            $table->integer('item_id')->nullable()->after('package_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('package_id');
            $table->dropColumn('item_id');

        });
    }
}
