@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Screening ')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <!-- <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" /> -->
@endsection
@section('vendor-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
        integrity="sha512-r22gChDnGvBylk90+2e/ycr3RVrDi8DIOkIGNhJlKfuyQM4tIRAI062MaV8sfjQKYVGjOBaZBOA87z+IhZE9DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('content')
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
    <h1>Screening</h1>
    <div class="container mt-5">
        <h1 class="text-center">Scan QR Code</h1>
        <div id="reader" style="width:500px; margin:0 auto;"></div>
        <script src="{{ mix('js/app.js') }}"></script>
    </div>
    <div class="card">
        <form id="formFilter">
            <div class="col-lg-12 mt-2 mb-2 mr-2 ml-2">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="date_start" class="col-sm-6 col-form-label">Tanggal</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input id="screening_date" name="screening_date" type="date"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="date_start" class="col-sm-6 col-form-label">Status</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select id="screening_status" class="form-control" name="screening_status">
                                        <option>Semua</option>
                                        <option value="hasScreening">Sudah Screening</option>
                                        <option value="notScreening">Belum Screening</option>
                                        <option value="fit">Fit</option>
                                        <option value="unfit">Tidak Vit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <button id="exportExcel" class="btn btn-success"><i
                                        class="mdi mdi-file-excel-outline me-1"></i>Excel</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </form>
        <div class="card-datatable table-responsive pt-0">
            <table id="datatable" class="table table-bordered">
                <thead>
                    <!-- Definisi Kolom -->
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>Action</th>
                        <th>Nama</th>
                        <th>Result</th>
                        <th>Fisik</th>
                        <th>Sistole</th>
                        <th>Diasistole</th>
                        <th>HR</th>
                        <th>Suhu</th>
                        <th>RR</th>
                        <th>SPO2</th>
                        <th>Romberg Test</th>
                        <th>Alcohol Test</th>
                        <th>Alcohol Level</th>
                        <th>Anamnesis</th>
                        <th>Ket</th>
                    </tr>
                </thead>
            </table>
        </div>
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
                        <input type="text" id="id" class="" name="id" hidden />
                        <input type="text" id="qrcode" class="" name="qrcode" hidden />
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input id="name" name="name" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input id="unit" name="unit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-6 mb-2">
                                <div class="form-group row">
                                    <label for="sistole" class="col-sm-2 col-form-label">Sistole</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="sistole" name="sistole" class="form-control" required>
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diastole" class="col-sm-2 col-form-label">Diastole</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="diastole" name="diastole" class="form-control" required>
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hr" class="col-sm-2 col-form-label">HR</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="hr" name="hr" class="form-control" required>
                                            <span class="input-group-text">bpm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="temp" class="col-sm-2 col-form-label">Suhu</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="temp" name="temp" class="form-control" required>
                                            <span class="input-group-text">&deg;C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">

                                <div class="form-group row">
                                    <label for="rr" class="col-sm-2 col-form-label">RR</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="rr" name="rr" class="form-control" required>
                                            <span class="input-group-text">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="spo2" class="col-sm-2 col-form-label">SPO2</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="spo2" name="spo2" class="form-control">
                                            <span class="input-group-text">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fisik" class="col-sm-2 col-form-label">Fisik</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control" name="fisik" id="fisik">
                                                <option value="baik">Baik</option>
                                                <option value="umum">Umum</option>
                                                <option value="buruk">Buruk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="romberg" class="col-sm-4 col-form-label">Romberg Test</label>
                                    <div class="col-sm-6">
                                        <div class="input-group switches-stacked">
                                            <div class=" ">
                                                <label class="switch switch-success me-1">
                                                    <input type="radio" class="switch-input" id="rombergN"
                                                        name="romberg" value="N">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Negatif</span>
                                                </label>
                                                <label class="switch switch-danger">
                                                    <input type="radio" id="rombergY" class="switch-input"
                                                        name="romberg" value="Y">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Positif</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="alcohol" class="col-sm-4 col-form-label">Alcohol Test</label>
                                    <div class="col-sm-6">
                                        <div class="input-group switches-stacked">
                                            <div class=" ">
                                                <label class="switch switch-success me-1">
                                                    <input type="radio" class="switch-input" id="alcoholN"
                                                        name="alcohol" value="N">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Negatif</span>
                                                </label>
                                                <label class="switch switch-danger">
                                                    <input type="radio" id="alcoholY" class="switch-input"
                                                        name="alcohol" value="Y">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Positif</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="alcohol_level" class="col-sm-6 col-form-label">Alcohol Level</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input id="alcohol_level" name="alcohol_level" class="form-control">
                                            <span class="input-group-text">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="anemnesis" class="col-sm-2 col-form-label">Anamnesis</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <textarea id="anamnesis" name="anamnesis" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="form-control"></textarea>
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
    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
    <script>
        $(document).ready(function() {

            var formFilter = {
                'form': $('#formFilter'),
                'screening_date': $('#formFilter').find('#screening_date'),
                'screening_status': $('#formFilter').find('#screening_status'),
            }
            var ScreeningForm = {
                'form': $('#form-screening'),
                'insertBtn': $('#form-screening').find('#insertBtn'),
                'updateBtn': $('#form-screening').find('#updateBtn'),
                'id': $('#form-screening').find('#id'),
                'user_id': $('#form-screening').find('#user_id'),
                'name': $('#form-screening').find('#name'),
                'sistole': $('#form-screening').find('#sistole'),
                'diastole': $('#form-screening').find('#diastole'),
                'hr': $('#form-screening').find('#hr'),
                'rr': $('#form-screening').find('#rr'),
                'spo2': $('#form-screening').find('#spo2'),
                'rombergY': $('#form-screening').find('#rombergY'),
                'rombergN': $('#form-screening').find('#rombergN'),
                'alcoholY': $('#form-screening').find('#alcoholY'),
                'alcoholN': $('#form-screening').find('#alcoholN'),
                'alcohol_level': $('#form-screening').find('#alcohol_level'),
                'description': $('#form-screening').find('#description'),
                'anamnesis': $('#form-screening').find('#anamnesis'),
                'temp': $('#form-screening').find('#temp'),
                'qrcode': $('#form-screening').find('#qrcode'),
            }

            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                html5QrcodeScanner.clear(); // Hentikan sementara pemindaian
                scanProcess(decodedText);
                setTimeout(() => {
                    // Lanjutkan pemindaian setelah 5 detik
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                }, 5000);
            }
            // scanProcess('d3286f12-a0ab-45a7-aba9-11b7e15f4723')

            function scanProcess(decodedResult) {
                swalLoading();
                url = '{{ url('screening/scan') }}/' + decodedResult;
                $.ajax({
                    url: url,
                    'type': 'GET',
                    success: function(data) {
                        ScreeningForm.form.trigger("reset")
                        if (data['error']) {
                            swalError(data['message'], "Simpan Gagal !!");
                            return;
                        }
                        Swal.close();
                        // swalBerhasil();
                        $('#emergencyModal').modal('show');
                        user = data["data"]
                        console.log(user['name'])
                        ScreeningForm.insertBtn.attr('style', 'display: ""');
                        ScreeningForm.insertBtn.attr('style', 'display: ""');
                        console.log(ScreeningForm.insertBtn)

                        ScreeningForm.updateBtn.attr('style', 'display: none !important');
                        ScreeningForm.name.val(user['name'])
                        ScreeningForm.qrcode.val(decodedResult)
                    },
                    error: function(e) {}
                });
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                // console.warn(`Code scan error = ${error}`);
            }

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
            formFilter.screening_date.on("change", function() {
                DataTable.ajax.reload(null, false)
            })
            formFilter.screening_status.on("change", function() {
                DataTable.ajax.reload(null, false)
            })

            var DataTable = $('#datatable').DataTable({
                processing: true,
                paggination: true,
                responsive: false,
                serverSide: true,
                searching: true,
                ordering: true,
                dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-label-primary dropdown-toggle me-2',
                        text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: 'excelHtml5',
                                text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                                },
                                action: function(e, dt, button, config) {
                                    var self = this;
                                    $.ajax({
                                        url: "{{ route('screening.index') }}",
                                        data: {
                                            length: -1
                                        },
                                        success: function(json) {
                                            var oldData = dt.rows().data();
                                            dt.clear().rows.add(json.data).draw();
                                            $.fn.dataTable.ext.buttons.excelHtml5
                                                .action.call(self, e, dt, button,
                                                    config);
                                            dt.clear().rows.add(oldData).draw();
                                        }
                                    });
                                }
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                                },
                                customize: function(doc) {
                                    // Set orientation to landscape
                                    doc.pageOrientation = 'landscape';

                                    // Remove default title
                                    doc.content = doc.content.filter(function(item) {
                                        return !(item.text && item.text.includes(
                                            'Screening | Pertamina Screening'));
                                    });

                                    doc.content.unshift({
                                        text: 'Tanggal: ' + new Date()
                                            .toLocaleDateString(), // Custom date text
                                        fontSize: 14,
                                        bold: false,
                                        margin: [0, 0, 0,
                                            10
                                        ], // Margin: left, top, right, bottom
                                        alignment: 'center'
                                    });

                                    // Add border to table
                                    if (doc.content[1] && doc.content[1].table) {
                                        doc.content[1].layout = {
                                            hLineWidth: function(i, node) {
                                                return 1;
                                            },
                                            vLineWidth: function(i, node) {
                                                return 1;
                                            },
                                            hLineColor: function(i, node) {
                                                return '#aaa';
                                            },
                                            vLineColor: function(i, node) {
                                                return '#aaa';
                                            },
                                            paddingLeft: function(i, node) {
                                                return 4;
                                            },
                                            paddingRight: function(i, node) {
                                                return 4;
                                            }
                                        };
                                    }
                                },
                                action: function(e, dt, button, config) {
                                    var self = this;
                                    $.ajax({
                                        url: "{{ route('screening.index') }}",
                                        data: {
                                            length: -1
                                        },
                                        success: function(json) {
                                            var oldData = dt.rows().data();
                                            dt.clear().rows.add(json.data).draw();
                                            $.fn.dataTable.ext.buttons.pdfHtml5
                                                .action.call(self, e, dt, button,
                                                    config);
                                            dt.clear().rows.add(oldData).draw();
                                        }
                                    });
                                }
                            },
                        ]
                    },

                ],
                order: [1, 'desc'],
                ajax: {
                    url: "{{ route('screening.index') }}",
                    data: function(d) {
                        var filterData = {};
                        $('#formFilter').serializeArray().forEach(function(item) {
                            filterData[item.name] = item.value; // Convert to key-value pair
                        });
                        d.filter = filterData;
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    }, {
                        data: "timescan",
                        name: "timescan"
                    }, {
                        data: "aksi",
                        name: "aksi"
                    }, {
                        data: "user_name",
                        name: "user_name"
                    },
                    {
                        data: "result_span",
                        name: "result_span"
                    }, {
                        data: "fisik",
                        name: "fisik"
                    }, {
                        data: "sistole_span",
                        name: "sistole_span"
                    },
                    {
                        data: "diastole_span",
                        name: "diastole_span"
                    }, {
                        data: "hr_span",
                        name: "hr_span"
                    }, {
                        data: "temp_span",
                        name: "temp_span"
                    }, {
                        data: "rr_span",
                        name: "rr"
                    }, {
                        data: "spo2_span",
                        name: "spo2"
                    },
                    {
                        data: "romberg_span",
                        name: "romberg"
                    },
                    {
                        data: "alcohol_span",
                        name: "alcohol"
                    },
                    {
                        data: "alcohol_level",
                        name: "alcohol_level"
                    },
                    {
                        data: "anamnesis",
                        name: "anamnesis"
                    },
                    {
                        data: "description",
                        name: "description"
                    }
                    // {
                    //     data: "high_risk_span",
                    //     name: "high_risk"
                    // },

                ]
            });


            // var currenPickOff = null;
            // Pusher.logToConsole = true;

            // var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            //     cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
            // });


            // var channel = pusher.subscribe('emergency-channel');
            // channel.bind('emergency-event', function(data) {
            //     // alert(JSON.stringify(data));
            //     newData(data)
            // });

            // var audio = new Audio('/assets/sound/siren1.mp3');
            // audio.load();


            // // Function to pause the audio
            // function pauseAudio() {
            //     audio.pause();
            // }
            // // Optional: You can also add a stop button to completely stop the audio


            // // Function to stop the audio
            // function stopAudio() {
            //     audio.pause();
            //     audio.currentTime = 0; // Reset the audio to the beginning
            // }

            DataTable.on("click", ".editBtn", function() {
                var currentId = $(this).data('id');
                console.log(currentId)
                var rowData = DataTable.row($(this).closest('tr')).data();

                // Cek data yang didapatkan
                console.log("ID:", currentId);
                ScreeningForm.qrcode.val(rowData["user_qrcode"])
                ScreeningForm.sistole.val(rowData["sistole"])
                ScreeningForm.diastole.val(rowData["diastole"])
                ScreeningForm.hr.val(rowData["hr"])
                ScreeningForm.rr.val(rowData["rr"])
                ScreeningForm.spo2.val(rowData["spo2"])
                // ScreeningForm.romberg.val(rowData["romberg"])
                // console.log(ScreeningForm.rombergY)
                if (rowData["romberg"] == "Y") {
                    ScreeningForm.rombergY.prop('checked', true);
                } else if (rowData["romberg"] == "N") {
                    ScreeningForm.rombergN.prop('checked', true);
                }
                if (rowData["alcohol"] == "Y") {
                    ScreeningForm.alcoholY.prop('checked', true);
                } else if (rowData["alcohol"] == "N") {
                    ScreeningForm.alcoholN.prop('checked', true);
                }
                ScreeningForm.alcohol_level.val(rowData["alcohol_level"])
                ScreeningForm.anamnesis.val(rowData["anamnesis"])
                ScreeningForm.description.val(rowData["description"])
                ScreeningForm.temp.val(rowData["temp"])
                ScreeningForm.id.val(rowData["id"])
                ScreeningForm.name.val(rowData["user_name"])
                $('#emergencyModal').modal('show');
                // console.log("Row Data:", rowData);

                // Misalnya, kamu bisa ambil kolom tertentu dari row tersebut
                // var userName = rowData.user_name;
                // console.log("User Name:", userName);
            })

            function newData(d) {
                console.log(d)
                $.ajax({
                    url: "{{ route('get-emergency') }}",
                    type: "get",
                    data: {
                        'id_request': d['idRequest']
                    },
                    success: (data) => {
                        console.log(data['data']['data'])
                        var currentData = data['data']['data']
                        if (data['error']) {
                            newData(d);
                            alert("Koneksi Terputus, lakukan refres halaman")
                            return;
                        }
                        currenPickOff = d['idRequest']

                        $('#emergencyModal').modal('show');
                        $('#emergency_info').html(
                            `<b> ${currentData['emergency_name']}<br> ${currentData['name']}</b>`
                        );

                        audio.play()
                        audio.addEventListener('ended', function() {
                            audio.play()
                        });

                        console.log(currenPickOff)
                        document.getElementById('pickOffBtn').addEventListener('click', function() {
                            $('#emergencyModal').modal('hide');
                            window.open("{{ url('emergency-act/') }}/" + currenPickOff +
                                '/pick-off',
                                '_blank');
                            stopAudio();
                        });
                    },
                    error: () => {
                        // buttonIdle(submitBtn);
                    }
                });

            }
            var screeningForm = document.getElementById('form-screening');

            function validasi_form(event) {
                if (!screeningForm.checkValidity()) {
                    console.log(' not acc')
                    validation_form = false;
                    event.preventDefault();
                    event.stopPropagation();
                    screeningForm.classList.add('was-validated');
                    return false;
                } else {
                    screeningForm.classList.add('was-validated');
                    return true;
                }
            }
            ScreeningForm.form.on('submit', function(event) {
                event.preventDefault();
                // if (!validasi_form(event)) {
                //     return
                // };
                if (ScreeningForm.insertBtn.is(":visible")) {
                    url = '{{ route('screening.create') }}';
                    metode = 'POST';
                } else {
                    url = '{{ route('screening.update') }}';
                    metode = 'PUT';
                }
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: url,
                        'type': metode,
                        data: ScreeningForm.form.serialize(),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            swalBerhasil();
                            $('#emergencyModal').modal('hide');
                            DataTable.ajax.reload(null, false)
                        },
                        error: function(e) {}
                    });
                });
            });

            // newData({
            //     'idRequest': 1
            // })
        });
    </script>
@endpush
