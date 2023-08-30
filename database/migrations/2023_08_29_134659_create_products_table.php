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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('categories_id')->nullable();
            $table->index(['categories_id']);
            $table
                ->foreign('categories_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->float('price_unity')->nullable();


            $table->mediumInteger('ordering')->default(0);
            $table->integer('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
