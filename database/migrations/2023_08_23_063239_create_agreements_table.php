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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('agreement_name');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('counter_party_name');
            $table->date('signing_date');
            $table->date('effective_date');
            $table->tinyInteger('check_date_period');
            $table->date('date_end')->nullable();
            $table->integer('period')->nullable();
            $table->date('add_date')->nullable();
            $table->date('set_notification')->nullable();
            $table->String('document_keys')->index()->nullable()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
