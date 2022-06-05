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
                    <form class="form-inline" action="<?= base_url("dosen/pengujiSidangSkripsi") ?>" method="get">
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
                <table class="table table-bordered" id="jadwalPengujiSidang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
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
                    <?php $counter = 1; ?>
                    <?php foreach($sidangSkripsi as $ss): ?>
                        <tr>
                            <td><?= $counter; ?></td>
                            <td class="npm"><?= $ss['npm'] ?></td>
                            <td><?= $ss['nama_mahasiswa'] ?></td>
                            <td><?= $ss['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_bidang'] ?>"><?= $ss['inisial_bidang'] ?></td>

                            <td class="tanggal" style="min-width: 10vw"><?= date_format(date_create($ss['tanggal']), 'd-m-Y H:i') ?> WIB</td>

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
                                <a class="btn btn-primary" href="<?= base_url("dosen/penilaianSidangSkripsi/".$ss['id']) ?>" data-toggle="tooltip" title="Penilaian"><i class="fas fa-clipboard-list"></i></a>
                            </td>
                        </tr>
                        <?php $counter++ ?>
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