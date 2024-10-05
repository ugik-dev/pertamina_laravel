<div class="tab-pane fade" id="waktu" role="tabpanel">
    <div class="d-flex mb-3 gap-3">
        <div class="avatar">
            <span class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-cart-plus mdi-24px"></i>
            </span>
        </div>
        <div>
            <h5 class="mb-0">
                <span class="align-middle">Waktu</span>
            </h5>
        </div>
    </div>
    <div id="accordionWaktu" class="accordion">
        <div class="accordion-item active">
            {{-- <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    aria-expanded="true" data-bs-target="#accordionWaktu-1"
                    aria-controls="accordionWaktu-1">
                    How would you ship my order?
                </button>
            </h2> --}}

            <div id="accordionWaktu-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <label for="tanggal" class="form-label">Tanggal: </label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ !empty($id) ? $dataContent->created_at->format('Y-m-d') : $dataForm->tanggal ?? '' }}"
                                {{ !empty($id) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="waktu_panggilan" class="form-label">Waktu Panggilan:</label>
                            <input type="time" class="form-control" id="waktu_panggilan"
                                value="{{ !empty($id) ? $dataContent->created_at->format('H:i') : $dataForm->waktu_panggilan ?? '' }}"
                                name="waktu_panggilan" {{ !empty($id) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="waktu_berangkat" class="form-label">Waktu Berangkat:</label>
                            <input type="time" class="form-control" id="waktu_berangkat" name="waktu_berangkat"
                                value="{{ $dataForm->waktu_berangkat ?? '' }}" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="waktu_tkp" class="form-label">Waktu Tiba TKP:</label>
                            <input type="time" class="form-control" id="waktu_tkp" name="waktu_tkp"
                                value="{{ $dataForm->waktu_tkp ?? '' }}">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="waktu_yankes" class="form-label">Waktu Tiba di Yankes:</label>
                            <input type="time" class="form-control" id="waktu_yankes" name="waktu_yankes"
                                value="{{ $dataForm->waktu_yankes ?? '' }}">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="waktu_rujukan" class="form-label">Waktu Tiba di Tempat Rujukan:</label>
                            <input type="time" class="form-control" id="waktu_rujukan" name="waktu_rujukan"
                                value="{{ $dataForm->waktu_rujukan ?? '' }}">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="tempat_rujukan" class="form-label">Tempat Rujukan:</label>
                            <input type="text" class="form-control" id="tempat_rujukan" name="tempat_rujukan"
                                value="{{ $dataForm->tempat_rujukan ?? '' }}">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
