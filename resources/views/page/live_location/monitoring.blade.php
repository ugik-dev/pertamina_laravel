{{-- @extends('layouts/layoutMaster')

@section('title', 'eCommerce Order Details - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-ecommerce-order-details.js') }}"></script>
    <script src="{{ asset('assets/js/modal-add-new-address.js') }}"></script>
    <script src="{{ asset('assets/js/modal-edit-user.js') }}"></script>
@endsection

@section('content')




    <!-- Order Details Table -->



    <!-- Modals -->
    @include('_partials/_modals/modal-edit-user')
    @include('_partials/_modals/modal-add-new-address')


@endsection --}}



@extends('layouts/layoutMaster')

@section('title', 'Live Location - Monitoring')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
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
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=geometry&callback=initMap">
    </script>
    {{-- <script>
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
        })
        ({
            key: "{{ env('GOOGLE_MAPS_API_KEY') }}",
            v: "weekly"
        });
    </script> --}}

@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Live Location /</span>
        {{ $dataContent->name }}
    </h4>
    <div class="col-12 col-lg-12">
        {{-- <div class="card mb-4">
            <div class="card-body">

            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Maps</h5>
                    </div>
                    <div class="card-datatable table-responsive">
                        <div id="map" style="height:400px; width:100%; "></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-4"></h6>
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <div class="avatar me-2 pe-1">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{ url('app/user/view/account') }}">
                                    <h6 class="mb-1">{{ $dataContent->name }}</h6>
                                </a>
                                <small>Nomor Polisi : {{ $dataContent->police_number }}</small>
                            </div>
                        </div>

                        <div class="justify-content-between">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            var currenPickOff = null;
            Pusher.logToConsole = true;
            let map;
            const preloadedImages = [];

            // Function to preload images
            function preloadImages(callback) {
                let imagesToLoad = 23;

                function onImageLoad() {
                    imagesToLoad--;
                    if (imagesToLoad === 0) {
                        callback();
                    }
                }

                ambulance = ['ambulance-s-0.png',
                    'ambulance-s-15.png',
                    'ambulance-s-30.png',
                    'ambulance-s-45.png',
                    'ambulance-s-60.png',
                    'ambulance-s-75.png',
                    'ambulance-s-90.png',
                    'ambulance-s-105.png',
                    'ambulance-s-120.png',
                    'ambulance-s-135.png',
                    'ambulance-s-150.png',
                    'ambulance-s-165.png',
                    'ambulance-s-180.png',
                    'ambulance-s-195.png',
                    'ambulance-s-210.png',
                    'ambulance-s-225.png',
                    'ambulance-s-240.png',
                    'ambulance-s-255.png',
                    'ambulance-s-270.png',
                    'ambulance-s-285.png',
                    'ambulance-s-300.png',
                    'ambulance-s-315.png',
                    'ambulance-s-330.png',
                    'ambulance-s-345.png',
                ]
                ambulance.forEach(element => {
                    const image = new Image();
                    image.onload = onImageLoad;
                    image.src = `{{ url('assets/img/ambulance') }}/${element}`;
                    console.log(image.src)
                    preloadedImages.push(image);
                });
            }

            function onPreloadComplete() {
                initMap();
            }

            // Call the preloadImages function with the onPreloadComplete callback
            preloadImages(onPreloadComplete);

            function getRotatedImageUrl(bearing) {
                const normalizedBearing = (bearing % 360 + 360) % 360;
                const index = Math.round(normalizedBearing / 15) % 24;
                return index; // Adjust the modulo value based on the array length
            }
            async function runPusher() {
                var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
                });
                var channel = pusher.subscribe('livelocation-channel.{{ $dataContent->id }}');
                channel.bind(
                    'livelocation-event',
                    function(data) {
                        // alert(JSON.stringify(data));
                        console.log('move');

                        const updatePosition = {
                            lat: parseFloat(data['lat']),
                            lng: parseFloat(data['long'])
                        };

                        if (currentPickOff) {
                            currentPickOff.setMap(null);
                        }

                        const bearing = google.maps.geometry.spherical.computeHeading(
                            new google.maps.LatLng(currentPickOff.getPosition().lat(), currentPickOff
                                .getPosition().lng()),
                            new google.maps.LatLng(updatePosition)
                        );
                        const normalizedBearing = (bearing % 360 + 360) % 360;

                        indexbearing = getRotatedImageUrl(bearing)
                        console.log('bearng', indexbearing);

                        currentPickOff = new google.maps.Marker({
                            position: updatePosition,
                            map: map,
                            title: data.name,
                            icon: {
                                url: preloadedImages[indexbearing].src,
                                scale: 5,
                                fillColor: '#00F',
                                fillOpacity: 1,
                                strokeColor: '#00F',
                                strokeWeight: 1
                            }
                        });
                        map.panTo(updatePosition);
                    }
                );

            }
            async function initMap() {
                const position = {
                    lat: {{ $dataContent->lat }},
                    lng: {{ $dataContent->long }}
                };
                const {
                    Map
                } = await google.maps.importLibrary("maps");

                const dataContentPosition = {
                    lat: {{ $dataContent->lat }},
                    lng: {{ $dataContent->long }}
                };

                // Initialize the map centered at dataContentPosition
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: dataContentPosition,
                    mapId: "DEMO_MAP_ID",
                });

                currentPickOff = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: "{{ $dataContent->name }}",
                    icon: {
                        url: preloadedImages[0].src,
                        scale: 5,
                        fillColor: '#00F',
                        fillOpacity: 1,
                        strokeColor: '#00F',
                        strokeWeight: 1
                    }
                });
                runPusher()
            }


        });
    </script>
@endpush
