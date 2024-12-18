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

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manage /</span> Kategori Kerja
    </h4>
    @csrf
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="padat">No</th>
                        <th class="padat">Aksi</th>
                        <th>Kode OSS</th>
                        <th>Kelas</th>
                        <th>Sub Kelas</th>
                        <th>Nama Obat</th>
                        <th>Pabrik</th>
                        <th>PBF</th>
                        <th>Zat Aktif Utama</th>
                        <th>Zat Aktif Lain</th>
                        <th>Sediaan</th>
                        <th>Isi Per Kemasan</th>
                        <th>Dosis</th>
                        <th>HNA Per Kemasan</th>
                        <th>HNA Satuan</th>
                        <th>Diskon</th>
                        <th>Harga Beli Satuan</th>
                        <th>Harga Beli Kemasan</th>
                        <th>Golongan</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form Kategori Kerja</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3" id="form-field" onsubmit="return false">
                @csrf
                <input type="text" id="id" class="" name="id" hidden />

                <div class="col-sm-12">
                    <label for="kodeOss">Kode OSS:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="kodeOss" class="form-control" name="kode_oss" placeholder="Kode OSS" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="kelas">Kelas:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="kelas" class="form-control" name="kelas" placeholder="Kelas" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="subKelas">Sub Kelas:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="subKelas" class="form-control" name="sub_kelas"
                            placeholder="Sub Kelas" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="namaObat">Nama Obat:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="namaObat" class="form-control" name="nama_obat"
                            placeholder="Nama Obat" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="pabrik">Pabrik:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-factory"></i></span>
                        <input type="text" id="pabrik" class="form-control" name="pabrik" placeholder="Pabrik" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="pbf">PBF:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-truck"></i></span>
                        <input type="text" id="pbf" class="form-control" name="pbf" placeholder="PBF" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="zatAktifUtama">Zat Aktif Utama:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-flask"></i></span>
                        <input type="text" id="zatAktifUtama" class="form-control" name="zat_aktif_utama"
                            placeholder="Zat Aktif Utama" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="zatAktifLain">Zat Aktif Lain:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-flask"></i></span>
                        <input type="text" id="zatAktifLain" class="form-control" name="zat_aktif_lain"
                            placeholder="Zat Aktif Lain (Optional)" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="sediaan">Sediaan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-pill"></i></span>
                        <input type="text" id="sediaan" class="form-control" name="sediaan"
                            placeholder="Sediaan" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="isiPerkemasan">Isi Per Kemasan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-package-variant"></i></span>
                        <input type="number" id="isiPerkemasan" class="form-control" name="isi_perkemasan"
                            placeholder="Isi Per Kemasan" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="dosis">Dosis:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-syringe"></i></span>
                        <input type="text" id="dosis" class="form-control" name="dosis" placeholder="Dosis" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="hnaPerKemasan">HNA Per Kemasan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                        <input type="number" id="hnaPerKemasan" class="form-control" name="hna_per_kemasan"
                            placeholder="HNA Per Kemasan" step="0.01" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="hnaSatuan">HNA/Satuan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                        <input type="number" id="hnaSatuan" class="form-control" name="hna_satuan"
                            placeholder="HNA/Satuan" step="0.01" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="disc">Diskon:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-percent"></i></span>
                        <input type="number" id="disc" class="form-control" name="disc" placeholder="Diskon"
                            step="0.01" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="hargaBeliSatuan">Harga Beli/Satuan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                        <input type="number" id="hargaBeliSatuan" class="form-control" name="harga_beli_satuan"
                            placeholder="Harga Beli/Satuan" step="0.01" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="hargaBeliKemasan">Harga Beli/Kemasan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                        <input type="number" id="hargaBeliKemasan" class="form-control" name="harga_beli_kemasan"
                            placeholder="Harga Beli/Kemasan" step="0.01" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="golongan">Golongan:</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="mdi mdi-label"></i></span>
                        <input type="text" id="golongan" class="form-control" name="golongan"
                            placeholder="Golongan" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <a class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="insertBtn"
                        data-metod="ins">Tambah</a>
                    <a class="btn btn-primary data-submit me-sm-3 me-1 text-white" id="updateBtn" data-act="upd">Simpan
                        Perubahan</a>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
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
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Obat</span>',
                        className: 'create-new btn btn-primary me-2'
                    },
                ],

            });
            $('div.head-label').html('<h5 class="card-title mb-0">Data Obat</h5>')

            var FieldForm = {
                'form': $('#form-field'),
                'insertBtn': $('#form-field').find('#insertBtn'),
                'updateBtn': $('#form-field').find('#updateBtn'),
                'id': $('#form-field').find('#id'),
                'kode_oss': $('#form-field').find('#kodeOss'),
                'kelas': $('#form-field').find('#kelas'),
                'sub_kelas': $('#form-field').find('#subKelas'),
                'nama_obat': $('#form-field').find('#namaObat'),
                'pabrik': $('#form-field').find('#pabrik'),
                'pbf': $('#form-field').find('#pbf'),
                'zat_aktif_utama': $('#form-field').find('#zatAktifUtama'),
                'zat_aktif_lain': $('#form-field').find('#zatAktifLain'),
                'sediaan': $('#form-field').find('#sediaan'),
                'isi_perkemasan': $('#form-field').find('#isiPerkemasan'),
                'dosis': $('#form-field').find('#dosis'),
                'hna_per_kemasan': $('#form-field').find('#hnaPerKemasan'),
                'hna_satuan': $('#form-field').find('#hnaSatuan'),
                'disc': $('#form-field').find('#disc'),
                'harga_beli_satuan': $('#form-field').find('#hargaBeliSatuan'),
                'harga_beli_kemasan': $('#form-field').find('#hargaBeliKemasan'),
                'golongan': $('#form-field').find('#golongan')
            }

            var dataField = {}

            swalLoading();
            $.when(
                getAllField(), ).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });

            function getAllField() {
                return $.ajax({
                    url: `{{ route('drug.get') }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataField = data['data'];
                        renderField(dataField);
                    },
                    error: function(e) {}
                });
            }

            function renderField(data) {
                console.log(data)
                if (data == null || typeof data != "object") {
                    console.log("User::UNKNOWN DATA");
                    return;
                }
                var i = 0;

                var renderData = [];
                Object.values(data).forEach((obat) => {
                    var button =
                        '<div class="d-inline-block">' +
                        '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                        `<li><a class="edit dropdown-item" data-id="${obat['id']}" ><i class="mdi mdi-pencil-outline"></i> Edit </a></li>` +
                        `<li><a class="delete dropdown-item text-danger" data-id="${obat['id']}" ><i class="mdi mdi-trash-can-outline"></i> Hapus </a></li>` +
                        '</ul>' +
                        '</div>';
                    renderData.push([
                        obat['id'],
                        button,
                        obat['kode_oss'],
                        obat['kelas'],
                        obat['sub_kelas'],
                        obat['nama_obat'],
                        obat['pabrik'],
                        obat['pbf'],
                        obat['zat_aktif_utama'],
                        obat['zat_aktif_lain'] || '', // optional field with fallback
                        obat['sediaan'],
                        obat['isi_perkemasan'],
                        obat['dosis'],
                        obat['hna_per_kemasan'],
                        obat['hna_satuan'],
                        obat['disc'],
                        obat['harga_beli_satuan'],
                        obat['harga_beli_kemasan'],
                        obat['golongan']
                    ]);

                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }


            $('.create-new').on('click', function() {
                FieldForm.form.trigger('reset')
                FieldForm.updateBtn.attr('style', 'display: none !important');
                FieldForm.insertBtn.attr('style', 'display: ""');
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                var currentData = dataField[$(this).data('id')];
                FieldForm.form.trigger('reset')
                FieldForm.insertBtn.attr('style', 'display: none !important');
                FieldForm.updateBtn.attr('style', 'display: ""');
                offCanvasEl.show();
                console.log(currentData)
                // Assigning values to each form field
                FieldForm.id.val(currentData['id']);
                FieldForm.kode_oss.val(currentData['kode_oss']);
                FieldForm.kelas.val(currentData['kelas']);
                FieldForm.sub_kelas.val(currentData['sub_kelas']);
                FieldForm.nama_obat.val(currentData['nama_obat']);
                FieldForm.pabrik.val(currentData['pabrik']);
                FieldForm.pbf.val(currentData['pbf']);
                FieldForm.zat_aktif_utama.val(currentData['zat_aktif_utama']);
                FieldForm.zat_aktif_lain.val(currentData['zat_aktif_lain']);
                FieldForm.sediaan.val(currentData['sediaan']);
                FieldForm.isi_perkemasan.val(currentData['isi_perkemasan']);
                FieldForm.dosis.val(currentData['dosis']);
                FieldForm.hna_per_kemasan.val(currentData['hna_per_kemasan']);
                FieldForm.hna_satuan.val(currentData['hna_satuan']);
                FieldForm.disc.val(currentData['disc']);
                FieldForm.harga_beli_satuan.val(currentData['harga_beli_satuan']);
                FieldForm.harga_beli_kemasan.val(currentData['harga_beli_kemasan']);
                FieldForm.golongan.val(currentData['golongan']);
                console.log(FieldForm.satuan)
            });

            FieldForm.insertBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('drug.create') }}', 'POST');
            });
            FieldForm.updateBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('drug.update') }}', 'PUT');
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
                        data: FieldForm.form.serialize(),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            var user = data['data']
                            dataField[user['id']] = user;
                            swalBerhasil();
                            offCanvasEl.hide();
                            renderField(dataField);
                            // FieldForm.self.modal('hide');
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
                        url: "<?= route('drug.delete') ?>/",
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
                            delete dataField[id];
                            swalBerhasil('Data berhasil di Hapus');
                            renderField(dataField);
                        },
                        error: function(e) {}
                    });
                });
            });



        });
    </script>
@endpush
