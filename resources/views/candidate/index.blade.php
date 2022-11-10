@extends('layouts.app')

@section('page-title', 'Manage Data')
@section('page-heading', 'Candidate Management')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Candidate Management
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        @if(auth()->user()->hasRole('Admin_HRD'))
        <div class="row mb-3 pb-3 border-bottom-light">
			<div class="col-lg-12">
				<div class="float-right">
					<a href="{{ route('candidate-management.create') }}" class="btn btn-primary btn-rounded float-right">
						<i class="fas fa-plus mr-2"></i>
						@lang('Add Data')
					</a>
				</div>
			</div>
		</div>
        @endif

        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="candidate-table-wrapper">
                        <thead class="thead-dark">
                            <tr>
                                <th class="w-20"></th>
                                <th class="min-width-80">@lang('Applicant Name')</th>
                                <th class="min-width-80">@lang('Applicant Email')</th>
                                @if(auth()->user()->hasRole('Admin_HRD'))
                                <th class="min-width-90">@lang('Action')</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script type="text/javascript">
        DataTableElement = $('#candidate-table-wrapper');
        TableColumns = [
            {data: "DT_RowIndex", orderable:false, filter: false, searchable: false},
            {data: "name", name:"name", orderable:false, filter: false},
            {data: "email", name:"email", orderable:false, filter: false},
            @if(auth()->user()->hasRole('Admin_HRD'))
            {data: "action", name: "action",orderable: false, searchable: false}
            @endif
        ];

        var Datatable = {
            "init" : function(){
                dtcandidate = {
                    /*destroy: true,*/
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("get.candidate") }}',
                    columns: TableColumns,
                    columnDefs: [{
                        targets: 0,
                        searchable: false,
                        className: 'dt-body-center'
                    }],
                    responsive:!0, lengthMenu:[[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],pageLength:15,
                }; DataTableElement.DataTable(dtcandidate);
            }
        };

        $(document).ready(function(){
            // ...
            Datatable.init();
        });
    </script>
@stop
