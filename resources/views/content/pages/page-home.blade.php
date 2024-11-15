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
        <!-- Gamification Card -->
        <div class="col-md-12 col-lg-12">
            {{-- Hello --}}
            <div class="row">

                <div class="col-lg-6">

                    <div class="card h-100 mb-3">
                        <div class="d-flex align-items-center row">
                            <div class="col-md-6 order-2 order-md-1">
                                <div class="card-body">
                                    <h4 class="card-title pb-xl-2">Selamat datang!🎉</h4>
                                    <p class="mb-0">Di sistem informasi PERTAFIT</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                                <div class="card-body pb-0 px-0 px-md-4 ps-0">
                                    {{-- <img src="{{ asset('assets/img/illustrations/illustration-john-' . $configData['style'] . '.png') }}" --}}
                                    <img src="{{ asset('assets/img/splash1.png') }}" height="180" alt="View Profile"
                                        data-app-light-img="illustrations/illustration-john-light.png"
                                        data-app-dark-img="illustrations/illustration-john-dark.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card Info --}}
                <div class="col-lg-6 mb-3 h-100">
                    <div class="row h-100">
                        <div class="col-lg-6 col-sm-6 h-100">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded">
                                                <i class="mdi mdi-account-group-outline mdi-24px"></i>
                                            </div>
                                        </div>
                                        {{-- <div class="d-flex align-items-center">
                                            <p class="mb-0 text-success me-1">+22%</p>
                                            <i class="mdi mdi-chevron-up text-success"></i>
                                        </div> --}}
                                    </div>
                                    <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                                        <h5 class="mb-2">Internal Workers</h5>
                                        <p class="mb-lg-2 mb-xl-3">Total {{ $dataContent['counterInternal']['total'] }}
                                            workers</p>
                                        {{-- <div class="badge bg-label-secondary rounded-pill">Last 4 Month</div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded">
                                                <i class="mdi mdi-book-account mdi-24px"></i>
                                            </div>
                                        </div>
                                        {{-- <div class="d-flex align-items-center">
                                            <p class="mb-0 text-success me-1">+22%</p>
                                            <i class="mdi mdi-chevron-up text-success"></i>
                                        </div> --}}
                                    </div>
                                    <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                                        <h5 class="mb-2">External Workers</h5>
                                        <p class="mb-lg-2 mb-xl-3">Total {{ $dataContent['counterExternal']['total'] }}
                                            wokers </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-sm-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-primary rounded">
                                            <i class="mdi mdi-cart-plus mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 text-success me-1">+22%</p>
                                        <i class="mdi mdi-chevron-up text-success"></i>
                                    </div>
                                </div>
                                <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                                    <h5 class="mb-2">155k</h5>
                                    <p class="mb-lg-2 mb-xl-3">Total Orders</p>
                                    <div class="badge bg-label-secondary rounded-pill">Last 4 Month</div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    </div>
                </div>
            </div>


        </div>

        <!--/ Grafik-->
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Internal Chart Screening</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="donutChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body card-datatable table-responsive">
                            <table id="tableScreening" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>PT/PJP</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataContent['internalUser'] as $internal)
                                        <tr>
                                            <td>{{ $internal->name }}</td>
                                            <td>{{ $internal->company->name }}</td>
                                            {{-- <td>{{ $internal->field_work?->high_risk == 'Y' ? 'HIGH RISK' : '' }}</td> --}}
                                            <td>{!! spanFitality($internal->screenings?->first() ? $internal->screenings?->first()->fitality : '') !!}
                                            </td>
                                            <td>{!! $internal->screenings?->first()
                                                ? \Carbon\Carbon::parse($internal->screenings?->first()->created_at)->format('H:i')
                                                : '-' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="col-md-12 col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">External Chart Screening</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="donutChartEx"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body card-datatable table-responsive">
                            <table id="tableScreeningEx" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>PT/PJP</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataContent['externalUser'] as $internal)
                                        <tr>
                                            <td>{{ $internal->name }}</td>
                                            <td>{{ $internal->company->name }}</td>
                                            {{-- <td>{{ $internal->field_work?->high_risk == 'Y' ? 'HIGH RISK' : '' }}</td> --}}
                                            <td>{!! spanFitality($internal->screenings?->first() ? $internal->screenings?->first()->fitality : '') !!}
                                            </td>
                                            <td>{!! $internal->screenings?->first()
                                                ? \Carbon\Carbon::parse($internal->screenings?->first()->created_at)->format('H:i')
                                                : '-' !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Berita Artikel --}}
        <div class="col-lg-12">
            <div class="row mb-5">
                @foreach ($dataContent['content'] as $content)
                    <div class="col-lg-6 d-flex align-items-stretch mb-2">
                        <div class="card mb-3 h-100">
                            <div class="row g-0 h-100">
                                <div class="col-md-4">
                                    <img class="card-img card-img-left h-100"
                                        src="{{ $content->sampul ? url('storage/upload/content/' . $content->sampul) : url('assets/img/reading.jpg') }}"
                                        alt="Card image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column">
                                        <a href="{{ url('content/show/' . $content->slug) }}">
                                            <h5 class="card-title" title="{{ $content->judul }}">
                                                {{ \Illuminate\Support\Str::words($content->judul, 6) }}</h5>
                                        </a>

                                        <p class="card-text flex-grow-1">
                                            {{ \Illuminate\Support\Str::words(strip_tags($content->content), 30) }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">{{ $content->updated_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-2 mb-3">
                <a href="{{ url('content') }}" class="btn btn-primary">Baca Berita dan Informasi Lainnya</a>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                        <h4 class="mb-0 me-2">$38.5k</h4>
                        <p class="mb-0 text-success">+62%</p>
                    </div>
                    <span class="d-block mb-2 text-body">Sessions</span>
                </div>
                <div class="card-body pt-0 h-100">
                    <div id="sessions"></div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-12 col-xl-8">
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
                                <h5 class="mb-1">Report</h5>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="totalTransaction"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalTransaction">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 text-body">Last month transactions $234.40k</p>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-6 border-end">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-success rounded">
                                                <div class="mdi mdi-trending-up mdi-24px"></div>
                                            </div>
                                        </div>
                                        <p class="my-2">This Week</p>
                                        <h6 class="mb-0">+82.45%</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded">
                                                <div class="mdi mdi-trending-down mdi-24px"></div>
                                            </div>
                                        </div>
                                        <p class="my-2">This Week</p>
                                        <h6 class="mb-0">-24.86%</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-around flex-wrap gap-2">
                                <div>
                                    <p class="mb-1">Performance</p>
                                    <h6 class="mb-0">+94.15%</h6>
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

        <div class="col-12 col-xl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Performance</h5>
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
                    <div id="performanceChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Project Statistics</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="projectStatus" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatus">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between py-2 px-4 border-bottom">
                    <h6 class="mb-0 small">NAME</h6>
                    <h6 class="mb-0 small">BUDGET</h6>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4">
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
                                    <h6 class="mb-0">3D Illustration</h6>
                                    <small>Blender Illustration</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">$6,500</div>
                            </div>
                        </li>
                        <li class="d-flex mb-4">
                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                <div class="avatar-initial bg-lighter rounded">
                                    <div>
                                        <img src="{{ asset('assets/img/icons/misc/finance-app-design.png') }}"
                                            alt="User" class="h-25">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Finance App Design</h6>
                                    <small>Figma UI Kit</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">$4,290</div>
                            </div>
                        </li>
                        <li class="d-flex mb-4">
                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                <div class="avatar-initial bg-lighter rounded">
                                    <div>
                                        <img src="{{ asset('assets/img/icons/misc/4-square.png') }}" alt="User"
                                            class="h-25">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">4 Square</h6>
                                    <small>Android Application</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">$44,500</div>
                            </div>
                        </li>
                        <li class="d-flex mb-4">
                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                <div class="avatar-initial bg-lighter rounded">
                                    <div>
                                        <img src="{{ asset('assets/img/icons/misc/delta-web-app.png') }}" alt="User"
                                            class="h-25">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Delta Web App</h6>
                                    <small>React Dashboard</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">$12,690</div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                <div class="avatar-initial bg-lighter rounded">
                                    <div>
                                        <img src="{{ asset('assets/img/icons/misc/ecommerce-website.png') }}"
                                            alt="User" class="h-25">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">eCommerce Website</h6>
                                    <small>Vue + Laravel</small>
                                </div>
                                <div class="badge bg-label-primary rounded-pill">$10,850</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="row g-4">
                <!-- Total Revenue chart -->
                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                                <h4 class="mb-0 me-2">$42.5k</h4>
                                <p class="mb-0 text-danger">-22%</p>
                            </div>
                            <span class="d-block mb-2 text-body">Total Revenue</span>
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
                                <p class="text-body">Total Sales</p>
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
                                <p class="text-body">Total Impression</p>
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
                            <span class="d-block mb-2 text-body">Overview</span>
                        </div>
                        <div class="card-body pt-0">
                            <div id="overviewChart" class="d-flex align-items-center"></div>
                        </div>
                    </div>
                </div>
                <!--/ overview Radial chart -->
            </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Sales Country</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="salesCountryDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesCountryDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 text-body">Total $42,580 Sales</p>
                </div>
                <div class="card-body pb-1 px-0">
                    <div id="salesCountryChart"></div>
                </div>
            </div>
        </div>


        <div class="col-12 col-xl-8">
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
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
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
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
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
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
                                            <td class="pe-0 text-danger">-8%</td>
                                            <td class="pe-0 text-end h6">$322</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Facebook page advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
                                            <td class="text-success pe-0">+19%</td>
                                            <td class="pe-0 text-end h6">$5,634</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Messenger advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-danger">Expired</span></td>
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
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
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
                                                    class="badge rounded-pill bg-label-danger">Expired</span></td>
                                            <td class="pe-0 text-success">+2%</td>
                                            <td class="pe-0 text-end h6">$404</td>
                                        </tr>
                                        <tr>
                                            <td class="h6 ps-0">Community advertising</td>
                                            <td class="pe-0"><span
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
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
                                                    class="badge rounded-pill bg-label-primary">Active</span></td>
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
        </div>

        <div class="col-12 col-xl-4 col-md-6">
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


        <div class="col-12 col-xl-4 col-md-6">
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

        <div class="col-12 col-xl-8">
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
    <script>
        $(document).ready(function() {
            $('#tableScreening, #tableScreeningEx').DataTable({
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
                "order": [
                    [3, 'desc'],
                    [0, 'asc'],
                ],
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


            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;


            const chartColors = {
                column: {
                    series1: '#826af9',
                    series2: '#d2b0ff',
                    bg: '#f8d3ff'
                },
                donut: {
                    series1: '#fdd835',
                    series2: '#32baff',
                    series3: '#ffa1a1',
                    series4: '#7367f0',
                    series5: '#29dac7'
                },
                area: {
                    series1: '#ab7efd',
                    series2: '#b992fe',
                    series3: '#e0cffe'
                }
            };
            seriesInternal = [{{ $dataContent['counterInternal']['nul'] }},
                {{ $dataContent['counterInternal']['fit'] }},
                {{ $dataContent['counterInternal']['unfit'] }}
            ];
            seriesExternal = [{{ $dataContent['counterExternal']['nul'] }},
                {{ $dataContent['counterExternal']['fit'] }},
                {{ $dataContent['counterExternal']['unfit'] }}
            ];
            renderChart(seriesInternal, '#donutChart')
            renderChart(seriesExternal, '#donutChartEx')

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
        })
    </script>
@endsection
