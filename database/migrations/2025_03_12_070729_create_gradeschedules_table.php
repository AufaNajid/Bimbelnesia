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
        Schema::create('gradeschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->dateTime('repeat_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gradeschedules');
    }
};
