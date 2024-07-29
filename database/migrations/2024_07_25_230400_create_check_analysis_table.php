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
        Schema::create('check_analysis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['accepted', 'rejected']);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints (if applicable)
            $table->foreign('check_id')->references('id')->on('checks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_analysis');
    }
};
