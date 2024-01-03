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
        Schema::create('test_sk_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('sks');
            $table->string('sk');
            $table->string('jenis_sk');
            $table->string('keterangan_sk')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('q1_start')->nullable();
            $table->date('q1_end')->nullable();
            $table->date('q2_start')->nullable();
            $table->date('q2_end')->nullable();
            $table->date('q3_start')->nullable();
            $table->date('q3_end')->nullable();
            $table->date('q4_start')->nullable();
            $table->date('q4_end')->nullable();
            $table->string('start_sk')->nullable();
            $table->string('end_sk')->nullable();
            $table->string('NIP')->nullable();
            $table->foreign('NIP')->references('NIP')->on('users')->onDelete('cascade');
            // $table->timestamps();
           
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
