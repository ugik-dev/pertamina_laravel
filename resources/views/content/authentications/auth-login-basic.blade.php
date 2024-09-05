@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp @extends('layouts/layoutMaster')
@section('title', 'Login') @section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection @section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
@endsection @section('vendor-script')
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection @section('page-script')
<script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection @section('content')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card p-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-5">
                    <a href="{{ url('/assets/img/logo.png') }}" width=300 class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            @include('_partials.macros', ['width' => 155, 'withbg' => 'var(--bs-primary)'])
                        </span>
                        {{-- <span class="app-brand-text demo text-heading fw-bold">PERTAFIT</span> --}}
                    </a>
                </div>
                <!-- /Logo -->

                <div class="card-body mt-2">
                    {{-- <h4 class="mb-2">PSC 119</h4>
                    <h4 class="mb-2">Sepintu Sedulang</h4>
                    <h4 class="mb-2">Kabupaten Bangka</h4> --}}
                    <p class="mb-4">Masukkan username dan password.</p>
                    @if (session('error'))
                        <p>{{ session('error') }}</p>
                    @endif
                    <form id="formAuthentication2" class="mb-3">
                        @csrf
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter your username" autofocus />
                            <label for="username">Username</label>
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                            <a href="javascript:void(0);" class="float-end mb-1">
                                <span>Forgot Password?</span>
                            </a>
                        </div> --}}
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('portal') }}" class="btn btn-white d-grid w-100">Back to
                                Portal</a>
                        </div>
                    </form>

                    {{-- <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ url('auth/register-basic') }}">
                            <span>Create an account</span>
                        </a>
                    </p>

                    <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                            <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                            <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                            <i class="tf-icons mdi mdi-24px mdi-github"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                            <i class="tf-icons mdi mdi-24px mdi-google"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login -->
            <img alt="mask"
                src="{{ asset('assets/img/illustrations/auth-basic-login-mask-' . $configData['style'] . '.png') }}"
                class="authentication-image d-none d-lg-block"
                data-app-light-img="illustrations/auth-basic-login-mask-light.png"
                data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
        </div>
    </div>
</div>
{{-- @endsection
@section('page-script') --}}
<script>
    $(document).ready(function() {
        cur_sh = 'hide';
        $('.show-hide').on('click', function() {
            if (cur_sh == 'hide') {
                console.log('go show')
                cur_sh = 'show';
                $('#password').prop('type', 'text')
            } else {
                // console.log('go show')
                cur_sh = 'hide';
                $('#password').prop('type', 'password')
            }
        })
        var loginForm = $('#formAuthentication2');


        console.log('masuk')
        loginForm.on('submit', function(event) {
            event.preventDefault();
            // return;
            Swal.fire({
                title: 'Please Wait !',
                html: 'Loggin ..', // add html attribute if you want or remove
                // allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light d-none'
                },
                buttonsStyling: false,
                showCancelButton: false,
                showConfirmButton: false,
                showLoaderOnConfirm: false,
            });
            Swal.showLoading()
            $.ajax({
                url: "{{ route('auth-login-process') }}",
                type: "POST",
                data: loginForm.serialize(),
                success: (data) => {
                    // buttonIdle(submitBtn);
                    // json = JSON.parse(data);
                    console.log(data)
                    if (data['error']) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: data['message'],
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect'
                            }
                        });
                        return;
                    }
                    $(location).attr('href', "{{ route('dashboard') }}");
                },
                error: () => {
                    // buttonIdle(submitBtn);
                }
            });
        });
    });
</script>
@endsection
