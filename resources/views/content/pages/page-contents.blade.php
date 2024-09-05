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
        {{-- Berita Artikel --}}
        <div class="col-lg-12">
            <div class="row mb-5">
                @foreach ($contents as $content)
                    <div class="col-lg-6 d-flex align-items-stretch mb-2">
                        <div class="card mb-3 h-100">
                            <div class="row g-0 h-100">
                                <div class="col-md-4">
                                    <img class="card-img card-img-left"
                                        src="{{ url('storage/upload/content/' . $content->sampul) }}" alt="Card image">
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
                {{ $contents->links() }}
            </div>
        </div>

    </div>
@endsection
