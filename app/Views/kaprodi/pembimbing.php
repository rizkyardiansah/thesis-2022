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
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePembimbing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Pemb. Ilmu 1</th>
                            <th>Pemb. Ilmu 2</th>
                            <th>Pemb. Agama</th>
                            <th>Jumlah Bimbingan Ilmu 1</th>
                            <th>Jumlah Bimbingan Ilmu 2</th>
                            <th>Jumlah Bimbingan Agama</th>
                            <th>Total Bimbingan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($pembimbing as $mpp): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $mpp['npm'] ?></td>
                            <td><?= $mpp['nama_mahasiswa'] ?></td>
                            <td><?= $mpp['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_bidang'] ?>"><?= $mpp['inisial_bidang'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_pembimbing_1'] ?>"><?= $mpp['inisial_pembimbing_1'] ?></td>
                            
                            <?php if ($mpp['nama_pembimbing_2']) : ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_pembimbing_2'] ?>"><?= $mpp['inisial_pembimbing_2'] ?></td>
                            <?php else : ?>
                                <td>-</td>
                            <?php endif; ?>
                                    
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_pembimbing_agama'] ?>"><?= $mpp['inisial_pembimbing_agama'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['jumlah_bimbingan_1'] ?> kali bimbingan dengan Pembimbing Ilmu 1"><?= $mpp['jumlah_bimbingan_1'] ?></td>
                            <?php if ($mpp['nama_pembimbing_2']) : ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['jumlah_bimbingan_2'] ?> kali bimbingan dengan Pembimbing Ilmu 2"><?= $mpp['jumlah_bimbingan_2'] ?></td>
                            <?php else : ?>
                                <td>-</td>
                            <?php endif; ?>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['jumlah_bimbingan_agama'] ?> kali bimbingan dengan Pembimbing Agama"><?= $mpp['jumlah_bimbingan_agama'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['total_bimbingan'] ?> kali bimbingan" class="totalBimbingan"><?= $mpp['total_bimbingan'] ?></td>
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
    <script src="<?= base_url("assets/js/kaprodi/pembimbing.js");?>"></script>
<?= $this->endSection(); ?>