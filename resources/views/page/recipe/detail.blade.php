@extends('layouts/layoutMaster')

@section('title', 'Detail Emergency Call')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
@endsection

@section('page-script')
    <script>
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
    </script>
    <script>
        // Initialize and add the map
        let map;
        let polyline;
        async function initMap() {
            // The location of Uluru
            const position = {
                lat: {{ $dataContent->lat }},
                lng: {{ $dataContent->long }}
            };
            // Request needed libraries.
            //@ts-ignore
            const {
                Map
            } = await google.maps.importLibrary("maps");
            // const {
            //     AdvancedMarkerElement
            // } = await google.maps.importLibrary("marker");

            // The map, centered at Uluru
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

            // Marker for dataContent
            const dataContentMarker = new google.maps.Marker({
                position: dataContentPosition,
                map: map,
                title: "{{ $dataContent->login_session->name }}",
            });

            if (navigator.geolocation) {
                // Get user's current location
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userPosition = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        // Marker for user's location
                        // userMarker = new google.maps.Marker({
                        //     position: userPosition,
                        //     map: map,
                        //     title: "Your Location"
                        // });

                        // Center the map between dataContent and user locations
                        const bounds = new google.maps.LatLngBounds();
                        // bounds.extend(dataContentMarker.getPosition());
                        // bounds.extend(userMarker.getPosition());
                        map.fitBounds(bounds);
                        // drawPolyline(userPosition, dataContentPosition);
                        displayRoute(userPosition, dataContentPosition);
                        displayRoute(start, end)
                    },
                    (error) => {
                        console.error("Error getting user location:", error);
                    }
                );
            } else {
                console.error("Geolocation is not supported by this browser.");
            }

            // The marker, positioned at Uluru
            // const marker = new AdvancedMarkerElement({
            //     map: map,
            //     position: position,
            //     title: "Uluru",
            // });
        }

        function drawPolyline(start, end) {
            polyline = new google.maps.Polyline({
                path: [start, end],
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            polyline.setMap(map);
        }

        function displayRoute(start, end) {
            const directionsService = new google.maps.DirectionsService();

            directionsService.route({
                origin: start,
                destination: end,
                travelMode: 'DRIVING', // Specify the travel mode, e.g., 'DRIVING', 'WALKING', 'BICYCLING'
                avoidTolls: true
            }, function(response, status) {
                if (status === 'OK') {
                    // The directions service response is available in the 'response' object
                    console.log(response);
                    console.error('Directions request ok. Status:', status);

                    // To display the route on the map, you can use the DirectionsRenderer
                    const directionsRenderer = new google.maps.DirectionsRenderer();
                    directionsRenderer.setMap(map); // Assuming 'map' is your Google Map instance
                    directionsRenderer.setDirections(response);
                } else {
                    console.error('Directions request failed. Status:', status);
                }
            })

        }
        initMap();
    </script>
    {{-- <script src="{{ asset('assets/js/maps-leaflet.js') }}"></script> --}}
    {{-- <script>
        if ("geolocation" in navigator) { //check geolocation available 
            console.log('search location');
            if (!navigator.geolocation) {
                console.log('browser tidak suport')
            } else {
                console.log('browser suport')
                navigator.geolocation.getCurrentPosition(getPosition())
            }

            function getPosition(position) {

                console.log(position);
            }
            //try to get user current location using getCurrentPosition() method
            navigator.geolocation.getCurrentPosition(function(position) {
                console.log("Found your location \nLat : " + position.coords.latitude + " \nLang :" + position
                    .coords.longitude);
            });
        } else {
            console.log("Browser doesn't support geolocation!");
        }

        const basicMapVar = document.getElementById('basicMap');
        if (basicMapVar) {
            const basicMap = L.map('basicMap').setView([{{ $dataContent->lat }}, {{ $dataContent->long }}], 10);
            L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
                maxZoom: 18
            }).addTo(basicMap);
        }
    </script> --}}
@endsection

@section('content')
    <?php
    $userPhone = preg_replace('/[^0-9]/', '', $dataContent->login_session->phone);
    if (substr($userPhone, 0, 2) === '08') {
        $userPhone = '628' . substr($userPhone, 2);
    } elseif (substr($userPhone, 0, 3) === '+628') {
        $userPhone = '628' . substr($userPhone, 4);
    }
    $urlDirect = "https://www.google.com/maps/dir/?api=1&destination=$dataContent->lat,$dataContent->long";
    $messageWa = urlencode("*Emergency Call*\n" . "Nama : {$dataContent->login_session->name} \n" . "Phone : {$dataContent->login_session->phone}\n" . "Jenis Panggilan : {$dataContent->ref_emergency->name}\n" . "Waktu : {$dataContent->created_at}\n" . "Location : {$urlDirect}");
    $urlWa = 'https://wa.me/?text=' . $messageWa;
    $urlWaPengguna = "https://wa.me/$userPhone/?text=" . urlencode("Hallo, \nini dari PSC 119");
    ?>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Emergency Call /</span>
        Detail
    </h4>
    <div class="col-12 col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="mb-1 mt-3">Permintaan {{ $dataContent->ref_emergency->name }}
                            {!! statusCall($dataContent->status) !!}
                        </h5>
                        <p class="text-body">
                            {{ tanggalFull($dataContent->created_at) }}
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-2">
                        <a href="{{ $urlDirect }}" target="_blank" class="btn btn-outline-warning"><span
                                class="mdi mdi-map-marker-left-outline"></span> Buka Maps </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            <div class="card mb-4">
                <h5 class="card-header">Form Kajian dan Tindakan
                    <a class="btn btn-primary active float-end" href="{{ route('emergency-form', $dataContent->id) }}">+
                        Form</a>

                </h5>
                <div class="text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Agent</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($dataContent->forms as $form)
                                <tr>
                                    <td>{{ $form->created_at->format('d-m-Y  (H:i)') }}</td>
                                    <td>{{ $form->user->name }}</td>
                                    <td>
                                        <div class="btn-group me-2">
                                            <button type="button"
                                                class="btn btn-primary btn-icon  dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="mdi mdi-printer"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item waves-effect"
                                                        href="{{ route('emergency-form-print', [$dataContent->id, $form->id, 1]) }}">Format
                                                        1</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item waves-effect"
                                                        href="{{ route('emergency-form-print', [$dataContent->id, $form->id, 2]) }}">Format
                                                        2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a type="button" class="btn btn-icon me-2 btn-primary"
                                            href="{{ route('emergency-form-edit', [$dataContent->id, $form->id]) }}">
                                            <span class="tf-icons mdi mdi-pencil-outline"></span>
                                        </a>
                                        <button type="button" class="btn btn-icon me-2 btn-danger">
                                            <span class="tf-icons mdi mdi-trash-can-outline"></span>
                                        </button>
                                        {{-- <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item waves-effect"
                                                    href="{{ route('emergency-form-print', [$dataContent->id, $form->id]) }}"><i
                                                        class="mdi mdi-printer me-1"></i> Print</a>
                                                <a class="dropdown-item waves-effect"
                                                    href="{{ route('emergency-form-edit', [$dataContent->id, $form->id]) }}"><i
                                                        class="mdi mdi-pencil-outline me-1"></i> Edit</a>

                                            </div>
                                        </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title m-0">Log</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline pb-0 mb-0">
                        <li class="timeline-item timeline-item-transparent border-primary">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Request Call (ID: #{{ $dataContent->id }})
                                    </h6>
                                    <span class="text-muted">{{ tanggalSort($dataContent->created_at) }},
                                        ({{ tanggalJam($dataContent->created_at) }})</span>
                                </div>
                                <p class="mt-2">{{ $dataContent->login_session->name }}</p>
                            </div>
                        </li>
                        @foreach ($dataContent->logs as $log)
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">{{ $log->action }}</h6>
                                        <span class="text-muted">{{ tanggalSort($log->created_at) }},
                                            ({{ tanggalJam($log->created_at) }})
                                        </span>

                                    </div>
                                    <p class="mt-2">by {{ $log->user->name }}</p>
                                </div>
                            </li>
                        @endforeach
                        <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event pb-0">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Selesai</h6>
                                </div>
                                {{-- <p class="mt-2 mb-0">Package will be delivered by tomorrow</p> --}}
                            </div>
                        </li>
                    </ul>
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
                                <h6 class="mb-1">{{ $dataContent->login_session->name }}</h6>
                            </a>
                            <small>Telpn Number : {{ $dataContent->login_session->phone }}</small>
                        </div>
                    </div>

                    <div class="justify-content-between">
                        <a href="{{ $urlWaPengguna }}" target="_blank" class="w-100 btn btn-outline-success mb-3"><span
                                class="mdi mdi-whatsapp"></span> WA Pengguna </a>
                        <a href="{{ $urlWa }}" target="_blank" class="w-100 btn btn-outline-success"><span
                                class="mdi mdi-whatsapp"></span> WA Petugas </a>


                    </div>
                    <p class=" mb-1">Email: Shamus889@yahoo.com</p>
                    <p class=" mb-0">Mobile: +1 (609) 972-22-22</p>
                </div>
            </div>


        </div>
    </div>

@endsection
