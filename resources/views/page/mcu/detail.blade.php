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
        <span class="text-muted fw-light">MCU /</span> Batch
    </h4>
    @csrf

    {{-- Chart Start --}}
    <div class="row gy-4">
        <div class="col-12">
            {{-- <div class="card">
                <div class="card-body"> --}}
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
                            <form class="add-new-record pt-0 row g-3 mb-3" id="toolbar_form" onsubmit="return false">
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
                                    <label for="basicSalary">Provider :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="provider" name="provider[]" class="form-control select2" multiple>
                                            <option value=""> -- Semua --</option>
                                            @foreach ($dataContent['filter']['lokasi'] as $provider)
                                                <option value="{{ $provider['value'] }}">{{ $provider['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">BMI :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_bmi" name="bmi[]" class="form-control select2" multiple>
                                            @foreach ($dataContent['filter']['bmi'] as $bmi)
                                                <option value="{{ $bmi }}">{{ $bmi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Ekg :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_ekg" name="ekg[]" class="form-control select2" multiple>
                                            @foreach ($dataContent['filter']['ekg'] as $ekg)
                                                <option value="{{ $ekg }}">{{ $ekg }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="basicSalary">Kardio :</label>
                                    <div class="form-floating form-floating-outline">
                                        <select id="filter_kardio" name="kardio[]" class="form-control select2" multiple>
                                            @foreach ($dataContent['filter']['kardio'] as $kardio)
                                                <option value="{{ $kardio }}">{{ $kardio }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <button id="toolbar_submit" class="btn btn-primary w-100"> <i class="mdi mdi-filter"></i>
                                Filter </button>
                        </div>
                        <div class="accordion-footer">
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div>
            </div> --}}
        </div>
        {{-- </div> --}}
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

        {{-- KOL GROUP --}}
        <div class="col-md-6 col-xl-4">
            <div class="row g-4">
                <!-- Total Revenue chart -->
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
                <!--/ Total Revenue chart -->

                {{-- <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-success rounded">
                                        <i class="mdi mdi-currency-usd mdi-24px"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-success me-1">+38%</p>
                                    <i class="mdi mdi-chevron-up text-success"></i>
                                </div>
                            </div>
                            <div class="card-info mt-4 pt-3">
                                <h5 class="mb-2">$13.4k</h5>
                                <p class="text-body">Hiperuricemia</p>
                                <div class="badge bg-label-secondary rounded-pill mt-1">Last Six Month </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-info rounded">
                                        <i class="mdi mdi-link mdi-24px"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-success me-1">+62%</p>
                                    <i class="mdi mdi-chevron-up text-success"></i>
                                </div>
                            </div>
                            <div class="card-info mt-4 pt-4">
                                <h5 class="mb-2">142.8k</h5>
                                <p class="text-body">Hiperglikemia</p>
                                <div class="badge bg-label-secondary rounded-pill">Last One Year</div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Smokee Free -->
                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="mb-0">Free Smoke</h5>

                            {{-- <span class="d-block mb-2 text-body">Tidak Merkok</span> --}}
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
                                {{-- <p class="my-2"></p> --}}
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
                                {{-- <p class="my-2">Laki-laki</p> --}}
                                <h6 class="mb-0"><span id="smoker">-</span>
                                    Org</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ overview Radial chart -->
            </div>
        </div>

        {{-- TOP MCU --}}
        <div class="col-md-6 col-xl-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">TOP Ranking MCU</h5>
                </div>
                <div class="d-flex justify-content-between py-2 px-4 border-bottom">
                    <h6 class="mb-0 small">Nama Provider</h6>
                    <h6 class="mb-0 small">Jumlah</h6>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0" id="top_lokasi">
                        {{-- <li class="d-flex mb-4">
                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                <div class="avatar-initial bg-lighter rounded">
                                    <div>
                                        <img src="{{ asset('assets/img/icons/misc/3d-illustration.png') }}"
                                            alt="User" class="h-25">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Agususanto</h6>
                                    <small>PT Pertamina</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">200</div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>

        {{-- SEBARAN LOKASI --}}
        <div class="col-12 col-xl-6 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Derajat Kesehatan</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="performanceDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-value="last">Last Review</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-value="first">First Review</a>
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
                    <ul id='cardiovascularLegend' class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 mb-4">
            <div class="card">
                <h5 class="card-header">Gambaran EKG</h5>
                <div class="card-body">
                    <canvas id="ekgChart" class="chartjs mb-4" data-height="350"></canvas>
                    <ul id='ekgLegend' class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 mb-4">
            <div class="card">
                <h5 class="card-header">Status Gizi</h5>
                <div class="card-body">
                    <canvas id="bmiChart" class="chartjs mb-4" data-height="350"></canvas>
                    <ul id='bmiLegend' class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                    </ul>
                </div>
            </div>
        </div>

        {{-- Usia --}}
        <div class="col-12 col-xl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Rentang Usia</h5>
                    </div>
                    {{-- <p class="mb-0 text-body">Total $42,580 Sales</p> --}}
                </div>
                <div class="card-body pb-1 px-0">
                    <div id="chartUsia"></div>
                </div>
            </div>
        </div>


        {{-- <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title m-0">
                        <h5 class="mb-1">Top Referral Sources</h5>
                        <p class="text-body mb-0">82% Activity Growth</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-3">
                    <ul class="nav nav-tabs nav-tabs-widget pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                        <li class="nav-item">
                            <div class="nav-link btn active d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id"
                                aria-controls="navs-orders-id" aria-selected="true">
                                <button type="button" class="btn btn-icon rounded-pill btn-label-google-plus">
                                    <i class="mdi mdi-google mdi-20px"></i>
                                </button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id"
                                aria-controls="navs-sales-id" aria-selected="false">
                                <button type="button" class="btn btn-icon rounded-pill btn-label-facebook">
                                    <i class="mdi mdi-facebook mdi-20px"></i>
                                </button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id"
                                aria-controls="navs-profit-id" aria-selected="false">
                                <button type="button" class="btn btn-icon rounded-pill btn-label-instagram">
                                    <i class="mdi mdi-instagram mdi-20px"></i>
                                </button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <button type="button" class="btn btn-icon rounded-pill btn-label-twitter">
                                    <i class="mdi mdi-twitter mdi-20px"></i>
                                </button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link btn d-flex align-items-center justify-content-center disabled"
                                role="tab" data-bs-toggle="tab" aria-selected="false">
                                <button type="button" class="btn btn-icon rounded bg-label-secondary">
                                    <i class="mdi mdi-plus mdi-20px"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content p-0 ms-0 ms-sm-2">
                        <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th class="fw-medium ps-0 text-heading">Parameter</th>
                                            <th class="pe-0 fw-medium text-heading">Status</th>
                                            <th class="pe-0 fw-medium text-heading">Conversion</th>
                                            <th class="pe-0 text-end text-heading">total revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h6 ps-0">Email Marketing Campaign</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="pe-0 text-success">+24%</td>
                                            <td class="pe-0 text-end h6">$42,857</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Google Workspace</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-warning">Completed</span></td>
                                            <td class="text-danger pe-0">-12%</td>
                                            <td class="pe-0 text-end h6">$850</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Affiliation Program</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="text-success pe-0">+24%</td>
                                            <td class="pe-0 text-end h6">$5,576</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Google Adsense</td>
                                            <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                    Draft</span></td>
                                            <td class="text-success pe-0">0%</td>
                                            <td class="pe-0 text-end h6">$0</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th class="fw-medium ps-0 text-heading">parameter</th>
                                            <th class="pe-0 fw-medium text-heading">Status</th>
                                            <th class="pe-0 fw-medium text-heading">Conversion</th>
                                            <th class="pe-0 text-end text-heading">total revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h6 ps-0">Create Audiences in Ads Manager</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="pe-0 text-danger">-8%</td>
                                            <td class="pe-0 text-end h6">$322</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Facebook page advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="text-success pe-0">+19%</td>
                                            <td class="pe-0 text-end h6">$5,634</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Messenger advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-danger">Expired</span>
                                            </td>
                                            <td class="text-danger pe-0">-23%</td>
                                            <td class="pe-0 text-end h6">$751</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Video campaign</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-warning">Completed</span></td>
                                            <td class="text-success pe-0">+21%</td>
                                            <td class="pe-0 text-end h6">$3,585</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th class="fw-medium ps-0 text-heading">parameter</th>
                                            <th class="pe-0 fw-medium text-heading">Status</th>
                                            <th class="pe-0 fw-medium text-heading">Conversion</th>
                                            <th class="pe-0 text-end text-heading">total revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h6 ps-0">Create shopping advertising</td>
                                            <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                    Draft</span></td>
                                            <td class="pe-0 text-danger">-15%</td>
                                            <td class="pe-0 text-end h6">$599</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">IGTV advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-warning">Completed</span></td>
                                            <td class="text-success pe-0">+37%</td>
                                            <td class="pe-0 text-end h6">$1,467</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Collection advertising</td>
                                            <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                    Draft</span></td>
                                            <td class="text-danger pe-0">0%</td>
                                            <td class="pe-0 text-end h6">$0</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Stories advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="text-success pe-0">+29%</td>
                                            <td class="pe-0 text-end h6">$4,546</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th class="fw-medium ps-0 text-heading">Parameter</th>
                                            <th class="pe-0 fw-medium text-heading">Status</th>
                                            <th class="pe-0 fw-medium text-heading">Conversion</th>
                                            <th class="pe-0 text-end text-heading">total revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="h6 ps-0">Interests advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-danger">Expired</span>
                                            </td>
                                            <td class="pe-0 text-success">+2%</td>
                                            <td class="pe-0 text-end h6">$404</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Community advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="text-success pe-0">+25%</td>
                                            <td class="pe-0 text-end h6">$399</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Device advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-warning">Completed</span></td>
                                            <td class="text-success pe-0">+21%</td>
                                            <td class="pe-0 text-end h6">$177</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Campaigning</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span>
                                            </td>
                                            <td class="text-danger pe-0">-5%</td>
                                            <td class="pe-0 text-end h6">$1,139</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- 
        <div class="col-12 col-xl-6 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Weekly Sales</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="weeklySalesDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklySalesDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <p class="text-body mb-0">Total 85.4k Sales</p>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6 d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-trending-up mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3 d-flex flex-column">
                                <small class="text-body mb-1">Net Income</small>
                                <h6 class="mb-0">$438.5K</h6>
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <i class="mdi mdi-currency-usd mdi-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3 d-flex flex-column">
                                <small class="text-body mb-1">Expense</small>
                                <h6 class="mb-0">$22.4K</h6>
                            </div>
                        </div>
                    </div>
                    <div id="weeklySalesChart"></div>
                </div>
            </div>
        </div> --}}


        {{-- <div class="col-12 col-xl-6 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Visits by Day</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="visitsByDayDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitsByDayDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 text-body">Total 248.5k Visits</p>
                </div>
                <div class="card-body pt-0">
                    <div id="visitsByDayChart"></div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <h6 class="mb-1">Most Visited Day</h6>
                            <p class="mb-0">Total 62.4k Visits on Thursday</p>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <i class="mdi mdi-chevron-right mdi-24px scaleX-n1-rtl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Activity Timeline</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="timelineDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 pb-1">
                    <ul class="timeline card-timeline mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-2">Create youtube video for next product 😎</h6>
                                    <small class="text-muted">Tomorrow</small>
                                </div>
                                <p class="mb-2">Product introduction and details video</p>
                                <div class="d-flex">
                                    <a href="https://www.youtube.com/@pixinvent1515" target="_blank"
                                        class="text-truncate">
                                        <span class="badge badge-center rounded-pill bg-danger w-px-20 h-px-20 me-2">
                                            <i class="mdi mdi-play text-white"></i>
                                        </span>
                                        <span class="fw-medium">https://www.youtube.com/@pixinvent1515</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-2">Received payment from usa client 😍
                                    </h6>
                                    <small class="text-muted">January, 18</small>
                                </div>
                                <p class="mb-2">Received payment $1,490 for banking ios app</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-transparent">
                            <span class="timeline-point timeline-point-warning"></span>
                            <div class="timeline-event pb-1">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-2">Meeting with joseph morgan for next project</h6>
                                    <small class="text-muted">April, 23</small>
                                </div>
                                <p class="mb-2">Meeting Video call on zoom at 9pm</p>
                                <div class="d-flex">
                                    <a href="javascript:void(0)" class="me-3">
                                        <img src="{{ asset('assets/img/icons/misc/pdf.png') }}" alt="PDF image"
                                            width="20" class="me-2">
                                        <span class="fw-medium">presentation.pdf</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- Chart END --}}
    {{-- Table Start --}}
    <div class="card mt-5">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Aksi</th>

                        @foreach ($dataContent['paramMCU'] as $label)
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
            <form class="add-new-record pt-0 row g-3" id="form-pengantar" onsubmit="return false">
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
                    <a type="" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="insertBtn"
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
                'bmi': $('#toolbar_form').find('#filter_bmi'),
                'ekg': $('#toolbar_form').find('#filter_ekg'),
                'kardio': $('#toolbar_form').find('#filter_kardio'), // tambahin juga ini
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

            // targetTrims = [
            //     10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
            //     20, 21, 22, 23, 24, 25, 26, 27, 28, 29,
            //     30, 31, 32, 33, 34, 35, 36, 37, 38, 39,
            //     40, 41, 42, 43, 44, 45, 46, 47, 48, 49,
            //     50, 51, 52, 53, 54, 55, 56, 57, 58, 59,
            //     60, 61, 62, 63, 64, 65, 66, 67, 68, 69,
            //     70, 71, 72, 73, 74, 75, 76, 77, 78, 79,
            //     80, 81, 82, 83, 84, 85, 86, 87, 88, 89,
            //     90, 91, 92, 93, 94, 95, 96, 97, 98, 99,
            //     100, 101, 102, 103, 104, 105, 106, 107, 108, 109,
            //     110, 111, 112, 113, 114, 115, 116, 117, 118, 119,
            //     120, 121, 122, 123, 124, 125, 126, 127, 128, 129,
            //     130, 131, 132, 133, 134, 135, 136, 137, 138, 139,
            //     140, 141, 142, 143, 144, 145, 146, 147, 148, 149,
            //     150, 151, 152, 153, 154, 155, 156, 157, 158, 159,
            //     160, 161, 162, 163, 164, 165, 166, 167, 168, 169,
            //     170, 171, 172, 173, 174, 175, 176, 177, 178, 179,
            //     180, 181, 182, 183, 184, 185, 186, 187
            // ];
            var targetTrims = Array.from({
                length: 177
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
                'ref_mcu_id': $('#form-content').find('#ref_mcu_id'),
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

            $('#toolbar_submit').on("click", function() {
                getAllContent()
                // blockUIclose()
            })

            function getAllContent() {
                blockUIshowLoading()
                return $.ajax({
                    url: `{{ route('mcu.fetch_detail', $dataContent['id']) }}`,
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
                        renderGender(dataContent['statis']['gender']);
                        // renderLokasi(dataContent['statis']['kesimpulan']);
                        renderTopLokasi(dataContent['statis']['lokasi']['data']);
                        renderUsia(dataContent['statis']['usia']);
                        renderChartjsDonuts(dataContent['statis']['kardio'], 'cardiovascularChart',
                            'cardiovascularLegend', 'Org')
                        renderChartjsDonuts(dataContent['statis']['ekg'], 'ekgChart',
                            'ekgLegend', 'Org')
                        renderChartjsDonuts(dataContent['statis']['bmi'], 'bmiChart',
                            'bmiLegend', 'Org')
                        renderApexJsPercentage('percentageMerokok',
                            dataContent['statis']['merokok']['Tidak'],
                            dataContent['statis']['merokok']['Ya'],
                            'Tidak Merokok', "Org"
                        )
                        renderKesimpulan(dataContent['statis']['kesimpulan'])

                        $('#smoker').html(dataContent['statis']['merokok']['Ya'])
                        $('#smoker_anti').html(dataContent['statis']['merokok']['Tidak'])
                        dataContent = dataContent['batches'];
                        blockUIclose()

                    },
                    error: function(e) {}
                });
            }

            FDataTable.on('click', '.show-review', function() {
                var currentId = $(this).data('id');
                blockUIshowLoading()
                return $.ajax({
                    url: `{{ url('mcu/batch-review') }}/` + currentId,
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
                // ContentForm.ref_mcu_id.val(currentData['ref_mcu_id']);
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
                        @foreach ($dataContent['paramMCU'] as $label)
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

            function renderLokasi(data) {
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

            function renderTopLokasi(data) {
                let html = ''
                for (let key in data) {
                    if (data.hasOwnProperty(key)) { // Pastikan key adalah properti langsung dari objek
                        html += htmlLokasi(key, data[key])
                    }
                }
                $('#top_lokasi').html(html)
            }

            function htmlLokasi(name, value) {
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
