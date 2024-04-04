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
        Schema::create('contract_threes', function (Blueprint $table) {
            $table->id();
            $table->string("contract_id")->unique();
            $table->string("project_id")->nullable();
            $table->string("proc_detail_link")->nullable();
            $table->string("project_ctry_name")->nullable();
            $table->string("bid_reference_no")->nullable();
            $table->string("procurement_method_name")->nullable();
            $table->string("notice_lang_name")->nullable();
            $table->string("submission_date")->nullable();
            $table->string("notice_date")->nullable();
            $table->string("project_name")->nullable();
            $table->jsonb("financing_id")->nullable();
            $table->string("notice_title")->nullable();
            $table->string("notice_version_no")->nullable();
            $table->string("notice_type")->nullable();
            $table->string("notice_lang_code")->nullable();
            $table->string("notice_status")->nullable();
            $table->string("project_ctry_code")->nullable();
            $table->string("region_name")->nullable();
            $table->string("prod_line")->nullable();
            $table->string("agency_name")->nullable();
            $table->string("bid_currency_code")->nullable();
            $table->string("bid_estimate_amount")->nullable();
            $table->string("bid_description")->nullable();
            $table->string("procurement_group")->nullable();
            $table->string("procurement_group_desc")->nullable();
            $table->string("procurement_method_code")->nullable();
            $table->string("contact_address")->nullable();
            $table->string("contact_ctry_code")->nullable();
            $table->string("contact_ctry_name")->nullable();
            $table->string("contact_email")->nullable();
            $table->string("contact_job_title")->nullable();
            $table->string("contact_name")->nullable();
            $table->string("contact_organization")->nullable();
            $table->string("contact_phone_no")->nullable();
            $table->string("contact_id")->nullable();
            $table->longText("notice_text")->nullable();
            $table->string("unspsc_classification")->nullable();
            $table->string("api_modified_date")->nullable();
            $table->boolean("status")->nullable();
            $table->timestamps();
















































        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_threes');
    }
};
