@php
    $headers = [
        ['key' => 'contract_id', 'label' => 'Id', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'reference', 'label' => 'Reference', 'class' => 'm-0 p-2'],
        ['key' => 'title', 'label' => 'Title', 'class' => 'm-0 p-2'],
        ['key' => 'link', 'label' => 'Link To Contract', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'typeOfContract', 'label' => 'Type of Contract', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'responseDeadline', 'label' => 'Response Deadline', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'complaintProcedure', 'label' => 'Complaint Procedure', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'office', 'label' => 'Office', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'contact', 'label' => 'Contact', 'class' => 'm-0 p-2 w-1 text-wrap'],
        ['key' => 'dateOfDispatch', 'label' => 'Date of Dispatch', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'packageMailingAddress', 'label' => 'Mailing Address', 'class' => 'm-0 p-2 w-1'],
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
            <x-menu-item title="Clear" wire:click="uncheckAllFilters()" id="uncheckAllFilters" icon="o-arrow-path" left/>

            <x-menu-separator/>
            <x-menu-item>
                <x-checkbox label="Approved" wire:model.live="showApproved" id="showApproved" class="checkbox-success"  @click.stop="" tight/>
            </x-menu-item>

            <x-menu-item>
                <x-checkbox label="Rejected" wire:model.live="showRejected" id="showRejected" class="checkbox-error"  @click.stop="" tight/>
            </x-menu-item>
            <x-menu-item>
                <x-checkbox label="Not Selected" wire:model.live="showNull" id="showNull" class="checkbox-primary"  @click.stop="" tight/>
            </x-menu-item>
        </x-dropdown>
    </div>
    <x-table :headers="$headers" :rows="$contracts" striped :cell-decoration="$cell_decoration" with-pagination
             class="w-full text-sm ">
        @scope('cell_link', $contracts)
        <x-button label="View" link="{{ $contracts->link }}" target="_blank" class="btn btn-link"/>
        @endscope
        @scope('cell_status', $contracts)
        <x-dropdown>
            <x-slot:trigger>
                <x-button
                    label="{{ $contracts->status === 1 ? 'Approved' : ( $contracts->status === 0 ? 'Rejected' : 'Select Status') }}"
                    class="btn-sm text-sm text-nowrap m-0 p-0 px-2
                    {{ $contracts->status === 1 ? 'btn-success' : ( $contracts->status === 0 ? 'btn-error' : 'btn-ghost') }}"/>
            </x-slot:trigger>

            <x-menu-item title="Approved" icon="fas.check" wire:click="changeStatus({{ $contracts->id }}, 1)"/>
            <x-menu-item title="Rejected" icon="fas.xmark" wire:click="changeStatus({{ $contracts->id }}, 0)"/>
        </x-dropdown>
        @endscope
        @scope('cell_description', $contracts)
        @if (strlen($contracts->description) > 100)
            {{substr($contracts->description, 0, 100) . '...'}}<br>

            <x-button label="Open" wire:click="loadText('Description',  '{{ $contracts->contract_id }}')"
                      class="btn btn-link" spinner/>
        @else
            {{ $contracts->description }}
        @endif
        @endscope
        @scope('cell_complaintProcedure', $contracts)
        @if (strlen($contracts->complaintProcedure) > 100)
            {{ substr($contracts->complaintProcedure, 0, 100) . '...' }}<br>
            <x-button label="Open" wire:click="loadText('Complaint Procedure',  '{{ $contracts->contract_id }}')"
                      class="btn btn-link" spinner/>
        @endif
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
        @forelse ($contracts as $contract)
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
         <p class="text-start  flex-fill">Viewing {{ $contracts->firstItem() }} - {{ $contracts->lastItem() }}
             of {{ $contracts->total() }} entries
         </p>
        <div class=" flex-fill">{{ $contracts->links() }}</div>
    </div>--}}

    <x-modal wire:model="myModal1" title="{{ $modalTitle }}" separator>
        <div>{!! nl2br(e(@trim($selectedText))) !!}</div>

        <x-slot:actions>
            <x-button label="Close" @click="$wire.myModal1 = false"/>
        </x-slot:actions>
    </x-modal>

</div>
