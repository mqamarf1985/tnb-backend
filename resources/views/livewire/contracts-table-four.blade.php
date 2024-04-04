@php
    $headers = [
        ['key' => 'id', 'label' => 'project id', 'class' => 'm-0 p-2 w-1'],
        ['key' => 'title', 'label' => 'Title', 'class' => 'm-0 p-2'],
        ['key' => 'date', 'label' => 'Bid Reference No', 'class' => 'm-0 p-2'],
        ['key' => 'description', 'label' => 'Project Country', 'class' => 'm-0 p-2'],
        ['key' => 'detail_text', 'label' => 'Submission Date', 'class' => 'm-0 p-2'],
        ['key' => 'categories', 'label' => 'Notice Date', 'class' => 'm-0 p-2 w-1'],

        ['key' => 'detail_page_link', 'label' => 'Link To Contract', 'class' => 'm-0 p-2 w-1'],
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
                <x-checkbox label="Approved" wire:model.live="showApproved4" id="showApproved4" class="checkbox-success"
                            @click.stop="" tight/>
            </x-menu-item>

            <x-menu-item>
                <x-checkbox label="Rejected" wire:model.live="showRejected4" id="showRejected4" class="checkbox-error"
                            @click.stop="" tight/>
            </x-menu-item>
            <x-menu-item>
                <x-checkbox label="Not Selected" wire:model.live="showNull4" id="showNull4" class="checkbox-primary"
                            @click.stop="" tight/>
            </x-menu-item>
        </x-dropdown>
    </div>
    <x-table :headers="$headers" :rows="$contracts4" striped :cell-decoration="$cell_decoration" with-pagination
             class="w-full text-sm ">
        @scope('cell_detail_page_link', $contracts4)
        <a label="View" href="{{ $contracts4->detail_page_link }}" target="_blank" class="btn btn-link">View</a>
        @endscope
        @scope('cell_status', $contracts4)
        <x-dropdown>
            <x-slot:trigger>
                <x-button
                    label="{{ $contracts4->status === 1 ? 'Approved' : ( $contracts4->status === 0 ? 'Rejected' : 'Select Status') }}"
                    class="btn-sm text-sm text-nowrap m-0 p-0 px-2
                    {{ $contracts4->status === 1 ? 'btn-success' : ( $contracts4->status === 0 ? 'btn-error' : 'btn-ghost') }}"/>
            </x-slot:trigger>

            <x-menu-item title="Approved" icon="fas.check" wire:click="changeStatus('{{ $contracts4->id }}', 1)"/>
            <x-menu-item title="Rejected" icon="fas.xmark" wire:click="changeStatus('{{ $contracts4->id }}', 0)"/>
        </x-dropdown>
        @endscope
        @scope('cell_description', $contracts4)
        @if (strlen($contracts4->description) > 100)
            {{substr($contracts4->description, 0, 100) . '...'}}<br>

            <x-button label="Open" wire:click="loadText('Bid Description',  '{{ $contracts4->id }}')"
                      class="btn btn-link" spinner/>
        @else
            {{ $contracts4->description }}
        @endif
        @endscope
        @scope('cell_detail_text', $contracts4)
        @if (strlen($contracts4->detail_text) > 100)
            {{substr($contracts4->detail_text, 0, 100) . '...'}}<br>

            <x-button label="Open" wire:click="loadText('Detail Text',  '{{ $contracts4->id }}')"
                      class="btn btn-link" spinner/>
        @else
            {{ $contracts4->detail_text }}
        @endif
        @endscope
        @scope('cell_contact', $contracts4)
        {{ $contracts4->contact_organization }}<br>
        {{ $contracts4->contact_name }}<br>
        {{ $contracts4->contact_job_title }}<br>
        {{ $contracts4->contact_email }}<br>
        {{ $contracts4->contact_address }}<br>
        {{ $contracts4->contact_ctry_name }}<br>
        {{ $contracts4->contact_phone_no }}
        @endscope
    </x-table>

    <x-modal wire:model="myModal4" title="{{ $modalTitle }}" separator>
        <div>{!! nl2br(e(@trim($selectedText))) !!}</div>
        <x-slot:actions>
            <x-button label="Close" @click="$wire.myModal4 = false"/>
        </x-slot:actions>
    </x-modal>
</div>
