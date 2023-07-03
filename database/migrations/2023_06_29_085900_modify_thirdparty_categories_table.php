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
        
        Schema::table('thirdparties_categories', function (Blueprint $table) {

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->index(['parent_id']);
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('thirdparties_categories')
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
