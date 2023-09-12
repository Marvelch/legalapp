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
        Schema::create('document_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->foreign('key')->references('document_keys')->on('agreements');
            $table->string('file_name');
            $table->string('path');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_agreements');
    }
};
