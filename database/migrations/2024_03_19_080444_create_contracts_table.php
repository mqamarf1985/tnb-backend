<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
           /* $table->id();
            $table->string("contract_id")->nullable();
            $table->string("title")->nullable();
            $table->string("closure")->nullable();
            $table->string("published")->nullable();
            $table->string("reference")->nullable();
            $table->string("type")->nullable();
            $table->string("location")->nullable();
            $table->string("category")->nullable();
            $table->string("contract_type")->nullable();
            $table->string("description")->nullable();
            $table->string("change_log")->nullable();
            $table->string("contact_office_name")->nullable();
            $table->string("contact_person_name")->nullable();
            $table->string("contact_person_position")->nullable();
            $table->string("contact_person_email")->nullable();
            $table->string("contact_page_link")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();*/

            $table->id();
            /*$table->string("contract_id")->nullable();
            $table->string("reference")->nullable();
            $table->string("title")->nullable();
            $table->string("link")->nullable();
            $table->string("contractTitle")->nullable();
            $table->longText("description")->nullable();
            $table->string("typeOfContract")->nullable();
            $table->string("responseDeadline")->nullable();
            $table->string("cpvCodes")->nullable();
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
            $table->string("packageMailingAddress")->nullable();*/
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
