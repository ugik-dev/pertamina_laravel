@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css",') }}"></script>

@endsection
@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}">
    <style>
        .doughnut-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1rem 0;
            list-style: none;
            margin: 0;
            max-height: 250px;
            /* batas tinggi */
            overflow-y: auto;
            /* scroll jika tinggi lebih */
        }

        /* Legend Item */
        .legend-item {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            width: 100%;
            max-width: 250px;
            flex: 1 1 auto;
        }

        /* Warna bulatan */
        .legend-color {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }

        /* Teks Legend */
        .legend-text {
            flex: 1;
            overflow-wrap: break-word;
        }

        .legend-label {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
    </style>
@endsection
@section('page-script')
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/cards-analytics.js') }}"></script> --}}
    <script src="{{ asset('assets/js/extended-ui-blockui-custom.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">POPULATE /</span> Batch
    </h4>
    @csrf

    {{-- Chart Start --}}
    <div class="row gy-4">
        <div class="col-12">
            <div id="accordionPopoutIcon" class="accordion mt-3 accordion-popout">
                <div class="accordion-item">
                    <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionPopoutIconOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionPopoutIcon-1" aria-controls="accordionPopoutIcon-1"
                            aria-expanded="false">
                            <i class="mdi mdi-filter me-2"></i>
                            Filter
                        </button>
                    </h2>

                    <div id="accordionPopoutIcon-1" class="accordion-collapse collapse"
                        data-bs-parent="#accordionPopoutIcon" style="">
                        <div class="accordion-body">
                            <form class="add-new-record pt-0 row g-3 mb-3" id="toolbar_form"
                                onsusub_divisiont="return false">
                                @csrf
                                <input type="text" id="id" class="" hidden name="id" />
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Jenis :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="cat_review" name="cat_review"
                                            class="form-control select2 select2-singgle">
                                            <option value="first">First Review</option>
                                            <option value="last">Last Review</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Divisi :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="provider" name="provider[]" class="form-control select2" multiple>
                                            <option value=""> -- Semua --</option>
                                            @foreach ($dataContent['filter']['divisi'] as $provider)
                                                <option value="{{ $provider }}">{{ $provider }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Sub Divisi :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_sub_division" name="sub_division[]" class="form-control select2"
                                            multiple>
                                            @foreach ($dataContent['filter']['sub_division'] as $sub_division)
                                                <option value="{{ $sub_division }}">{{ $sub_division }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Sub Area Large :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_sub_area_large" name="sub_area_large[]"
                                            class="form-control select2" multiple>
                                            @foreach ($dataContent['filter']['sub_area_large'] as $sub_area_large)
                                                <option value="{{ $sub_area_large }}">{{ $sub_area_large }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Departemen :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_departemen" name="departemen[]" class="form-control select2"
                                            multiple>
                                            @foreach ($dataContent['filter']['departemen'] as $departemen)
                                                <option value="{{ $departemen }}">{{ $departemen }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <button id="toolbar_susub_divisiont" class="btn btn-primary w-100"> <i
                                    class="mdi mdi-filter"></i>
                                Filter </button>
                        </div>
                        <div class="accordion-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="chart-layout">
            <div class="col-12 col-xl-8">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-md-7 col-12 order-2 order-md-0">
                            <div class="card-header">
                                <h5 class="mb-0">Total Transactions</h5>
                            </div>
                            <div class="card-body">
                                <div id="totalTransactionChart"></div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 border-start">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Populasi</h5>
                                </div>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-6 border-end">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-initial bg-label-success rounded">
                                                    <div class="mdi mdi-gender-male mdi-24px"></div>
                                                </div>
                                            </div>
                                            <p class="my-2">Laki-laki</p>
                                            <h6 class="mb-0"><span id="laki-laki">-</span> Org</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-initial bg-label-primary rounded">
                                                    <div class="mdi mdi-gender-female mdi-24px"></div>
                                                </div>
                                            </div>
                                            <p class="my-2">Perempuan</p>
                                            <h6 class="mb-0"><span id="perempuan">-</span> Org</h6>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="d-flex justify-content-around flex-wrap gap-2">
                                    <div>
                                        <p class="mb-1">Total</p>
                                        <h6 class="mb-0"><span id="total_gender">-</span> Org</h6>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" type="button">view report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="row g-4">
                    <div class="col-md-6 col-sm-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                                    <h4 class="mb-0 me-2">Kolestrol</h4>
                                    <p class="mb-0 text-danger">-22%</p>
                                </div>
                                <span class="d-block mb-2 text-body">Kolestrol</span>
                            </div>
                            <div class="card-body">
                                <div id="totalRevenue"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h5 class="mb-0">Free Smoke</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div id="percentageMerokok" class="d-flex align-items-center"></div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex flex-row align-items-center gap-2 mb-1">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-success rounded">
                                            <div class="mdi mdi-smoking-off mdi-24px"></div>
                                        </div>
                                    </div>
                                    <h6 class="mb-0">
                                        <span id="smoker_anti">-</span>
                                        Org
                                    </h6>
                                </div>
                                <div class="d-flex flex-row align-items-center gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-danger rounded">
                                            <div class="mdi mdi-smoking mdi-24px"></div>
                                        </div>
                                    </div>
                                    <h6 class="mb-0"><span id="smoker">-</span>
                                        Org</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">TOP Ranking POPULATE</h5>
                    </div>
                    <div class="d-flex justify-content-between py-2 px-4 border-bottom">
                        <h6 class="mb-0 small">Nama Provider</h6>
                        <h6 class="mb-0 small">Jumlah</h6>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0" id="top_divisi">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Derajat Kesehatan</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="performanceDropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);" data-value="last">Last Review</a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-value="first">First
                                        Review</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 pt-1 mb-3">
                        <h7 class="mb-1">Berdasarkan review terahir</h7>

                        <div id="derajatKesehatanChart"></div>
                        <div id="customPerformanceChartxx"></div>
                    </div>


                </div>
            </div>

            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Risiko Cardiovascular (SKJ)</h5>
                    <div class="card-body">
                        <canvas id="cardiovascularChart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul id='cardiovascularLegend'
                            class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Gambaran SUB_AREA_LARGE</h5>
                    <div class="card-body">
                        <canvas id="sub_area_largeChart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul id='sub_area_largeLegend'
                            class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Status Gizi</h5>
                    <div class="card-body">
                        <canvas id="sub_divisionChart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul id='sub_divisionLegend' class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Rentang Usia</h5>
                        </div>
                    </div>
                    <div class="card-body pb-1 px-0">
                        <div id="chartUsia"></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="card mt-5">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Aksi</th>

                        @foreach ($dataContent['paramPOPULATE'] as $label)
                            <th>{{ $label['label'] }}</th>
                        @endforEach
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3" id="form-pengantar" onsusub_divisiont="return false">
                @csrf
                <input type="text" id="id" class="" hidden name="id" />
                {{-- <div class="col-sm-12">
                    <label for="basicFullname">Description:</label>
                    <textarea type="text" id="description" class="form-control dt-full-name" name="description" placeholder=""
                        aria-label="" aria-describedby="basicFullname2"> </textarea>
                </div> --}}
                <div class="row">
                    <div class="col-sm-12">
                        <label for="basicFullname">Name :</label>
                        <input type="text" id="user_name" class="form-control dt-full-name" name="nama"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                    <div class="col-sm-12">
                        <label for="basicSalary">Klinik / Laboratorium :</label>
                        <div class="form-floating form-floating-outline">
                            <select id="labor_id" name="labor_id" class="form-control select2-close">
                                <option value="">--</option>
                                @foreach ($dataContent['filter']['labor'] as $lab)
                                    <option value="{{ $lab['id'] }}">{{ $lab['name'] }} | {{ $lab['address'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="basicFullname">Tanggal Mulai :</label>
                        <input type="date" id="date_start" class="form-control dt-full-name" name="date_start"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                    <div class="col-sm-12">
                        <label for="basicFullname">Tanggal Selesai :</label>
                        <input type="date" id="date_end" class="form-control dt-full-name" name="date_end"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="labor_services">Pilih Layanan Laboratorium:</label>
                        <div class="row">
                            @foreach ($dataContent['laborServices'] as $service)
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="labor_services[]"
                                            id="service-{{ $service['id'] }}" value="{{ $service['id'] }}">
                                        <label class="form-check-label" for="service-{{ $service['id'] }}">
                                            {{ $service['name'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <label for="basicFullname">File :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="file" id="file_attachment" class="form-control dt-full-name"
                                name="file_attachment" aria-label="" aria-describedby="basicFullname2"
                                accept=".xls, .xlsx" />
                        </div>
                    </div>
                    <div class="col-sm-6"></div>
                </div> --}}
                <div class="col-sm-12">
                    <a type="" class="btn btn-primary data-susub_divisiont me-sm-3 me-1 text-white" id="insertBtn"
                        data-metod="ins">Tambah</a>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="show-review" style="width : 80% !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="">Review Histories</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <div class="card-datatable table-responsive pt-0">
                <table id="FDataTableReviews" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Tanggal Review</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Hasil Derajat</th>
                            <th>Kelainkan Kerja</th>
                            <th>Temuan</th>
                            <th>Saran</th>
                            <th>Keterangan</th>
                            <th>Sumber Data</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <style>
        .text-truncate-ellipsis {
            max-width: 150px;
            /* atau berapa pun yang cocok */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* .table.table-bordered.dataTable.no-footer thead th {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    background-color: #f8f9fa;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    position: sticky;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    top: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    z-index: 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    border-bottom: 1px solid #dee2e6;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                .dataTables_scrollHead .table.table-bordered.dataTable.no-footer thead th {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    background-color: #f8f9fa;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    z-index: 2;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } */
    </style>
    <script>
        $(document).ready(function() {
            var chartInstances = {};
            var toolbar = {
                'form': $('#toolbar_form'),
                'cat_review': $('#toolbar_form').find('#cat_review'),
                'provider': $('#toolbar_form').find('#provider'), // <-- perbaiki di sini
                'sub_division': $('#toolbar_form').find('#filter_sub_division'),
                'sub_area_large': $('#toolbar_form').find('#filter_sub_area_large'),
                'departemen': $('#toolbar_form').find('#filter_departemen'), // tambahin juga ini
            };

            $('.select2-close').select2({
                placeholder: 'Pilih',
                allowClear: true,
                closeOnSelect: true
            });
            $('#toolbar_form').find('.select2').select2({
                placeholder: 'Pilih',
                allowClear: true,
                closeOnSelect: false
            });

            toolbar.cat_review.select2({
                placeholder: 'Pilih jenis review',
                allowClear: false,
                closeOnSelect: true
            });

            const offCanvasEl = new bootstrap.Offcanvas($('#add-new-record'));
            const offCanvasElReviews = new bootstrap.Offcanvas($('#show-review'));
            var targetTrims = Array.from({
                length: 10
            }, (_, i) => i + 10);
            var FDataTableReviews = $('#FDataTableReviews').DataTable()
            var FDataTable = $('#FDataTable').DataTable({
                columnDefs: [{
                    targets: targetTrims, // Menargetkan kolom yang sesuai
                    render: function(data, type, row, meta) {
                        // Menangani jika data kosong atau undefined
                        if (type === 'display' && data) {
                            // Menghindari masalah jika data tidak ada
                            return `<div class="text-truncate-ellipsis" title="${data || ''}">${data || ''}</div>`;
                        }
                        return data;
                    }
                }],
                fixedColumns: {
                    left: 3
                },
                fixedHeader: {
                    header: true,
                    headerOffset: 65
                },
                scrollY: '700px',
                scrollCollapse: true,
                scrollX: true,
                order: [
                    [2, 'desc']
                ],
                dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-label-primary dropdown-toggle me-2',
                        text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: 'print',
                                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6, 7, 8, 9],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = '';
                                            $.each(el, function(index, item) {
                                                if (item.classList !== undefined && item
                                                    .classList.contains('user-name')) {
                                                    result = result + item.lastChild
                                                        .firstChild.textContent;
                                                } else if (item.innerText ===
                                                    undefined) {
                                                    result = result + item.textContent;
                                                } else result = result + item.innerText;
                                            });
                                            return result;
                                        }
                                    }
                                },
                                customize: function(win) {
                                    //customize print view for dark
                                    $(win.document.body)
                                        .css('color', config.colors.headingColor)
                                        .css('border-color', config.colors.borderColor)
                                        .css('background-color', config.colors.bodyBg);
                                    $(win.document.body)
                                        .find('table')
                                        .addClass('compact')
                                        .css('color', 'inherit')
                                        .css('border-color', 'inherit')
                                        .css('background-color', 'inherit');
                                }
                            },
                            {
                                extend: 'csv',
                                text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = '';
                                            $.each(el, function(index, item) {
                                                if (item.classList !== undefined && item
                                                    .classList.contains('user-name')) {
                                                    result = result + item.lastChild
                                                        .firstChild.textContent;
                                                } else if (item.innerText ===
                                                    undefined) {
                                                    result = result + item.textContent;
                                                } else result = result + item.innerText;
                                            });
                                            return result;
                                        }
                                    }
                                }
                            },
                            {
                                extend: 'excel',
                                text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = '';
                                            $.each(el, function(index, item) {
                                                if (item.classList !== undefined && item
                                                    .classList.contains('user-name')) {
                                                    result = result + item.lastChild
                                                        .firstChild.textContent;
                                                } else if (item.innerText ===
                                                    undefined) {
                                                    result = result + item.textContent;
                                                } else result = result + item.innerText;
                                            });
                                            return result;
                                        }
                                    }
                                }
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = '';
                                            $.each(el, function(index, item) {
                                                if (item.classList !== undefined && item
                                                    .classList.contains('user-name')) {
                                                    result = result + item.lastChild
                                                        .firstChild.textContent;
                                                } else if (item.innerText ===
                                                    undefined) {
                                                    result = result + item.textContent;
                                                } else result = result + item.innerText;
                                            });
                                            return result;
                                        }
                                    }
                                }
                            },
                            {
                                extend: 'copy',
                                text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = '';
                                            $.each(el, function(index, item) {
                                                if (item.classList !== undefined && item
                                                    .classList.contains('user-name')) {
                                                    result = result + item.lastChild
                                                        .firstChild.textContent;
                                                } else if (item.innerText ===
                                                    undefined) {
                                                    result = result + item.textContent;
                                                } else result = result + item.innerText;
                                            });
                                            return result;
                                        }
                                    }
                                }
                            }
                        ]
                    },
                    {
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Content</span>',
                        className: 'create-new btn btn-primary'
                    }
                ],

            });

            console.log("panjang table >", FDataTable.columns().count())
            $('div.head-label').html('<h5 class="card-title mb-0">Data Content</h5>')

            var ContentForm = {
                'form': $('#form-content'),
                'insertBtn': $('#form-content').find('#insertBtn'),
                'updateBtn': $('#form-content').find('#updateBtn'),
                'id': $('#form-content').find('#id'),
                'description': $('#form-content').find('#description'),
                'user_id': $('#form-content').find('#user_id'),
                'content': $('#form-content').find('#content'),
                'ref_populate_id': $('#form-content').find('#ref_populate_id'),
                'doc_date': $('#form-content').find('#doc_date'),
                'file_attachment': $('#form-content').find('#file_attachment'),
            }

            // var select2 = $('.select2');
            // if (select2.length) {
            //     select2.each(function() {
            //         var $this = $(this);
            //         select2Focus($this);
            //         $this.wrap('<div class="position-relative"></div>').select2({
            //             placeholder: 'Select value',
            //             dropdownParent: $this.parent()
            //         });
            //     });
            // }


            var dataContent = {}

            // swalLoading();
            $.when(
                getAllContent()).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });

            $('#toolbar_susub_divisiont').on("click", function() {
                getAllContent()
                // blockUIclose()
            })

            function getAllContent() {
                blockUIshowLoading()
                return $.ajax({
                    url: `{{ route('populate.fetch_detail', $dataContent['id']) }}`,
                    'type': 'post',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        // Swal.close();

                        if (data['error']) {
                            blockUIclose()

                            return;
                        }
                        dataContent = data['data'];


                        renderContent(dataContent['batches']);
                        // renderGender(dataContent['statis']['gender']);
                        // // renderDivisi(dataContent['statis']['kesimpulan']);
                        // renderTopDivisi(dataContent['statis']['divisi']['data']);
                        // renderUsia(dataContent['statis']['usia']);
                        // renderChartjsDonuts(dataContent['statis']['departemen'], 'cardiovascularChart',
                        //     'cardiovascularLegend', 'Org')
                        // renderChartjsDonuts(dataContent['statis']['sub_area_large'],
                        //     'sub_area_largeChart',
                        //     'sub_area_largeLegend', 'Org')
                        // renderChartjsDonuts(dataContent['statis']['sub_division'], 'sub_divisionChart',
                        //     'sub_divisionLegend', 'Org')
                        // renderApexJsPercentage('percentageMerokok',
                        //     dataContent['statis']['merokok']['Tidak'],
                        //     dataContent['statis']['merokok']['Ya'],
                        //     'Tidak Merokok', "Org"
                        // )
                        // renderKesimpulan(dataContent['statis']['kesimpulan'])

                        // $('#smoker').html(dataContent['statis']['merokok']['Ya'])
                        // $('#smoker_anti').html(dataContent['statis']['merokok']['Tidak'])
                        // dataContent = dataContent['batches'];
                        blockUIclose()

                    },
                    error: function(e) {}
                });
            }

            FDataTable.on('click', '.show-review', function() {
                var currentId = $(this).data('id');
                blockUIshowLoading()
                return $.ajax({
                    url: `{{ url('populate/batch-review') }}/` + currentId,
                    'type': 'get',
                    data: {},
                    success: function(data) {
                        console.log(data['data'])
                        offCanvasElReviews.show();

                        if (data['error']) {
                            blockUIclose()
                        }
                        renderContentReviews(data['data'])
                        blockUIclose()
                    },
                    error: function(e) {
                        const errMessage = e.responseJSON.message ?? "Terjadi kesalahan";
                        blockUIclose()
                        swalError(errMessage, "Gagal !!");
                    }
                });
            })

            FDataTable.on('click', '.add-pengantar', function() {
                console.log("add-pengantar")
                // ContentForm.form.trigger('reset')
                // var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                // ContentForm.insertBtn.attr('style', 'display: none !important');
                // ContentForm.updateBtn.attr('style', 'display: ""');
                offCanvasEl.show();

                var currentId = $(this).data('id');
                var currentData = dataContent.find(item => item.id == currentId);
                console.log("currentId: ", currentId)
                console.log("currentData: ", currentData)
                // ContentForm.id.val(currentData['id']);
                // ContentForm.user_id.val(currentData['user_id']).trigger("change");
                // ContentForm.description.val(currentData['description']);
                // ContentForm.doc_date.val(currentData['doc_date']);
                // ContentForm.ref_populate_id.val(currentData['ref_populate_id']);
            });

            function renderKesimpulan(data) {
                renderChartE1('#derajatKesehatanChart', data['jenis_kesimpulan'], data['values'],
                    'derajat_kesehatan', 'Orang', true)
            }

            function renderChartE1(selector, labels, values, type, satuan, asPersen = false) {
                const originalValues = values;
                const originalLabel = labels;
                if (asPersen) {
                    const ctotal = values.reduce((acc, val) => acc + val, 0);
                    if (ctotal > 0) {
                        cvalues = values.map(v => +(v / ctotal * 100).toFixed(2)); // persen 2 desimal
                    }
                }
                if (chartInstances[selector]) {
                    chartInstances[selector].destroy();
                }
                if (isDarkStyle) {
                    cardColor = config.colors_dark.cardColor;
                    labelColor = config.colors_dark.textMuted;
                    headingColor = config.colors_dark.headingColor;
                    borderColor = config.colors_dark.borderColor;
                    grayColor = '#3b3e59';
                    currentTheme = 'dark';
                    bodyColorLabel = config.colors_dark.bodyColor;
                } else {
                    cardColor = config.colors.cardColor;
                    labelColor = config.colors.textMuted;
                    headingColor = config.colors.headingColor;
                    borderColor = config.colors.borderColor;
                    grayColor = '#f4f4f6';
                    currentTheme = 'light';
                    bodyColorLabel = config.colors.bodyColor;
                }

                const chartColors = {
                    donut: {
                        series1: config.colors.warning,
                        series2: '#fdb528cc',
                        series3: '#fdb52899',
                        series4: '#fdb52866',
                        series5: config.colors_label.warning
                    },
                    donut2: {
                        series1: config.colors.success,
                        series2: '#43ff64e6',
                        series3: '#43ff6473',
                        series4: '#43ff6433'
                    },
                    line: {
                        series1: config.colors.warning,
                        series2: config.colors.primary,
                        series3: '#7367f029'
                    }
                };
                if (type == 'derajat_kesehatan') {

                    colorsIndicator = [
                        '#2ecc71e6', // P1
                        '#27ae60e6', // P2
                        '#f1c40fe6', // P3
                        '#f39c12e6', // P4
                        '#e67e22e6', // P5
                        '#e74c3ce6', // P6
                        '#c0392be6', // P7
                    ]
                }
                console.log("render E1")

                const total = values.reduce((sum, current) => sum + current, 0);
                deliveryExceptionsChartE1 = document.querySelector(selector),
                    deliveryExceptionsChartConfig = {
                        chart: {
                            height: 420,
                            parentHeightOffset: 0,
                            type: 'donut'
                        },
                        labels: labels,
                        series: asPersen ? cvalues : values,
                        colors: colorsIndicator,
                        stroke: {
                            width: 0
                        },
                        dataLabels: {
                            enabled: false,
                            formatter: function(val, opt) {
                                return parseInt(val) + (asPersen ? ' %' : ' Orang');
                            }
                        },
                        legend: {
                            show: true,
                            position: 'bottom',
                            offsetY: 10,
                            markers: {
                                width: 8,
                                height: 8,
                                offsetX: -3
                            },
                            itemMargin: {
                                horizontal: 15,
                                vertical: 5
                            },
                            fontSize: '13px',
                            fontFamily: 'Inter',
                            fontWeight: 400,
                            labels: {
                                colors: headingColor,
                                useSeriesColors: false
                            }
                        },
                        tooltip: {
                            theme: currentTheme
                        },
                        grid: {
                            padding: {
                                top: 15
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '75%',
                                    labels: {
                                        show: true,
                                        value: {
                                            fontSize: '26px',
                                            fontFamily: 'Inter',
                                            color: headingColor,
                                            fontWeight: 500,
                                            offsetY: -30,
                                            formatter: function(val, opts) {
                                                const index = opts.globals.series.indexOf(parseFloat(val));
                                                return asPersen ? (
                                                    parseInt(val) + ' % / ' +
                                                    originalValues[index] + ' ' + satuan) : (
                                                    parseInt(
                                                        val) + ' ' + satuan);
                                            }
                                        },
                                        name: {
                                            offsetY: 20,
                                            fontFamily: 'Inter',

                                        },
                                        total: {
                                            show: true,
                                            fontSize: '0.9rem',
                                            // label: '',
                                            color: bodyColorLabel,
                                            formatter: function(w) {
                                                return (total ?? '-') + ' Orang';
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 420,
                            options: {
                                chart: {
                                    height: 360
                                }
                            }
                        }]
                    };
                if (typeof deliveryExceptionsChartE1 !== undefined && deliveryExceptionsChartE1 !== null) {
                    const deliveryExceptionsChart = new ApexCharts(deliveryExceptionsChartE1,
                        deliveryExceptionsChartConfig);
                    deliveryExceptionsChart.render();
                    chartInstances[selector] = deliveryExceptionsChart;
                }
            }
            // })();
            // }

            function renderContentReviews(data) {
                console.log(data)
                if (data == null || typeof data != "object") {
                    console.log("User::UNKNOWN DATA");
                    return;
                }
                var i = 0;

                var renderData = [];
                Object.values(data).forEach((user) => {
                    var button =
                        `<div class="d-inline-block">
                            <button class="btn btn-sm btn-text-warning rounded-pill edit-review" data-id="${user['id']}">
                                <i class="mdi mdi-pen-plus me-1"></i>
                            </button>
                            <button class="btn btn-sm btn-text-danger rounded-pill delete-review" data-id="${user['id']}">
                                <i class="mdi mdi-trash-can-outline me-1"></i>
                            </button>
                            </div>`;
                    // <a href="<?= url('info-desa/sub-wilayah') ?>/${user['id']}" title="Lihat Detail" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i> Lihat Review</a>
                    console.log(user)
                    renderData.push([button, user['tgl_review'],
                        user['nama_dokter_reviewer'],
                        user['status_derajat_kesehatan'],
                        user['kelaikan_kerja'],
                        user['temuan'],
                        user['saran'],
                        user['keterangan'] ?? '-',
                        user['source_data'],

                    ]);
                });
                FDataTableReviews.clear().rows.add(renderData).draw('full-hold');
            }

            function renderContent(data) {
                console.log(data)
                if (data == null || typeof data != "object") {
                    console.log("User::UNKNOWN DATA");
                    return;
                }
                var i = 0;

                var renderData = [];
                Object.values(data).forEach((user) => {
                    var button =
                        `<div class="d-inline-block">
                            <button class="btn btn-sm btn-text-secondary rounded-pill add-pengantar" data-id="${user['id']}">
                                <i class="mdi mdi-pen-plus me-1"></i> Pengantar
                            </button>
                            <button class="btn btn-sm btn-text-secondary rounded-pill show-review" data-id="${user['id']}">
                                <i class="mdi mdi-eye-outline me-1"></i> Review
                            </button>
                            </div>`;
                    // <a href="<?= url('info-desa/sub-wilayah') ?>/${user['id']}" title="Lihat Detail" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i> Lihat Review</a>

                    renderData.push([button,
                        @foreach ($dataContent['paramPOPULATE'] as $label)
                            user['{{ $label['field'] }}'],
                        @endforEach
                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }

            function renderChart(series, selector) {
                document.querySelector(selector).destroy();
                const donutChartEl = document.querySelector(selector),
                    donutChartConfig = {
                        chart: {
                            height: 390,
                            fontFamily: 'Inter',
                            type: 'donut'
                        },
                        labels: ['Belum Screening', 'FIT', 'UNFIT'],
                        series: series,
                        colors: [
                            chartColors.donut.series1,
                            chartColors.donut.series5,
                            chartColors.donut.series3,
                        ],
                        stroke: {
                            show: false,
                            curve: 'straight'
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function(val, opt) {
                                return parseInt(val, 10) + '%';
                            }
                        },
                        legend: {
                            show: true,
                            position: 'bottom',
                            markers: {
                                offsetX: -3
                            },
                            itemMargin: {
                                vertical: 3,
                                horizontal: 10
                            },
                            labels: {
                                colors: legendColor,
                                useSeriesColors: false
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            fontSize: '2rem'
                                        },
                                        value: {
                                            fontSize: '1.5rem',
                                            color: legendColor,
                                            formatter: function(val) {
                                                return parseInt(val, 10) + ' Orang';
                                            }
                                        },
                                        total: {
                                            show: true,
                                            fontSize: '1.5rem',
                                            color: headingColor,
                                            label: 'Screening',
                                            formatter: function(w) {
                                                return 'Harian';
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 380
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: legendColor,
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 320
                                    },
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                labels: {
                                                    show: true,
                                                    name: {
                                                        fontSize: '1.5rem'
                                                    },
                                                    value: {
                                                        fontSize: '1rem'
                                                    },
                                                    total: {
                                                        fontSize: '1.5rem'
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: legendColor,
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 420,
                                options: {
                                    chart: {
                                        height: 280
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            },
                            {
                                breakpoint: 360,
                                options: {
                                    chart: {
                                        height: 250
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            }
                        ]
                    };
                if (typeof donutChartEl !== undefined && donutChartEl !== null) {
                    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
                    donutChart.render();
                }
            }

            function renderChartjsDonuts(series, selector, legend_selector = false, satuan = '') {
                const colorPalette = [
                    '#836AF9', // purpleColor
                    '#ffe800', // yellowColor
                    '#28dac6', // cyanColor
                    '#FF8132', // orangeColor
                    '#ffcf5c', // orangeLightColor
                    '#299AFF', // oceanBlueColor
                    '#4F5D70', // greyColor
                    '#EDF1F4', // greyLightColor
                    '#2B9AFF', // blueColor
                    '#84D0FF' // blueLightColor
                ];
                const labels = Object.keys(series);
                const values = Object.values(series);
                const colors = labels.map((_, index) => colorPalette[index % colorPalette.length])

                let cardColor, headingColor, labelColor, borderColor, legendColor;

                if (isDarkStyle) {
                    cardColor = config.colors_dark.cardColor;
                    headingColor = config.colors_dark.headingColor;
                    labelColor = config.colors_dark.textMuted;
                    legendColor = config.colors_dark.bodyColor;
                    borderColor = config.colors_dark.borderColor;
                } else {
                    cardColor = config.colors.cardColor;
                    headingColor = config.colors.headingColor;
                    labelColor = config.colors.textMuted;
                    legendColor = config.colors.bodyColor;
                    borderColor = config.colors.borderColor;
                }
                renderChartjsDonuts

                const doughnutChart = document.getElementById(selector);
                const doughnutLegend = document.getElementById(legend_selector);
                if (doughnutChart) {
                    if (chartInstances[selector]) {
                        chartInstances[selector].destroy();
                    }

                    const ctx = doughnutChart.getContext('2d');

                    const doughnutChartVar = new Chart(doughnutChart, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: colors,
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 500
                            },
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.labels || '',
                                                value = context.parsed;
                                            const output = ' ' + label + ' : ' + value + ' ' +
                                                satuan;
                                            return output;
                                        }
                                    },
                                    // Updated default tooltip UI
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                }
                            }
                        }
                    });
                    chartInstances[selector] = doughnutChartVar;
                    if (doughnutLegend) {
                        doughnutLegend.innerHTML = labels.map((label, index) => {
                            return `
                                <li class="legend-item">
                                    <span class="legend-color" style="background-color: ${colors[index]};"></span>
                                    <div class="legend-text">
                                        <h6 class="legend-label mb-1">${label}</h6>
                                        <div class="text-muted small">${values[index]} ${satuan}</div>
                                    </div>
                                </li>
                            `;
                        }).join('');
                    }
                }
            }

            function renderApexJsPercentage(selector, positif, negatif, label, satuan) {
                console.log(selector, positif, negatif, label, satuan)
                const persentase = Math.round(positif / (positif + negatif) * 100)
                console.log(persentase)

                if (chartInstances[selector]) {
                    chartInstances[selector].destroy();
                }
                const overviewChartEl = document.querySelector('#' + selector),
                    overviewChartConfig = {
                        chart: {
                            height: 114,
                            type: 'radialBar',
                            sparkline: {
                                enabled: true
                            }
                        },
                        plotOptions: {
                            radialBar: {
                                hollow: {
                                    size: '55%'
                                },
                                dataLabels: {
                                    name: {
                                        show: false
                                    },
                                    value: {
                                        show: true,
                                        offsetY: 5,
                                        fontWeight: 500,
                                        fontSize: '1rem',
                                        fontFamily: 'Inter',
                                        color: headingColor
                                    }
                                },
                                track: {
                                    background: config.colors_label.secondary
                                }
                            }
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: 'none'
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none'
                                }
                            }
                        },
                        stroke: {
                            lineCap: 'round'
                        },
                        colors: [config.colors.primary],
                        grid: {
                            padding: {
                                bottom: -15
                            }
                        },
                        series: [persentase],
                        labels: [label + ' : ' + positif + ' ' + satuan]
                    };
                if (typeof overviewChartEl !== undefined && overviewChartEl !== null) {
                    console.log("create Apex Chart")
                    const overviewChart = new ApexCharts(overviewChartEl, overviewChartConfig);
                    overviewChart.render();
                    chartInstances[selector] = overviewChart
                }

            }

            function renderGender(data) {
                $('#perempuan').html(data['Perempuan'])
                $('#laki-laki').html(data['Laki-laki'])
                $('#total_gender').html(data['Perempuan'] + data['Laki-laki'])
            }
            let cardColor, labelColor, headingColor, borderColor, bodyColor;
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                labelColor = config.colors_dark.textMuted;
                headingColor = config.colors_dark.headingColor;
                borderColor = config.colors_dark.borderColor;
                bodyColor = config.colors_dark.bodyColor;
            } else {
                cardColor = config.colors.cardColor;
                labelColor = config.colors.textMuted;
                headingColor = config.colors.headingColor;
                borderColor = config.colors.borderColor;
                bodyColor = config.colors.bodyColor;
            }

            function renderDivisi(data) {
                console.log("data derajat", data)
                const performanceChartEl = document.querySelector('#customPerformanceChartxx'),
                    performanceChartConfig = {
                        chart: {
                            height: 247,
                            type: 'radar',
                            toolbar: {
                                show: false
                            }
                        },
                        legend: {
                            show: true,
                            markers: {
                                offsetX: -2
                            },
                            itemMargin: {
                                horizontal: 10
                            },
                            fontFamily: 'Inter',
                            fontSize: '15px',
                            labels: {
                                colors: bodyColor,
                                useSeriesColors: false
                            }
                        },
                        plotOptions: {
                            radar: {
                                polygons: {
                                    strokeColors: borderColor,
                                    connectorColors: borderColor
                                }
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        series: [{
                                name: 'Review Ke 1',
                                data: data['values']
                            },
                            //  {
                            //     name: 'Kesimpulan2',
                            //     data: data['values']['kesimpulan2']
                            // },
                        ],
                        colors: [config.colors.warning, config.colors.primary],
                        xaxis: {
                            categories: data['jenis_kesimpulan'],
                            labels: {
                                show: true,
                                style: {
                                    colors: [bodyColor, bodyColor, bodyColor, bodyColor, bodyColor, bodyColor],
                                    fontSize: '15px',
                                    fontFamily: 'Inter'
                                }
                            }
                        },
                        fill: {
                            opacity: [1, 0.9]
                        },
                        stroke: {
                            show: false,
                            width: 0
                        },
                        markers: {
                            size: 0
                        },
                        grid: {
                            show: false,
                            padding: {
                                top: 0,
                                bottom: -10
                            }
                        },
                        responsive: [{
                                breakpoint: 1398,
                                options: {
                                    chart: {
                                        height: 287
                                    }
                                }
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 393
                                    }
                                }
                            }
                        ]
                    };
                if (typeof performanceChartEl !== undefined && performanceChartEl !== null) {
                    const performanceChart = new ApexCharts(performanceChartEl, performanceChartConfig);
                    performanceChart.render();
                }
            }

            function renderTopDivisi(data) {
                let html = ''
                for (let key in data) {
                    if (data.hasOwnProperty(key)) { // Pastikan key adalah properti langsung dari objek
                        html += htmlDivisi(key, data[key])
                    }
                }
                $('#top_divisi').html(html)
            }

            function htmlDivisi(name, value) {
                return ` 
                         <li class="d-flex mb-1">
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-0">
                                <div class="me-2">
                                    <h6 class="mb-0">${name}</h6>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">${value}</div>
                            </div>
                        </li>`
            }

            function renderUsia(data) {
                console.log(data)
                const salesCountryChartEl = document.querySelector('#chartUsia'),
                    salesCountryChartConfig = {
                        chart: {
                            type: 'bar',
                            height: 368,
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Sales',
                            data: [data['< 20'], data['20-25'], data['25-30'], data['30-35'], data[
                                    '35-40'],
                                data['40-45'], data['45-50'], data['50-55'], data['55-60'], data[
                                    '> 60']
                            ]
                        }],
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                barHeight: '60%',
                                horizontal: true,
                                distributed: true,
                                startingShape: 'rounded',
                                dataLabels: {
                                    position: 'bottom'
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            offsetY: 8,
                            offsetX: 11,
                            style: {
                                fontWeight: 500,
                                fontSize: '0.9375rem',
                                fontFamily: 'Inter'
                            }
                        },
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            show: false
                        },
                        colors: [
                            config.colors.primary,
                            config.colors.success,
                            config.colors.warning,
                            config.colors.info,
                            config.colors.danger
                        ],
                        grid: {
                            strokeDashArray: 8,
                            borderColor,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: -18,
                                left: 21,
                                right: 33,
                                bottom: 10
                            }
                        },
                        xaxis: {
                            categories: ['< 20', '20-25', '25-30', '30-35', '35-40', '40-45', '45-50', '50-55',
                                '55-60', '> 60'
                            ],
                            labels: {
                                // formatter: function(val) {
                                //     return Number(val / 1000) + 'K';
                                // },
                                style: {
                                    fontSize: '0.9375rem',
                                    colors: labelColor,
                                    fontFamily: 'Inter'
                                }
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    fontWeight: 500,
                                    fontSize: '0.9375rem',
                                    colors: headingColor,
                                    fontFamily: 'Inter'
                                }
                            }
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: 'none'
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none'
                                }
                            }
                        }
                    };
                if (typeof salesCountryChartEl !== undefined && salesCountryChartEl !== null) {
                    const salesCountryChart = new ApexCharts(salesCountryChartEl, salesCountryChartConfig);
                    salesCountryChart.render();
                }
            }
        });
    </script>
@endsection
