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
        Schema::create('softwares', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('company_id')
                  ->constrained('companies')// references id on companies
                  ->onDelete('cascade');// if a company is deleted, delete its softwares
            $table->string('name');
            $table->string('user');
            $table->date('installed_date');
            $table->date('expiration_date');
            $table->string('license_key');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('softwares');
    }
};
