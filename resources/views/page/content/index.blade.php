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
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>

@endsection

@section('page-script')
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manage /</span> Kontent Informasi
    </h4>
    @csrf
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="FDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record" style="width : 700px !important">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Form</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-3" id="form-content" onsubmit="return false">
                @csrf
                <input type="text" id="id" class="" name="id" />
                <div class="col-sm-12">
                    <label for="basicFullname">Judul:</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="judul" class="form-control dt-full-name" name="judul" placeholder=""
                            aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Isi :</label>
                    <textarea hidden id="content" name="content"></textarea>
                    <div id="quill" style="width: 100%">
                        <p></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="basicSalary">Jenis :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                            <div class="form-floating form-floating-outline">
                                <!-- <input type="number" id="user_id" name="user_id" class="form-control dt-salary" aria-label="" aria-describedby="basicSalary2" /> -->
                                <select id="ref_content_id" name="ref_content_id" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($dataContent['refContent'] as $rd)
                                        <option value="{{ $rd->id }}">{{ $rd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="basicFullname">Tanggal :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="date" id="tanggal" class="form-control dt-full-name" name="tanggal"
                                placeholder="" aria-label="" aria-describedby="basicFullname2" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="basicFullname">Gambar Sampul :</label>
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                            <input type="file" id="file_sampul" class="form-control dt-full-name" name="file_sampul"
                                accept="image/*" aria-label="" aria-describedby="basicFullname2" />
                        </div>
                    </div>
                    <div class="col-sm-6"></div>
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
            const fullToolbar = [
                [{
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                        color: []
                    },
                    {
                        background: []
                    }
                ],
                [{
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [{
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [{
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [{
                    direction: 'rtl'
                }],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ];
            const fullEditor = new Quill('#quill', {
                bounds: '#quill',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });

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
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Content</span>',
                        className: 'create-new btn btn-primary'
                    }
                ],
            });
            $('div.head-label').html('<h5 class="card-title mb-0">Data Content</h5>')

            var ContentForm = {
                'form': $('#form-content'),
                'insertBtn': $('#form-content').find('#insertBtn'),
                'updateBtn': $('#form-content').find('#updateBtn'),
                'id': $('#form-content').find('#id'),
                'judul': $('#form-content').find('#judul'),
                'content': $('#form-content').find('#content'),
                'ref_content_id': $('#form-content').find('#ref_content_id'),
                'tanggal': $('#form-content').find('#tanggal'),
                'file_sampul': $('#form-content').find('#file_sampul'),
            }

            var dataContent = {}

            swalLoading();
            $.when(
                getAllContent()).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });


            function getAllContent() {
                return $.ajax({
                    url: `{{ route('content.get') }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataContent = data['data'];
                        renderContent(dataContent);
                    },
                    error: function(e) {}
                });
            }

            function renderContent(data) {
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
                        `<a href="<?= url('content/') ?>/show/${user['slug']}" title="Lihat Detail" class="btn btn-sm btn-text-secondary rounded-pill btn-icon item-edit"><i class="mdi mdi-eye-outline" ></i></a>`;
                    renderData.push([user['id'], button, user['judul'], user['ref_content'] == null ? '' :
                        user['ref_content']['name'], user['tanggal'],
                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }


            $('.create-new').on('click', function() {
                ContentForm.form.trigger('reset')
                var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                ContentForm.updateBtn.attr('style', 'display: none !important');
                ContentForm.insertBtn.attr('style', 'display: ""');
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                ContentForm.form.trigger('reset')
                var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                ContentForm.insertBtn.attr('style', 'display: none !important');
                ContentForm.updateBtn.attr('style', 'display: ""');
                offCanvasEl.show();

                var currentData = dataContent[$(this).data('id')];
                ContentForm.id.val(currentData['id']);
                ContentForm.judul.val(currentData['judul']);
                ContentForm.tanggal.val(currentData['tanggal']);
                ContentForm.ref_content_id.val(currentData['ref_content_id']);
                ContentForm.content.val(currentData['content']);
                const delta = fullEditor.clipboard.convert(currentData['content'])
                fullEditor.setContents(delta, 'silent')

            });

            ContentForm.insertBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('content.create') }}', 'POST');
            });
            ContentForm.updateBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('content.update') }}', 'POST');
            });

            function submit_form(url, metode) {
                conten = fullEditor.root.innerHTML;
                console.log(conten);
                ContentForm.content.val(conten);
                Swal.fire(SwalOpt()).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    swalLoading();
                    $.ajax({
                        url: url,
                        'type': metode,
                        processData: false,
                        contentType: false,
                        data: new FormData(ContentForm.form[0]),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            var user = data['data']
                            dataContent[user['id']] = user;
                            swalBerhasil();
                            offCanvasEl.hide();
                            renderContent(dataContent);
                            // ContentForm.self.modal('hide');
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
                        url: "<?= route('content.delete') ?>/",
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
                            delete dataContent[id];
                            swalBerhasil('Data berhasil di Hapus');
                            renderContent(dataContent);
                        },
                        error: function(e) {}
                    });
                });
            });
        });
    </script>
@endsection
