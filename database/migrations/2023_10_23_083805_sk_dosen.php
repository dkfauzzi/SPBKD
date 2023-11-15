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

        Schema::create('sk_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('sks');
            $table->string('sk');
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
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_dosen');
    
    }
};
