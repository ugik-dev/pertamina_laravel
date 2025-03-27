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
                            <form id="form-workout">
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
                                                <td class="h6 ps-0" colspan="1">Durasi <small>(jam/menit/detik)</small>
                                                </td>
                                                {{-- </tr>
                                            <tr> --}}
                                                <td class="pe-0 " colspan="1">
                                                    <div class="input-group">
                                                        <input type="number" name="hours" id="hours"
                                                            class="form-control" min="0" max="23"
                                                            value="" placeholder="Jam" />
                                                        {{-- <span class="input-group-text">Jam</span> --}}

                                                        <input type="number" name="minutes" id="minutes"
                                                            class="form-control" min="0" max="59"
                                                            value="" placeholder="Menit" />
                                                        {{-- <span class="input-group-text">Mnt</span> --}}

                                                        <input type="number" name="seconds" id="seconds"
                                                            class="form-control" min="0" max="59"
                                                            value="" placeholder="Detik" />
                                                        {{-- <span class="input-group-text">Dtk</span> --}}
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Jenis Workout</td>
                                                <td class="pe-0 "><select type="" name="workout_jenis"
                                                        id="workout_jenis" class="form-control">
                                                        <option value="Jalan">Jalan</option>
                                                        <option value="Lari">Lari</option>
                                                        <option value="Sepeda">Sepeda</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">KM Tempuh</td>
                                                <td class="pe-0 "><input type="number" name="km_tempuh" id="km_tempuh"
                                                        class="form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h6 ps-0">Evidance Workout</td>
                                                <td class="pe-0 "><input type="file" name="attachment_evi"
                                                        class="form-control" />
                                                    <span id="evi_span"></span>
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
                'form': $('#result').find('#form-workout'),
                'close': $('#result').find('#icon-close'),
                'check': $('#result').find('#icon-check'),
                'name': $('#result').find('#user_name'),
                'qr_user': $('#result').find('#qr_user'),
                'hours': $('#result').find('#hours'),
                'minutes': $('#result').find('#minutes'),
                'seconds': $('#result').find('#seconds'),
                'evi_span': $('#result').find('#evi_span'),
                'workout_jenis': $('#result').find('#workout_jenis'),
                'km_tempuh': $('#result').find('#km_tempuh'),
                'time': $('#result').find('#check_time'),
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

            function setFieldAndAttachment(resultField, resultSpan, workoutFieldValue, workoutFieldAttachment) {
                // Ensure the field element exists before setting its value
                // if (resultField && typeof resultField.val === 'function') {
                //     resultField.val(workoutFieldValue ?? '');
                // }

                // Ensure the span element exists before setting the attachment link
                if (resultSpan && typeof resultSpan.html === 'function') {
                    console.log("masuk res p", workoutFieldAttachment)
                    if (workoutFieldAttachment) {
                        resultSpan.html('<a href="/storage/' + workoutFieldAttachment +
                            '" target="_blank">Lihat Attachment</a>');
                    } else {
                        resultSpan.html(''); // Clear the span if there's no attachment
                    }
                }
            }


            function scanProcess(decodedResult) {
                swalLoading();
                // decodedResult = "d3286f12-a0ab-45a7-aba9-11b7e15f4723"
                url = '{{ url('scanner/checker-workout') }}/' + decodedResult;
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
                        console.log("render ere")
                        user = data["data"]
                        Result.name.html(user["name"])
                        Result.qr_user.val(user['qrcode'])
                        Result.workout_jenis.val(user.workout['workout_jenis'])
                        // Result.km_tempuh.val(user['km_tempuh'])
                        Result.km_tempuh.val(user.workout['km_tempuh'])
                        console.log(user.workout)
                        Result.hours.val(user.workout['hours'])
                        Result.minutes.val(user.workout['minutes'])
                        Result.seconds.val(user.workout['seconds'])
                        setFieldAndAttachment(user['workout']['evi_attch'], Result.evi_span, user[
                            'workout'] ? user[
                            'workout']['evi_attch'] : '', user['workout'] ? user['workout'][
                            'evi_attch'
                        ] : '');
                        Result.layout.show();
                        // console.log(user)
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
                        url: "{{ route('workout-post') }}",
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
                        error: function(e) {
                            swalError(e['message'], "Simpan Gagal !!");

                        }
                    });
                });
            })
        });
    </script>
@endpush
