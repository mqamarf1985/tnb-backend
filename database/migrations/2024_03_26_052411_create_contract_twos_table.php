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
        Schema::create('contract_twos', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("closure")->nullable();
            $table->string("published")->nullable();
            $table->string("reference")->unique();
            $table->string("location")->nullable();
            $table->string("category")->nullable();
            $table->string("tender_type")->nullable();
            $table->string("contract_type")->nullable();
            $table->longText("description")->nullable();
            $table->string("change_log")->nullable();
            $table->string("contact_office_name")->nullable();
            $table->string("contact_person_name")->nullable();
            $table->string("contact_person_position")->nullable();
            $table->string("contact_person_email")->nullable();
            $table->string("contract_page_link")->nullable();
            $table->boolean("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_twos');
    }
};
