<div id="accordionPrimary_assessment" class="accordion mt-4 ">
    <div class="accordion-item active">
        <h2 class="accordion-header ">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true"
                data-bs-target="#accordionPrimary_assessment-4" aria-controls="accordionPrimary_assessment-4">
                DISABILITY (GCS)
            </button>
        </h2>

        <div id="accordionPrimary_assessment-4" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md">
                            <div class="row mt-2">
                                <label class="col-sm-3 col-form-label" for="gcs">1. GCS </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input id="gcs" name="gcs" class="form-control " readonly
                                            value="{{ $dataForm->gcs ?? '' }}" />
                                    </div>
                                </div>
                            </div>

                            {{-- {!! input_inline('gcs', '1. DISABILITY (GCS)', 'sm-3', 'sm-9', '', $dataForm->gcs ?? '') !!} --}}
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">2.
                                        Membuka Mata
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'gcs_res_mata',
                                            [
                                                '4' => '[4] Spontan',
                                                '3' => '[3] Terhadap bicara',
                                                '2' => '[2] Terhadap nyeri',
                                                '1' => '[1] Tidak ada respon',
                                            ],
                                            'ml-3 mr-3',
                                            'sm-5',
                                            $dataForm->gcs_res_mata ?? '',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{--  Respon Verbal --}}
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        Respon Verbal
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'gcs_res_verbal',
                                            [
                                                '5' => '[5] Terorientasi',
                                                '4' => '[4] Percakapan yang membingungkan',
                                                '3' => '[3] Menggunakan kata-kata yang tidak sesuai',
                                                '2' => '[2] Suara mengerang',
                                                '1' => '[1] Tidak ada respon',
                                            ],
                                            'ml-3 mr-3',
                                            'sm-12',
                                            $dataForm->gcs_res_verbal ?? '',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        Respon Motorik
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_radios(
                                            'gcs_res_motorik',
                                            [
                                                '6' => '[6] Mengikuti perintah',
                                                '5' => '[5] Menunjuk tempat rangsang',
                                                '4' => '[4] Menghindar dari stimulus',
                                                '3' => '[3] Fleksi abnormal',
                                                '2' => '[2] Ekstensi abnormal',
                                                '1' => '[1] Tidak ada respon',
                                            ],
                                            'ml-3 mr-3',
                                            'sm-12',
                                            $dataForm->gcs_res_motorik ?? '',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{--  Nadi --}}
                            <div class="col-md">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">
                                        Tindakan
                                    </label>
                                    <div class="col-sm-9">
                                        {!! input_inline('gcs_t_posisi', 'Posisi', 'sm-3', 'sm-9', '', $dataForm->gcs_t_posisi ?? '') !!}
                                        {!! input_inline('gcs_t_gds', 'GDS', 'sm-3', 'sm-9', 'mg/dl', $dataForm->gcs_t_gds ?? '') !!}
                                        {!! input_inline('gcs_t_chol', 'Chol', 'sm-3', 'sm-9', 'mg/dl', $dataForm->gcs_t_chol ?? '') !!}
                                        {!! input_inline('gcs_t_au', 'AU', 'sm-3', 'sm-9', 'mg/dl', $dataForm->gcs_t_au ?? '') !!}
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
