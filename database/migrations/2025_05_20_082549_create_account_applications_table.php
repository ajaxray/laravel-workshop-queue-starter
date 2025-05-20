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
        Schema::create('account_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('region_state');
            $table->string('country');
            $table->string('account_type');
            $table->string('category');
            $table->string('state')->default('pending'); // for state machine
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_applications');
    }
};
