@extends('layouts.app')

@section('page-title', 'Manage Master Data')
@section('page-heading', 'Education Qualifications')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Education Qualifications
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <div class="row mb-3 pb-3 border-bottom-light">
			<div class="col-lg-12">
				<div class="float-right">
					<a href="{{ route('qualifications.create') }}" class="btn btn-primary btn-rounded float-right">
						<i class="fas fa-plus mr-2"></i>
						@lang('Add Education Qualifications')
					</a>
				</div>
			</div>
		</div>

        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="qualifications-table-wrapper">
                        <thead class="thead-dark">
                            <tr>
                                <th class="w-20"></th>
                                <th class="min-width-200">@lang('Qualification Name')</th>
                                <th class="min-width-10">@lang('Action')</th>
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
        DataTableElement = $('#qualifications-table-wrapper');
        TableColumns = [
            {data: "DT_RowIndex", orderable:false, filter: false, searchable: false},
            {data: "name", name:"name", orderable:false, filter: false},
            {data: "action", name: "action",orderable: false, searchable: false}
        ];

        var Datatable = {
            "init" : function(){
                dtqualification = {
                    /*destroy: true,*/
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("get.qualification") }}',
                    columns: TableColumns,
                    columnDefs: [{
                        targets: 0,
                        searchable: false,
                        className: 'dt-body-center'
                    }],
                    responsive:!0, lengthMenu:[[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],pageLength:15,
                }; DataTableElement.DataTable(dtqualification);
            }
        };

        $(document).ready(function(){
            // ...
            Datatable.init();
        });
    </script>
@stop
