<div id="accordionPrimary_assessment" class="accordion mt-4 ">
    <div class="accordion-item ">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                data-bs-target="#accordionPrimary_assessment-3" aria-controls="accordionPrimary_assessment-3">
                CIRCULATION
            </button>
        </h2>
        <div id="accordionPrimary_assessment-3" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md">
                            {!! input_inline('cir_cap_refil', '1. Capilary refil', 'sm-3', 'sm-9', 'dt', $dataForm->cir_cap_refil ?? '') !!}
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">2.
                                        Warna Kulit
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'cir_col_kulit',
                                            ['normal' => 'Normal', 'pucat' => 'Pucat', 'kemerahan' => 'Kemerahan', 'sianosis' => 'Sianosis'],
                                            'ml-3 mr-3',
                                            '',
                                            $dataForm->cir_col_kulit ?? '',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        3. Kulit
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'cir_kulit',
                                            ['normal' => 'Normal', 'hangat' => 'Hangat', 'dingin' => 'Dingin', 'kering' => 'Kering', 'lembab' => 'Lembab'],
                                            'ml-3 mr-3',
                                            '',
                                            $dataForm->cir_kulit ?? '',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        4. Nadi
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_inline('cir_nadi_tempat', 'Tempat', 'sm-3', 'sm-9', '', $dataForm->cir_nadi_tempat ?? '') !!}
                                        <hr>
                                        <div class="col-sm-12">
                                            {!! input_radios(
                                                'cir_nadi',
                                                [
                                                    'normal' => 'Normal',
                                                    'reguler' => 'Reguler',
                                                    'irreguler' => 'Irreguler',
                                                    'bradikardi' => 'Bradikardi',
                                                    'takikardi' => 'Takikardi',
                                                    'kuat' => 'Kuat',
                                                    'lemah' => 'Lemah',
                                                ],
                                                'ml-3 mr-3',
                                                'sm-3',
                                                $dataForm->cir_nadi ?? '',
                                            ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        <b>Tindakan</b>

                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_inline('cir_monitor', 'Pasang Monitor', 'sm-3', 'sm-9', '', $dataForm->cir_monitor ?? '') !!}
                                        <div class="row mt-3">
                                            <label class="col-sm-3 col-form-label" for="multicol-username">EKG</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <textarea type="text" id="cir_ekg" name="cir_ekg" rows="4" class="form-control">{!! $dataForm->cir_ekg ?? '' !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        {!! input_inline('cir_cpr', 'CPR', 'sm-3', 'sm-9', 'mt', $dataForm->cir_cpr ?? '') !!}
                                        {!! input_inline('cir_ifvd', 'IFVD', 'sm-3', 'sm-9', 'tts/ms', $dataForm->cir_ifvd ?? '') !!}


                                        {!! input_checkbox('cir_tensi', 'Periksa Tensi', '', $dataForm->cir_tensi ?? '') !!}
                                        {!! input_checkbox('cir_balut_tekan', 'Balut Tekan', '', $dataForm->cir_balut_tekan ?? '') !!}
                                        {!! input_checkbox('cir_bebat_tekan', 'Bebat Tekan', '', $dataForm->cir_bebat_tekan ?? '') !!}
                                        {!! input_checkbox('cir_defibrator', 'Defibrator', '', $dataForm->cir_defibrator ?? '') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
