<div class="tab-pane fade  show active" id="informasi" role="tabpanel">
    <div class="d-flex mb-3 gap-3">
        <div class="avatar">
            <div class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-credit-card-outline mdi-24px"></i>
            </div>
        </div>
        <div>
            <h5 class="mb-0">
                <span class="align-middle">Informasi Umum</span>
            </h5>
            {{-- <small>Get help with informasi</small> --}}
        </div>
    </div>
    <div id="accordionInformasi-Umum" class="accordion">
        <div class="accordion-item active">

            <div id="accordionInformasi-Umum-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="col-sm-12 mb-2">
                        <label for="user_id" class="form-label">Nama Pasien :</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @if (!empty($dataForm->pasien))
                                <option value="{{ $dataForm->pasien->id }}" selected>{{ $dataForm->pasien->name }}
                                </option>
                            @endif
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="doctor_id" class="form-label">Nama Dokter :</label>
                            <select class="form-control" id="doctor_id" name="doctor_id">
                                @if (!empty($dataForm->doctor))
                                    <option value="{{ $dataForm->doctor->id }}" selected>{{ $dataForm->doctor->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="assist_id" class="form-label">Asisten :</label>
                            <select class="form-control" id="assist_id" name="assist_id">
                                @if (!empty($dataForm->assist))
                                    <option value="{{ $dataForm->assist->id }}" selected>{{ $dataForm->assist->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="no_poli" class="form-label">No Resep :</label>
                            <input class="form-control" id="no_poli" name="no_poli"
                                value="{{ $dataForm->no_poli ?? $lastNumber }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="tujuan" class="form-label">Kepada RS/Dokter :</label>
                            <input class="form-control" id="tujuan" name="tujuan"
                                value="{{ $dataForm->tujuan ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="atas_beban" class="form-label">Biaya atas beban :</label>
                            <input class="form-control" id="atas_beban" name="atas_beban"
                                value="{{ $dataForm->atas_beban ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="ia_dari" class="form-label">I/A dari :</label>
                            <input class="form-control" id="ia_dari" name="ia_dari"
                                value="{{ $dataForm->ia_dari ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="relation_desc" class="form-label">Nama & Hubungan :</label>
                            <input class="form-control" id="relation_desc" name="relation_desc"
                                value="{{ $dataForm->relation_desc ?? 'Pekerja' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
