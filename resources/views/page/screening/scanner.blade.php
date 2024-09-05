@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Screening ')
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>

@endsection
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-5">
                <h1 class="text-center">Scan QR Code</h1>
                <div id="reader" class="mr-3 ml-3 w-100" style="margin:0 auto;"></div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4" id="result">
                    <div class="row">
                        <div class="col-lg-3 d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon-close" viewBox="0 0 24 24">
                                <title>close</title>
                                <path
                                    d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"
                                    fill="red" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon-check" viewBox="0 0 24 24">
                                <title>check-bold</title>
                                <path fill="green"
                                    d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
                            </svg>
                        </div>


                        <div class="col-lg-9">
                            <div class="card-body">
                                <h6 class="card-title mb-4">QRcode Result</h6>
                                <div class="d-flex justify-content-start align-items-center mb-4">
                                    <div class="avatar me-2 pe-1">
                                        <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="app-user-view-account.html">
                                            <h6 class="mb-1" id="user_name"></h6>
                                        </a>
                                        <small>Screening : <span id="check_time"> </span></small>
                                        <span id="fit_result"></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-2">Status Kesehatan</h6>
                                </div>
                                <p class="mb-1">Sistole : <span id="sistole"></span> mmHg</p>
                                <p class="mb-1">Diastole : <span id="diastole"></span> mmHg</p>
                                <p class="mb-1">HR : <span id="hr"> </span>bpm</p>
                                <p class="mb-1">Suhu : <span id="temp"></span> &deg;C</p>
                                <p class="mb-1">RR : <span id="rr"></span>-</p>
                                <p class="mb-1">SPO2 : <span id="spo2"></span>-</p>
                                <p class="mb-1">Fisik : <span id="fisik"></span>-</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">

        <div class="text-center mt-3">
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </div>
    <!-- Add this modal HTML structure to your page -->
    <div class="modal fade" id="emergencyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="emergencyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form class="needs-validation add-new-record pt-0 row g-3" id="form-screening" novalidate>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emergencyModalLabel">Form Screening</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="text" id="qrcode" class="" name="qrcode" />
                        <div class="row">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sistole" class="col-sm-2 col-form-label">Sistole</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="sistole" name="sistole" class="form-control">
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="temp" class="col-sm-2 col-form-label">Temp</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="temp" name="temp" class="form-control">
                                        <span class="input-group-text">&deg;C</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hr" class="col-sm-2 col-form-label">Hr</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="hr" name="hr" class="form-control">
                                        <span class="input-group-text">bpm</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- <button type="button" id="pickOffBtn" class="btn btn-xl btn-warning" data-dismiss="modal">Pickof</button> --}}
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="insertBtn"
                            data-metod="ins">Tambah</button>
                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="updateBtn"
                            data-act="upd">Simpan Perubahan</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
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
                'result': $('#result').find('#fit_result'),
            }
            Result.form.hide();

            function convDate(dateTimeString) {
                return moment(dateTimeString).format('YYYY-MM-DD HH:mm');
            }

            function onScanSuccess(decodedText, decodedResult) {
                scanProcess(decodedText)
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
                        Result.fisik.html(user['screening']["fisik"])
                        Result.temp.html(user['screening']["temp"])
                        Result.result.html(user['screening']["fitality"] == 'Y' ?
                            "<span class='badge badge-success'>FIT</span>" :
                            "<span class='badge badge-danger'>UNFIT</span>")
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
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush
