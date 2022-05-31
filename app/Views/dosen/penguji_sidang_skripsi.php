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
                <table class="table table-bordered" id="jadwalPengujiSidang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Tanggal Sidang</th>
                            <th>Ruangan</th>
                            <th>Penguji</th>
                            <th>Pembimbing Ilmu 1</th>
                            <th>Pembimbing Ilmu 2</th>
                            <th>Pembimbing Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($sidangSkripsi as $ss): ?>
                        <tr>
                            <td class="npm"><?= $ss['npm'] ?></td>
                            <td><?= $ss['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_bidang'] ?>"><?= $ss['inisial_bidang'] ?></td>

                            <td class="tanggal"><?= date_format(date_create($ss['tanggal']), 'd-m-Y H:i') ?></td>

                            <td class="ruangan"><?= $ss['ruangan'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_penguji'] ?>" class="dosen_penguji"><?= $ss['inisial_penguji'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing1'] ?>" class="pembimbing1"><?= $ss['inisial_pembimbing1'] ?></td>

                            <?php if ($ss['nama_pembimbing2'] != null): ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing2'] ?>" class="pembimbing2"><?= $ss['inisial_pembimbing2'] ?></td>
                            <?php else: ?>
                                <td>-</td>
                            <?php endif; ?>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing_agama'] ?>" class="pembimbing_agama"><?= $ss['inisial_pembimbing_agama'] ?></td>

                            <td>
                                <a class="btn btn-primary" href="<?= base_url("dosen/penilaianSidangSkripsi/".$ss['id']) ?>">Penilaian</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/pengujiSidangSkripsi.js");?>" defer></script>
<?= $this->endSection(); ?>