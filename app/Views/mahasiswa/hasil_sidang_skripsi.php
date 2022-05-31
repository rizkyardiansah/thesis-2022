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
            <?php if (count($nilaiPembimbing1) == 0 && ($pembimbingIlmu2[0]['id_dosen'] == null || ($pembimbingIlmu2[0]['id_dosen'] != null && count($nilaiPembimbing2) == 0)) && count($nilaiPembimbingAgama) == 0 && count($nilaiPenguji) == 0): ?>
                <div class="alert alert-warning" role="alert">
                    <small>
                        Nilai yang ada lihat saat ini masih belum lengkap.
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                   <div class="form-group">
                        <label for="judul">Judul Skripsi</label>
                        <textarea name="judul" id="judul" rows="2" class="form-control" disabled><?= $lastSkripsi['judul'] ?></textarea>
                    </div>
                </div>
                <div class="col-3">
                   <div class="form-group">
                        <label for="penguji">Penguji Ilmu</label>
                        <input type="text" name="penguji" id="penguji" class="form-control" value="<?= $penguji['nama'] ?>" disabled>
                    </div>
                </div>
                <div class="col-3">
                   <div class="form-group">
                        <label for="pembimbing1">Pembimbing Ilmu 1</label>
                        <input type="text" name="pembimbing1" id="pembimbing1" class="form-control" value="<?= $pembimbingIlmu1[0]['nama_dosen'] ?>" disabled>
                    </div>
                </div>
                <div class="col-3">
                   <div class="form-group">
                        <label for="pembimbing2">Pembimbing Ilmu 2</label>
                        <?php if ($pembimbingIlmu2[0]['id_dosen'] == null): ?>
                            <input type="text" name="pembimbing2" id="pembimbing2" class="form-control" value="-" disabled>
                        <?php else: ?>
                            <input type="text" name="pembimbing2" id="pembimbing2" class="form-control" value="<?= $pembimbingIlmu2[0]['nama_dosen'] ?>" disabled>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-3">
                   <div class="form-group">
                        <label for="pembimbingAgama">Pembimbing Agama</label>
                        <input type="text" name="pembimbingAgama" id="pembimbingAgama" class="form-control" value="<?= $pembimbingAgama[0]['nama_dosen'] ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <h4>Nilai Sidang Skripsi</h4>
                <table class="table table-bordered table-sm" id="hasilNilaiSidang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center text-dark">Aspek</th>
                            <th class="text-center text-dark">Penguji Ilmu</th>
                            <th class="text-center text-dark">Pembimbing Ilmu 1</th>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <th class="text-center text-dark">Pembimbing Ilmu 2</th>
                            <?php endif; ?>
                            <th class="text-center text-dark">Pembimbing Agama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <td colspan="5" class="bg-secondary text-white">Aspek Penyajian Lisan</td>
                            <?php else: ?>
                                <td colspan="4" class="bg-secondary text-white">Aspek Penyajian Lisan</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Penyajian sesuai dengan waktu yang disediakan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_1'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_1'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_1'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_1'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Relevansi penyajian dengan isi skripsi</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_2'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_2'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_2'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_2'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Cara Penyajian (Kelancaran, kejelasan, penampilan/sikap dll)</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_3'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_3'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_3'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_3'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <td colspan="5" class="bg-secondary text-white">Teknik dan Sistematika Penulisan</td>
                            <?php else: ?>
                                <td colspan="4" class="bg-secondary text-white">Teknik dan Sistematika Penulisan</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kesinambungan antara alinea, antar bab dalam susunan skripsi</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_4'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_4'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_4'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_4'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Tata cara penulisan kepustakaan dan catatan kaki</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_5'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_5'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_5'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_5'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kebersihan dan kerapihan tulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_6'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_6'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_6'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_6'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <td colspan="5" class="bg-secondary text-white">Aspek Isi Tulisan</td>
                            <?php else: ?>
                                <td colspan="4" class="bg-secondary text-white">Aspek Isi Tulisan</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kejelasan rumusan penulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_7'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_7'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_7'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_7'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kesesuaian isi tulisan dengan judul skripsi</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_8'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_8'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_8'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_8'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kemampuan membuat analisa dan pembahasan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_9'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_9'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_9'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_9'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <td colspan="5" class="bg-secondary text-white">Aspek Tanya Jawab</td>
                            <?php else: ?>
                                <td colspan="4" class="bg-secondary text-white">Aspek Tanya Jawab</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Pengetahuan Umum yang berhubungan dengan tulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_10'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_10'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_10'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_10'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Pengetahuan khusus tentang isi tulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_11'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_11'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_11'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_11'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Ketepatan menjawab</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPenguji[0]['nilai_12'] ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbing1[0]['nilai_12'] ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center">-</td>
                                <?php else: ?>
                                    <td class="text-center"><?= $nilaiPembimbing2[0]['nilai_12'] ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center">-</td>
                            <?php else: ?>
                                <td class="text-center"><?= $nilaiPembimbingAgama[0]['nilai_12'] ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Nilai Akhir</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPenguji[0]['nilai_akhir'] ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing1[0]['nilai_akhir'] ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing2[0]['nilai_akhir'] ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbingAgama[0]['nilai_akhir'] ?></strong></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Grade</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPenguji[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing1[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing2[0]['grade'] ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbingAgama[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Status</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPenguji[0]['status'] ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing1[0]['status'] ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbing2[0]['status'] ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold"><strong><?= $nilaiPembimbingAgama[0]['status'] ?></strong></td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if (count($nilaiPembimbing1) == 1 && ($pembimbingIlmu2[0]['id_dosen'] == null || ($pembimbingIlmu2[0]['id_dosen'] != null && count($nilaiPembimbing2) == 1)) && count($nilaiPembimbingAgama) == 1 && count($nilaiPenguji) == 1): ?>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <h3>Anda dinyatakan <strong><?= $sidangSkripsi['status'] ?></strong> dengan total nilai <strong><?= $sidangSkripsi['total_nilai'] ?> (<?= $sidangSkripsi['grade'] ?>)</strong></h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/hasilSidangSkripsi.js");?>"></script>
<?= $this->endSection(); ?>