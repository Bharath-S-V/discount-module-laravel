<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToDiscountUsagesTable extends Migration
{
    public function up()
    {
        Schema::table('discount_usages', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('discount_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('discount_usages', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
}
