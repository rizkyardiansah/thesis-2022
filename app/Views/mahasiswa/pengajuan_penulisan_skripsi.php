<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<?php if (session()->getFlashdata("message")) : ?>
    <div id="flashdata" data-open="true">
        <p id="icon" hidden><?= session()->getFlashdata("message")["icon"]; ?></p>
        <p id="title" hidden><?= session()->getFlashdata("message")["title"]; ?></p>
        <p id="text" hidden><?= session()->getFlashdata("message")["text"]; ?></p>
    </div>
<?php endif; ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if ($mahasiswa['file_khs'] != null && $mahasiswa['file_krs'] != null && $mahasiswa['file_persetujuan_skripsi'] != null && $mahasiswa['sks_lulus'] != null && $mahasiswa['pembimbing_akademik'] != null && $mahasiswa['mk_sedang_diambil'] != null && $mahasiswa['mk_akan_diambil'] != null && $mahasiswa['status_persetujuan_skripsi'] == 'Disetujui' ): ?>
                    <div class="alert alert-success" role="alert">
                        <small>
                            <strong>Pengajuan penulisan skripsi</strong> anda <strong>disetujui</strong>. Silahkan kumpulkan <strong>proposal</strong> anda pada <a href="<?= base_url("mahasiswa/proposal") ?>" >menu berikut</a>.
                        </small>
                    </div>
                <?php elseif ($mahasiswa['file_khs'] != null && $mahasiswa['file_krs'] != null && $mahasiswa['file_persetujuan_skripsi'] != null && $mahasiswa['sks_lulus'] != null && $mahasiswa['pembimbing_akademik'] != null && $mahasiswa['mk_sedang_diambil'] != null && $mahasiswa['mk_akan_diambil'] != null && $mahasiswa['status_persetujuan_skripsi'] == 'Ditolak' ): ?>
                    <div class="alert alert-danger"  role="alert">
                        <small>
                            <strong>Pengajuan penulisan skripsi</strong> anda <strong>ditolak</strong>. Silahkan perbaiki dan kirim ulang pengajuan anda.
                        </small>
                    </div>
                <?php elseif ($mahasiswa['file_khs'] != null && $mahasiswa['file_krs'] != null && $mahasiswa['file_persetujuan_skripsi'] != null && $mahasiswa['sks_lulus'] != null && $mahasiswa['pembimbing_akademik'] != null && $mahasiswa['mk_sedang_diambil'] != null && $mahasiswa['mk_akan_diambil'] != null && $mahasiswa['status_persetujuan_skripsi'] == null ): ?>
                    <div class="alert alert-info"  role="alert">
                        <small>
                            <strong>Pengajuan Penulisan Skripsi</strong> anda sedang <strong>diproses</strong>.
                        </small>
                    </div>
                <?php elseif ($mahasiswa['file_khs'] == null || $mahasiswa['file_krs'] == null || $mahasiswa['file_persetujuan_skripsi'] == null || $mahasiswa['sks_lulus'] == null || $mahasiswa['pembimbing_akademik'] == null || $mahasiswa['mk_sedang_diambil'] == null || $mahasiswa['mk_akan_diambil'] == null || $mahasiswa['status_persetujuan_skripsi'] == null ): ?>
                    <div class="alert alert-danger" role="alert">
                        <small>
                            Lengkapi data berikut sebagai syarat <strong>wajib</strong> untuk dapat mengikuti kegiatan skripsi.
                        </small>
                    </div>
                <?php endif; ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Persyaratan Pengajuan Penulisan Skripsi
        </div>
        <div class="card-body">
            <form action="<?= base_url("mahasiswa/insertPengajuanPenulisanSkripsi/".$mahasiswa['npm']) ?>" method="post" id="formDataPersetujuanSkripsi" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" >
                            <label for="sks_lulus">SKS yang Sudah Lulus</label>
                            <input type="text" class="form-control" id="sks_lulus" name="sks_lulus" value="<?= $mahasiswa["sks_lulus"] ?>" <?= ($mahasiswa['status_persetujuan_skripsi'] == 'Disetujui') ? "disabled" : "" ?>>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pembimbing_akademik">Dosen Pembimbing Akademik</label>
                            <select class="form-control" name="pembimbing_akademik" id="pembimbing_akademik" value="<?= $mahasiswa["pembimbing_akademik"] ?>" <?= ($mahasiswa['status_persetujuan_skripsi'] == 'Disetujui') ? "disabled" : "" ?>>
                                <option value="none" selected disabled> - Pilih Pembimbing Akademik - </option>
                            <?php foreach($dosen as $d) : ?>
                                <?php if ($mahasiswa['pembimbing_akademik'] == $d['id']) : ?>
                                    <option value="<?= $d['id'] ?>" selected><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group" >
                            <label for="mk_sedang_diambil">Matakuliah yang sedang diambil</label>
                            <input type="text" class="form-control" id="mk_sedang_diambil" name="mk_sedang_diambil" value="<?= $mahasiswa["mk_sedang_diambil"] ?>" <?= ($mahasiswa['status_persetujuan_skripsi'] == 'Disetujui') ? "disabled" : "" ?>>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group" >
                            <label for="mk_akan_diambil">Matakuliah yang akan diambil</label>
                            <input type="text" class="form-control" id="mk_akan_diambil" name="mk_akan_diambil" value="<?= $mahasiswa["mk_akan_diambil"] ?>" <?= ($mahasiswa['status_persetujuan_skripsi'] == 'Disetujui') ? "disabled" : "" ?>>
                        </div>
                    </div>

                    <div class="col-lg-12 my-2">
                        <label>File Kartu Hasil Studi</label>
                        <?php if ($mahasiswa['file_khs'] == null) : ?>
                            <small class="text-muted d-block">Unggah KHS dalam format PDF dengan ukuran maksimal 10 MB </small>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputKhs" name="inputKhs">
                                    <label class="custom-file-label" for="inputKhs">Pilih File Kartu Hasil Studi</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $mahasiswa['file_khs'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauKhs" data-npm="<?= $mahasiswa['npm'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-lg-12 my-2">
                        <label>File Kartu Rencana Studi</label>
                        <?php if ($mahasiswa['file_krs'] == null) : ?>
                            <small class="text-muted d-block">Unggah KRS dalam format PDF dengan ukuran maksimal 10 MB </small>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputKrs" name="inputKrs">
                                    <label class="custom-file-label" for="inputKrs">Pilih File Kartu Rencana Studi</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $mahasiswa['file_krs'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauKrs" data-npm="<?= $mahasiswa['npm'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-lg-12 my-2">
                        <label>File Persetujuan Penyusunan Skripsi</label>
                        <?php if ($mahasiswa['file_persetujuan_skripsi'] == null) : ?>
                            <small class="text-muted d-block">Unggah Persetujuan Penyusunan Skripsi dalam format PDF dengan ukuran maksimal 10 MB</small>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputPersetujuanSkripsi" name="inputPersetujuanSkripsi">
                                    <label class="custom-file-label" for="inputPersetujuanSkripsi">Pilih File Persetujuan Skripsi</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $mahasiswa['file_persetujuan_skripsi'] ?>" readonly>
                                <div class="input-group-append">
                                    <a role="button" class="btn btn-outline-primary" id="tinjauPersetujuan" data-npm="<?= $mahasiswa['npm'] ?>">Tinjau</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($mahasiswa['status_persetujuan_skripsi'] != 'Disetujui'): ?>
                        <div class="col-lg-12 d-flex justify-content-end my-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </form>
        </div>
    </div>


    <!-- modal untuk preview file -->
    <div class="modal fade" id="filePreview" tabindex="-1" role="dialog" aria-labelledby="filePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filePreviewLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="embed-responsive embed-responsive-16by9" id="previewContainer">
                                    <iframe class="embed-responsive-item" src=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <form action="" id="formUnduh" method="post">
                            <button class="btn btn-primary" type="submit">Unduh</button>
                        </form>
                        <?php if ($mahasiswa['status_persetujuan_skripsi'] != 'Disetujui'): ?>
                            <form action="" id="formHapus" method="post">
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("assets/js/mahasiswa/pengajuanPenulisanSkripsi.js");?>"></script>
<?= $this->endSection(); ?>