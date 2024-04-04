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
        Schema::create('contract_ones', function (Blueprint $table) {
            $table->id();
            $table->string("contract_id")->unique();
            $table->string("reference")->nullable();
            $table->string("title")->nullable();
            $table->string("link")->nullable();
            $table->string("contractTitle")->nullable();
            $table->longText("description")->nullable();
            $table->string("typeOfContract")->nullable();
            $table->string("responseDeadline")->nullable();
            $table->longText("cpvCodes")->nullable();
            $table->longText("complaintProcedure")->nullable();
            $table->string("office")->nullable();
            $table->string("contact")->nullable();
            $table->string("notice")->nullable();
            $table->string("noticeLink")->nullable();
            $table->string("dateOfDispatch")->nullable();
            $table->string("packageTitle")->nullable();
            $table->string("packageSubTitle")->nullable();
            $table->string("packageInfo")->nullable();
            $table->string("packageAdditionalInformation")->nullable();
            $table->string("packageAdditionalInformationHref")->nullable();
            $table->string("documents")->nullable();
            $table->string("documentNames")->nullable();
            $table->string("documentLinks")->nullable();
            $table->string("packageMailingAddress")->nullable();
            $table->boolean("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_ones');
    }
};
