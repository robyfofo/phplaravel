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
        Schema::create('estimates_articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('estimate_id')->nullable();
            $table->index(['estimate_id']);
            $table
                ->foreign('estimate_id')
                ->references('id')
                ->on('estimates')
                ->onDelete('set null')
                ->onUpdate('set null');

                $table->string('note')->nullable();
                $table->text('content')->nullable();
                $table->smallInteger('quantity')->default(0);
                $table->float('value')->nullable();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates_articles');
    }
};
