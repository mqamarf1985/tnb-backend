
<div>
    <x-tabs selected="contracts-one-tab">
        <x-tab name="contracts-one-tab" label="Contracts One" icon="o-sparkles">
            <div> @livewire('contracts-table-one')</div>
        </x-tab>
        <x-tab name="contract-two-tab" label="Contracts Two" icon="o-sparkles">
            <div>@livewire('contracts-table-two')</div>
        </x-tab>
        <x-tab name="contract-three-tab" label="Contracts Three" icon="o-sparkles">
            <div>@livewire('contracts-table-three')</div>
        </x-tab>
        <x-tab name="contract-four-tab" label="Contracts Four" icon="o-sparkles">
            <div>@livewire('contracts-table-four')</div>
        </x-tab>
    </x-tabs>


   {{-- <ul class="nav nav-pills nav-fill  mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="table-one-tab" data-bs-toggle="tab" data-bs-target="#tableOne" type="button" role="tab" aria-controls="tableOne" aria-selected="true">Contract One</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="table-two-tab" data-bs-toggle="tab" data-bs-target="#tableTwo" type="button" role="tab" aria-controls="tableTwo" aria-selected="false">Contract Two</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="table-three-tab" data-bs-toggle="tab" data-bs-target="#tableThree" type="button" role="tab" aria-controls="tableThree" aria-selected="false">Contract Three</button>
        </li>
        <!-- Repeat for other tables -->
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tableOne" role="tabpanel" aria-labelledby="table-one-tab">
            @livewire('contracts-table-one')
        </div>
        <div class="tab-pane fade" id="tableTwo" role="tabpanel" aria-labelledby="table-two-tab">
            @livewire('contracts-table-two')
        </div>
        <div class="tab-pane fade" id="tableThree" role="tabpanel" aria-labelledby="table-three-tab">
            @livewire('contracts-table-three')
        </div>
        <!-- Repeat for other tables -->
    </div>--}}
</div>

{{--<div>
    <h3 class="pt-0 pd-4">Welt Hunger Hilfe Tenders and Contracts </h3>
    <table class="table table-bordered table-sm">
        <thead class="">
        <tr class="text-uppercase small">
            <th>Id</th>
            <th>Reference</th>
            <th>Title</th>
            <th>Link</th>
            <th>Description</th>
            <th>Type of Contract</th>
            <th>Response Deadline</th>
            <th>CPV Codes</th>
            <th>Complaint Procedure</th>
            <th>Office</th>
            <th>Contact</th>
            <th>Published Notice</th>
            <th>Publish Notice Link</th>
            <th>Date of Dispatch</th>
            <th>Package Title</th>
            <th>Attached Documents Link</th>
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
                <td><a href="{{ $contract->link }}">Link</a></td>
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
                    <button wire:click="changeStatus({{ $contract->id }}, 'active')">Active</button>
                    <button wire:click="changeStatus({{ $contract->id }}, 'inactive')">Inactive</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No data found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="textModal" tabindex="-1" aria-labelledby="textModalLabel" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="textModalLabel">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
--}}{{--                    {{ ltrim(str_replace('\n','<br>',$selectedText)) }}--}}{{--
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
        $('#textModal').on('hidden.bs.modal', function (e){
            console.log("Modal closed")
            $('.modal-body').empty()
            // $('.modal-body').remove();
            // $('.modal-body').clear();
            // $(this).removeData('bs.modal');
        });

    </script>
</div>--}}
