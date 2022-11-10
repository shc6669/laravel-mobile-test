@extends('layouts.auth')

@section('page-title', trans('Login'))

@section('content')

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-30 pt-15">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-10">
                    <img src="{{ url('auth_assets/media/logos/logo-letter-1.png') }}"  class="max-h-70px" alt="{{ setting('app_name') }}">
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">Candidate Application System</h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ url('auth_assets/media/svg/patterns/rhone-2.svg') }})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-signin">

                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_signin_form" action="<?= url('login') ?>" method="POST">
                        {{ csrf_field() }}
                        @if (Request::has('to'))
                            <input type="hidden" value="{{ Request::get('to') }}" name="to">
                        @endif
                        @if (setting('reg_enabled'))
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Authorized Personnel Only</h3>
                            <span class="text-muted font-weight-bold font-size-h4">New Here?
                            <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
                        </div>
                        @endif
                        <!--end::Title-->

                        {{-- Error Message --}}
                        @include('partials.auth-messages')

                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">@lang('Email or Username')</label>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="text" name="username" autocomplete="off" placeholder="@lang('Email or Username')" value="{{ old('username') }}" />
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">@lang('Password')</label>
                                <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">@lang('Forgot password?')</a>
                            </div>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" name="password" placeholder="@lang('Password')" autocomplete="off" />
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group -->
                        @if (setting('remember_me'))
                            <div class="form-group row">
                                <div class="col-9 col-form-label">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                            <input type="checkbox" name="remember" value="1"/>
                                            <span></span>
                                            @lang('Remember me?')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--end::Form group -->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <button type="submit" id="kt_login_signin_submit" class="btn btn-outline-success btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                @lang('Log In')
                                <!--begin::Svg Icon-->
                                <span class="svg-icon svg-icon-2hx">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
                                        <path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"/>
                                        <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" onclick="window.location='{{ route("home.front") }}'">
                                @lang('Landingpage')
                                <!--begin::Svg Icon-->
                                <span class="svg-icon svg-icon-2hx">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="black"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->

                <!--begin::Signup-->
                <div class="login-form login-signup">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_signup_form" action="<?= url('register') ?>" method="POST">
                        {{ csrf_field() }}
                        <!--begin::Title-->
                        <div class="pb-4 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Register New User</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
                        </div>
                        <!--end::Title-->

                        {{-- Error Message --}}
                        @include('partials.auth-messages')

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="@lang('Email')" name="email" value="{{ old('email') }}" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="@lang('Username')" name="username" value="{{ old('username') }}" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="@lang('Firstname')" name="first_name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="@lang('Lastname')" name="last_name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="@lang('Password')" name="password" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="@lang('Confirm Password')" name="password_confirmation" autocomplete="off" />
                        </div>
                        <!--end::Form group-->

                        {{-- Only display TOS if it is enabled --}}
                        @if (setting('tos'))
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="checkbox mb-0">
                                    <input type="checkbox" name="agree" />
                                    <span></span>
                                    <div class="ml-2">I Agree the
                                    <a href="#">terms and conditions</a>.</div>
                                </label>
                            </div>
                            <!--end::Form group-->
                        @endif
                        {{-- end TOS --}}

                        {{-- Only display captcha if it is enabled --}}
                        @if (setting('registration.captcha.enabled'))
                            <!--begin::Form group-->
                            <div class="form-group">
                                {!! app('captcha')->display() !!}
                            </div>
                            <!--end::Form group-->
                        @endif
                        {{-- end captcha --}}

                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                            <button type="submit" id="kt_login_signup_submit" class="btn btn-outline-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">@lang('Register')</button>
                            <button type="button" id="kt_login_signup_cancel" class="btn btn-outline-secondary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signup-->

                <!--begin::Forgot-->
                <div class="login-form login-forgot">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_forgot_form" action="<?= route('password.email') ?>" method="POST">
                        {{ csrf_field() }}
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                            <p class="text-muted font-weight-bold font-size-h4">@lang('Please provide your email below and we will send you a password reset link.')</p>
                        </div>
                        <!--end::Title-->

                        {{-- Error Message --}}
                        @include('partials.auth-messages')

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="@lang('Your E-Mail')" name="email" autocomplete="off" />
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap pb-lg-0">
                            <button type="button" id="kt_login_forgot_submit" class="btn btn-outline-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                            <button type="button" id="kt_login_forgot_cancel" class="btn btn-outline-secondary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Forgot-->

            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                    <span class="mr-1">{{date('Y')}} © Chandrayana Putra</span>
                    {{-- <a href="#" target="_blank" class="text-dark-75 text-hover-primary">Chandrayana Putra</a> --}}
                </div>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->

@stop

@section('scripts')
    <script src="{{ url('auth_assets/js/pages/custom/login/login-general.js?v=7.0.5') }}"></script>
@endsection
