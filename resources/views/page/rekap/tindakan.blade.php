@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pengguna Aplikasi')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Rekap /</span> Tindakan
    </h4>
    <div class="card">
        <div class="card-datatable">
            <a class="create-new btn btn-primary me-2" href="{{ route('tindakan.create') }}">
                <i class="mdi mdi-plus
                me-sm-1"></i> <span class="d-none d-sm-inline-block">Tindakan
                    Baru</span>
            </a>
            <table id="datatable" class="table table-bordered">
                <thead>
                    <!-- Definisi Kolom -->
                    <tr>
                        <th>No</th>
                        <th>Waktu Login</th>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                ajax: {
                    url: "{{ route('rekap.tindakan') }}"
                },
                columns: [{
                    data: "id",
                    name: "id"
                }, {
                    data: "created_at",
                    name: "created_at"
                }, {
                    data: "nama_pasien",
                    name: "nama_pasien"
                }, {
                    data: "umur",
                    name: "umur"
                }, {
                    data: "aksi",
                    name: "aksi"
                }, ],
                // columnDefs: [],
                order: [
                    [2, 'desc']
                ],
                // dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                // buttons: [{
                //         extend: 'collection',
                //         className: 'btn btn-label-primary dropdown-toggle me-2',
                //         text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                //         buttons: [{
                //                 extend: 'print',
                //                 text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                //                 className: 'dropdown-item',
                //                 exportOptions: {
                //                     columns: [2, 3, 4],
                //                     // prevent avatar to be display
                //                     format: {
                //                         body: function(inner, coldex, rowdex) {
                //                             if (inner.length <= 0) return inner;
                //                             var el = $.parseHTML(inner);
                //                             var result = '';
                //                             $.each(el, function(index, item) {
                //                                 if (item.classList !== undefined && item
                //                                     .classList.contains('user-name')) {
                //                                     result = result + item.lastChild
                //                                         .firstChild.textContent;
                //                                 } else if (item.innerText ===
                //                                     undefined) {
                //                                     result = result + item.textContent;
                //                                 } else result = result + item.innerText;
                //                             });
                //                             return result;
                //                         }
                //                     }
                //                 },
                //                 customize: function(win) {
                //                     //customize print view for dark
                //                     $(win.document.body)
                //                         .css('color', config.colors.headingColor)
                //                         .css('border-color', config.colors.borderColor)
                //                         .css('background-color', config.colors.bodyBg);
                //                     $(win.document.body)
                //                         .find('table')
                //                         .addClass('compact')
                //                         .css('color', 'inherit')
                //                         .css('border-color', 'inherit')
                //                         .css('background-color', 'inherit');
                //                 }
                //             },
                //             {
                //                 extend: 'csv',
                //                 text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                //                 className: 'dropdown-item',
                //                 exportOptions: {
                //                     columns: [3, 4, 5, 6, 7],
                //                     // prevent avatar to be display
                //                     format: {
                //                         body: function(inner, coldex, rowdex) {
                //                             if (inner.length <= 0) return inner;
                //                             var el = $.parseHTML(inner);
                //                             var result = '';
                //                             $.each(el, function(index, item) {
                //                                 if (item.classList !== undefined && item
                //                                     .classList.contains('user-name')) {
                //                                     result = result + item.lastChild
                //                                         .firstChild.textContent;
                //                                 } else if (item.innerText ===
                //                                     undefined) {
                //                                     result = result + item.textContent;
                //                                 } else result = result + item.innerText;
                //                             });
                //                             return result;
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 extend: 'excel',
                //                 text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                //                 className: 'dropdown-item',
                //                 exportOptions: {
                //                     columns: [3, 4, 5, 6, 7],
                //                     // prevent avatar to be display
                //                     format: {
                //                         body: function(inner, coldex, rowdex) {
                //                             if (inner.length <= 0) return inner;
                //                             var el = $.parseHTML(inner);
                //                             var result = '';
                //                             $.each(el, function(index, item) {
                //                                 if (item.classList !== undefined && item
                //                                     .classList.contains('user-name')) {
                //                                     result = result + item.lastChild
                //                                         .firstChild.textContent;
                //                                 } else if (item.innerText ===
                //                                     undefined) {
                //                                     result = result + item.textContent;
                //                                 } else result = result + item.innerText;
                //                             });
                //                             return result;
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 extend: 'pdf',
                //                 text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                //                 className: 'dropdown-item',
                //                 exportOptions: {
                //                     columns: [3, 4, 5, 6, 7],
                //                     // prevent avatar to be display
                //                     format: {
                //                         body: function(inner, coldex, rowdex) {
                //                             if (inner.length <= 0) return inner;
                //                             var el = $.parseHTML(inner);
                //                             var result = '';
                //                             $.each(el, function(index, item) {
                //                                 if (item.classList !== undefined && item
                //                                     .classList.contains('user-name')) {
                //                                     result = result + item.lastChild
                //                                         .firstChild.textContent;
                //                                 } else if (item.innerText ===
                //                                     undefined) {
                //                                     result = result + item.textContent;
                //                                 } else result = result + item.innerText;
                //                             });
                //                             return result;
                //                         }
                //                     }
                //                 }
                //             },
                //             {
                //                 extend: 'copy',
                //                 text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
                //                 className: 'dropdown-item',
                //                 exportOptions: {
                //                     columns: [3, 4, 5, 6, 7],
                //                     // prevent avatar to be display
                //                     format: {
                //                         body: function(inner, coldex, rowdex) {
                //                             if (inner.length <= 0) return inner;
                //                             var el = $.parseHTML(inner);
                //                             var result = '';
                //                             $.each(el, function(index, item) {
                //                                 if (item.classList !== undefined && item
                //                                     .classList.contains('user-name')) {
                //                                     result = result + item.lastChild
                //                                         .firstChild.textContent;
                //                                 } else if (item.innerText ===
                //                                     undefined) {
                //                                     result = result + item.textContent;
                //                                 } else result = result + item.innerText;
                //                             });
                //                             return result;
                //                         }
                //                     }
                //                 }
                //             }
                //         ]
                //     },
                //     {
                //         text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tindakan Baru</span>',
                //         className: 'create-new btn btn-primary me-2',
                //         action: function() {
                //             window.location.href = "{{ route('tindakan.create') }}";
                //         }
                //     },
                // ],
            });

            // $('div.head-label').html('<h5 class="card-title mb-0">Tindakan</h5>')
            // <th>No</th>
            //     <th>Waktu Login</th>
            //     <th>Nama</th>
            //     <th>Phone</th>
            //     <th>Aksi</th>
            // let table = new DataTable('#datatable');
        });
    </script>
@endpush
