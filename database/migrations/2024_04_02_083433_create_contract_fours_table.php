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
        Schema::create('contract_fours', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->date("date")->nullable();
            $table->string("description")->nullable();
            $table->string("detail_page_link")->nullable();
            $table->longText("detail_text")->nullable();
            $table->jsonb("categories")->nullable();
//            $table->jsonb("attachments")->nullable();
            $table->boolean("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_fours');
    }
};
