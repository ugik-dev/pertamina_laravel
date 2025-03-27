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
    <div class="authentication-wrapper authentication-basic container-p-y"
        style="background-image: url({{ asset('assets/img/background-3.jpg') }}) !important;
    background-position: center bottom;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;">


        <div class="authentication-inner py-4">
            <!-- Login -->

            <div class="card p-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-5  ms-2 me-2">
                    <a href="#" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo w-100">
                            <img class="w-100" src="{{ url('/assets/img/logo2.png') }}">
                            {{-- @include('_partials.macros', ['width' => 155, 'withbg' => 'var(--bs-primary)']) --}}
                        </span>
                    </a>
                </div>
                <div class="app-brand justify-content-center mt-3">
                    <h4 class="app-brand-text demo text-heading fw-bold">PORTAL PERTAFIT</h4>
                </div>
                <!-- /Logo -->
                <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('home') }}">
                        <div class="card bg-primary mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-info mb-1">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-white">Dashbord</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 text-white ">Informasi utama dan artikel lainnya</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/card-ratings-illustration.png') }}"
                                            alt="Ratings" class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('portal.scan-fit') }}">
                        <div class="card bg-success mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-success mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-white">Scan DCU</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-0 text-white">Scan disini untuk cek status daily checkup
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/scanner2.png') }}" alt="Ratings"
                                            class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('portal.scan-sebuse') }}">
                        <div class="card bg-success mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-success mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-white">SEBUSE</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-0 text-white">Scan disini untuk cek sebuse
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/scanner2.png') }}" alt="Ratings"
                                            class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('portal.scan-workout') }}">
                        <div class="card bg-success mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-success mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-white">WORKOUT</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-0 text-white">Scan disini untuk cek workout
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/scanner2.png') }}" alt="Ratings"
                                            class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('login') }}">
                        <div class="card bg-success mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-info mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-white">Bank Data</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-2 text-white">Scan disini untuk lihat data anda</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/bank-data.png') }}" alt="Ratings"
                                            class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <div class="col-lg-12 col-sm-12">
                    <a href="{{ route('login') }}">
                        <div class="card bg-danger mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-info mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-white">Login</h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-2 text-white">Management</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <img src="{{ asset('assets/img/illustrations/login.png') }}" alt="Ratings"
                                            class="img-fluid" width="95">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
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
