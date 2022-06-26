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
                    <form class="form-inline" action="<?= base_url("dosen/pengujiSeminarPrasidang") ?>" method="get">
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
            <!-- table sempro -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalPengujiSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Tanggal Seminar</th>
                            <th>Ruangan</th>
                            <th>Reviewer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($seminarPrasidang as $sp): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td class="npm"><?= $sp['npm'] ?></td>
                            <td><?= $sp['nama_mahasiswa'] ?></td>
                            <td style="min-width: 10vw"><?= $sp['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_bidang'] ?>"><?= $sp['inisial_bidang'] ?></td>

                            <td class="tanggal" style="min-width: 8vw"><?= date_format(date_create($sp['tanggal']), 'd-m-Y H:i') ?> WIB</td>

                            <?php if (preg_match('#^https?://#i', $sp['ruangan']) === 1): ?>
                                <td class="ruangan"><a href="<?= $sp['ruangan'] ?>" target="_blank">Klik disini!</a></td>
                            <?php else: ?>
                                <td class="ruangan"><?= $sp['ruangan'] ?></td>
                            <?php endif; ?>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_reviewer'] ?>" class="reviewer"><?= $sp['inisial_reviewer'] ?></td>
                            
                            <td>
                                <a class="btn btn-primary" href="<?= base_url("dosen/reviewSeminarPrasidang/".$sp['id']) ?>" data-toggle="tooltip" title="Review"><i class="fas fa-clipboard-list"></i></a>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/pengujiSeminarPrasidang.js");?>" defer></script>
<?= $this->endSection(); ?>