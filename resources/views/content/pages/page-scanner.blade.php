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
<style>
    button.html5-qrcode-element,
    select.html5-qrcode-element,
    button.scanapp-button {
        appearance: none;
        background-color: #FAFBFC;
        border: 1px solid rgba(27, 31, 35, 0.15);
        border-radius: 6px;
        box-shadow: rgba(27, 31, 35, 0.04) 0 1px 0, rgba(255, 255, 255, 0.25) 0 1px 0 inset;
        box-sizing: border-box;
        color: #24292E;
        cursor: pointer;
        display: inline-block;
        font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        list-style: none;
        padding: 6px 16px;
        position: relative;
        transition: background-color 0.2s cubic-bezier(0.3, 0, 0.5, 1);
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
        white-space: nowrap;
        word-wrap: break-word;
        margin-bottom: 5px;
    }
</style>
@endsection @section('vendor-script')
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>

@endsection @section('page-script')
<script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@section('content')
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
                    <div class="app-brand justify-content-center mt-5">
                        <a href="{{ url('/assets/img/logo.png') }}" width=300 class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                @include('_partials.macros', [
                                    'width' => 155,
                                    'withbg' => 'var(--bs-primary)',
                                ])
                            </span>
                            {{-- <span class="app-brand-text demo text-heading fw-bold">Scanner</span> --}}
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-2">
                        <div id="reader" class="mr-3 ml-3 w-100" style="margin:0 auto;"></div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div id="result" class="card mb-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <div class="card-info mb-2">
                                            <strong>
                                                <h4 class="mb-3 text-nowrap text-bold text-bold"><span id="user_name">
                                                </h4>
                                            </strong>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <h5 class="mb-0 me-2 text-bold"><span id="check_time"></h5>
                                        </div>
                                        <div class="" id="fit_result">
                                            <span class='badge rounded-pill bg-label-warning'></span>
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
                            <div class="table-responsive text-nowrap ms-1 me-1">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th class="fw-medium ps-0 text-heading">Parameter</th>
                                            <th class="pe-0 fw-medium text-heading">Value</th>
                                            {{-- <th class="pe-0 fw-medium text-heading">Conversion</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h6 ps-0">Sistole</td>
                                            <td class="pe-0 "><span id="sistole"></span> mmHg</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Diastole</td>
                                            <td class="pe-0 "><span id="diastole"></span> mmHg</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">HR</td>
                                            <td class="pe-0 "><span id="hr"></span> bpm</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Suhu</td>
                                            <td class="pe-0 "><span id="temp"></span> &deg;C</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">RR</td>
                                            <td class="pe-0 "><span id="rr"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">SPO2</td>
                                            <td class="pe-0 "><span id="spo2"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Fisik</td>
                                            <td class="pe-0 "><span id="fisik"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Romberg Test</td>
                                            <td class="pe-0 "><span id="romberg"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Alcohol Test</td>
                                            <td class="pe-0 "><span id="alcohol"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Alcohol Level</td>
                                            <td class="pe-0 "><span id="alcohol_level"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Anamnesis</td>
                                            <td class="pe-0 "><span id="anamnesis"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Keterangan</td>
                                            <td class="pe-0 "><span id="description"></span></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('portal') }}" class="btn btn-white d-grid w-100">Back to
                            Portal</a>
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
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var Result = {
                'form': $('#result'),
                'close': $('#result').find('#icon-close'),
                'check': $('#result').find('#icon-check'),
                'name': $('#result').find('#user_name'),
                'time': $('#result').find('#check_time'),
                'sistole': $('#result').find('#sistole'),
                'diastole': $('#result').find('#diastole'),
                'hr': $('#result').find('#hr'),
                'rr': $('#result').find('#rr'),
                'spo2': $('#result').find('#spo2'),
                'fisik': $('#result').find('#fisik'),
                'temp': $('#result').find('#temp'),
                'romberg': $('#result').find('#romberg'),
                'alcohol': $('#result').find('#alcohol'),
                'alcohol_level': $('#result').find('#alcohol_level'),
                'anamnesis': $('#result').find('#anamnesis'),
                'description': $('#result').find('#description'),
                'result': $('#result').find('#fit_result'),

            }
            Result.form.hide();

            function convDate(dateTimeString) {
                return moment(dateTimeString).format('YYYY-MM-DD HH:mm');
            }

            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear(); // Hentikan sementara pemindaian
                scanProcess(decodedText);
                setTimeout(() => {
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                }, 5000); // 5000 milidetik = 5 detik
            }

            function scanProcess(decodedResult) {
                swalLoading();
                // decodedResult = "d3286f12-a0ab-45a7-aba9-11b7e15f4723"
                url = '{{ url('scanner/checker') }}/' + decodedResult;
                $.ajax({
                    url: url,
                    'type': 'GET',
                    success: function(data) {
                        if (data['error']) {
                            swalError(data['message'], "Simpan Gagal !!");
                            return;
                        }
                        Swal.close()
                        user = data["data"]
                        if (user['screening']['fitality'] == 'Y') {
                            Result.close.hide()
                            Result.check.show()
                        } else {
                            Result.close.show()
                            Result.check.hide()
                        }
                        Result.name.html(user["name"])
                        Result.time.html(convDate(user['screening']["created_at"]))
                        Result.sistole.html(user['screening']["sistole"])
                        Result.diastole.html(user['screening']["diastole"])
                        Result.hr.html(user['screening']["hr"])
                        Result.rr.html(user['screening']["rr"])
                        Result.spo2.html(user['screening']["spo2"])
                        Result.fisik.html(capitalizeFirstLetter(user['screening']["fisik"]))
                        Result.temp.html(user['screening']["temp"])
                        Result.romberg.html(user['screening']["romberg"])
                        Result.alcohol.html(user['screening']["alcohol"])
                        Result.alcohol_level.html(user['screening']["alcohol_level"])
                        Result.anamnesis.html(user['screening']["anamnesis"])
                        Result.description.html(user['screening']["description"])
                        Result.result.html(user['screening']["fitality"] == 'Y' ?
                            "<h4 class='badge rounded-pill bg-label-success'><strong>FIT</strong></h4>" :
                            "<h4 class='badge rounded-pill bg-label-danger'><strong>UNFIT</strong></h4>"
                        )
                        Result.form.show();
                        console.log(user)
                    },
                    error: function(e) {}
                });
            }

            function onScanFailure(error) {}

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush
