<div id="accordionPrimary_assessment" class="accordion mt-4 ">
    <div class="accordion-item ">
        <h2 class="accordion-header ">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                data-bs-target="#accordionPrimary_assessment-2" aria-controls="accordionPrimary_assessment-2">
                BREATHING
            </button>
        </h2>

        <div id="accordionPrimary_assessment-2" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md">
                            {!! input_checkbox('breathing_andekuat', 'Andekuat', '', $dataForm->breathing_andekuat ?? '') !!}
                            {!! input_radios(
                                'breathing_val',
                                ['lambat' => 'Lambat', 'cepat' => 'Cepat', 'asismetris' => 'Asismetris'],
                                'ml-3 mr-3',
                                '',
                                $dataForm->breathing_val ?? '',
                            ) !!}
                            {!! input_checkbox('breathing_wheezing', 'Wheezing', '', $dataForm->breathing_wheezing ?? '') !!}
                            {!! input_checkbox('breathing_stridor', 'Stridor', '', $dataForm->breathing_stridor ?? '') !!}
                            {!! input_checkbox('breathing_apnoe', 'Apnoe', '', $dataForm->breathing_apnoe ?? '') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md">
                            <label>Tindakan : </label>
                            {!! input_checkbox(
                                'breathing_t_o2',
                                '',
                                input_inline('breathing_t_o2_val', 'Oksigen / O2', '5', '6', 'lt/mt', $dataForm->breathing_t_o2_val ?? ''),
                                $dataForm->breathing_t_o2 ?? '',
                            ) !!}
                            {!! input_checkbox(
                                'breathing_t_satur',
                                '',
                                input_inline('breathing_t_satur_val', 'Saturasi', '5', '6', '%', $dataForm->breathing_t_satur_val ?? ''),
                                $dataForm->breathing_t_satur ?? '',
                            ) !!}
                            {!! input_checkbox('breathing_t_bvm', 'BVM', '', $dataForm->breathing_t_bvm ?? '') !!}
                            {!! input_checkbox(
                                'breathing_t_needle_thorac',
                                'Needle thoracosistesis',
                                '',
                                $dataForm->breathing_t_needle_thorac ?? '',
                            ) !!}
                            {!! input_checkbox('breathing_t_thorax_drain', 'Thorax Drain', '', $dataForm->breathing_t_thorax_drain ?? '') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
