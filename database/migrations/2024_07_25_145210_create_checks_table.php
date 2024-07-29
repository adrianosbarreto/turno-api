<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 15,2);
            $table->text('description');
            $table->enum('status', ['pending','reject', 'accept']);
            $table->string('picture');

            $table->foreignId('account_id')->constrained();

            $table->unsignedBigInteger('income_id')->nullable();;
            $table->foreign('income_id')->references('id')->on('incomes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checks');
    }
};
