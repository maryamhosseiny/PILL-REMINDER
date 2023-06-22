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
        Schema::create('user_pills', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->integer('consumption_period')->nullable()->default(null);
            $table->integer('treatment_start_time')->nullable()->default(null);
            $table->integer('treatment_duration')->nullable()->default(null);
            $table->integer('last_remind_time')->nullable()->default(null);
            $table->integer('next_remind_time')->nullable()->default(null);
            $table->integer('status')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pills');
    }
};
