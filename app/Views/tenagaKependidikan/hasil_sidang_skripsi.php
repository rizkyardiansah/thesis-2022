<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= $mahasiswa['nama'] ?>" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" id="npm" name="npm" class="form-control" value="<?= $mahasiswa['npm'] ?>" disabled>
                    </div>
                </div>
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
                            <th class="text-center text-dark align-middle">Aspek</th>
                            <th class="text-center text-dark align-middle">Penguji Ilmu</th>
                            <th class="text-center text-dark align-middle">Pembimbing Ilmu 1</th>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <th class="text-center text-dark align-middle">Pembimbing Ilmu 2</th>
                            <?php endif; ?>
                            <th class="text-center text-dark align-middle">Pembimbing Agama</th>
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
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_1'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_1'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_1'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_1'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Relevansi penyajian dengan isi skripsi</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_2'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_2'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_2'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_2'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Cara Penyajian (Kelancaran, kejelasan, penampilan/sikap dll)</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_3'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_3'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_3'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_3'], 2, ".", "") ?></td>
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
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_4'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_4'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_4'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_4'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Tata cara penulisan kepustakaan dan catatan kaki</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_5'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_5'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_5'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_5'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kebersihan dan kerapihan tulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_6'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_6'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_6'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_6'], 2, ".", "") ?></td>
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
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_7'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_7'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_7'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_7'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kesesuaian isi tulisan dengan judul skripsi</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_8'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_8'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_8'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_8'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Kemampuan membuat analisa dan pembahasan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_9'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_9'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_9'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_9'], 2, ".", "") ?></td>
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
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_10'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_10'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_10'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_10'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Pengetahuan khusus tentang isi tulisan</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_11'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_11'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_11'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_11'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Ketepatan menjawab</td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPenguji[0]['nilai_12'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbing1[0]['nilai_12'], 2, ".", "") ?></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center align-middle">-</td>
                                <?php else: ?>
                                    <td class="text-center align-middle"><?= number_format($nilaiPembimbing2[0]['nilai_12'], 2, ".", "") ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center align-middle">-</td>
                            <?php else: ?>
                                <td class="text-center align-middle"><?= number_format($nilaiPembimbingAgama[0]['nilai_12'], 2, ".", "") ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Nilai Akhir</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= number_format($nilaiPenguji[0]['nilai_akhir'], 2, ".", "") ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= number_format($nilaiPembimbing1[0]['nilai_akhir'], 2, ".", "") ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong><?= number_format($nilaiPembimbing2[0]['nilai_akhir'], 2, ".", "") ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= number_format($nilaiPembimbingAgama[0]['nilai_akhir'], 2, ".", "") ?></strong></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Grade</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPenguji[0]['grade'] == null ? "-" : $nilaiPenguji[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbing1[0]['grade'] == null ? "-" : $nilaiPembimbing1[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbing2[0]['grade'] == null ? "-" : $nilaiPembimbing2[0]['grade'] ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbingAgama[0]['grade'] == null ? "-" : $nilaiPembimbingAgama[0]['grade'] ?></strong></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-dark font-weight-bold"><strong>Status</strong></td>
                            <?php if(count($nilaiPenguji) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPenguji[0]['status'] ?></strong></td>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbing1) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbing1[0]['status'] ?></strong></td>
                            <?php endif; ?>
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <?php if(count($nilaiPembimbing2) == 0): ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                                <?php else: ?>
                                    <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbing2[0]['status'] ?></strong></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(count($nilaiPembimbingAgama) == 0): ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong>-</strong></td>
                            <?php else: ?>
                                <td class="text-center text-dark font-weight-bold align-middle"><strong><?= $nilaiPembimbingAgama[0]['status'] ?></strong></td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if (count($nilaiPembimbing1) == 1 && ($pembimbingIlmu2[0]['id_dosen'] == null || ($pembimbingIlmu2[0]['id_dosen'] != null && count($nilaiPembimbing2) == 1)) && count($nilaiPembimbingAgama) == 1 && count($nilaiPenguji) == 1): ?>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <h3>Dinyatakan <strong><?= $sidangSkripsi['status'] ?></strong> dengan total nilai <strong><?= number_format($sidangSkripsi['total_nilai'], 2, ".", "") ?> (<?= $sidangSkripsi['grade'] == null ? "-" : $sidangSkripsi['grade'] ?>)</strong></h3>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-12 my-2 d-flex justify-content-end">
                <a class="btn btn-secondary mr-2" role="button" href="<?= base_url("TenagaKependidikan/penilaianSidang") ?>">Kembali</a>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<?= $this->endSection(); ?>