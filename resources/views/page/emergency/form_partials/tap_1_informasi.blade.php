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
    <div id="accordionInformasi Umum" class="accordion">
        <div class="accordion-item active">

            <div id="accordionInformasi Umum-1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="nama_pemanggil" class="form-label">Nama Pemanggil :</label>
                            <input value="{{ $dataContent->login_session->name ?? ($dataForm->nama_pemanggil ?? '') }}"
                                class="form-control" id="nama_pemanggil" name="nama_pemanggil"
                                {{ !empty($id) ? 'readonly' : '' }}>
                        </div>

                        <div class="col-sm-6 mb-2">

                            <label for="phone_pemanggil" class="form-label">No Telp Pemanggil</label>
                            <input
                                value=" {{ $dataContent->login_session->phone ?? ($dataForm->phone_pemanggil ?? '') }}"
                                class="form-control" id="phone_pemanggil" name="phone_pemanggil"
                                {{ !empty($id) ? 'readonly' : '' }}>
                        </div>

                        <div class="col-sm-6 mb-2">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input class="form-control" id="nama_pasien" name="nama_pasien"
                                value="{{ $dataForm->nama_pasien ?? '' }}" required>
                        </div>

                        <div class="col-sm-6 mb-2">
                            <label for="phone_pasien" class="form-label">No Phone</label>
                            <input value="{{ $dataForm->phone_pasien ?? '' }}" class="form-control" id="phone_pasien"
                                name="phone_pasien">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="umur" class="form-label">Umur (Tahun)</label>
                            <input type="number" value="{{ $dataForm->umur ?? '' }}" class="form-control"
                                id="umur" name="umur">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="jamkes" class="form-label">Jamkes:</label>
                            <input type="text" class="form-control" value="{{ $dataForm->jamkes ?? '' }}"
                                id="jamkes" name="jamkes">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                            {!! input_radios(
                                'jenis_kelamin',
                                ['l' => 'Laki-laki', 'p' => 'Perempuan'],
                                'ml-3 mr-3',
                                '',
                                $dataForm->jenis_kelamin ?? null,
                            ) !!}
                        </div>

                        <div class="col-sm-6 mb-2">
                            <label for="sumber_informasi" class="form-label">Sumber Informasi:</label>
                            {!! input_radios(
                                'sumber_informasi',
                                ['diri' => 'Diri', 'orang_lain' => 'Orang Lain'],
                                'ml-3 mr-3',
                                '',
                                $dataForm->sumber_informasi ?? null,
                            ) !!}
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian:</label>
                            <input type="text" value="{{ $dataForm->lokasi_kejadian ?? '' }}" class="form-control"
                                id="lokasi_kejadian" name="lokasi_kejadian" required>
                        </div>

                        <div class="col-sm-6 mb-2">
                            <label for="alamat_rumah" class="form-label">Alamat Rumah:</label>
                            <input type="text" class="form-control" value="{{ $dataForm->alamat_rumah ?? '' }}"
                                id="alamat_rumah" name="alamat_rumah" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
