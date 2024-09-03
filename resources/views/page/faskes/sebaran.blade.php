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
        <span class="text-muted fw-light">Home /</span> Sebaran Fasilitas Kesehatan
    </h4>
    @csrf
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div id="map" style="height:600px; width:100%; "></div>
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
            async function initMap(data) {
                const position = {
                    lat: -1.901627,
                    lng: 106.110315
                };

                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                    center: position,
                    mapId: "PSC_FASKES",
                });

                infowindow = new google.maps.InfoWindow();

                markers = [];

                clearMarkers()

                const bounds = new google.maps.LatLngBounds();

                Object.values(data).forEach((place) => {
                    console.log(place);
                    if (data == null || typeof data != "object") {
                        console.log("Place::UNKNOWN DATA");
                        return;
                    }

                    // const icon = {
                    //     size: new google.maps.Size(71, 71),
                    //     origin: new google.maps.Point(0, 0),
                    //     anchor: new google.maps.Point(17, 34),
                    //     scaledSize: new google.maps.Size(25, 25),
                    // };

                    const marker = new google.maps.Marker({
                        map,
                        title: place['name'],
                        position: {
                            lat: parseFloat(place['lat']),
                            lng: parseFloat(place['long'])
                        },
                    });

                    marker.addListener("click", () => {

                        infowindow.setContent(`
                                    <div>
                                        <strong>${place['name']}</strong><br>
                                        ${place['alamat']}<br>
                                        Coordinates: ${parseFloat(place['lat'])}, ${parseFloat(place['long'])}
                                    </div>
                                `);
                        infowindow.open(map, marker);
                    });

                    markers.push(marker);
                });

                // map.fitBounds(bounds);
            }

            function clearMarkers() {
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers.length = 0; // Clear the markers array
            }



            var toolbar = {
                'form': $('#toolbar_form'),
                'id_role': $('#toolbar_form').find('#id_role'),
                'id_opd': $('#toolbar_form').find('#id_opd'),
                'newBtn': $('#new_btn'),
            }


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
                        initMap(dataFaskes)

                    },
                    error: function(e) {}
                });
            }
        });
    </script>
@endpush
