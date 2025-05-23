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
       Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->text('item_name');
            $table->text('category');
            $table->integer('quantity')->default(0);
            $table->text('unit');
            $table->integer('minimum_stock_level')->default(0);
            $table->date('expiry_date')->nullable();
            $table->text('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
