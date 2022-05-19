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
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $detailPengajuan['nama_mahasiswa'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm" value="<?= $detailPengajuan['npm'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <textarea class="form-control" id="judul" name="judul" rows="2" disabled><?= $detailPengajuan['judul'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pembimbing1">Pembimbing Ilmu</label>
                        <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailPengajuan['nama_pembimbing1'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pembimbingAgama">Pembimbing Agama</label>
                        <input type="text" class="form-control" id="pembimbingAgama" name="pembimbingAgama" value="<?= $detailPengajuan['nama_pembimbing_agama'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sifat">Sifat Penelitian</label>
                        <input type="text" class="form-control" id="sifat" name="sifat" value="<?= $detailPengajuan['sifat'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sumber">Sumber Penelitian</label>
                        <input type="text" class="form-control" id="sumber" name="sumber" value="<?= $detailPengajuan['sumber'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_draft">File Draft</label>
                        <div class="embed-responsive embed-responsive-16by9" id="file_draft" style="width: 85%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderDraft/".$detailPengajuan['file_draft']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="lembar_persetujuan">Lembar Persetujuan Seminar Prasidang</label>
                        <div class="embed-responsive embed-responsive-16by9" id="lembar_persetujuan" style="width: 85%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderLembarPersetujuanPrasidang/".$detailPengajuan['lembar_persetujuan']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-end">
                    <form action="<?= base_url("dosen/tolakPengajuanPrasidang/".$detailPengajuan['id']) ?>" method="post" class="d-inline">
                        <button class="btn btn-danger mr-2" type="submit">Tolak Pengajuan</button>
                    </form>
                    <form action="<?= base_url("dosen/setujuiPengajuanPrasidang/".$detailPengajuan['id']) ?>" method="post" class="d-inline">
                        <button class="btn btn-success" type="submit">Setujui Pengajuan</button>
                    </form>
                </div>
           </div>
        </div>
    </div>

   

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/dosen/pengajuanPraSidang.js");?>"></script>
<?= $this->endSection(); ?>