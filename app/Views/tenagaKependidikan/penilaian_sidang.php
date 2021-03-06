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
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePenilaianSidang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th class="text-center">Nama</th>
                            <th>Program Studi</th>
                            <th>Judul</th>
                            <th>Tanggal Sidang</th>
                            <th>Ruangan</th>
                            <th>Penguji</th>
                            <th>Total Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($mahasiswa as $mhs): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $mhs['npm'] ?></td>
                            <td><?= $mhs['nama_mahasiswa'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mhs['nama_prodi'] ?>"><?= $mhs['inisial_prodi'] ?></td>
                            <td><?= $mhs['judul'] ?></td>
                            <td style="min-width: 7vw;"><?= date_format(date_create($mhs['tanggal']), 'd-m-Y H:i') ?> WIB</td>
                            <?php if (preg_match('#^https?://#i', $mhs['ruangan']) === 1): ?>
                                <td class="ruangan"><a href="<?= $mhs['ruangan'] ?>" target="_blank">Link Zoom</a></td>
                            <?php else: ?>
                                <td class="ruangan"><?= $mhs['ruangan'] ?></td>
                            <?php endif; ?>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mhs['nama_penguji'] ?>"><?= $mhs['inisial_penguji'] ?></td>
                            <td><?= number_format($mhs['total_nilai'], 2, ',', '') ?></td>
                            <td><?= $mhs['status'] == null ? 'TERTUNDA' : $mhs['status'] ?></td>
                            <td style="min-width: 7vw">
                                <a role="button" class="btn btn-primary" href="<?= base_url("TenagaKependidikan/hasilSidangSkripsi/".$mhs['id_skripsi']) ?>" data-toggle="tooltip" title="Hasil Sidang Skripsi" data-placement="top"><i class="fas fa-clipboard-list"></i></a>
                                <?php if($mhs['status'] != null): ?>
                                    <a role="button" class="btn btn-primary" href="<?= base_url("TenagaKependidikan/cetakBeritaAcara/".$mhs['id_skripsi']) ?>" target="_blank" data-toggle="tooltip" title="Print Berita Acara" data-placement="top"><i class="fas fa-print"></i></a>
                                <?php else: ?>
                                    <button class="btn btn-primary" disabled><i class="fas fa-print"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/tenagakependidikan/penilaianSidang.js");?>"></script>
<?= $this->endSection(); ?>