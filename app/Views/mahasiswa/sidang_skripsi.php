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
            <?php if ($lastSkripsi == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <small>Kumpulkan <strong>Skripsi</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif (count($lastSkripsi) > 0 && $lastSkripsi['status'] == 'Lulus') : ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        Anda telah dinyatakan <strong>Lulus</strong>. Silahkan kumpulkan <strong>File Final Skripsi</strong> pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.
                    </small>
                </div>
             <?php elseif (count($lastSkripsi) > 0 && $lastSkripsi['status'] == 'Tidak Lulus') : ?>
                <div class="alert alert-info" role="alert">
                    <small>
                        Anda telah dinyatakan <strong>Tidak Lulus</strong>. Silahkan kumpulkan <strong>Proposal</strong> kembali pada <a href="<?= base_url("mahasiswa/proposal") ?>">Menu Berikut</a>.
                    </small>
                </div>
            <?php elseif ($pengajuan == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <small>Buat <strong>Pengajuan Sidang Skripsi</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/pengajuanSidangSkripsi") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif ($pengajuan['status'] != 'DISETUJUI') : ?>
                <div class="alert alert-warning" role="alert">
                    <small>Pastikan <strong>Pengajuan Sidang Skripsi</strong> anda telah <strong>Disetujui</strong>.</small>
                </div>
            <?php elseif ($pengajuan['status'] == 'DISETUJUI'): ?>
                <div class="alert alert-info" role="alert">
                    <small><strong>Jadwal Sidang Skripsi</strong> anda dapat dilihat pada tabel dibawah.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSidangSkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Sidang</th>
                            <th>Ruangan</th>
                            <th>Penguji</th>
                            <th>Pemb. Ilmu 1</th>
                            <th>Pemb. Ilmu 2</th>
                            <th>Pemb. Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $counter = 1;
                    foreach($jadwalSidangSkripsi as $jss): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td style="min-width: 10vw"><?= $jss['judul'] ?></td>
                            <td style="min-width: 8vw"><?= date_format(date_create($jss['tanggal']), 'd-m-Y H:i') ?> WIB</td>
                            <?php if (preg_match('#^https?://#i', $jss['ruangan']) === 1): ?>
                                <td class="ruangan"><a href="<?= $jss['ruangan'] ?>" target="_blank">Klik disini!</a></td>
                            <?php else: ?>
                                <td class="ruangan"><?= $jss['ruangan'] ?></td>
                            <?php endif; ?>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $jss['nama_penguji'] ?>"><?= $jss['inisial_penguji'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $jss['nama_pembimbing1'] ?>"><?= $jss['inisial_pembimbing1'] ?></td>
                            
                            <?php if ($jss['nama_pembimbing2'] != null) : ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $jss['nama_pembimbing2'] ?>"><?= $jss['inisial_pembimbing2'] ?></td>
                            <?php else: ?>
                                <td>-</td>
                            <?php endif; ?>
                                    
                            <td data-toggle="tooltip" data-placement="top" title="<?= $jss['nama_pembimbing_agama'] ?>"><?= $jss['inisial_pembimbing_agama'] ?></td>

                            
                            <td>
                                <a role="button" class="btn btn-primary" href="<?= base_url("mahasiswa/hasilSidangSkripsi/".$jss['id']) ?>">Hasil</a>
                            </td>
                        </tr>
                    <?php
                    $counter++; 
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/sidangSkripsi.js");?>"></script>
<?= $this->endSection(); ?>