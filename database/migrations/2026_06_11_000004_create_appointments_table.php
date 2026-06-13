<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('doctor_id')->nullable()->constrained();
            $table->date('preferred_date');
            $table->text('reason')->nullable();
            $table->string('status', 20)->default('pending'); // pending / confirmed / seen / cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
