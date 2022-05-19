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
            <!-- table sempro -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalPengujiSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                        <?php if ($prodi['mode_sempro'] != 'Asinkronus') : ?>
                            <th>Tanggal Seminar</th>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <th>Link Konferensi</th>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <th>Ruangan</th>
                        <?php elseif ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <th>Video</th>
                        <?php endif; ?>
                        
                        <?php if ($prodi['mode_sempro'] != 'Asinkronus') : ?>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                        <?php endif; ?>
                            <th>Status</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($seminarProposal as $sm): ?>
                        <tr>
                            <td class="npm"><?= $sm['npm'] ?></td>
                            <td><?= $sm['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $sm['nama_bidang'] ?>"><?= $sm['inisial_bidang'] ?></td>

                        <?php if ($prodi['mode_sempro'] != 'Asinkronus') : ?>
                            <td class="tanggal"><?= date_format(date_create($sm['tanggal']), 'd-m-Y H:i') ?></td>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <td class="link_konferensi"><?= $sm['link_konferensi'] ?></td>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <td class="ruangan"><?= $sm['ruangan'] ?></td>
                        <?php elseif ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <td class="link_video"><a href="<?= $sm['link_video'] ?>">Klik disini!</a></td>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] != 'Asinkronus') : ?>
                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $sm['dosen_penguji1']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji1" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($sm['dosen_penguji2'] != null) :?>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $sm['dosen_penguji2']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji2" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else:?>
                                <td>-</td>
                            <?php endif; ?>
                        <?php endif; ?>

                            <td class="status"><?= $sm['status'] != 'TERTUNDA' ? $sm['status'] : "-" ?></td>
                            <td class="komentar"><?= $sm['komentar'] != null ? $sm['komentar'] : "-" ?></td>

                            <td>
                                <form action="<?= base_url("mahasiswa/downloadProposal/".$sm['id_proposal']) ?>" method="post" class="d-inline">
                                    <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="top" title="Unduh Proposal"><i class="fa fa-download" aria-hidden="true"></i></button>
                                </form>
                                <?php if ($sm['status'] == 'TERTUNDA' && $sm['komentar'] == null) : ?>
                                    <button class="btn btn-primary buat-nilai" data-toggle="tooltip" data-placement="top" title="Beri Penilaian" data-id="<?= $sm['id'] ?>"><i class="fa fa-comment" aria-hidden="true"></i></button>
                                <?php else: ?>
                                    <button class="btn btn-primary buat-nilai" data-toggle="tooltip" data-placement="top" title="Beri Penilaian" disabled ><i class="fa fa-comment" aria-hidden="true"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal untuk menilai seminar proposal -->
    <div class="modal fade" id="penilaianSempro" tabindex="-1" role="dialog" aria-labelledby="penilaianSemproLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penilaianSemproLabel">Penilaian Seminar Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formPenilaianSempro">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" id="komentar" name="komentar" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Status Proposal</label>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusDiterima" value="DITERIMA">
                                        <label class="form-check-label" for="statusDiterima">Diterima</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusRevisi" value="REVISI">
                                        <label class="form-check-label" for="statusRevisi">Revisi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="statusDitolak" value="DITOLAK">
                                        <label class="form-check-label" for="statusDitolak">Ditolak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/pengujiSeminarProposal.js");?>" defer></script>
<?= $this->endSection(); ?>