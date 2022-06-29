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
                    <form class="form-inline" action="<?= base_url("Kaprodi/proposal") ?>" method="get">
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
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Sifat Penelitian</th>
                            <th>Sumber Penelitian</th>
                            <th>Dosen Usulan 1</th>
                            <th>Dosen Usulan 2</th>
                            <th>Tanggal Pengumpulan</th>
                            <th>Status</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($proposal as $p) :
                        ?>
                            <tr>
                                <td><?= $counter; ?></td>
                                <td><?= $p['npm'] ?></td>
                                <td><?= $p['nama_mahasiswa'] ?></td>
                                <td style="min-width: 10vw"><?= $p['judul'] ?></td>
                                <?php foreach($bidang as $b) : ?>
                                    <?php if ($b['id'] == $p['id_bidang']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $b['nama'] ?>"><?= $b['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?= $p['sifat'] ?></td>
                                <td><?= $p['sumber'] ?></td>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $p['dosen_usulan1']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $p['dosen_usulan2']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td style="min-width: 8vw"><?= date_format(date_create($p['tanggal_upload']), "d-m-Y") ?></td>
                                <td><?= $p['status'] ?></td>
                                <td><?= ($p['komentar'] == null) ? "-": $p['komentar'] ?></td>
                                <td>
                                    <form action="<?= base_url("mahasiswa/downloadProposal/".$p['id']) ?>" method="post">
                                        <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Unduh" data-placement="top"><i class="fas fa-download"></i></button>
                                    </form>
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
    <script src="<?= base_url("assets/js/kaprodi/proposal.js");?>"></script>
<?= $this->endSection(); ?>