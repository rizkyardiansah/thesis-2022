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
            <?php if ($proposal == null) : ?>
                <div class="alert alert-danger" role="alert">
                    <small>Kumpulkan <strong>Proposal</strong> terlebih dahulu pada <a href="<?= base_url("mahasiswa/proposal") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif ($proposal['status'] == 'TERTUNDA') : ?>
                <div class="alert alert-info" role="alert">
                    <small>Seminar Proposal Prodi <strong><?= $prodi['inisial'] ?></strong> dilaksanakan secara <strong><?= $prodi['mode_sempro'] ?></strong>. Berikut <strong>Jadwal Seminar Proposal</strong> anda.</small>
                </div>
            <?php elseif ($proposal['status'] == 'DITERIMA'): ?>
                <div class="alert alert-success" role="alert">
                    <small><strong>Seminar Proposal</strong> anda telah <strong>Diterima</strong>. Silahkan isi <strong>Judul Skripsi</strong> anda pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif ($proposal['status'] == 'DITOLAK'): ?>
                <div class="alert alert-danger" role="alert">
                    <small><strong>Seminar Proposal</strong> anda telah <strong>Ditolak</strong>. Silahkan lakukan revisi dan kumpulkan <strong>Proposal Revisi</strong> pada <a href="<?= base_url("mahasiswa/proposal") ?>">Menu Berikut</a> agar bisa melakukan <strong>Seminar Proposal</strong> kembali.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Jadwal Seminar Proposal
        </div>
        <div class="card-body">
            <!-- table sempro -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Seminar</th>
                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <th>Link Konferensi</th>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <th>Ruangan</th>
                        <?php endif; ?>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $counter = 1;
                    foreach($jadwalSempro as $js): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $js['judul'] ?></td>
                            <td class="tanggal"><?= date_format(date_create($js['tanggal']), 'd-m-Y H:i') ?></td>
                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <td class="link_konferensi"><?= $js['link_konferensi'] ?></td>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <td class="ruangan"><?= $js['ruangan'] ?></td>
                        <?php endif; ?>
                        <?php foreach($dosen as $d) : ?>
                            <?php if ($d['id'] == $js['dosen_penguji1']) : ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji1" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                        
                        <?php if ($js['dosen_penguji2'] != null) : ?>
                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $js['dosen_penguji2']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji2" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>             
                        <?php else: ?>
                            <td>-</td>
                        <?php endif; ?>
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
    <script src="<?= base_url("assets/js/mahasiswa/seminarProposal.js");?>"></script>
<?= $this->endSection(); ?>