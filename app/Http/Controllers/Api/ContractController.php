<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContractFive;
use App\Models\ContractFour;
use App\Models\ContractOne;
use App\Models\ContractSeven;
use App\Models\ContractSix;
use App\Models\ContractThree;
use App\Models\ContractTwo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{
    public function contractOneIndex()
    {
        $contractIds = ContractOne::pluck('contract_id');
        return response()->json($contractIds);
    }

    public function contractsOneStore(Request $request)
    {
//        return $request;
        $request->validate([
            'id' => 'required|unique:contract_ones,contract_id',
// Add other validation rules for contract data
        ]);

        $contract = new ContractOne();
        $contract->contract_id = $request->id;
        $contract->reference = $request->reference;
        $contract->title = $request->title;
        $contract->link = $request->link;
        $contract->contractTitle = $request->contractTitle;
        $contract->description = $request->description;
        $contract->typeOfContract = $request->typeOfContract;
        $contract->responseDeadline = $request->responseDeadline;
        $contract->cpvCodes = $request->cpvCodes;
        $contract->complaintProcedure = $request->complaintProcedure;
        $contract->office = $request->office;
        $contract->contact = $request->contact;
        $contract->notice = $request->notice;
        $contract->noticeLink = $request->noticeLink;
        $contract->dateOfDispatch = $request->dateOfDispatch;
        $contract->packageTitle = $request->packageTitle;
        $contract->packageSubTitle = $request->packageSubTitle;
        $contract->packageInfo = $request->packageInfo;
        $contract->packageAdditionalInformation = $request->packageAdditionalInformation;
        $contract->packageAdditionalInformationHref = $request->packageAdditionalInformationHref;
        $contract->documents = $request->documents;
        $contract->documentNames = $request->documentNames;
        $contract->documentLinks = $request->documentLinks;
        $contract->packageMailingAddress = $request->packageMailingAddress;
// Assign other contract data from the request
        $contract->save();

        return response()->json(['message' => 'Contract saved successfully'], 201);
    }

    public function contractTwoIndex()
    {
        $contractIds = ContractTwo::pluck('reference');
        return response()->json($contractIds);
    }

    public function contractsTwoStore(Request $request)
    {
//        return $request;
        $request->validate([
            'reference' => 'required|unique:contract_twos,reference',

        ]);

        $contract = new ContractTwo();
        $contract->reference = $request->reference;
        $contract->title = $request->title;
        $contract->closure = $request->TenderClosure;
        $contract->published = $request->TenderPublished;
        $contract->location = $request->TenderLocation;
        $contract->category = $request->TenderCategory;
        $contract->tender_type = $request->TenderType;
        $contract->contract_type = $request->TenderContractType;
        $contract->description = $request->TenderDescription;
        $contract->change_log = $request->TenderChangelog;
        $contract->contact_office_name = $request->TenderContactOfficeName;
        $contract->contact_person_name = $request->TenderContactPersonName;
        $contract->contact_person_position = $request->TenderContactPersonPosition;
        $contract->contact_person_email = $request->TenderContactPersonEmail;
        $contract->contract_page_link = $request->contractPageLink;
        $contract->status = $request->status;
// Assign other contract data from the request
        $contract->save();

        return response()->json(['message' => 'Contract saved successfully'], 201);
    }

    public function contractThreeIndex()
    {
        $contractIds = ContractThree::pluck('contract_id');
        return response()->json($contractIds);
    }

    public function contractsThreeStore(Request $request)
    {
//        return $request->id;
        $request->validate([
            'id' => 'required|unique:contract_threes,contract_id',

        ]);
        $contract = new ContractThree();
        $contract->contract_id = $request->id;
        $contract->project_id = $request->project_id;
        $contract->project_ctry_name = $request->project_ctry_name;
        $contract->bid_reference_no = $request->bid_reference_no;
        $contract->procurement_method_name = $request->procurement_method_name;
        $contract->notice_lang_name = $request->notice_lang_name;
        $contract->submission_date = $request->submission_date;
        $contract->notice_date = $request->noticedate;
        $contract->project_name = $request->project_name;
        $contract->financing_id = collect($request->Credit)->pluck('financing_id');
        $contract->notice_title = $request->noticetitle;
        $contract->notice_version_no = $request->notice_version_no;
        $contract->notice_type = $request->notice_type;
        $contract->notice_lang_code = $request->notice_lang_code;
        $contract->notice_status = $request->notice_status;
        $contract->project_ctry_code = $request->project_ctry_code;
        $contract->region_name = $request->regionname;
        $contract->prod_line = $request->prodline;
        $contract->agency_name = $request->agency_name;
        $contract->bid_currency_code = $request->bid_currency_code;
        $contract->bid_estimate_amount = $request->bid_estimate_amount;
        $contract->bid_description = $request->bid_description;
        $contract->procurement_group = $request->procurement_group;
        $contract->procurement_group_desc = $request->procurement_group_desc;
        $contract->procurement_method_code = $request->procurement_method_code;
        $contract->contact_address = $request->contact_address;
        $contract->contact_ctry_code = $request->contact_ctry_code;
        $contract->contact_ctry_name = $request->contact_ctry_name;
        $contract->contact_email = $request->contact_email;
        $contract->contact_job_title = $request->contact_job_title;
        $contract->contact_name = $request->contact_name;
        $contract->contact_organization = $request->contact_organization;
        $contract->contact_phone_no = $request->contact_phone_no;
        $contract->unspsc_classification = $request->UnspscClassification;
        $contract->notice_text = $request->notice_text;
        $contract->api_modified_date = $request->api_modified_date;
        $contract->status = $request->status;

//        dd(($contract->financing_id));

// Assign other contract data from the request
        $contract->save();

        return response()->json(['message' => 'Contract saved successfully'], 201);
    }

    public function contractFourIndex()
    {
        $contractIds = ContractFour::pluck('title');
        return response()->json($contractIds);
    }

    public function contractsFourStore(Request $request)
    {
        Log::info("____________________________");
//        return $request;
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);


        $response =  [];
//        DB::transaction(function () use ($request) {
            $inputData = [
                'title' => $request['title'],
                'date' => Carbon::parse($request['date']),
                'description' => $request['description'],
                'detail_page_link' => $request['detailPageLink'],
                'detail_text' => $request['detailText'],
                'categories' => collect($request['categories']),
            ];
            Log::info($request);
            $tender = ContractFour::FirstOrNew(['title' => $request['title'],
                'date' => Carbon::parse($request['date'])], $inputData);
            Log::info($tender);
            if ($tender->wasRecentlyCreated) {
            Log::info("Tender Recently Created: ",[$tender->wasRecentlyCreated]);
                foreach ($request['attachments'] as $attachmentData) {
                    $tender->attachments()->FirstOrNew([
                        'fileName' => $attachmentData['fileName'],
                        'icon' => $attachmentData['icon'],
                        'size' => $attachmentData['size'],
                        'downloadLink' => $attachmentData['downloadLink'],
                    ]);
                }
                $response['message'] =  'Contract saved successfully';
                Log::info("Tender saved successfully: ", [$response]);
//                return response()->json(['message' => 'Contract saved successfully'], 201);
            } else {
                $response['message'] = 'Contract already exists';
                Log::info("Tender already exists: ", [$response]);
//                return response()->json(['message' => 'Contract already exists'], 201);
            }
//        });
        Log:: info("All DONE, sending response...", [$response]);
        return response()->json($response, 201);
    }

    public function contractFiveIndex()
    {
        $contractIds = ContractFive::pluck('title');
        return response()->json($contractIds);
    }

    public function contractsFiveStore(Request $request)
    {
        Log::info("____________________________");
        Log::info("Store request for Contract Five.", $request->all());
        return "Request received, Rest will be done later by Backend developer";
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);


        $response =  [];
//        DB::transaction(function () use ($request) {
            $inputData = [
                'title' => $request['title'],
                'date' => Carbon::parse($request['date']),
                'description' => $request['description'],
                'detail_page_link' => $request['detailPageLink'],
                'detail_text' => $request['detailText'],
                'categories' => collect($request['categories']),
            ];
            Log::info($request);
            $tender = ContractFive::FirstOrNew(['title' => $request['title'],
                'date' => Carbon::parse($request['date'])], $inputData);
            Log::info($tender);
            if ($tender->wasRecentlyCreated) {
            Log::info("Tender Recently Created: ",[$tender->wasRecentlyCreated]);
                foreach ($request['attachments'] as $attachmentData) {
                    $tender->attachments()->FirstOrNew([
                        'fileName' => $attachmentData['fileName'],
                        'icon' => $attachmentData['icon'],
                        'size' => $attachmentData['size'],
                        'downloadLink' => $attachmentData['downloadLink'],
                    ]);
                }
                $response['message'] =  'Contract saved successfully';
                Log::info("Tender saved successfully: ", [$response]);
//                return response()->json(['message' => 'Contract saved successfully'], 201);
            } else {
                $response['message'] = 'Contract already exists';
                Log::info("Tender already exists: ", [$response]);
//                return response()->json(['message' => 'Contract already exists'], 201);
            }
//        });
        Log:: info("All DONE, sending response...", [$response]);
        return response()->json($response, 201);
    }

    public function ContractSixIndex()
    {
        $contractIds = ContractSix::pluck('title');
        return response()->json($contractIds);
    }

    public function cContractSixStore(Request $request)
    {
        Log::info("____________________________");
        Log::info("Store request for Contract Six.", $request->all());
        return "Request received, Rest will be done later by Backend developer";
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);


        $response =  [];
//        DB::transaction(function () use ($request) {
            $inputData = [
                'title' => $request['title'],
                'date' => Carbon::parse($request['date']),
                'description' => $request['description'],
                'detail_page_link' => $request['detailPageLink'],
                'detail_text' => $request['detailText'],
                'categories' => collect($request['categories']),
            ];
            Log::info($request);
            $tender = ContractSix::FirstOrNew(['title' => $request['title'],
                'date' => Carbon::parse($request['date'])], $inputData);
            Log::info($tender);
            if ($tender->wasRecentlyCreated) {
            Log::info("Tender Recently Created: ",[$tender->wasRecentlyCreated]);
                foreach ($request['attachments'] as $attachmentData) {
                    $tender->attachments()->FirstOrNew([
                        'fileName' => $attachmentData['fileName'],
                        'icon' => $attachmentData['icon'],
                        'size' => $attachmentData['size'],
                        'downloadLink' => $attachmentData['downloadLink'],
                    ]);
                }
                $response['message'] =  'Contract saved successfully';
                Log::info("Tender saved successfully: ", [$response]);
//                return response()->json(['message' => 'Contract saved successfully'], 201);
            } else {
                $response['message'] = 'Contract already exists';
                Log::info("Tender already exists: ", [$response]);
//                return response()->json(['message' => 'Contract already exists'], 201);
            }
//        });
        Log:: info("All DONE, sending response...", [$response]);
        return response()->json($response, 201);
    }

    public function ContractSevenIndex()
    {
        $contractIds = ContractSeven::pluck('title');
        return response()->json($contractIds);
    }

    public function cContractSevenStore(Request $request)
    {
        Log::info("____________________________");
        Log::info("Store request for Contract Seven.", $request->all());
        return "Request received, Rest will be done later by Backend developer";
        $request->validate([
            'title' => 'required',
            'date' => 'required',
        ]);


        $response =  [];
//        DB::transaction(function () use ($request) {
            $inputData = [
                'title' => $request['title'],
                'date' => Carbon::parse($request['date']),
                'description' => $request['description'],
                'detail_page_link' => $request['detailPageLink'],
                'detail_text' => $request['detailText'],
                'categories' => collect($request['categories']),
            ];
            Log::info($request);
            $tender = ContractSeven::FirstOrNew(['title' => $request['title'],
                'date' => Carbon::parse($request['date'])], $inputData);
            Log::info($tender);
            if ($tender->wasRecentlyCreated) {
            Log::info("Tender Recently Created: ",[$tender->wasRecentlyCreated]);
                foreach ($request['attachments'] as $attachmentData) {
                    $tender->attachments()->FirstOrNew([
                        'fileName' => $attachmentData['fileName'],
                        'icon' => $attachmentData['icon'],
                        'size' => $attachmentData['size'],
                        'downloadLink' => $attachmentData['downloadLink'],
                    ]);
                }
                $response['message'] =  'Contract saved successfully';
                Log::info("Tender saved successfully: ", [$response]);
//                return response()->json(['message' => 'Contract saved successfully'], 201);
            } else {
                $response['message'] = 'Contract already exists';
                Log::info("Tender already exists: ", [$response]);
//                return response()->json(['message' => 'Contract already exists'], 201);
            }
//        });
        Log:: info("All DONE, sending response...", [$response]);
        return response()->json($response, 201);
    }

}
