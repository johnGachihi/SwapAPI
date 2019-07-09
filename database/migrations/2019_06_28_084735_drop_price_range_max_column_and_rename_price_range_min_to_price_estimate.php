<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPriceRangeMaxColumnAndRenamePriceRangeMinToPriceEstimate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->dropColumn('price_range_max');
//            $table->renameColumn('price_range_min', 'price_estimate');
            DB::statement("ALTER table goods CHANGE price_range_min price_estimate int");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
//            $table->integer('price_range_min')->nullable();
            DB::statement("ALTER table goods CHANGE price_estimate price_range_min int");
        });
    }
}
