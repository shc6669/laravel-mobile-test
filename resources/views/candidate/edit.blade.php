@extends('layouts.app')

@section('page-title', 'Manage Candidate')
@section('page-heading', $data->applicant_name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('candidate-management.index') }}">@lang('Candidate Management')</a>
    </li>
    <li class="breadcrumb-item active">
        Edit Data
    </li>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => ['candidate-management.update', $data->id], 'method' => 'PUT', 'id' => 'candidate-form', 'enctype' => 'multipart/form-data']) !!}

<input type="hidden" name="id" value="{{ $data->id }}">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <h5 class="card-title">
                    @lang('Applicant Form')
                </h5>
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Back" onclick="window.location.href='{{ route('candidate-management.index') }}'">
                    <span>
                        <i class="fa fa-arrow-left"></i> Back
                    </span>
                </button>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="education_qualification_id">@lang('Education Qualification')</label>
                    <select class="form-control input-solid" id="education_qualification_id" name="education_qualification_id">
                        <option></option>
                        @foreach($qualifications as $qualification)
                            <option value="{{$qualification->id}}" {{$qualification->id == $data->education_qualification_id ? 'selected': '' }}>{{$qualification->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="education_name">@lang('Education Name')</label>
                    <input type="text" class="form-control" id="education_name" name="education_name" value="{{ $data->education_name ? $data->education_name : old('education_name') }}" placeholder="@lang('Please input name')">
                </div>
                <div class="form-group">
                    <label for="applicant_name">@lang('Applicant Name')</label>
                    <input type="text" class="form-control" id="applicant_name" name="applicant_name" value="{{ $data->applicant_name ? $data->applicant_name : old('applicant_name') }}" placeholder="@lang('Please input applicant name')">
                </div>
                <div class="form-group">
                    <label for="email">@lang('Applicant Email')</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email ? $data->email : old('email') }}" placeholder="@lang('Please input email')">
                </div>
                <div class="form-group">
                    <label for="applied_position">@lang('Applied Position')</label>
                    <input type="text" class="form-control" id="applied_position" name="applied_position" value="{{ $data->applied_position ? $data->applied_position : old('applied_position') }}" placeholder="@lang('Please input applied position')">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="education_country_id">@lang('Education Country')</label>
                    <select class="form-control input-solid" id="education_country_id" name="education_country_id">
                        <option></option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{$country->id == $data->education_country_id ? 'selected': '' }}>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">@lang('Experience (in years)')</label>
                    <input type="number" class="form-control" id="experience" name="experience" value="{{ $data->experience ? $data->experience : old('experience') }}" placeholder="@lang('Please input how many experience (in years)')">
                </div>
                <div class="form-group">
                    <label for="birthday">@lang('Applicant Birthday')</label>
                    <div class="form-group">
                        <input type="text" name="birthday" value="{{ $data->birthday ? $data->birthday : old('birthday') }}" id='birthday' class="form-control input-solid" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">@lang('Applicant Phone')</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{ $data->phone ? $data->phone : old('phone') }}" placeholder="@lang('Please input phone')">
                </div>
                <div class="form-group">
                    <label for="last_position">@lang('Last Position')</label>
                    <input type="text" class="form-control" id="last_position" name="last_position" value="{{ $data->last_position ? $data->last_position : old('last_position') }}" placeholder="@lang('Please input last position')">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="skills">@lang('Skills')</label>
                    <select class="form-control input-solid" id="skills" name="skills[]" multiple="multiple">
                        <option value=""></option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- File Resume Preview --}}
        @isset($data->resume)
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="file_preview">@lang('Resume File Preview')</label>
                    <input data-theme="fas" id="file_preview" name="file_preview" type="file">
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <p class="text-muted well well-sm no-shadow">
                    <b>-- No File Available --</b>
                </p>
            </div>
        </div>
        @endisset

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-info btn-sm btn-block" data-toggle="tooltip" title="Reupload Resume" id="upload">
                        <i class="fas fa-upload"></i> Reupload Resume
                    </button>
                </div>
            </div>
        </div>
        <div class="row" id="reupload">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="form-group">
                    <label for="resume">@lang('Resume')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="resume">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-sm-2">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <button type="submit" class="btn btn-outline-success">
                    Edit data
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Candidate\UpdateRequest', '#candidate-form') !!}
    {!! HTML::script('assets/js/as/custom.js') !!}

    <script type="text/javascript">
        // Custom Fileinput Bootstrap
        $(document).ready(function () {
            bsCustomFileInput.init();
        })
        
        var GetTagSkills = function(data_id) {
            $.ajax({
                url : "{{ URL::to('admin/candidate-management/tag-skills') }}/" + data_id,
                type: 'get',
                dataType: 'json',
            })
            .done(function(response) {
                $("#skills").val(response).change();
            })
            .fail(function(xhr) {
                console.log(xhr);
            })
        }

        var data_id = "{{ $data->id }}";
        if($.trim(data_id)){      
            GetTagSkills(data_id);
        }

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
                    url: "{{ route('delete.file', $data->id) }}",
                    key: {{ $data->id }},
                    extra: {
                        _token: "{{ csrf_token() }}",
                        id: {{ $data->id }},
                    }
                },
            ]
        }).on('filebeforedelete', function() {
            return new Promise(function(resolve, reject) {
                $.confirm({
                    title: 'Confirmation!',
                    content: 'Do you want to delete this file?',
                    type: 'red',
                    buttons: {
                        ok: {
                            btnClass: 'btn-success text-white',
                            keys: ['enter'],
                            action: function(){
                                resolve();
                            }
                        },
                        cancel: function(){
                            $.alert('Failed delete file!');
                        }
                    }
                });
            });
        }).on('filedeleted', function() {
            setTimeout(function() {
                $.alert('File deleted!');
            });
            setTimeout(function() {
                window.location.reload();
            }, 1500);
        });

        // Reupload File
        $('#reupload').hide();
        $('#upload').click(function() {
            $('#reupload').toggle();
        });
        $(".btnRmv").on("click", function(){
            $(this).closest('div.removable').remove();
        });
    </script>
@stop
