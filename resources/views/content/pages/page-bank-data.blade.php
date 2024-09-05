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


        <!--/ Grafik-->
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
                        <tbody>
                            @foreach ($contents as $bank_data)
                                <tr>
                                    <td>{{ $bank_data->doc_date }}</td>
                                    <td>{{ $bank_data->ref_bank->name ?? '' }}</td>
                                    <td>{{ $bank_data->owner->name ?? '' }}</td>
                                    <td>{{ $bank_data->description }}</td>
                                    <td><a class="btn btn-info"
                                            href="{{ url('storage/upload/bank/' . $bank_data->filename) }}"
                                            target="_blank">Lihat</a>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tableScreening').DataTable({
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
        })
    </script>
@endsection
