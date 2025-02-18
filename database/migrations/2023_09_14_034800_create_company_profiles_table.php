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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('logo')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('entity_type')->nullable();
            $table->date('fiscal_year_start')->nullable();
            $table->date('fiscal_year_end')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
