<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSksColumnTypeInTestSkDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_sk_dosen', function (Blueprint $table) {
            // Change 'integer' to 'float' if values can be decimals
            $table->float('sks')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_sk_dosen', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->string('sks')->change();
        });
    }
}
