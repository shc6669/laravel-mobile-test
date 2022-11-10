@extends('layouts.app')

@section('page-title', 'Manage Candidate')
@section('page-heading', $data->applicant_name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('candidate-management.index') }}">@lang('Candidate Management')</a>
    </li>
    <li class="breadcrumb-item active">
        Show Data Candidate {{$data->applicant_name}}
    </li>
@stop

@section('styles')
    <style>
        .kv-file-remove {
            display: none !important;
        }
    </style>
@stop

@section('content')

@include('partials.messages')

<div class="card text-center">
    <div class="card-header">
        <button type="button" class="btn btn-outline-secondary btn-sm back-btn" data-toggle="tooltip" title="Back" onclick="window.location.href='{{ route('candidate-management.index') }}'">
            <span>
                <i class="fa fa-arrow-left"></i> Back
            </span>
        </button>
        <h1>
            {{$data->applicant_name}}
        </h1>
    </div>
    <div class="card-body">
        {{-- Candidate Details --}}
        <div class="container pb-sm-6">
            <h5 class="card-text">
                Canditate Details
            </h5>
            <br>
        </div>

        <div class="container pt-sm-9">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Education Name</th>
                                <th scope="col">Education Qualification</th>
                                <th scope="col">Education Country</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Last Position</th>
                                <th scope="col">Applied Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$data->education_name}}</td>
                                <td>{{$data->qualification->name}}</td>
                                <td>{{$data->country->name}}</td>
                                <td>{{$data->birthday}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->experience}} years</td>
                                <td>{{$data->last_position}}</td>
                                <td>{{$data->applied_position}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Candidate Skills --}}
        <div class="container" style="padding-top: 25px;">
            <h5 class="card-text">
                Candidate Skills
            </h5>
            <br>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-group list-group-horizontal-xl">
                        @foreach ($skills as $skill )
                        <li class="list-group-item">{{$skill}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Candidate Resume --}}
        <div class="container" style="padding-top: 25px;">
            <h5 class="card-text">
                Candidate Resume
            </h5>
            <br>
        </div>

        <div class="container">
            @isset($data->resume)
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input data-theme="fas" id="file_preview" name="file_preview" type="file">
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12">
                    <p class="text-muted well well-sm no-shadow">
                        <b>-- No File Available --</b>
                    </p>
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script type="text/javascript">
        // File Preview
        $('#file_preview').fileinput({
            allowedFileTypes: ['pdf'],
            initialPreviewAsData: true,
            overwriteInitial: false,
            showClose: false,
            showUpload: false,
            showRemove: false,
            theme: 'fas',
            language: 'en',
            initialPreview: [
                '{{ asset("storage/upload/files/".$data->resume) }}',               
            ],
            initialPreviewConfig: [
                {
                    caption: '{{ $data->name }}',
                    width: '150px',
                    key: {{ $data->id }}
                },
            ]
        });
    </script>
@stop