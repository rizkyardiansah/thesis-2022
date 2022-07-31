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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <form action="<?= count($nilaiSidang) == 0 ? base_url("dosen/insertNilaiSidangSkripsi") : base_url("dosen/updateNilaiSidangSkripsi") ?>" method="post" id="formPenilaianSidang">
                <div class="row">
                    <input type="hidden" name="idSidangSkripsi" value="<?= $detailSidangSkripsi['id'] ?>">
                    <input type="hidden" name="idDosen" value="<?= $dataAkun['id'] ?>">
                    <?php if (count($nilaiSidang) != 0): ?>
                        <input type="hidden" name="idPenilaianSidang" value="<?= $nilaiSidang[0]['id'] ?>">
                    <?php endif; ?>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $detailSidangSkripsi['nama_mahasiswa'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value="<?= $detailSidangSkripsi['npm'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bidang">Bidang</label>
                            <input class="form-control" id="bidang" name="bidang" value="<?= $detailSidangSkripsi['nama_bidang'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <textarea class="form-control" id="judul" name="judul" disabled><?= $detailSidangSkripsi['judul'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pembimbing1">Pembimbing Ilmu 1</label>
                            <input class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailSidangSkripsi['pembimbing1'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pembimbing2">Pembimbing Ilmu 2</label>
                            <input class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $detailSidangSkripsi['pembimbing2'] == null ? "-" : $detailSidangSkripsi['pembimbing2'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pembimbingAgama">Pembimbing Agama</label>
                            <input class="form-control" id="pembimbingAgama" name="pembimbingAgama" value="<?= $detailSidangSkripsi['pembimbing_agama'] ?>" disabled>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="penguji">Dosen Penguji</label>
                            <input class="form-control" id="penguji" name="penguji" value="<?= $detailSidangSkripsi['nama_penguji'] ?>" disabled>
                        </div>
                    </div>

                   
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="reviewer_sempro">Reviewer Seminar Proposal</label>
                            <input class="form-control" id="reviewer_sempro" name="reviewer_sempro" value="<?= $detailSidangSkripsi['nama_reviewer_sempro'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="reviewer_sempra">Reviewer Seminar Prasidang</label>
                            <input class="form-control" id="reviewer_sempra" name="reviewer_sempra" value="<?= $detailSidangSkripsi['nama_reviewer_sempra'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="rekomendasi_nilai">Rekomendasi Kluster Nilai</label>
                            <input class="form-control" id="rekomendasi_nilai" name="rekomendasi_nilai" value="<?= $detailSidangSkripsi['rekomendasi_nilai'] ?>" disabled>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="komentar_sempro">Komentar Seminar Proposal</label>
                            <textarea class="form-control" id="komentar_sempro" name="komentar_sempro" rows="5" disabled><?= $detailSidangSkripsi['komentar_sempro'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="komentar_sempra">Catatan Seminar Prasidang</label>
                            <textarea class="form-control" id="komentar_sempra" name="komentar_sempra" rows="5" disabled><?= $detailSidangSkripsi['komentar_sempra'] ?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <h4 class="text-center">Penilaian Sidang</h4>
                    </div>
                    <div class="row m-3">
                        <div class="col-lg-6">
                            <h5>Penyajian Lisan</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Penyajian sesuai dengan waktu yang disediakan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_1'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_1" name="nilai_1" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_1" name="nilai_1" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_1'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Relevansi penyajian dengan isi skripsi
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_2'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_2" name="nilai_2" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_2" name="nilai_2" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_2'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Cara Penyajian (kelancaran, kejelasan, penampilan/sikap, dll)
                                   <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_3'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_3" name="nilai_3" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_3" name="nilai_3" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_3'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Subtotal</strong>
                                    <input type="text" class="form-control form-control-sm nilai-sidang" id="subtotal1" name="subtotal1" style="width: 13%" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>Teknik dan Sistematika Penulisan</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Kesinambungan antar alinea, antar bab dalam susunan skripsi
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_4'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_4" name="nilai_4" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_4" name="nilai_4" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_4'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Tata cara penulisan kepustakaan dan catatan kaki
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_5'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_5" name="nilai_5" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_5" name="nilai_5" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_5'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Kebersihan dan kerapihan tulisan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_6'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_6" name="nilai_6" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_6" name="nilai_6" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_6'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Subtotal</strong>
                                    <input type="text" class="form-control form-control-sm nilai-sidang" id="subtotal2" name="subtotal2" style="width: 13%" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row m-3">
                        <div class="col-lg-6">
                            <h5>Isi Tulisan</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Kejelasan rumusan penulisan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_7'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_7" name="nilai_7" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_7" name="nilai_7" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_7'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Kesesuaian isi tulisan dengan judul skripsi
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_8'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_8" name="nilai_8" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_8" name="nilai_8" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_8'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Kemampuan membuat analisa dan pembahasan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_9'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_9" name="nilai_9" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_9" name="nilai_9" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_9'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Subtotal</strong>
                                    <input type="text" class="form-control form-control-sm nilai-sidang" id="subtotal3" name="subtotal3" style="width: 13%" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>Tanya Jawab</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Pengetahuan Umum yang berhubungan dengan tulisan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_10'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_10" name="nilai_10" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_10" name="nilai_10" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_10'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Pengetahuan khusus tentang isi tulisan
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_11'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_11" name="nilai_11" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_11" name="nilai_11" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_11'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Ketepatan menjawab
                                    <?php if (count($nilaiSidang) == 0 || $nilaiSidang[0]['nilai_12'] == null): ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_12" name="nilai_12" style="width: 13%">
                                    <?php else: ?>
                                        <input type="text" class="form-control form-control-sm nilai-sidang" id="nilai_12" name="nilai_12" style="width: 13%" value="<?= $nilaiSidang[0]['nilai_12'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Subtotal</strong>
                                    <input type="text" class="form-control form-control-sm nilai-sidang" id="subtotal4" name="subtotal4" style="width: 13%" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-lg-3">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Total
                                    <input type="text" class="form-control form-control-sm" id="total" name="total" style="width: 50%" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Nilai Akhir
                                    <input type="text" class="form-control form-control-sm" id="nilai_akhir" name="nilai_akhir" style="width: 50%" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Grade
                                    <input type="text" class="form-control form-control-sm" id="grade" name="grade" style="width: 50%" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    Status
                                    <input type="text" class="form-control form-control-sm" id="status" name="status" style="width: 50%" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="file_draft_final">Draft Final Skripsi</label>
                            <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_draft_final" style="width: 90%">
                                <iframe class="embed-responsive-item" src="<?= base_url("folderDraftFinal/".$detailSidangSkripsi['file_draft_final']) ?>"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="file_form_bimbingan">Form Bimbingan Skripsi</label>
                            <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_form_bimbingan" style="width: 90%">
                                <iframe class="embed-responsive-item" src="<?= base_url("folderFormBimbingan/".$detailSidangSkripsi['file_form_bimbingan']) ?>"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="form-group">
                            <label for="file_persyaratan_sidang">Persyaratan Sidang</label>
                            <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_persyaratan_sidang" style="width: 90%">
                                <iframe class="embed-responsive-item" src="<?= base_url("folderPersyaratanSidang/".$detailSidangSkripsi['file_persyaratan_sidang']) ?>"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-end">
                        <a role="button" class="btn btn-secondary mr-3" href="<?= base_url("dosen/pengujiSidangSkripsi") ?>">Kembali</a>
                        <button class="btn btn-primary" type="submit" id="submitNilai">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/penilaianSidangSkripsi.js");?>" defer></script>
<?= $this->endSection(); ?>