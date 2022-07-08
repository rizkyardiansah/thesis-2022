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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input class="form-control" id="npm" name="npm" value="<?= $mahasiswa['npm'] ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="hasilBimbingan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Bimbingan</th>
                            <th>Materi Konsultasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($catatanBimbingan as $cb) : ?>
                            <tr>
                                <td><?= $counter ?></td>
                                <td><?= date_format(date_create($cb['tanggal_bimbingan']), 'd-m-Y') ?></td>
                                <td><?= $cb['hasil_bimbingan'] ?></td>
                                <td><?= $cb['status'] ?></td>
                                <td style="min-width: 8vw;">
                                    <?php if ($cb['status'] == 'TERTUNDA'): ?>
                                        <form action="<?= base_url("dosen/setujuiBimbingan/".$cb['id']) ?>" method="post" class="d-inline">
                                            <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Setujui"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                        </form>
                                        <form action="<?= base_url("dosen/tolakBimbingan/".$cb['id']) ?>" method="post" class="d-inline">
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Setujui" disabled><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Tolak" disabled><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <a role="button" href="<?= base_url("dosen/bimbingan") ?>"class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/detailBimbingan.js");?>"></script>
<?= $this->endSection(); ?>