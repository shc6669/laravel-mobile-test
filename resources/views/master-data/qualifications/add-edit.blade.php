@extends('layouts.app')

@section('page-title', 'Manage Master Data')
@section('page-heading', $edit ? $qualification->name : 'Manage Master Data - Education Qualifications')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('qualifications.index') }}">@lang('Education Qualifications')</a>
    </li>
    <li class="breadcrumb-item active">
        {{ $edit ? 'Edit Data' : 'Create Data' }}
    </li>
@stop

@section('content')

@include('partials.messages')

@if($edit)
    {!! Form::open(['route' => ['qualifications.update', $qualification->id], 'method' => 'PUT', 'id' => 'qualification-form']) !!}
@else
    {!! Form::open(['route' => 'qualifications.store', 'id' => 'qualification-form']) !!}
@endif

<input type="hidden" name="id" value="{{ $edit ? $qualification->id : null }}">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('Cars Owner')
                </h5>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Back" onclick="window.location.href='{{ route('qualifications.index') }}'">
                    <span>
                        <i class="fa fa-arrow-left"></i> Back
                    </span>
                </button>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text" class="form-control" id="name"
                           name="name" placeholder="@lang('Please input name')" value="{{ $edit ? $qualification->name : old('name') }}">
                </div>
            </div>
        </div>
        <div class="row pt-sm-4">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <button type="submit" class="btn btn-outline-success">
                    {{ $edit ? 'Update data' : 'Submit data' }}
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\MasterData\QualificationCreatedUpdatedRequest', '#qualification-form') !!}
    {!! HTML::script('assets/js/as/custom.js') !!}
@stop
