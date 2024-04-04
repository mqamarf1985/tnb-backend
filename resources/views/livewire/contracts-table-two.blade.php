@php
    $headers = [
//        ['key' => 'id', 'label' => 'Id', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'reference', 'label' => 'Reference', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'title', 'label' => 'Title', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'closure', 'label' => 'Closure', 'class' => 'm-0 p-2'],
        ['key' => 'published', 'label' => 'Published', 'class' => 'm-0 p-2'],
        ['key' => 'location', 'label' => 'Location', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'category', 'label' => 'Category', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'tender_type', 'label' => 'Tender Type', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'contract_type', 'label' => 'Contract Type', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'change_log', 'label' => 'Change Log', 'class' => 'm-0 p-2 w-1 text-wrap'],
        ['key' => 'contact', 'label' => 'Contact', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'contract_page_link', 'label' => 'Link To Contract', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'status', 'label' => 'Status', 'class' => 'm-0 p-2 whitespace-normal'],
    ];
$cell_decoration  = [
    'status' => [
//                    'bg-green-500/25' => fn(\App\Models\ContractOne $contract) => $contract->status,
//                    'bg-red-500/25' => fn(\App\Models\ContractOne $contract) => !$contract->status,
        ],
    ];
@endphp
<div>
    <div class="flex justify-end mb-4">
        <x-dropdown label="Filters" class="btn-outline text-primary btn-sm px-6">
            {{-- By default any click closes dropdown --}}
            <x-menu-item title="Clear" wire:click="uncheckAllFilters()" id="uncheckAllFilters" icon="o-arrow-path"
                         left/>

            <x-menu-separator/>
            <x-menu-item>
                <x-checkbox label="Approved" wire:model.live="showApproved2" id="showApproved2" class="checkbox-success"
                            @click.stop="" tight/>
            </x-menu-item>

            <x-menu-item>
                <x-checkbox label="Rejected" wire:model.live="showRejected2" id="showRejected2" class="checkbox-error"
                            @click.stop="" tight/>
            </x-menu-item>
            <x-menu-item>
                <x-checkbox label="Not Selected" wire:model.live="showNull2" id="showNull2" class="checkbox-primary"
                            @click.stop="" tight/>
            </x-menu-item>
        </x-dropdown>
    </div>
    <x-table :headers="$headers" :rows="$contracts2" striped :cell-decoration="$cell_decoration" with-pagination
             class="w-full text-sm ">
        @scope('cell_contract_page_link', $contracts2)
        <a label="View" href="{{ $contracts2->contract_page_link }}" target="_blank" class="btn btn-link">View</a>
        @endscope
        @scope('cell_status', $contracts2)
        <x-dropdown>
            <x-slot:trigger>
                <x-button
                    label="{{ $contracts2->status === 1 ? 'Approved' : ( $contracts2->status === 0 ? 'Rejected' : 'Select Status') }}"
                    class="btn-sm text-sm text-nowrap m-0 p-0 px-2
                    {{ $contracts2->status === 1 ? 'btn-success' : ( $contracts2->status === 0 ? 'btn-error' : 'btn-ghost') }}"/>
            </x-slot:trigger>

            <x-menu-item title="Approved" icon="fas.check" wire:click="changeStatus({{ $contracts2->id }}, 1)"/>
            <x-menu-item title="Rejected" icon="fas.xmark" wire:click="changeStatus({{ $contracts2->id }}, 0)"/>
        </x-dropdown>
        @endscope
        @scope('cell_description', $contracts2)
        @if (strlen($contracts2->description) > 100)
            {{substr($contracts2->description, 0, 100) . '...'}}<br>

            <x-button label="Open" wire:click="loadText('Description',  '{{ $contracts2->reference }}')"
                      class="btn btn-link" spinner/>
        @else
            {{ $contracts2->description }}
        @endif
        @endscope
        @scope('cell_contact', $contracts2)
        {{ $contracts2->contact_office_name }}<br>
        {{ $contracts2->contact_person_name }}<br>
        {{ $contracts2->contact_person_position }}<br>
        {{ $contracts2->contact_person_email }}
        @endscope
    </x-table>
    {{-- The Master doesn't talk, he acts. --}}
    {{--<h3 class="pt-0">Welt Hunger Hilfe Tenders and Contracts </h3>
    <div class="py-4">
        <fieldset class="border rounded-3 p-2 row-auto" style="width: fit-content">
            <legend class="float-none w-auto px-2 m-2 text-size-sm text-bold"
                    style="font-size: 1.2rem !important; line-height: 1rem !important;">
                Filter by Status
            </legend>
            <div class="btn-group btn-group-sm">
                <input type="checkbox" class="btn-check" wire:model.live="showApproved" id="showApproved"
                       autocomplete="off">
                <label class="btn btn-outline-success" for="showApproved">Approved</label>

                <input type="checkbox" class="btn-check" wire:model.live="showRejected" id="showRejected"
                       autocomplete="off">
                <label class="btn btn-outline-danger" for="showRejected">Rejected</label>

                <input type="checkbox" class="btn-check" wire:model.live="showNull" id="showNull" autocomplete="off">
                <label class="btn btn-outline-dark" for="showNull">Not Selected</label>
            </div>
        </fieldset>
    </div>--}}
    {{--<table class="table table-bordered table-sm">
        <thead class="">
        <tr class="text-uppercase small">
            <th>Id</th>
            <th>Reference</th>
            <th>Title</th>
            <th>Link To Contract</th>
            <th>Description</th>
            <th>Type of Contract</th>
            <th>Response Deadline</th>
            <th>Complaint Procedure</th>
            <th>Office</th>
            <th>Contact</th>
            <th>Date of Dispatch</th>
            <th>Mailing Address</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($contracts2 as $contract)
            <tr>
                <td>{{ $contract->contract_id }}</td>
                <td>{{ $contract->reference }}</td>
                <td>{{ $contract->title }}</td>
                <td><a href="{{ $contract->link }}" target="_blank">Link</a></td>
                <td>
                    <span>
                        {{ strlen($contract->description) > 100 ? substr($contract->description, 0, 100) . '...' : $contract->description }}
                        @if (strlen($contract->description) > 100)
                            <button class="btn btn-link"
                                    wire:click="loadText('Description',  '{{ $contract->contract_id }}')"
                                    data-bs-toggle="modal" data-bs-target="#textModal">Read More</button>
                        @endif
                    </span>
                </td>
                <td>{{ $contract->typeOfContract }}</td>
                <td>{{ $contract->responseDeadline }}</td>
                                <td>{{ $contract->cpvCodes }}</td>
                <td>
                <span>
                    {{ strlen($contract->complaintProcedure) > 100 ? substr($contract->complaintProcedure, 0, 100) . '...' : $contract->complaintProcedure }}
                    @if (strlen($contract->complaintProcedure) > 100)
                        <button class="btn btn-link"
                                wire:click="loadText('Complaint Procedure', '{{ $contract->contract_id }}')"
                                data-bs-toggle="modal" data-bs-target="#textModal">Read More</button>
                    @endif
                    </span>
                </td>
                <td>{{ $contract->office }}</td>
                <td>{{ $contract->contact }}</td>
                                <td>{{ $contract->notice }}</td>
                                <td>{{ $contract->noticeLink }}</td>
                <td>{{ $contract->dateOfDispatch }}</td>
                                <td>{{ $contract->packageTitle }}</td>
                                <td>{{ $contract->packageAdditionalInformationHref }}</td>
                <td>{{ $contract->packageMailingAddress }}</td>
                <td>
                    <div class="dropdown">
                        @if($contract->status ===1)
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Approved
                            </button>
                        @elseif($contract->status === 0)
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Rejected
                            </button>
                        @else
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Select One
                            </button>
                        @endif
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" wire:click="changeStatus({{ $contract->id }}, 1)" href="#">Approved</a>
                            </li>
                            <li><a class="dropdown-item" wire:click="changeStatus({{ $contract->id }}, 0)" href="#">Rejected</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="18">No data found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex  justify-content-around pt-4 pb-4">
         <p class="text-start  flex-fill">Viewing {{ $contracts2->firstItem() }} - {{ $contracts2->lastItem() }}
             of {{ $contracts2->total() }} entries
         </p>
        <div class=" flex-fill">{{ $contracts2->links() }}</div>
    </div>--}}

    <x-modal wire:model="myModal2" title="{{ $modalTitle }}" separator>
        <div>{!! nl2br(e(@trim($selectedText))) !!}</div>

        <x-slot:actions>
            <x-button label="Close" @click="$wire.myModal2 = false"/>
        </x-slot:actions>
    </x-modal>

</div>

{{--<div>
    --}}{{-- Care about people's approval and you will be their prisoner. --}}{{--
    <h3 class="pt-0">Danish Refugee Councile Tenders and Contracts </h3>
    <div class="py-4">
        <fieldset class="border rounded-3 p-2 row-auto" style="width: fit-content">
            <legend class="float-none w-auto px-2 m-2 text-size-sm text-bold"
                    style="font-size: 1.2rem !important; line-height: 1rem !important;">
                Filter by Status
            </legend>
            <div class="btn-group btn-group-sm">
                <input type="checkbox" class="btn-check" wire:model.live="showApproved2" id="showApproved2"
                       autocomplete="off">
                <label class="btn btn-outline-success" for="showApproved2">Approved</label>

                <input type="checkbox" class="btn-check" wire:model.live="showRejected2" id="showRejected2"
                       autocomplete="off">
                <label class="btn btn-outline-danger" for="showRejected2">Rejected</label>

                <input type="checkbox" class="btn-check" wire:model.live="showNull2" id="showNull2" autocomplete="off">
                <label class="btn btn-outline-dark" for="showNull2">Not Selected</label>
            </div>
        </fieldset>
    </div>
    <table class="table table-bordered table-sm">
        <thead class="">
        <tr class="text-uppercase small">
            <th>ID</th>
            <th>Tender Reference</th>
            <th>Tender Title</th>
            <th>LINK TO CONTRACT</th>
            <th>Tender Closure</th>
            <th>Tender Published</th>
            <th>Tender Location</th>
            <th>Tender Category</th>
            <th>Tender Type</th>
            <th>Tender Contract Type</th>
            <th>Tender Description</th>
            <th>Tender Contact Office Name</th>
            <th>Timestamp</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($contracts2 as $contract)
            <tr>
                <td>{{ $contract->id }}</td>
                <td>{{ $contract->reference }}</td>
                <td>{{ $contract->title }}</td>
                <td><a href="{{ $contract->contract_page_link }}" target="_blank">Link</a></td>
                <td>{{ $contract->closure }}</td>
                <td>{{ $contract->published }}</td>
                <td>{{ $contract->location }}</td>
                <td>{{ $contract->category }}</td>
                <td>{{ $contract->tender_type }}</td>
                <td>{{ $contract->contract_type }}</td>
                <td>
                    <span>
                        {{ strlen($contract->description) > 100 ? substr($contract->description, 0, 100) . '...' : $contract->description }}
                        @if (strlen($contract->description) > 100)
                            <button class="btn btn-link"
                                    wire:click="loadText('Description',  '{{ $contract->reference }}')"
                                    data-bs-toggle="modal" data-bs-target="#textModal2">Read More</button>
                        @endif
                    </span>
                </td>
                <td>
                    {{ $contract->contact_office_name }}
                    <br>{{ $contract->contact_person_name }}
                    <br>{{ $contract->contact_person_position }}
                    <br>{{ $contract->contact_person_email }}
                </td>

                <td>{{ $contract->created_at }}</td>
                <td>
                    <div class="dropdown">
                        @if($contract->status ===1)
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Approved
                            </button>

                        @elseif($contract->status === 0)
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Rejected
                            </button>
                        @else
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Select One
                            </button>
                        @endif
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" wire:click="changeStatus({{ $contract->id }}, 1)" href="#">Approved</a></li>
                            <li><a class="dropdown-item" wire:click="changeStatus({{ $contract->id }}, 0)" href="#">Rejected</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="18">No data found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex  justify-content-around pt-4 pb-4">
       --}}{{-- <p class="text-start  flex-fill">Viewing {{ $contracts2->firstItem() }} - {{ $contracts2->lastItem() }}
            of {{ $contracts2->total() }} entries
        </p>--}}{{--
        <div class=" flex-fill">{{ $contracts2->links() }}</div>
    </div>

    <!-- Bootstrap Modal -->
    --}}{{--<div class="modal fade" id="textModal2" tabindex="-1" aria-labelledby="textModal2Label" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="textModal2Label">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        {!! nl2br(e(@trim($selectedText))) !!}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#textModal2').on('hidden.bs.modal', function (e) {
            console.log("Modal closed")
            $('.modal-body').empty()
        });

    </script>--}}{{--
</div>--}}
