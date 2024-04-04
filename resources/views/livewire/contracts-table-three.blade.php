@php
    $headers = [
        ['key' => 'project_id', 'label' => 'project id', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'notice_title', 'label' => 'Title', 'class' => 'm-0 p-2'],
        ['key' => 'bid_reference_no', 'label' => 'Bid Reference No', 'class' => 'm-0 p-2'],
        ['key' => 'project_ctry_name', 'label' => 'Project Country', 'class' => 'm-0 p-2'],
        ['key' => 'submission_date', 'label' => 'Submission Date', 'class' => 'm-0 p-2'],
        ['key' => 'notice_date', 'label' => 'Notice Date', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'project_name', 'label' => 'Project Name', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'notice_type', 'label' => 'Notice Type', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'bid_description', 'label' => 'Bid Description', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'contact', 'label' => 'Contact', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'proc_detail_link', 'label' => 'Link To Contract', 'class' => 'm-0 p-2 w-1'],
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
                <x-checkbox label="Approved" wire:model.live="showApproved3" id="showApproved3" class="checkbox-success"
                            @click.stop="" tight/>
            </x-menu-item>

            <x-menu-item>
                <x-checkbox label="Rejected" wire:model.live="showRejected3" id="showRejected3" class="checkbox-error"
                            @click.stop="" tight/>
            </x-menu-item>
            <x-menu-item>
                <x-checkbox label="Not Selected" wire:model.live="showNull3" id="showNull3" class="checkbox-primary"
                            @click.stop="" tight/>
            </x-menu-item>
        </x-dropdown>
    </div>
    <x-table :headers="$headers" :rows="$contracts3" striped :cell-decoration="$cell_decoration" with-pagination
             class="w-full text-sm ">
        @scope('cell_proc_detail_link', $contracts3)
        <a label="View" href="{{ $contracts3->proc_detail_link }}" target="_blank" class="btn btn-link">View</a>
        @endscope
        @scope('cell_status', $contracts3)
        <x-dropdown>
            <x-slot:trigger>
                <x-button
                    label="{{ $contracts3->status === 1 ? 'Approved' : ( $contracts3->status === 0 ? 'Rejected' : 'Select Status') }}"
                    class="btn-sm text-sm text-nowrap m-0 p-0 px-2
                    {{ $contracts3->status === 1 ? 'btn-success' : ( $contracts3->status === 0 ? 'btn-error' : 'btn-ghost') }}"/>
            </x-slot:trigger>

            <x-menu-item title="Approved" icon="fas.check" wire:click="changeStatus('{{ $contracts3->contract_id }}', 1)"/>
            <x-menu-item title="Rejected" icon="fas.xmark" wire:click="changeStatus('{{ $contracts3->contract_id }}', 0)"/>
        </x-dropdown>
        @endscope
        @scope('cell_bid_description', $contracts3)
        @if (strlen($contracts3->bid_description) > 100)
            {{substr($contracts3->bid_description, 0, 100) . '...'}}<br>

            <x-button label="Open" wire:click="loadText('Bid Description',  '{{ $contracts3->contract_id }}')"
                      class="btn btn-link" spinner/>
        @else
            {{ $contracts3->bid_description }}
        @endif
        @endscope
        @scope('cell_contact', $contracts3)
        {{ $contracts3->contact_organization }}<br>
        {{ $contracts3->contact_name }}<br>
        {{ $contracts3->contact_job_title }}<br>
        {{ $contracts3->contact_email }}<br>
        {{ $contracts3->contact_address }}<br>
        {{ $contracts3->contact_ctry_name }}<br>
        {{ $contracts3->contact_phone_no }}
        @endscope
    </x-table>

    <x-modal wire:model="myModal3" title="{{ $modalTitle }}" separator>
        <div>{!! nl2br(e(@trim($selectedText))) !!}</div>
        <x-slot:actions>
            <x-button label="Close" @click="$wire.myModal3 = false"/>
        </x-slot:actions>
    </x-modal>

</div>
