<div id="accordionPrimary_assessment" class="accordion">
    <div class="accordion-item ">
        <h2 class="accordion-header ">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                data-bs-target="#accordionPrimary_assessment-1" aria-controls="accordionPrimary_assessment-1">
                AIRWAY
            </button>
        </h2>

        <div id="accordionPrimary_assessment-1" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md">
                            {!! input_checkbox('airway_bebas', 'Bebas', '', $dataForm->airway_bebas ?? '') !!}
                            {!! input_checkbox('airway_tiak_efektif', 'Tidak Efektif', '', $dataForm->airway_tiak_efektif ?? '') !!}
                            {!! input_checkbox('airway_benda_asing', 'Benda Asing', '', $dataForm->airway_benda_asing ?? '') !!}
                            {!! input_checkbox('airway_c_spine', 'C-Spine', '', $dataForm->airway_c_spine ?? '') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md">
                            <label>Tindakan : </label>
                            {!! input_checkbox(
                                'airway_t_bebaskan_jalan_napas',
                                'Bebaskan Jalan Napas',
                                '',
                                $dataForm->airway_t_bebaskan_jalan_napas ?? '',
                            ) !!}
                            {!! input_checkbox(
                                'airway_t_kel_ben',
                                '',
                                input_inline(
                                    'airway_t_kel_ben_val',
                                    'Keluarkan Benda Asing',
                                    '',
                                    'sm-12',
                                    '',
                                    $dataForm->airway_t_kel_ben_val ?? '',
                                ),
                                $dataForm->airway_t_kel_ben ?? '',
                            ) !!}
                            {!! input_checkbox(
                                'airway_t_fik_man',
                                'Fiksasi Manual',
                                input_radios(
                                    'airway_t_fik_man_val',
                                    ['head_tilt' => 'Head Tilt', 'chin_lit' => 'Chin Lit', 'jaw_trush' => 'Jaw Thrus'],
                                    '6',
                                    '6',
                                    $dataForm->airway_t_fik_man_val ?? '',
                                ),
                                $dataForm->airway_t_fik_man ?? '',
                            ) !!}
                            {!! input_checkbox('airway_t_col_brance', 'Colar brance', '', $dataForm->airway_t_col_brance ?? '') !!}
                            {!! input_checkbox('airway_t_opa', 'OPA', '', $dataForm->airway_t_opa ?? '') !!}
                            {!! input_checkbox(
                                'airway_t_intubasi',
                                'Intubasi / Needle krokotirodektomie',
                                '',
                                $dataForm->airway_t_intubasi ?? '',
                            ) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
