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
        Schema::create('modules_levels_access', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('modules_id')->default(0);
            $table->mediumInteger('levels_id')->default(0);
            $table->mediumInteger('users_id')->default(0);
            $table->integer('read_access')->default(0);
            $table->integer('write_access')->default(0);  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules_levels_access');
    }
};
