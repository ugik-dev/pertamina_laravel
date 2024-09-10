<div class="tab-pane fade " id="keluhan_utama" role="tabpanel">
    <div class="d-flex mb-3 gap-3">
        <div class="avatar">
            <span class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-reload mdi-24px"></i>
            </span>
        </div>
        <div>
            <h5 class="mb-0"><span class="align-middle">Rujukan</span></h5>
        </div>
    </div>
    <div id="accordionKeluhan_utama" class="accordion">
        <div class="accordion-item active">
            <div id="accordionKeluhan_utama-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="col-lg-12">
                        <label class="form-label">Diagnosis</label>
                        <textarea type="text" rows="4" id="diagnosis" name="diagnosis" class="form-control">{{ $dataForm->diagnosis ?? '' }}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Ikhtisar klinik singkat</label>
                        <textarea type="text" rows="4" id="ikhtisar" name="ikhtisar" class="form-control">{{ $dataForm->ikhtisar ?? '' }}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Pengobatan diberikan</label>
                        <textarea type="text" rows="4" id="pengobatan_diberikan" name="pengobatan_diberikan" class="form-control">{{ $dataForm->pengobatan_diberikan ?? '' }}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Konsultasi yang diminta</label>
                        <textarea type="text" rows="4" id="konsultasi_diminta" name="konsultasi_diminta" class="form-control">{{ $dataForm->konsultasi_diminta ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
