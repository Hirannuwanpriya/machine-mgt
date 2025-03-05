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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamp('purchase_date')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('category')->default(0);
            $table->integer('brand')->default(0);
            $table->timestamp('timer_date')->nullable();
            $table->integer('hours')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
