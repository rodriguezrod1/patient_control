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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('document', 20)->unique()->comment('Identification document');
            $table->string('first_name', 255)->comment('Patient first name');
            $table->string('last_name', 255)->comment('Patient last name');
            $table->date('birth_date')->comment('Patient Birthday');
            $table->string('email', 255)->comment('Contact email');
            $table->string('phone', 20)->comment('Contact phone');
            $table->enum('gender', ['Male', 'Female'])->comment('Patient Genre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
