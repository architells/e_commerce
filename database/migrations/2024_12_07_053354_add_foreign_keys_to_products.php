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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('sub_category_id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('sub_sub_category_id')->references('sub_sub_category_id')->on('sub_sub_categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });

        Schema::table('sub_sub_categories', function (Blueprint $table) {
            $table->foreign('sub_category_id')->references('sub_category_id')->on('sub_categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
