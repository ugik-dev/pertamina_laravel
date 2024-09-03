<div class="tab-pane fade " id="keluhan_utama" role="tabpanel">
    <div class="d-flex mb-3 gap-3">
        <div class="avatar">
            <span class="avatar-initial bg-label-primary rounded">
                <i class="mdi mdi-reload mdi-24px"></i>
            </span>
        </div>
        <div>
            <h5 class="mb-0"><span class="align-middle">Keluhan Utama</span></h5>
        </div>
    </div>
    <div id="accordionKeluhan_utama" class="accordion">
        <div class="accordion-item active">
            <div id="accordionKeluhan_utama-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <textarea type="text" rows="4" id="keluhan_utama" name="keluhan_utama" class="form-control">{{ $dataForm->keluhan_utama ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
