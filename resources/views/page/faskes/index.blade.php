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
    <script>
        /* prettier-ignore */
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })({
            key: "",
            v: "weekly",
        }); /* prettier-ignore */
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&libraries=places,geometry&callback=initMap">
    </script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manage /</span> Fasilitas Kesehatan
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
                        <th>Jenis</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th>Telpon / Whatsapp</th>
                        <th>Website</th>
                        <th>Lokasi</th>
                        <th>Operasional</th>
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
            <form class="add-new-record pt-0 row g-3" id="form-faskes" onsubmit="return false">
                @csrf
                <input type="text" id="id" class="" name="id" />
                <div class="col-sm-12">
                    <label for="basicFullname">Nama Fasilitas :</label>
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
                            <select id="ref_jen_faskes_id" name="ref_jen_faskes_id" class="form-control">
                                <option value="">--</option>
                                @foreach ($dataContent['refFaskes'] as $rd)
                                    <option value="{{ $rd->id }}">{{ $rd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Alamat Fasilitas :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="alamat" class="form-control dt-full-name" name="alamat" placeholder=""
                            aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Deskripsi Fasilitas :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="description" class="form-control dt-full-name" name="description"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicFullname">Website :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="website" class="form-control dt-full-name" name="website"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
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
                    <label for="basicFullname">Whatsapp :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="mdi mdi-file"></i></span>
                        <input type="text" id="whatsapp" class="form-control dt-full-name" name="whatsapp"
                            placeholder="" aria-label="" aria-describedby="basicFullname2" />
                    </div>
                </div>
                <div class="row">
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
                    <div class="col-md-12 mt-2">
                        <hr>
                        {{-- <label for="basicFullname">Latitude :</label> --}}
                        <input type="text" id="search_maps" class="form-control"
                            placeholder="Cari lokasi disini, talu tekan enter / bisa mengklik langsung pada MAP" />
                        <div id="map" style="height:400px; width:100%; "></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="basicSalary">PIC :</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='mdi mdi-account-outline'></i></span>
                        <div class="form-floating form-floating-outline">
                            <!-- <input type="number" id="user_id" name="user_id" class="form-control dt-salary" aria-label="" aria-describedby="basicSalary2" /> -->
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

@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            // testJS();
            // let map;
            let map;
            let service;
            let infowindow;
            var markers = [];
            async function initMap() {
                const position = {
                    lat: -1.901627,
                    lng: 106.110315
                };
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                    center: position,
                    mapId: "PSC_FASKES",
                });
                const input = document.getElementById("search_maps");
                const searchBox = new google.maps.places.SearchBox(input);
                // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                infowindow = new google.maps.InfoWindow();
                markers = [];
                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });
                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();
                    if (places.length === 0) {
                        clearMarkers()
                        return;
                    }
                    clearMarkers()
                    const bounds = new google.maps.LatLngBounds();
                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }

                        const marker = new google.maps.Marker({
                            map,
                            title: place.name,
                            position: place.geometry.location,
                        });

                        marker.addListener("click", () => {
                            FaskesForm.long.val(place.geometry.location.lng())
                            FaskesForm.lat.val(place.geometry.location.lat())
                            infowindow.setContent(`
                                    <div>
                                        <strong>${place.name}</strong><br>
                                        ${place.formatted_address}<br>
                                        Coordinates: ${place.geometry.location.lat()}, ${place.geometry.location.lng()}
                                    </div>
                                `);
                            infowindow.open(map, marker);
                        });
                        markers.push(marker);
                        if (place.geometry.viewport) {
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }

                    });

                    map.fitBounds(bounds);
                });

                map.addListener("click", (event) => {
                    const clickedLocation = event.latLng;
                    FaskesForm.long.val(event.latLng.lng())
                    FaskesForm.lat.val(event.latLng.lat())
                    clearMarkers();
                    const marker = new google.maps.Marker({
                        position: clickedLocation,
                        map: map,
                        title: "Clicked Location"
                    });
                    markers.push(marker);
                    infowindow.setContent(`
                            <div>
                                Clicked Location<br>
                                Coordinates: ${clickedLocation.lat()}, ${clickedLocation.lng()}
                            </div>
                        `);
                    infowindow.open(map, marker);
                });

            }

            function clearMarkers() {
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers.length = 0; // Clear the markers array
            }


            initMap()

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
                        text: '<i class="mdi mdi-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Faskes</span>',
                        className: 'create-new btn btn-primary me-2'
                    },
                    {
                        text: '<i class="mdi mdi-eye me-sm-1"></i> <span class="d-none d-sm-inline-block">Sebaran</span>',
                        className: 'open-sebaran btn btn-primary me-2'
                    }
                ],

            });
            $('div.head-label').html('<h5 class="card-title mb-0">Data Faskes</h5>')

            var FaskesForm = {
                'form': $('#form-faskes'),
                'insertBtn': $('#form-faskes').find('#insertBtn'),
                'updateBtn': $('#form-faskes').find('#updateBtn'),
                'id': $('#form-faskes').find('#id'),
                'name': $('#form-faskes').find('#name'),
                'ref_jen_faskes_id': $('#form-faskes').find('#ref_jen_faskes_id'),
                'alamat': $('#form-faskes').find('#alamat'),
                'description': $('#form-faskes').find('#description'),
                'website': $('#form-faskes').find('#website'),
                'phone': $('#form-faskes').find('#phone'),
                'whatsapp': $('#form-faskes').find('#whatsapp'),
                'long': $('#form-faskes').find('#long'),
                'lat': $('#form-faskes').find('#lat'),
                'user_id': $('#form-faskes').find('#user_id'),
                'operasional_time': $('#form-faskes').find('#operasional_time'),
            }

            $('.open-sebaran').on('click',
                function() {
                    window.open("{{ route('faskes.sebaran') }}", "_blank");
                }
            )
            var dataFaskes = {}

            swalLoading();
            $.when(
                getAllFaskes(), ).then((e) => {
                Swal.close();
            }).fail((e) => {
                console.log(e)
            });

            function getAllFaskes() {
                return $.ajax({
                    url: `{{ route('faskes.get') }}`,
                    'type': 'get',
                    data: toolbar.form.serialize(),
                    success: function(data) {
                        console.log(data['data'])
                        Swal.close();
                        if (data['error']) {
                            return;
                        }
                        dataFaskes = data['data'];
                        renderFaskes(dataFaskes);
                    },
                    error: function(e) {}
                });
            }

            function renderFaskes(data) {
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
                    renderData.push([user['id'], button, user['name'], user['jen_faskes'] == null ? '' :
                        user['jen_faskes']['name'], user[
                            'alamat'],
                        user['description'], user['phone'] + ' / ' + user['whatsapp'], user[
                            'website'],
                        user['long'] + ', ' + user['lat'], user['operasional_time'],
                    ]);
                });
                FDataTable.clear().rows.add(renderData).draw('full-hold');
            }


            $('.create-new').on('click', function() {

                clearMarkers()
                FaskesForm.form.trigger('reset')
                var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                FaskesForm.user_id.append($newOption4).trigger('change');
                FaskesForm.updateBtn.attr('style', 'display: none !important');
                FaskesForm.insertBtn.attr('style', 'display: ""');
                offCanvasEl.show();
            })

            FDataTable.on('click', '.edit', function() {
                var currentData = dataFaskes[$(this).data('id')];
                clearMarkers()
                var edit_positition = {
                    lng: parseFloat(currentData['long']),
                    lat: parseFloat(currentData['lat']),
                }
                // const position = {
                //     lat: -1.901627,
                //     lng: 106.110315
                // };
                // -1.9241793, 106.1169299

                var marker = new google.maps.Marker({
                    map,
                    title: currentData['name'],
                    position: edit_positition,
                });

                markers.push(marker);
                FaskesForm.form.trigger('reset')
                var $newOption4 = $("<option selected='selected'></option>").val('').text("--");
                FaskesForm.user_id.append($newOption4).trigger('change');
                FaskesForm.insertBtn.attr('style', 'display: none !important');
                FaskesForm.updateBtn.attr('style', 'display: ""');
                offCanvasEl.show();

                FaskesForm.id.val(currentData['id']);
                FaskesForm.name.val(currentData['name']);
                FaskesForm.alamat.val(currentData['alamat']);
                FaskesForm.ref_jen_faskes_id.val(currentData['ref_jen_faskes_id']);
                FaskesForm.description.val(currentData['description']);
                FaskesForm.website.val(currentData['website']);
                FaskesForm.phone.val(currentData['phone']);
                FaskesForm.whatsapp.val(currentData['whatsapp']);
                FaskesForm.long.val(currentData['long']);
                FaskesForm.lat.val(currentData['lat']);
                FaskesForm.operasional_time.val(currentData['operasional_time']);

            });

            FaskesForm.insertBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('faskes.create') }}', 'POST');
            });
            FaskesForm.updateBtn.on('click', () => {
                event.preventDefault();
                submit_form('{{ route('faskes.update') }}', 'PUT');
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
                        data: FaskesForm.form.serialize(),
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Simpan Gagal !!");
                                return;
                            }
                            var user = data['data']
                            dataFaskes[user['id']] = user;
                            swalBerhasil();
                            offCanvasEl.hide();
                            renderFaskes(dataFaskes);
                            // FaskesForm.self.modal('hide');
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
                        url: "<?= route('faskes.delete') ?>/",
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
                            delete dataFaskes[id];
                            swalBerhasil('Data berhasil di Hapus');
                            renderFaskes(dataFaskes);
                        },
                        error: function(e) {}
                    });
                });
            });



        });
    </script>
@endpush
