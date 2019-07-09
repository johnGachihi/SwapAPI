<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGoodsChangeCategoryFromEnumToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Enum type not supported by DBAL thus code below cannot work*/
        /*Schema::table('goods', function (Blueprint $table) {
            $table->string('category')->change();
        });*/
        DB::statement("ALTER TABLE goods MODIFY COLUMN category VARCHAR(255)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('goods', function (Blueprint $table) {
            $table->enum('category', ['books', 'clothes'])->change();
        });*/

        DB::statement("ALTER TABLE goods MODIFY COLUMN category ENUM('books', 'clothes')");
    }
}
