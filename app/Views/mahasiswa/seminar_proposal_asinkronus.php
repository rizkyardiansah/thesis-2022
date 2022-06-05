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
            <?php elseif ($proposal['status'] == 'TERTUNDA' && (count($jadwalSempro) == 0 || $jadwalSempro[count($jadwalSempro)-1]['id_proposal'] != $proposal['id'])) : ?>
                <div class="alert alert-info" role="alert">
                    <small>Seminar Proposal Prodi <strong><?= $prodi['inisial'] ?></strong> dilaksanakan secara <strong><?= $prodi['mode_sempro'] ?></strong>. Silahkan kumpulkan <strong>Video Proposal</strong>.</small>
                </div>
            <?php elseif ($proposal['status'] == 'TERTUNDA' && $jadwalSempro[count($jadwalSempro)-1]['id_proposal'] == $proposal['id']): ?>
                <div class="alert alert-info" role="alert">
                    <small><strong>Video Seminar Proposal</strong> anda telah<strong>Terkirim</strong>. Dosen penguji akan memeriksa <strong>Video Seminar Proposal</strong> anda.</small>
                </div>
            <?php elseif ($proposal['status'] == 'DITERIMA' || $proposal['status'] == 'REVISI'): ?>
                <div class="alert alert-success" role="alert">
                    <small><strong>Video Seminar Proposal</strong> anda telah <strong>Diterima</strong>. Silahkan isi <strong>Judul Skripsi</strong> anda pada <a href="<?= base_url("mahasiswa/skripsi") ?>">Menu Berikut</a>.</small>
                </div>
            <?php elseif ($proposal['status'] == 'DITOLAK'): ?>
                <div class="alert alert-danger" role="alert">
                    <small><strong>Video Seminar Proposal</strong> anda telah <strong>Ditolak</strong>. Silahkan lakukan revisi dan kumpulkan <strong>Proposal Revisi</strong> pada <a href="<?= base_url("mahasiswa/proposal") ?>">Menu Berikut</a> dan lakukan <strong>Pengumpulan Ulang Video Seminar Proposal</strong>.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Kantung Pengumpulan Video Seminar Proposal
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-4 d-flex align-items-center">
                    <?php if ($proposal == null || ($proposal['status'] == 'TERTUNDA' && count($jadwalSempro) != 0 && $jadwalSempro[count($jadwalSempro)-1]['id_proposal'] == $proposal['id']) || $proposal['status'] == 'DITERIMA') : ?>
                        <button class="btn btn-primary" disabled>Kumpulkan Video Seminar Proposal</button>
                    <?php elseif ($proposal['status'] == 'DITOLAK' || ($proposal['status'] == 'TERTUNDA' && (count($jadwalSempro) == 0 || $jadwalSempro[count($jadwalSempro)-1]['id_proposal'] != $proposal['id']))): ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#pengumpulanVideo">Kumpulkan Video Seminar Proposal</button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- table sempro -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th>Judul</th>
                            <th>Link Video</th>
                            <th class="text-center align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $counter = 1;
                    foreach($jadwalSempro as $js): ?>
                        <tr>
                            <td class="text-center align-middle"><?= $counter ?></td>
                            <td class="judul align-middle" data-id="<?= $js['id_proposal'] ?>"><?= $js['judul'] ?></td>
                            <td class="link_video align-middle"><?= $js['link_video'] ?></td>
                            <td class="text-center align-middle">
                                <?php if ($js['editable']) : ?>
                                    <button class="btn btn-primary ubah-jadwal" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $js['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <?php else : ?>
                                    <button class="btn btn-primary ubah-jadwal" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $js['id'] ?>" disabled><i class="fas fa-pencil-alt"></i></button>
                                <?php endif; ?>
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

    <!-- modal tambah proposal -->
    <?php if ($proposal != null) : ?>
        <div class="modal fade" id="pengumpulanVideo" tabindex="-1" role="dialog" aria-labelledby="pengumpulanVideoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengumpulanVideoLabel">Pengumpulan Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url("mahasiswa/insertVideoSempro") ?>" method="post" id="formPengumpulanVideo">
                        <input type="hidden" name="id_proposal" id="id_proposal" value="<?= $proposal['id'] ?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="judul">Judul Proposal</label>
                                        <textarea class="form-control" id="judul" name="judul" disabled><?= $proposal['judul'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="link_video">Link Video Seminar Proposal</label>
                                        <textarea class="form-control" id="link_video" name="link_video" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/seminarProposal.js");?>"></script>
<?= $this->endSection(); ?>