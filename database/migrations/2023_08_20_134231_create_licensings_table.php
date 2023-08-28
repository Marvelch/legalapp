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
        Schema::create('licensings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legal_entity_id');
            $table->foreign('legal_entity_id')->references('id')->on('legal_entities');
            $table->string('permit_number')->nullable();
            $table->string('permit_name')->nullable();
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('period')->nullable();
            $table->date('extra_time')->nullable();
            $table->string('documents')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licensings');
    }
};
