@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Home')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

@endsection

@section('content')
    <div class="row gy-4">


        <!--/ Grafik-->
        <div class="col-md-4 col-lg-3 col-sm-10 mb-4 mx-auto">
            <div class="card">
                <div class="card-body mt-2">
                    <div id="reader" class="mr-3 ml-3 w-100" style="margin:0 auto;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-body card-datatable table-responsive">
                    <table id="tableScreening" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Owner</th>
                                <th>Keterangan</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

            var FDataTable = $('#tableScreening').DataTable({
                "language": {
                    "info": "",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "lengthMenu": "",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next"
                    }
                },
                "pageLength": 10, // Set default page length to 10
                "lengthChange": false, // Disable length change dropdown
                "pagingType": "simple_numbers", // Use simple pagination type
                "drawCallback": function(settings) {
                    var api = this.api();
                    var pagination = $(api.table().container()).find('.dataTables_paginate');

                    var pages = pagination.find('a.paginate_button');
                    var current = parseInt(pagination.find('.current').text(), 10);
                    var totalPages = api.page.info().pages;

                    // Hide all page links except for the first, last, previous, next, and 2 before and 2 after the current
                    pages.each(function(index) {
                        var pageNum = parseInt($(this).text(), 10);
                        if ($(this).text() !== 'Previous' && $(this).text() !== 'Next') {
                            if (Math.abs(pageNum - current) > 2 && pageNum !== 1 && pageNum !==
                                totalPages) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        }
                    });

                    // Always show the first and last pages, and dots if applicable
                    pagination.find('a.paginate_button').first().show();
                    pagination.find('a.paginate_button').last().show();

                    // Show dots
                    if (current > 3) {
                        pagination.find('span.ellipsis').show();
                    } else {
                        pagination.find('span.ellipsis').hide();
                    }
                }
            });


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

            // scanProcess("d3286f12-a0ab-45a7-aba9-11b7e15f4723")

            function scanProcess(decodedResult) {
                swalLoading();
                // decodedResult = "d3286f12-a0ab-45a7-aba9-11b7e15f4723"
                url = '{{ url('get-mcu') }}/' + decodedResult;
                $.ajax({
                    url: url,
                    'type': 'GET',
                    success: function(data) {
                        if (data['error']) {
                            swalError(data['message'], "Gagal mengambil data !!");
                            return;
                        }
                        Swal.close()
                        result = data["data"]
                        // if (user['screening']['fitality'] == 'Y') {
                        //     Result.close.hide()
                        //     Result.check.show()
                        // } else {
                        //     Result.close.show()
                        //     Result.check.hide()
                        // }
                        renderData(result)
                        console.log(result)
                    },
                    error: function(e) {}
                });
            }

            function renderData(data) {
                console.log(data)
                if (data == null || typeof data != "object") {
                    console.log("User::UNKNOWN DATA");
                    return;
                }
                var i = 0;

                var renderData = [];
                Object.values(data.mcu).forEach((d) => {
                    var button =
                        `<a href="<?= url('storage/upload/bank') ?>/${d['filename']}" target="_blank" title="Lihat" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i></a>`;
                    renderData.push([d['doc_date'], d['ref_bank']['name'], data['name'], d['description'],
                        button

                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
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

        })
    </script>
@endsection
