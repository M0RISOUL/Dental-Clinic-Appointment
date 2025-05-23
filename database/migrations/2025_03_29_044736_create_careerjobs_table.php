<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('careerjobs', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('jobtype');
            $table->text('location');
            $table->integer('salary');
            $table->integer('vacancy');
            $table->text('workexperience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careerjobs');
    }
};
