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
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("fakultas/skripsi") ?>" method="get">
                        <div class="form-group mr-2">
                            <label for="dari" class="form-control-label mr-1">Dari</label>
                            <input type="date" id="dari" name="dari" class="form-control" placeholder="dari">
                        </div>
                        <div class="form-group mr-2">
                            <label for="hingga" class="form-control-label mr-1">Hingga</label>
                            <input type="date" class="form-control" id="hingga" name="hingga" placeholder="hingga">
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Filter Table" id="filterTable"><i class="fas fa-filter"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="skripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Sifat Penelitian</th>
                            <th>Sumber Penelitian</th>
                            <th>Pembimbing Ilmu 1</th>
                            <th>Pembimbing Ilmu 2</th>
                            <th>Pembimbing Agama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Berkas Skripsi</th>
                            <th>Berkas Makalah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($skripsi as $s) :
                        ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td><?= $s['npm'] ?></td>
                                <td><?= $s['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_prodi'] ?>"><?= $s['inisial_prodi'] ?></td>
                                <td style="min-width: 10vw"><?= $s['judul'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_bidang'] ?>"><?= $s['inisial_bidang'] ?></td>
                                <td><?= $s['sifat'] ?></td>
                                <td><?= $s['sumber'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_pembimbing1'] ?>"><?= $s['inisial_pembimbing1'] ?></td>
                                <?php if ($s['tanggal_selesai_skripsi'] == null) : ?>
                                    <td>-</td>
                                <?php else: ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_pembimbing2'] ?>"><?= $s['inisial_pembimbing2'] ?></td>
                                <?php endif; ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $s['nama_pembimbing_agama'] ?>"><?= $s['inisial_pembimbing_agama'] ?></td>
                                <td style="min-width: 8vw"><?= date_format(date_create($s['tanggal_skripsi']), "d-m-Y") ?></td>
                                <?php if ($s['tanggal_selesai_skripsi'] == null) : ?>
                                    <td style="min-width: 8vw">-</td>
                                <?php else: ?>
                                    <td style="min-width: 8vw"><?= date_format(date_create($s['tanggal_selesai_skripsi']), "d-m-Y") ?></td>
                                <?php endif ?>
                                <td>
                                    <?php if($s['status'] == 'Lulus' && $s['file_skripsi'] != null): ?>
                                        Sudah diunggah
                                    <?php elseif ($s['status'] == 'Lulus' && $s['file_skripsi'] == null): ?>
                                        Belum diunggah
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                 <td>
                                    <?php if($s['status'] == 'Lulus' && $s['id_makalah'] != null): ?>
                                        Sudah diunggah
                                    <?php elseif ($s['status'] == 'Lulus' && $s['id_makalah'] == null): ?>
                                        Belum diunggah
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= $s['status'] ?></td>
                                <td style="min-width: 7vw">
                                    <?php if($s['file_skripsi'] != null): ?>
                                        <form action="<?= base_url("mahasiswa/downloadSkripsi/".$s['id']) ?>" method="post" style="display: inline;">
                                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Unduh berkas skripsi" data-placement="top"><i class="fas fa-download"></i></button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-primary" disabled><i class="fas fa-download"></i></button>
                                    <?php endif; ?>
                                    <?php if($s['status'] == 'Lulus'): ?>
                                        <a role="button" class="btn btn-primary" href="<?= base_url("fakultas/hasilSidangSkripsi/".$s['id']) ?>" data-toggle="tooltip" title="Hasil Sidang Skripsi" data-placement="top"><i class="fas fa-clipboard-list"></i></a>
                                    <?php else: ?>
                                        <button class="btn btn-primary" disabled><i class="fas fa-clipboard-list"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php 
                        $counter++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/fakultas/skripsi.js");?>"></script>
<?= $this->endSection(); ?>