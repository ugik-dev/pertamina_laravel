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
    <h1>Rekap</h1>
    <div class="card mb-2">
        <div class="card-body pt-0">
            <form id="formFilter">
                <div class="col-lg-12 mt-2 mb-2">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="date_start" class="col-sm-6 col-form-label">Dari Tanggal</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input id="date_start" name="date_start" type="date"
                                            value="{{ Carbon\Carbon::today()->subDays(1)->toDateString() }}"
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
                                            value="{{ Carbon\Carbon::today()->toDateString() }}" type="date"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


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
                        <th>Date</th>
                        <th>Time</th>
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
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
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
            }

            formFilter.start.on('change', reloadDataTable);
            formFilter.end.on('change', reloadDataTable);

            function reloadDataTable() {
                DataTable.ajax.reload(null, false);
            }

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
                                        url: "{{ route('screening.rekap') }}",
                                        data: {
                                            length: -1,
                                            ...formFilter.form.serializeArray()
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
                                        url: "{{ route('screening.rekap') }}",
                                        data: {
                                            length: -1,
                                            ...formFilter.form.serializeArray()
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
                order: [0, 'desc'],
                ajax: {
                    url: "{{ route('screening.rekap') }}",
                    data: function(d) {
                        return $.extend({}, d, formFilter.form.serializeArray());
                    }
                },
                columns: [{
                        data: "id",
                        name: "id"
                    }, {
                        data: "datescan",
                        name: "datescan"
                    }, {
                        data: "timescan",
                        name: "timescan"
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
                        data: "diastole",
                        name: "diastole"
                    }, {
                        data: "hr_span",
                        name: "hr_span"
                    }, {
                        data: "temp_span",
                        name: "temp_span"
                    }, {
                        data: "rr",
                        name: "rr"
                    }, {
                        data: "spo2",
                        name: "spo2"
                    },
                    {
                        data: "romberg",
                        name: "romberg"
                    },
                    {
                        data: "alcohol",
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
                    },
                    {
                        data: "aksi",
                        name: "aksi"
                    },
                ]
            });
        });
    </script>
@endpush
