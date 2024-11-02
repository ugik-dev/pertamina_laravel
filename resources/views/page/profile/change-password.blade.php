@extends('layouts/layoutMaster')

@section('title', 'Management User')

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
        <div class="card-body ">
            <form class="needs-validation add-new-record row g-3" id="form-user" novalidate>
                @csrf
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-4 col-form-label">Password Lama</label>
                        <div class="col-sm-8">
                            <input required type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="new_password" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input required type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label for="re_password" class="col-sm-4 col-form-label">Ulangi Password Baru</label>
                        <div class="col-sm-8">
                            <input required type="password" class="form-control" id="re_password" name="re_password">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="updateBtn"
                        data-act="upd">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var UserForm = {
                'form': $('#form-user'),
                'updateBtn': $('#form-user').find('#updateBtn'),
                'password': $('#form-user').find('#password'),
            }

            UserForm.updateBtn.on('click', function(ev) {
                ev.preventDefault();
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: `{{ route('profile.change-password-process') }}`,
                        'type': 'post',
                        data: UserForm.form.serialize(),
                        success: function(data) {
                            console.log(data['data'])
                            // Swal.close();
                            if (data['error']) {
                                swalError(data['message'])
                                return;
                            }
                            swalBerhasil("Password berhasil diganti")
                            UserForm.form.trigger("reset")
                        },
                        error: function(e) {}
                    });
                });
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
            // UserForm.form.on('submit', function(event) {
            //     event.preventDefault();
            //     if (!validasi_form(event)) {
            //         return
            //     };
            //     if (UserForm.insertBtn.is(":visible")) {
            //         url = '{{ route('agent.create') }}';
            //         metode = 'POST';
            //     } else {
            //         url = '{{ route('agent.update') }}';
            //         metode = 'PUT';
            //     }
            //     Swal.fire(SwalOpt()).then((result) => {
            //         if (!result.isConfirmed) {
            //             return;
            //         }
            //         swalLoading();
            //         $.ajax({
            //             url: url,
            //             'type': metode,
            //             data: UserForm.form.serialize(),
            //             success: function(data) {
            //                 if (data['error']) {
            //                     swalError(data['message'], "Simpan Gagal !!");
            //                     return;
            //                 }
            //                 var user = data['data']
            //                 dataUser[user['id']] = user;
            //                 swalBerhasil();
            //                 offCanvasEl.hide();
            //                 renderUser(dataUser);
            //                 // UserForm.self.modal('hide');
            //             },
            //             error: function(e) {}
            //         });
            //     });
            // });
        });
    </script>
@endpush
