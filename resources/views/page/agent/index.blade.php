@extends('layouts/layoutMaster')

@section('title', 'Manage Agent')

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
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to

        })()
    </script>
    {{-- <script src="{{ asset('assets/js/form-validation.js') }}"></script> --}}
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manage /</span> User
    </h4>
    @csrf
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="padat">No</th>
                        <th wlass="padat">Aksi</th>
                        <th>Nama</th>
                        <th>Unit</th>
                        <th>Bidang Kerja</th>
                        <th>Role</th>
                        <th>Telpon</th>
                        <th>Email</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form Fasilitas Kesehatan</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="needs-validation add-new-record pt-0 row g-3" id="form-user" novalidate>
                @csrf
                <input type="text" id="id" hidden name="id" />
                <div class="col-sm-12">
                    <label for="basicFullname">Nama :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="name" class="form-control dt-full-name" name="name" placeholder=""
                            aria-label="" aria-describedby="basicFullname2" required />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicSalary">Unit :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <select id="unit_id" name="unit_id" class="form-control" required>
                                <option value="">--</option>
                                @foreach ($dataContent['refUnit'] as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicSalary">Bidang Kerja :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <select id="field_work_id" name="field_work_id" class="form-control" required>
                                <option value="">--</option>
                                @foreach ($dataContent['refField'] as $field)
                                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Alamat :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="alamat" class="form-control dt-full-name" name="alamat" placeholder=""
                            aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Telepon :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="phone" class="form-control dt-full-name" name="phone"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Email :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="email" class="form-control dt-full-name" name="email"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">QRCode :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="qrcode" class="form-control dt-full-name" name="qrcode"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" required readonly />
                    </div>
                </div>
                <div class="col-sm-12 row mt-2 mb-2">
                    <div class="col-sm-4"> <a class="btn btn-info text-white" id="create_qr">Scan QR</a></div>
                    <div class="col-sm-7">
                        <div id="reader" class="mr-3 ml-3 w-80" style="margin:0 auto;"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicSalary">Role :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <select id="role_id" name="role_id" class="form-control" required>
                                <option value="">--</option>
                                @foreach ($dataContent['refRole'] as $rd)
                                    <option value="{{ $rd->id }}">{{ $rd->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Username :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="username" class="form-control dt-full-name" pattern="[a-z0-9]+"
                            name="username" placeholder="" aria-label="" aria-describedby="basicFullname2" required />
                        <div class="invalid-feedback">
                            Masukkan username hanya menggunakan huruf kecil dan angka, tanpa spasi dan karakter spesial
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="basicFullname">Password <small id="span_cp">*kosongkan jika tidak
                            diganti</small>:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="password" id="password" class="form-control" name="password" placeholder=""
                            required />
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="insertBtn"
                        data-metod="ins">Tambah</button>
                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="updateBtn"
                        data-act="upd">Simpan Perubahan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

            var html5QrcodeScanner = false;
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
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah User</span>',
                        className: 'create-new btn btn-primary me-2'
                    },
                ],

            });
            $('div.head-label').html('<h5 class="card-title mb-0">Data Agent</h5>')

            var UserForm = {
                'form': $('#form-user'),
                'insertBtn': $('#form-user').find('#insertBtn'),
                'updateBtn': $('#form-user').find('#updateBtn'),
                'id': $('#form-user').find('#id'),
                'name': $('#form-user').find('#name'),
                'role_id': $('#form-user').find('#role_id'),
                'unit_id': $('#form-user').find('#unit_id'),
                'field_work_id': $('#form-user').find('#field_work_id'),
                'alamat': $('#form-user').find('#alamat'),
                'password': $('#form-user').find('#password'),
                'span_cp': $('#form-user').find('#span_cp'),
                'phone': $('#form-user').find('#phone'),
                'email': $('#form-user').find('#email'),
                'long': $('#form-user').find('#long'),
                'lat': $('#form-user').find('#lat'),
                'username': $('#form-user').find('#username'),
                'create_qr': $('#form-user').find('#create_qr'),
                'qrcode': $('#form-user').find('#qrcode'),
            }

            UserForm.role_id.on("change", function() {
                if (UserForm.role_id.val() == 5) {
                    console.log("disable pass")
                    UserForm.password.prop('required', false);
                    UserForm.password.prop('disabled', true);
                    UserForm.username.prop('required', false);
                    UserForm.username.prop('disabled', true);
                } else {
                    UserForm.password.prop('required', true);
                    UserForm.password.prop('disabled', false);
                    UserForm.username.prop('required', true);
                    UserForm.username.prop('disabled', false);
                }
            })

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);
                console.log(decodedText)
                UserForm.qrcode.val(decodedText)
                console.log("try destroy");
                html5QrcodeScanner.clear().then(() => {
                    console.error("Success to clear QR code scanner");
                }).catch(error => {
                    console.error("Failed to clear QR code scanner:", error);
                });

                // scanProcess(decodedText)
            }
            // scanProcess('d3286f12-a0ab-45a7-aba9-11b7e15f4723')

            function scanProcess(decodedResult) {
                // swalLoading();
                // UserForm.qrcode.val(decodedResult)


            }

            function onScanFailure(error) {

            }


            UserForm.create_qr.on("click", function() {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    /* verbose= */
                    false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            })



            var dataUser = {}

            swalLoading();
            $.when(
                getAllUser(), ).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });

            function getAllUser() {
                return $.ajax({
                    url: `{{ route('agent.get') }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataUser = data['data'];
                        renderUser(dataUser);
                    },
                    error: function(e) {}
                });
            }

            function renderUser(data) {
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
                        `<a href="<?= url('info-desa/sub-wilayah') ?>/${user['id']}" title="Lihat Detail" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i></a>`;
                    renderData.push([user['id'], button, user['name'],
                        user['unit']['name'], user['field_work'] != null ? user['field_work'][
                            'name'
                        ] : "", user['role_title'],
                        user['phone'], user['email'],

                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }

            $('.create-new').on('click', function() {
                UserForm.form.trigger('reset')
                // var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                // UserForm.user_id.append($newOption4).trigger('change');
                UserForm.updateBtn.attr('style', 'display: none !important');
                UserForm.span_cp.hide();
                UserForm.insertBtn.attr('style', 'display: ""');
                UserForm.password.prop('required', true);
                UserForm.role_id.trigger('change');
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                var currentData = dataUser[$(this).data('id')];
                UserForm.form.trigger('reset')
                UserForm.insertBtn.attr('style', 'display: none !important');
                UserForm.updateBtn.attr('style', 'display: ""');
                UserForm.password.prop('required', false);
                offCanvasEl.show();
                UserForm.span_cp.show();
                UserForm.id.val(currentData['id']);
                UserForm.name.val(currentData['name']);
                UserForm.alamat.val(currentData['alamat']);
                UserForm.unit_id.val(currentData['unit_id']).trigger("change");
                UserForm.field_work_id.val(currentData['field_work_id']).trigger("change");
                UserForm.qrcode.val(currentData['qrcode']);
                UserForm.role_id.val(currentData['role_id']);
                UserForm.email.val(currentData['email']);
                UserForm.username.val(currentData['username']);
                UserForm.phone.val(currentData['phone']);
                UserForm.role_id.trigger('change');
            });

            var userForm = document.getElementById('form-user');


            function validasi_form(event) {
                if (!userForm.checkValidity()) {
                    console.log(' not acc')
                    validation_form = false;
                    event.preventDefault();
                    event.stopPropagation();
                    userForm.classList.add('was-validated');
                    return false;
                } else {
                    userForm.classList.add('was-validated');
                    return true;
                }
            }
            UserForm.form.on('submit', function(event) {
                event.preventDefault();
                if (!validasi_form(event)) {
                    return
                };
                if (UserForm.insertBtn.is(":visible")) {
                    url = '{{ route('agent.create') }}';
                    metode = 'POST';
                } else {
                    url = '{{ route('agent.update') }}';
                    metode = 'PUT';
                }
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: url,
                        'type': metode,
                        data: UserForm.form.serialize(),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            var user = data['data']
                            dataUser[user['id']] = user;
                            swalBerhasil();
                            offCanvasEl.hide();
                            renderUser(dataUser);
                            // UserForm.self.modal('hide');
                        },
                        error: function(e) {}
                    });
                });
            });

            FDataTable.on('click', '.delete', function() {
                event.preventDefault();
                var id = $(this).data('id');
                var token = $("[name='_token']").val();
                Swal.fire(SwalOpt('Konfirmasi hapus ?', 'Data ini akan dihapus!', )).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    $.ajax({
                        url: "<?= route('agent.delete') ?>/",
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
                            delete dataUser[id];
                            swalBerhasil('Data berhasil di Hapus');
                            renderUser(dataUser);
                        },
                        error: function(e) {}
                    });
                });
            });

        });
    </script>
@endpush
