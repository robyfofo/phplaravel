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
        Schema::create('timecards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index(['user_id']);
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->unsignedBigInteger('project_id')->nullable();
            $table->index(['project_id']);
            $table
                ->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->text('content')->nullable();

            $table->date('dateins')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->time('worktime')->nullable();





            




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timecards');
    }
};
