<div class="tab-pane fade" id="secondary_assessment" role="tabpanel">
    <div class="d-flex mb-3 gap-3">
        <div class="avatar">
            <span class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-wallet-giftcard mdi-24px"></i>
            </span>
        </div>
        <div>
            <h5 class="mb-0">
                <span class="align-middle"> Vital Sign & Secondary Assessment</span>
            </h5>
        </div>
    </div>
    <div id="accordionPrimary_assessment" class="accordion">
        <div class="accordion-item ">
            <h2 class="accordion-header ">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#accordionPrimary_assessment-1" aria-controls="accordionPrimary_assessment-1">
                    Secondary Assessment
                </button>
            </h2>

            <div id="accordionPrimary_assessment-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! input_inline('sec_nipb', 'NIPB : ', 'sm-3', 'sm-9', 'mm/hg', $dataForm->sec_nipb ?? '') !!}
                        </div>
                        <div class="col-md-6">
                            {!! input_inline('sec_hr', 'HR : ', 'sm-3', 'sm-9', 'x/mt', $dataForm->sec_hr ?? '') !!}
                        </div>
                        <div class="col-md-6">
                            {!! input_inline('sec_temp', 'Temp : ', 'sm-3', 'sm-9', '&deg;C', $dataForm->sec_temp ?? '') !!}
                        </div>
                        <div class="col-md-6">
                            {!! input_inline('sec_rr', 'RR :', 'sm-3', 'sm-9', 'x/mt', $dataForm->sec_rr ?? '') !!}
                        </div>
                        {!! textarea_inline('sec_riw_alergi', 'Riwayat Alergi ', 'sm-3', 'sm-9', '3', $dataForm->sec_riw_alergi ?? '') !!}
                        {!! textarea_inline(
                            'sec_riw_makanan',
                            'Riwayat Makanan ',
                            'sm-3',
                            'sm-9',
                            '3',
                            $dataForm->sec_riw_makanan ?? '',
                        ) !!}
                        {!! textarea_inline(
                            'sec_riw_penyakit_kel',
                            'Riwayat Penyakit Keluarga ',
                            'sm-3',
                            'sm-9',
                            '3',
                            $dataForm->sec_riw_penyakit_kel ?? '',
                        ) !!}
                        {!! textarea_inline('sec_suspect', 'Suspect Diagnosis', 'sm-3', 'sm-9', '3', $dataForm->sec_riw_alergi ?? '') !!}
                        {!! textarea_inline(
                            'sec_terapi',
                            'Terapi/Obat Yang di Berikan',
                            'sm-3',
                            'sm-9',
                            '3',
                            $dataForm->sec_terapi ?? '',
                        ) !!}

                        <hr class="mt-3">
                        {{-- <div> --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#fullscreenModal">
                            Mulai Gambarkan
                        </button>


                        <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFullTitle">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-2 mt-4">
                                                <label class="col-form-label" for="multicol-username">Arsirkan bila ada
                                                    luka
                                                    : jenis luka & ukurannya (panjang*lebar*dalam)
                                                </label>
                                                <label for="ketebalanPena">Ketebalan Pena:</label>
                                                <input type="range" id="ketebalanPena" min="1" max="10"
                                                    value="5">

                                                <label for="warnaPena">Warna Pena:</label>
                                                <input type="color" id="warnaPena" value="#000000">

                                                <label for="modePenghapus">Mode Penghapus:</label>
                                                <input type="checkbox" id="modePenghapus">

                                                <a class="btn btn-secondary active" id="hapusGambar"><i
                                                        class="mdi mdi-trash-can-outline"></i> Hapus
                                                    Gambar</a>
                                            </div>
                                            <div class="col-md-10" id="body_canvas">
                                                <canvas id="myCanvas" width="500" height="500"
                                                    style=" border: 1px solid #000; background-color: white; background-image: url('{{ url('assets/img/anotomi-tubuh.png') }}'); background-position: center center; background-repeat: no-repeat;"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
