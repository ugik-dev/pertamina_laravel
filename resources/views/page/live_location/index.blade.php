@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <!-- <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" /> -->
@endsection

@section('vendor-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manage /</span> Live Location
    </h4>
    @csrf
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable">
            <table id="FDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="padat">No</th>
                        <th wlass="padat">Aksi</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Nomor Polisi</th>
                        <th>Key</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form Live Location</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3" id="form-live_location" onsubmit="return false">
                @csrf
                <input type="text" id="id" class="" name="id" />
                <div class="col-sm-12">
                    <label for="basicFullname">Nama / Label :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="name" class="form-control dt-full-name" name="name" placeholder=""
                            aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicSalary">Jenis :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <!-- <input type="number" id="user_id" name="user_id" class="form-control dt-salary" aria-label="" aria-describedby="basicSalary2" /> -->
                            <select id="ref_live_location_id" name="ref_live_location_id" class="form-control">
                                <option value="">--</option>
                                @foreach ($dataContent['refLiveLocation'] as $rd)
                                    <option value="{{ $rd->id }}">{{ $rd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="basicFullname">Deskripsi :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="description" class="form-control dt-full-name" name="description"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">ID Login :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" required minlength="6" maxlength="8" id="id_login"
                            class="form-control dt-full-name" name="id_login" placeholder="" aria-label=""
                            aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Key Login :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" required minlength="6" maxlength="8" id="key_login"
                            class="form-control dt-full-name" name="key_login" placeholder="" aria-label=""
                            aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Nomor Polisi :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="police_number" class="form-control dt-full-name" name="police_number"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-6">
                        <label for="basicFullname">Longitute :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="text" id="long" class="form-control dt-full-name" name="long"
                                placeholder="" aria-label="" aria-describedby="basicFullname2" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="basicFullname">Latitude :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="text" id="lat" class="form-control dt-full-name" name="lat"
                                placeholder="" aria-label="" aria-describedby="basicFullname2" />
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-12">
                    <label for="basicSalary">PIC :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <select id="user_id" name="user_id" class="form-control select-nama-kadus">
                            </select>
                        </div>
                    </div>
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





    <script>
        $(document).ready(function() {
            // testJS();
            var toolbar = {
                'form': $('#toolbar_form'),
                'id_role': $('#toolbar_form').find('#id_role'),
                'id_opd': $('#toolbar_form').find('#id_opd'),
                'newBtn': $('#new_btn'),
            }

            const offCanvasEl = new bootstrap.Offcanvas($('#add-new-record'));

            var FDataTable = $('#FDataTable').DataTable({
                columnDefs: [],
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
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah </span>',
                        className: 'create-new btn btn-primary'
                    }
                ],

            });
            $('div.head-label').html('<h5 class="card-title mb-0">Data</h5>')

            var LiveLocationForm = {
                'form': $('#form-live_location'),
                'insertBtn': $('#form-live_location').find('#insertBtn'),
                'updateBtn': $('#form-live_location').find('#updateBtn'),
                'id': $('#form-live_location').find('#id'),
                'name': $('#form-live_location').find('#name'),
                'ref_live_location_id': $('#form-live_location').find('#ref_live_location_id'),
                'description': $('#form-live_location').find('#description'),
                'id_login': $('#form-live_location').find('#id_login'),
                'key_login': $('#form-live_location').find('#key_login'),
                'police_number': $('#form-live_location').find('#police_number'),
                'whatsapp': $('#form-live_location').find('#whatsapp'),
                'user_id': $('#form-live_location').find('#user_id'),
            }

            var dataLiveLocation = {}

            swalLoading();
            $.when(
                getAllLiveLocation()).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });


            // $("#user_id").select2({
            //     dropdownParent: $('#add-new-record'),
            //     ajax: {
            //         url: '<?= url('search/penduduk') ?>',
            //         type: "get",
            //         dataType: 'json',
            //         delay: 250,
            //         data: function(params) {
            //             return {
            //                 searchTerm: params.term // search term
            //             };
            //         },
            //         processResults: function(response) {
            //             return {
            //                 results: response
            //             };
            //         },
            //         cache: true
            //     }
            // });

            function getAllLiveLocation() {
                return $.ajax({
                    url: `{{ route('live-location.get') }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataLiveLocation = data['data'];
                        renderLiveLocation(dataLiveLocation);
                    },
                    error: function(e) {}
                });
            }

            function renderLiveLocation(data) {
                console.log(data)
                if (data == null || typeof data != "object") {
                    console.log("User::UNKNOWN DATA");
                    return;
                }
                var i = 0;

                var renderData = [];
                Object.values(data).forEach((user) => {
                    var button =
                        '<div class="d-inline-block">' +
                        '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                        `<li><a class="edit dropdown-item" data-id="${user['id']}" ><i class="mdi mdi-pencil-outline"></i> Edit </a></li>` +
                        `<li><a class="delete dropdown-item text-danger" data-id="${user['id']}" ><i class="mdi mdi-trash-can-outline"></i> Hapus </a></li>` +
                        '</ul>' +
                        '</div>' +
                        `<a href="<?= url('manage-live-location/monitoring') ?>/${user['id']}" title="Lihat Detail" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i></a>`;
                    renderData.push([user['id'], button, user['name'], user['ref_live_location'] == null ?
                        '' :
                        user['ref_live_location']['name'],
                        user['description'], user['police_number'],
                        user['id_login'] + '/' + user['key_login'], user['long'] + ', ' + user[
                            'lat'],
                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }


            $('.create-new').on('click', function() {
                LiveLocationForm.form.trigger('reset')
                LiveLocationForm.updateBtn.attr('style', 'display: none !important');
                LiveLocationForm.insertBtn.attr('style', 'display: ""');
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                LiveLocationForm.form.trigger('reset')
                var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                LiveLocationForm.user_id.append($newOption4).trigger('change');
                LiveLocationForm.insertBtn.attr('style', 'display: none !important');
                LiveLocationForm.updateBtn.attr('style', 'display: ""');
                offCanvasEl.show();

                var currentData = dataLiveLocation[$(this).data('id')];
                LiveLocationForm.id.val(currentData['id']);
                LiveLocationForm.name.val(currentData['name']);
                LiveLocationForm.ref_live_location_id.val(currentData['ref_live_location_id']);
                LiveLocationForm.description.val(currentData['description']);
                LiveLocationForm.id_login.val(currentData['id_login']);
                LiveLocationForm.key_login.val(currentData['key_login']);
                LiveLocationForm.police_number.val(currentData['police_number']);
                LiveLocationForm.whatsapp.val(currentData['whatsapp']);
            });

            LiveLocationForm.insertBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('live-location.create') }}', 'POST');
            });
            LiveLocationForm.updateBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('live-location.update') }}', 'PUT');
            });

            function submit_form(url, metode) {
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: url,
                        'type': metode,
                        data: LiveLocationForm.form.serialize(),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            var user = data['data']
                            dataLiveLocation[user['id']] = user;
                            swalBerhasil();
                            offCanvasEl.hide();
                            renderLiveLocation(dataLiveLocation);
                            // LiveLocationForm.self.modal('hide');
                        },
                        error: function(e) {}
                    });
                });
            };

            FDataTable.on('click', '.delete', function() {
                event.preventDefault();
                var id = $(this).data('id');
                var token = $("[name='_token']").val();
                Swal.fire(SwalOpt('Konfirmasi hapus ?', 'Data ini akan dihapus!', )).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    $.ajax({
                        url: "<?= route('live-location.delete') ?>/",
                        'type': 'DELETE',
                        data: {
                            '_token': token,
                            'id': id
                        },
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            delete dataLiveLocation[id];
                            swalBerhasil('Data berhasil di Hapus');
                            renderLiveLocation(dataLiveLocation);
                        },
                        error: function(e) {}
                    });
                });
            });


        });
    </script>
@endsection
