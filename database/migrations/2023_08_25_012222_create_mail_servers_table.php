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
        Schema::create('mail_servers', function (Blueprint $table) {
            $table->id();
            $table->string('mail_server');
            $table->string('port');
            $table->string('smtp');
            $table->string('username');
            $table->string('password');
            $table->string('description');
            $table->string('default')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_servers');
    }
};
