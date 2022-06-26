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
                    <form class="form-inline" action="<?= base_url("fakultas/makalah") ?>" method="get">
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
                <table class="table table-bordered" id="kaprodiProposal" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Kata Kunci</th>
                            <th>Bidang</th>
                            <th>Tanggal Pengumpulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($makalah as $m) :
                        ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td><?= $m['npm'] ?></td>
                                <td><?= $m['nama_mahasiswa'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $m['nama_prodi'] ?>"><?= $m['inisial_prodi'] ?></td>
                                <td style="min-width: 10vw"><?= $m['judul'] ?></td>
                                <td style="min-width: 10vw"><?= $m['deskripsi'] ?></td>
                                <td style="min-width: 10vw"><?= $m['kata_kunci'] ?></td>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $m['nama_bidang'] ?>"><?= $m['inisial_bidang'] ?></td>
                                <td style="min-width: 8vw"><?= $m['tanggal_upload'] == null ? "-" : date_format(date_create($m['tanggal_upload']), "d-m-Y") ?></td>
                                <td>    
                                     <?php if ($m['file_makalah'] != null): ?>
                                        <form action="<?= base_url("home/downloadMakalah/".$m['id']) ?>" method="post">
                                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Unduh" data-placement="top"><i class="fas fa-download"></i></button>
                                        </form>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary" disabled><i class="fas fa-download"></i></button>
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
    <script src="<?= base_url("assets/js/fakultas/makalah.js");?>"></script>
<?= $this->endSection(); ?>