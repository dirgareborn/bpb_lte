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
            $table->integer('category_id');
            $table->integer('location_id');
            $table->string('product_name');
            $table->json('product_facility')->nullable;
            $table->float('product_price');
            $table->text('product_image');
            $table->text('product_description');
            $table->string('url');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->tinyInteger('status')->default('0');
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
