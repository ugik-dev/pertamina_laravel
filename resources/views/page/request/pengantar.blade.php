@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Request Pengantar')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Review/</span> Pengantar
    </h4>
    {{-- <a class="btn btn-primary" href="{{ route('pengantar.form') }}">Buat Pengantar Baru </a> --}}
    @csrf
    <table id="datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Dibuat</th>
                <th>Pegawai</th>
                <th>Status</th>
                <th>Periode</th>
                <th>Tujuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    <!-- Add this modal HTML structure to your page -->
    <div class="modal fade" id="emergencyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="emergencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emergencyModalLabel">Emergency Alert</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <img src="/assets/gif/siren.gif" />
                    <p id="emergency_info"></p>
                </div>
                <button type="button" id="pickOffBtn" class="btn btn-xl btn-warning" data-dismiss="modal">Pickof</button>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            Datatable = $('#datatable').DataTable({
                processing: true,
                paggination: true,
                responsive: false,
                serverSide: true,
                searching: true,
                ordering: true,
                order: [0, 'desc'],
                ajax: {
                    url: "{{ route('approval.pengantar') }}"
                },
                columns: [{
                    data: "id",
                    name: "id"
                }, {
                    data: "span_time",
                    name: "span_time"
                }, {
                    data: "pasien_name",
                    name: "pasien_name"
                }, {
                    data: "status",
                    name: "status"
                }, {
                    data: "periode",
                    name: "periode"
                }, {
                    data: "labor_name",
                    name: "labor_name"
                }, {
                    data: "aksi",
                    name: "aksi"
                }, ]
            });
            Datatable.on("click", '.approv-btn', function(ev) {
                event.preventDefault();
                var id = $(this).data('id');
                var token = $("[name='_token']").val();
                Swal.fire(SwalOpt('Konfirmasi approv ?', 'Data ini akan approv!', )).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }
                    $.ajax({
                        url: "<?= url('approval/pengantar/') ?>/",
                        'type': 'post',
                        data: {
                            '_token': token,
                            'id': id,
                            'action': "approved"
                        },
                        success: function(data) {
                            if (data['error']) {
                                swalError(data['message'], "Approv Gagal !!");
                                return;
                            }
                            Datatable.ajax.reload(null, false);
                            swalBerhasil('Data berhasil di approv');
                        },
                        error: function(e) {
                            const errMessage = e.responseJSON.message ??
                                "Terjadi kesalahan";
                            // blockUIclose()
                            swalError(errMessage, "Gagal !!");

                        }
                    });
                });
            })
            var currenPickOff = null;
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
            });


            var channel = pusher.subscribe('emergency-channel');
            channel.bind('emergency-event', function(data) {
                // alert(JSON.stringify(data));
                newData(data)
            });

            var audio = new Audio('/assets/sound/siren1.mp3');
            audio.load();


            // Function to pause the audio
            function pauseAudio() {
                audio.pause();
            }
            // Optional: You can also add a stop button to completely stop the audio


            // Function to stop the audio
            function stopAudio() {
                audio.pause();
                audio.currentTime = 0; // Reset the audio to the beginning
            }

            function newData(d) {
                console.log(d)
                $.ajax({
                    url: "{{ route('get-emergency') }}",
                    type: "get",
                    data: {
                        'id_request': d['idRequest']
                    },
                    success: (data) => {
                        console.log(data['data']['data'])
                        var currentData = data['data']['data']
                        if (data['error']) {
                            newData(d);
                            alert("Koneksi Terputus, lakukan refres halaman")
                            return;
                        }
                        currenPickOff = d['idRequest']

                        $('#emergencyModal').modal('show');
                        $('#emergency_info').html(
                            `<b> ${currentData['emergency_name']}<br> ${currentData['name']}</b>`
                        );

                        audio.play()
                        audio.addEventListener('ended', function() {
                            audio.play()
                        });

                        console.log(currenPickOff)
                        document.getElementById('pickOffBtn').addEventListener('click', function() {
                            $('#emergencyModal').modal('hide');
                            window.open("{{ url('emergency-act/') }}/" + currenPickOff +
                                '/pick-off',
                                '_blank');
                            stopAudio();
                        });
                    },
                    error: () => {
                        // buttonIdle(submitBtn);
                    }
                });

            }
            // newData({
            //     'idRequest': 1
            // })
        });
    </script>
@endpush
