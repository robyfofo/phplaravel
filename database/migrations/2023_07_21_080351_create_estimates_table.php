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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index(['user_id']);
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->unsignedBigInteger('thirdparty_id')->nullable();
            $table->index(['thirdparty_id']);
            $table
                ->foreign('thirdparty_id')
                ->references('id')
                ->on('thirdparties')
                ->onDelete('set null')
                ->onUpdate('set null');


            $table->date('dateins')->nullable();
            $table->date('datesca')->nullable();

            $table->string('note')->nullable();
            $table->text('content')->nullable();

            $table->text('alt_thirdparty')->nullable();

            $table->integer('active')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};




