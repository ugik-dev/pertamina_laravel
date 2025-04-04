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

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css",') }}"></script>

@endsection
@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}">
@endsection
@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    {{-- <script src="{{ asset('js/custom-chart.js') }}"></script> --}}
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">MCU /</span> Batch
    </h4>
    @csrf

    {{-- Chart Start --}}
    <div class="row gy-4">
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
                                <h5 class="mb-1">Gender</h5>
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

                <div class="col-md-6 col-sm-6">
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
                </div>

                <div class="col-md-6 col-sm-6">
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
                </div>
                <!-- overview Radial chart -->
                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                                <h4 class="mb-0 me-2">$67.1k</h4>
                                <p class="mb-0 text-success">+49%</p>
                            </div>
                            <span class="d-block mb-2 text-body">DM Terkontrol</span>
                        </div>
                        <div class="card-body pt-0">
                            <div id="overviewChart" class="d-flex align-items-center"></div>
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
                    <h6 class="mb-0 small">NAME</h6>
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
                        <h5 class="mb-1">Sebaran Lokasi</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="performanceDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0 pt-1">
                    <div id="customPerformanceChartxx"></div>
                </div>
            </div>
        </div>


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
        </div>


        <div class="col-12 col-xl-6 col-md-6">
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
        </div>

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

    <div class="card mt-5">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        @foreach ($dataContent['paramMCU'] as $label)
                            <th>{{ $label['label'] }}
                        @endforEach
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3" id="form-content" onsubmit="return false">
                @csrf
                <input type="text" id="id" class="" hidden name="id" />
                <div class="col-sm-12">
                    <label for="basicFullname">Description:</label>
                    <textarea type="text" id="description" class="form-control dt-full-name" name="description" placeholder=""
                        aria-label="" aria-describedby="basicFullname2"> </textarea>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="basicSalary">Jenis :</label>
                        <div class="form-floating form-floating-outline">
                            <select id="ref_mcu_id" name="ref_mcu_id" class="form-control">
                                <option value="">--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="basicFullname">Tanggal Dokumen :</label>
                        <input type="date" id="doc_date" class="form-control dt-full-name" name="doc_date"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="basicFullname">File :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="file" id="file_attachment" class="form-control dt-full-name"
                                name="file_attachment" aria-label="" aria-describedby="basicFullname2"
                                accept=".csv" />
                        </div>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="col-sm-12">
                    <a type="" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="insertBtn"
                        data-metod="ins">Tambah</a>
                    <a type="" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="updateBtn"
                        data-act="upd">Simpan Perubahan</a>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>

        </div>
    </div>
    <style>
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

            var toolbar = {
                'form': $('#toolbar_form'),
                'id_role': $('#toolbar_form').find('#id_role'),
                'id_opd': $('#toolbar_form').find('#id_opd'),
                'newBtn': $('#new_btn'),
            }

            const offCanvasEl = new bootstrap.Offcanvas($('#add-new-record'));

            var FDataTable = $('#FDataTable').DataTable({
                columnDefs: [],
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

            var select2 = $('.select2');
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    select2Focus($this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Select value',
                        dropdownParent: $this.parent()
                    });
                });
            }
            var dataContent = {}

            swalLoading();
            $.when(
                getAllContent()).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });


            function getAllContent() {
                return $.ajax({
                    url: `{{ route('mcu.fetch_detail', $dataContent['id']) }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataContent = data['data'];

                        renderContent(dataContent['batches']);
                        renderGender(dataContent['statis']['gender']);
                        renderLokasi(dataContent['statis']['kesimpulan']);
                        renderTopLokasi(dataContent['statis']['lokasi']['data']);
                        renderUsia(dataContent['statis']['usia']);
                    },
                    error: function(e) {}
                });
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
                    renderData.push([
                        @foreach ($dataContent['paramMCU'] as $label)
                            user['{{ $label['field'] }}'],
                        @endforEach
                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }

            function renderChart(series, selector) {

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
                console.log(data)
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
                            name: 'Kesimpulan1',
                            data: data['values']['kesimpulan1']
                        }, {
                            name: 'Kesimpulan2',
                            data: data['values']['kesimpulan2']
                        }, ],
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
                            data: [data['< 20'], data['20-25'], data['25-30'], data['30-35'], data['35-40'],
                                data['40-45'], data['45-50'], data['50-55'], data['55-60'], data['> 60']
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
