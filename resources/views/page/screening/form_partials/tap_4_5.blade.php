<div id="accordionPrimary_assessment" class="accordion mt-4 ">
    <div class="accordion-item active">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                data-bs-target="#accordionPrimary_assessment-5" aria-controls="accordionPrimary_assessment-5">
                SKALA NYERI DAN EXPOSURE
            </button>
        </h2>

        <div id="accordionPrimary_assessment-5" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="multicol-username">1.
                                    Skala Nyeri</label>
                                <div class="col-sm-9">
                                    <div class="my-3" id="skala_nyeri_sliders"></div>
                                    <input class="form-control d-inline-block mt-2" type="number" min="0"
                                        max="10" step="1" id="skala_nyeri" name="skala_nyeri"
                                        value="{{ $dataForm->skala_nyeri ?? 0 }}" />
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        skalaNyeriUi = document.getElementById('skala_nyeri_sliders');
                                        skalaNyeriVal = document.getElementById('skala_nyeri');
                                        skalaNyeriUi = noUiSlider.create(skalaNyeriUi, {
                                            start: [{{ $dataForm->skala_nyeri ?? 0 }}],
                                            behaviour: 'tap-drag',
                                            step: 1,
                                            tooltips: true,
                                            range: {
                                                min: 0,
                                                max: 10
                                            },
                                            pips: {
                                                mode: 'steps',
                                                stepped: true,
                                                density: 1
                                            },
                                            direction: isRtl ? 'rtl' : 'ltr'
                                        });

                                        skalaNyeriUi.on('update', function(values, handle) {
                                            console.log('update slider')
                                            console.log(handle)

                                            skalaNyeriVal.value = values;

                                        });
                                    });
                                </script>
                            </div>
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">2.
                                        Exposure
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'expo',
                                            [
                                                'buka_pakaian' => 'Buka Pakaian',
                                                'selimut' => 'Selimut',
                                                'rawat_luka' => 'Rawat Luka',
                                                'reposisi' => 'Reposisi',
                                                'spalk' => 'Spalk',
                                                'spine_split' => 'Spine Split',
                                            ],
                                            'ml-3 mr-3',
                                            'sm-3',
                                            $dataForm->expo ?? '',
                                        ) !!}
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
