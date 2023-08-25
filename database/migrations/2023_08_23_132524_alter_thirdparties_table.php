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
        Schema::table('thirdparties', function (Blueprint $table) {
            
            $table->unsignedBigInteger('location_province_id')->nullable();
            $table->index(['location_province_id']);
            $table
                ->foreign('location_province_id')
                ->references('id')
                ->on('location_province')
                ->onDelete('set null')
                ->onUpdate('set null');                    
         
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
