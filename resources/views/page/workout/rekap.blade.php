@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Sebuse ')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
        integrity="sha512-r22gChDnGvBylk90+2e/ycr3RVrDi8DIOkIGNhJlKfuyQM4tIRAI062MaV8sfjQKYVGjOBaZBOA87z+IhZE9DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Rekap /</span> DCU
    </h4>
    <div class="card mb-2">
        <div class="card-body pt-0">
            <form id="formFilter">
                <div class="col-lg-12 mt-2 mb-2">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="date_start" class="col-sm-6 col-form-label">Dari Tanggal</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input id="date_start" name="date_start" type="date"
                                            value="{{ Carbon\Carbon::now()->startOfMonth()->toDateString() }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="date_end" class="col-sm-6 col-form-label">Sampai Tanggal </label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input id="date_end" name="date_end"
                                            value="{{ Carbon\Carbon::now()->endOfMonth()->toDateString() }}" type="date"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Pilihan Tahun -->
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label for="year" class="col-sm-6 col-form-label">Tahun</label>
                                <div class="col-sm-6">
                                    <select id="year" name="year" class="form-control">
                                        @for ($i = 2024; $i <= Carbon\Carbon::now()->year; $i++)
                                            <option value="{{ $i }}"
                                                {{ Carbon\Carbon::now()->year == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pilihan Bulan -->
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label for="month" class="col-sm-6 col-form-label">Bulan</label>
                                <div class="col-sm-6">
                                    <select id="month" name="month" class="form-control">
                                        @foreach (range(1, 12) as $month)
                                            <option value="{{ $month }}"
                                                {{ $month == Carbon\Carbon::now()->month ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pilihan Minggu ke -->
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label for="week" class="col-sm-6 col-form-label">Minggu ke</label>
                                <div class="col-sm-6">
                                    @php
                                        // Mendapatkan minggu ke berapa saat ini dalam bulan
                                        $currentWeek = Carbon\Carbon::now()->weekOfMonth;
                                    @endphp

                                    <select id="week" name="week" class="form-control">
                                        <option value="1" {{ $currentWeek == 0 ? 'selected' : '' }}>Minggu ke-1
                                        </option>
                                        <option value="2" {{ $currentWeek == 1 ? 'selected' : '' }}>Minggu ke-2
                                        </option>
                                        <option value="3" {{ $currentWeek == 2 ? 'selected' : '' }}>Minggu ke-3
                                        </option>
                                        <option value="4" {{ $currentWeek == 3 ? 'selected' : '' }}>Minggu ke-4
                                        </option>
                                        <option value="5" {{ $currentWeek == 4 ? 'selected' : '' }}>Minggu ke-5
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
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

        </div>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="datatable" class="table table-bordered">
                <thead>
                    <!-- Definisi Kolom -->
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Bagian</th>
                        <th>Jenis</th>
                        <th>Durasi</th>
                        <th>Jarak (KM)</th>
                        <th>Pace (Menit/KM)</th>
                        <th>Evidance</th>
                        <th>Verifikasi</th>
                        <th>Ket</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

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

                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Verifikasi</label>
                                    <div class="col-sm-6">
                                        <div class="input-group switches-stacked">
                                            <div class=" ">
                                                <label class="switch switch-danger me-1">
                                                    <input type="radio" class="switch-input" id="statusN"
                                                        name="verif_status" value="N">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Belum di Verifikasi</span>
                                                </label>
                                                <label class="switch switch-success">
                                                    <input type="radio" id="statusY" class="switch-input"
                                                        name="verif_status" value="Y">
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">Sudah di Verifikasi</span>
                                                </label>
                                            </div>

                                        </div>
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            var formFilter = {
                'form': $('#formFilter'),
                'start': $('#formFilter').find('#date_start'),
                'end': $('#formFilter').find('#date_end'),
                'year': $('#formFilter').find('#year'),
                'month': $('#formFilter').find('#month'),
                'week': $('#formFilter').find('#week'),
            }
            formFilter.start.on('change', reloadDataTable);
            formFilter.end.on('change', reloadDataTable);
            formFilter.year.on('change', reloadDataTable);
            formFilter.month.on('change', reloadDataTable);
            formFilter.week.on('change', reloadDataTable);

            function reloadDataTable() {
                DataTable.ajax.reload(null, false);
            }
            var ScreeningForm = {
                'form': $('#form-screening'),
                // 'insertBtn': $('#form-screening').find('#insertBtn'),
                // 'updateBtn': $('#form-screening').find('#updateBtn'),
                'id': $('#form-screening').find('#id'),
                'name': $('#form-screening').find('#name'),
                'statusY': $('#form-screening').find('#statusY'),
                'statusN': $('#form-screening').find('#statusN'),
                'description': $('#form-screening').find('#description'),
            }

            $("#exportExcel").on("click", function(event) {
                event.preventDefault();
                var query = formFilter.form.serialize();
                var url = "{{ url('workout/rekap/export') }}?" + query;
                window.open(url, '_blank');
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
                                columns: [0, 1, 2, 3, 4, 5, 7, 8],
                            },
                            action: function(e, dt, button, config) {
                                var self = this;
                                $.ajax({
                                    url: "{{ route('workout.rekap') }}",
                                    data: {
                                        length: -1,
                                        ...formFilter.form
                                        .serializeArray()
                                    },
                                    success: function(json) {
                                        var oldData = dt.rows()
                                            .data();
                                        dt.clear().rows.add(json
                                            .data).draw();
                                        $.fn.dataTable.ext.buttons
                                            .excelHtml5
                                            .action.call(self, e,
                                                dt, button,
                                                config);
                                        dt.clear().rows.add(oldData)
                                            .draw();
                                    }
                                });
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
                                    13, 14, 15
                                ],
                            },
                            customize: function(doc) {
                                // Set orientation to landscape
                                doc.pageOrientation = 'landscape';

                                // Remove default title
                                doc.content = doc.content.filter(function(
                                    item) {
                                    return !(item.text && item.text
                                        .includes(
                                            'Workout | Pertamina Workout'
                                        ));
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
                                    url: "{{ route('workout.rekap') }}",
                                    data: {
                                        length: -1,
                                        ...formFilter.form
                                        .serializeArray()
                                    },
                                    success: function(json) {
                                        var oldData = dt.rows()
                                            .data();
                                        dt.clear().rows.add(json
                                            .data).draw();
                                        $.fn.dataTable.ext.buttons
                                            .pdfHtml5
                                            .action.call(self, e,
                                                dt, button,
                                                config);
                                        dt.clear().rows.add(oldData)
                                            .draw();
                                    }
                                });
                            }
                        },
                    ]
                }, ],
                order: [0, 'desc'],
                ajax: {
                    url: "{{ route('workout.rekap') }}",
                    data: function(d) {
                        return $.extend({}, d, formFilter.form.serializeArray());
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    }, {
                        data: "activity_date",
                        name: "activity_date"
                    },
                    // {
                    //     data: "timescan",
                    //     name: "timescan"
                    // },
                    {
                        data: "user_name",
                        name: "user_name"
                    },
                    {
                        data: "bagian",
                        name: "bagian"
                    },
                    {
                        data: "workout_jenis",
                        name: "workout_jenis"
                    },
                    {
                        data: "duration",
                        name: "duration"
                    },
                    {
                        data: "km_tempuh",
                        name: "km_tempuh"
                    },
                    {
                        data: "pace",
                        name: "pace"
                    },
                    {
                        data: "evi_attch_span",
                        name: "evi_attch_span"
                    },
                    {
                        data: "status_span",
                        name: "status_span"
                    },
                    {
                        data: "description",
                        name: "description"
                    },
                    {
                        data: "aksi",
                        name: "aksi"
                    },
                ]
            });

            DataTable.on("click", ".editBtn", function() {
                var currentId = $(this).data('id');
                console.log(currentId)
                var rowData = DataTable.row($(this).closest('tr')).data();

                // Cek data yang didapatkan
                console.log("ID:", currentId);
                // ScreeningForm.qrcode.val(rowData["user_qrcode"])
                // ScreeningForm.sistole.val(rowData["sistole"])
                // ScreeningForm.diastole.val(rowData["diastole"])
                // ScreeningForm.hr.val(rowData["hr"])
                // ScreeningForm.rr.val(rowData["rr"])
                // ScreeningForm.spo2.val(rowData["spo2"])
                // ScreeningForm.romberg.val(rowData["romberg"])
                // // console.log(ScreeningForm.rombergY)
                if (rowData["verif_status"] == "Y") {
                    ScreeningForm.statusY.prop('checked', true);
                } else if (rowData["verif_status"] == "N") {
                    ScreeningForm.statusN.prop('checked', true);
                }
                // if (rowData["verif_status"] == "Y") {
                //     ScreeningForm.statusY.prop('checked', true);
                // } else if (rowData["verif_status"] == "N") {
                //     ScreeningForm.statusN.prop('checked', true);
                // }
                // ScreeningForm.verif_status_level.val(rowData["verif_status_level"])
                // ScreeningForm.anamnesis.val(rowData["anamnesis"])
                // ScreeningForm.description.val(rowData["description"])
                // ScreeningForm.temp.val(rowData["temp"])
                ScreeningForm.id.val(rowData["id"])
                ScreeningForm.name.val(rowData["user_name"])
                $('#emergencyModal').modal('show');
                // console.log("Row Data:", rowData);

                // Misalnya, kamu bisa ambil kolom tertentu dari row tersebut
                // var userName = rowData.user_name;
                // console.log("User Name:", userName);
            })

            ScreeningForm.form.on('submit', function(event) {
                event.preventDefault();
                // if (!validasi_form(event)) {
                //     return
                // };
                // if (ScreeningForm.insertBtn.is(":visible")) {
                //     url = '{{ route('screening.create') }}';
                //     metode = 'POST';
                // } else {
                url = '{{ route('workout.verif') }}';
                metode = 'PUT';
                // }
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
        });
    </script>
@endpush
