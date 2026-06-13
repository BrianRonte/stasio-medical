<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');            // e.g. General Practitioner
            $table->string('specialty');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->string('days');             // consulting days e.g. Mon - Fri
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
