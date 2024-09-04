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
        <span class="text-muted fw-light">Manage /</span> Agent
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
                        <th>Role</th>
                        <th>QRCode</th>
                        <th>Deskripsi</th>
                        <th>Telpon / Email</th>
                        <th>Website</th>
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
                <div class="col-12 mb-4">
                    <small class="text-light fw-medium mt-2">Basic</small>
                    <div class="bs-stepper wizard-modern wizard-modern-example mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#account-details-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">01</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Account Details</span>
                                            <span class="bs-stepper-subtitle">Setup Account Details</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#personal-info-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">02</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Personal Info</span>
                                            <span class="bs-stepper-subtitle">Add personal info</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#social-links-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">03</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Social Links</span>
                                            <span class="bs-stepper-subtitle">Add social links</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form onSubmit="return false">
                                <!-- Account Details -->
                                <div id="account-details-modern" class="content">
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Account Details</h6>
                                        <small>Enter Your Account Details.</small>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="username-modern" class="form-control"
                                                    placeholder="johndoe" />
                                                <label for="username-modern">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="email" id="email-modern" class="form-control"
                                                    placeholder="john.doe@email.com" aria-label="john.doe" />
                                                <label for="email-modern">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-password-toggle">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="password" id="password-modern" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="password2-modern" />
                                                    <label for="password-modern">Password</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer" id="password2-modern"><i
                                                        class="mdi mdi-eye-off-outline"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-password-toggle">
                                            <div class="input-group input-group-merge">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="password" id="confirm-password-modern"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="confirm-password-modern2" />
                                                    <label for="confirm-password-modern">Confirm Password</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer"
                                                    id="confirm-password-modern2"><i
                                                        class="mdi mdi-eye-off-outline"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-outline-secondary btn-prev" disabled> <i
                                                    class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-next"> <span
                                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                                    class="mdi mdi-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Personal Info -->
                                <div id="personal-info-modern" class="content">
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Personal Info</h6>
                                        <small>Enter Your Personal Info.</small>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="first-name-modern" class="form-control"
                                                    placeholder="John" />
                                                <label for="first-name-modern">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="last-name-modern" class="form-control"
                                                    placeholder="Doe" />
                                                <label for="last-name-modern">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2" id="country-modern">
                                                    <option label=" "></option>
                                                    <option>UK</option>
                                                    <option>USA</option>
                                                    <option>Spain</option>
                                                    <option>France</option>
                                                    <option>Italy</option>
                                                    <option>Australia</option>
                                                </select>
                                                <label for="country-modern">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <select class="selectpicker w-auto" id="language-modern"
                                                    data-style="btn-transparent" data-icon-base="mdi"
                                                    data-tick-icon="mdi-check text-white" multiple>
                                                    <option>English</option>
                                                    <option>French</option>
                                                    <option>Spanish</option>
                                                </select>
                                                <label for="language-modern">Language</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-outline-secondary btn-prev"> <i
                                                    class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-next"> <span
                                                    class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                                    class="mdi mdi-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Social Links -->
                                <div id="social-links-modern" class="content">
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Social Links</h6>
                                        <small>Enter Your Social Links.</small>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="twitter-modern" class="form-control"
                                                    placeholder="https://twitter.com/abc" />
                                                <label for="twitter-modern">Twitter</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="facebook-modern" class="form-control"
                                                    placeholder="https://facebook.com/abc" />
                                                <label for="facebook-modern">Facebook</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="google-modern" class="form-control"
                                                    placeholder="https://plus.google.com/abc" />
                                                <label for="google-modern">Google+</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="linkedin-modern" class="form-control"
                                                    placeholder="https://linkedin.com/abc" />
                                                <label for="linkedin-modern">LinkedIn</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-outline-secondary btn-prev"> <i
                                                    class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-primary btn-submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection



@push('scripts')
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
                'alamat': $('#form-user').find('#alamat'),
                'password': $('#form-user').find('#password'),
                'span_cp': $('#form-user').find('#span_cp'),
                'phone': $('#form-user').find('#phone'),
                'email': $('#form-user').find('#email'),
                'long': $('#form-user').find('#long'),
                'lat': $('#form-user').find('#lat'),
                'username': $('#form-user').find('#username'),
            }

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
                    renderData.push([user['id'], button, user['name'], user['role_title'], user['qrcode'],
                        user['phone'], user['email'],
                        (user['long'] ? user['long'] + ', ' + user['lat'] : ''),
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
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                var currentData = dataUser[$(this).data('id')];

                UserForm.form.trigger('reset')
                // var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                // UserForm.user_id.append($newOption4).trigger('change');
                UserForm.insertBtn.attr('style', 'display: none !important');
                UserForm.updateBtn.attr('style', 'display: ""');
                UserForm.password.prop('required', false);
                offCanvasEl.show();
                UserForm.span_cp.show();
                UserForm.id.val(currentData['id']);
                UserForm.name.val(currentData['name']);
                UserForm.alamat.val(currentData['alamat']);
                UserForm.role_id.val(currentData['role_id']);
                UserForm.email.val(currentData['email']);
                UserForm.username.val(currentData['username']);
                UserForm.phone.val(currentData['phone']);
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
