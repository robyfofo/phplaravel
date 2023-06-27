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
        Schema::create('thirdparties', function (Blueprint $table) {

            $table->id();
            
            $table->integer('categories_id')->default(0);
            
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('street')->nullable();
            $table->string('city_alt')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('provincia_alt')->nullable();

            $table->integer('loacation_cities_id')->default(0);
            $table->integer('loacation_province_id')->default(0);
            $table->integer('loacation_nations_id')->default(0);
            
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();

            $table->string('ragione_sociale')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('codice_fiscale')->nullable();
            $table->string('pec')->nullable();
            $table->string('sid')->nullable();
            
            $table->integer('active')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thirdparty');
    }
};
