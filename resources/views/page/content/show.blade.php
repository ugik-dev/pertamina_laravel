@extends('layouts/layoutMaster')

@section('title', 'Pricing - Pages')

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-pricing.css') }}" />
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-pricing.js') }}"></script>
@endsection

@section('content')
    <div class="card">
        <!-- Pricing Plans -->
        <div class="pb-sm-5 pb-2 rounded-top">
            <div class="container py-5">
                <h2 class="text-center mb-2 mt-0 mt-md-4">{{ $dataContent->judul }}</h2>
                <p class="text-center">{{ $dataContent->tanggal }}</p>


                <div class="pricing-plans row mx-0 gy-3 px-lg-5">
                    <!-- Basic -->
                    <div class="col-lg mb-md-0 mb-4">
                        <div class="card border rounded shadow-none">
                            <div class="card-body">
                                {!! $dataContent->content !!}
                                {{-- <div class="my-3 pt-2 text-center">
                                    <img src="{{ asset('assets/img/illustrations/pricing-basic.png') }}" alt="Basic Image"
                                        height="100">
                                </div>
                                <h3 class="card-title text-center text-capitalize mb-1">Basic</h3>
                                <p class="text-center pb-2">A simple start for everyone</p>
                                <div class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-body fw-normal">$</sup>
                                        <h1 class="display-3 mb-0 text-primary">0</h1>
                                        <sub class="h6 pricing-duration mt-auto mb-2 text-body fw-normal">/month</sub>
                                    </div>
                                </div>

                                <a href="{{ url('auth/register-basic') }}" class="btn btn-outline-success d-grid w-100">Your --}}
                                Current Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Pricing Plans -->
    </div>
@endsection
