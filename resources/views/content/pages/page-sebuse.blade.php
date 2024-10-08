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
                        <div id="result" style="display: none" class="card mb-2 ">
                            <div class="row">
                                <div class="col-8">
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
                                <div class="col-4 text-end d-flex align-items-end">
                                    <div class="card-body pb-0 pt-3">
                                        <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                            <svg style="display: none" xmlns="http://www.w3.org/2000/svg" id="icon-close"
                                                viewBox="0 0 24 24">
                                                <title>close</title>
                                                <path
                                                    d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"
                                                    fill="red" />
                                            </svg>
                                            <svg style="display: none" xmlns="http://www.w3.org/2000/svg" id="icon-check"
                                                viewBox="0 0 24 24">
                                                <title>check-bold</title>
                                                <path fill="green"
                                                    d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
                                            </svg>
                                        </div>
                                        {{-- <img src="{{ asset('assets/img/illustrations/scanner2.png') }}" alt="Ratings"
                                            class="img-fluid" width="95"> --}}
                                    </div>
                                </div>
                            </div>
                            <form id="form-sebuse">
                                @csrf
                                <input name="qrcode" hidden id="qr_user" />
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
                                                <td class="h6 ps-0">Kalori</td>
                                                <td class="pe-0 "><input type="number" name="kal" id="kal_val"
                                                        class="form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Kalori Attachment</td>
                                                <td class="pe-0 "><input type="file" name="attachment_kal"
                                                        class="form-control" />
                                                    <span id="kal_span"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Streching Attachment</td>
                                                <td class="pe-0 "><input type="file" name="attachment_str"
                                                        class="form-control" />
                                                    <span id="str_span"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Gym Attachment</td>
                                                <td class="pe-0 "><input type="file"name="attachment_gym"
                                                        class="form-control" />
                                                    <span id="gym_span"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Makan Sehat Attachment</td>
                                                <td class="pe-0 "><input type="file" name="attachment_mkn"
                                                        class="form-control" />
                                                    <span id="mkn_span"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="mb-3">
                        <button id="submitBtn" class="btn btn-primary d-grid w-100">Submit</button>
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

            var status = false;
            var submitBtn = $('#submitBtn')
            var Result = {
                'layout': $('#result'),
                'form': $('#result').find('#form-sebuse'),
                'close': $('#result').find('#icon-close'),
                'check': $('#result').find('#icon-check'),
                'name': $('#result').find('#user_name'),
                'qr_user': $('#result').find('#qr_user'),
                'kal_val': $('#result').find('#kal_val'),
                'kal_span': $('#result').find('#kal_span'),
                'str_span': $('#result').find('#str_span'),
                'gym_span': $('#result').find('#gym_span'),
                'mkn_span': $('#result').find('#mkn_span'),


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
            Result.layout.hide();

            function convDate(dateTimeString) {
                return moment(dateTimeString).format('YYYY-MM-DD HH:mm');
            }

            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear(); // Hentikan sementara pemindaian
                scanProcess(decodedText);
                // setTimeout(() => {
                // if (!status)
                //     html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                // }, 5000); // 5000 milidetik = 5 detik
            }
            // scanProcess("d3286f12-a0ab-45a7-aba9-11b7e15f4723");

            function setFieldAndAttachment(resultField, resultSpan, sebuseFieldValue, sebuseFieldAttachment) {
                // Ensure the field element exists before setting its value
                if (resultField && typeof resultField.val === 'function') {
                    resultField.val(sebuseFieldValue ?? '');
                }

                // Ensure the span element exists before setting the attachment link
                if (resultSpan && typeof resultSpan.html === 'function') {
                    if (sebuseFieldAttachment) {
                        resultSpan.html('<a href="/storage/' + sebuseFieldAttachment +
                            '" target="_blank">Lihat Attachment</a>');
                    } else {
                        resultSpan.html(''); // Clear the span if there's no attachment
                    }
                }
            }


            function scanProcess(decodedResult) {
                swalLoading();
                // decodedResult = "d3286f12-a0ab-45a7-aba9-11b7e15f4723"
                url = '{{ url('scanner/checker-sebuse') }}/' + decodedResult;
                $.ajax({
                    url: url,
                    'type': 'GET',
                    success: function(data) {
                        if (data['error']) {
                            swalError(data['message'], "Gagal !!");
                            return;
                        }
                        html5QrcodeScanner.clear();
                        status = true
                        Swal.close()

                        user = data["data"]

                        // if (user['screening']['fitality'] == 'Y') {
                        //     Result.close.hide()
                        //     Result.check.show()
                        // } else {
                        //     Result.close.show()
                        //     Result.check.hide()
                        // }
                        Result.name.html(user["name"])
                        Result.qr_user.val(user['qrcode'])
                        // Result.kal_val.val(user['sebuse']['kal_val'] ?? '')
                        setFieldAndAttachment(Result.kal_val, Result.kal_span, user['sebuse'] ? user[
                            'sebuse']['kal_val'] : '', user['sebuse'] ? user['sebuse'][
                            'kal_attch'
                        ] : '');

                        // Handle Streching
                        setFieldAndAttachment(Result.str_val, Result.str_span, user['sebuse'] ? user[
                            'sebuse']['str_val'] : '', user['sebuse'] ? user['sebuse'][
                            'str_attch'
                        ] : '');

                        // Handle Gym
                        setFieldAndAttachment(Result.gym_val, Result.gym_span, user['sebuse'] ? user[
                            'sebuse']['gym_val'] : '', user['sebuse'] ? user['sebuse'][
                            'gym_attch'
                        ] : '');

                        // Handle Makan Sehat
                        setFieldAndAttachment(Result.mkn_val, Result.mkn_span, user['sebuse'] ? user[
                            'sebuse']['mkn_val'] : '', user['sebuse'] ? user['sebuse'][
                            'mkn_attch'
                        ] : '');
                        Result.layout.show();
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

            submitBtn.on("click", function(ev) {
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: "{{ route('sebuse-post') }}",
                        'type': 'post',
                        contentType: false,
                        processData: false,
                        data: new FormData(Result.form[0]),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            swalBerhasil();
                            scanProcess(Result.qr_user.val());
                        },
                        error: function(e) {}
                    });
                });
            })
        });
    </script>
@endpush
