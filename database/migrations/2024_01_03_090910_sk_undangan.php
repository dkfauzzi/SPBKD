<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        Schema::create('sk_undangan', function (Blueprint $table) {
            $table->id();
            $table->string('sks');
            $table->string('sk');
            $table->string('jenis_sk');
            $table->string('start_date')->nullable();
            $table->string('start_sk')->nullable();
            $table->string('NIP')->nullable();
            $table->foreign('NIP')->references('NIP')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
