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
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $detailPengajuan['nama_mahasiswa'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="npm">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm" value="<?= $detailPengajuan['npm'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $detailPengajuan['nama_prodi'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sks_lulus">SKS yang telah lulus</label>
                        <input type="text" class="form-control" id="sks_lulus" name="sks_lulus" value="<?= $detailPengajuan['sks_lulus'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="pembimbing_akademik">Dosen Pembimbing Akademik</label>
                        <input type="text" class="form-control" id="pembimbing_akademik" name="pembimbing_akademik" value="<?= $detailPengajuan['nama_pembimbing_akademik'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mk_sedang_diambil">Matakuliah yang sedang diambil</label>
                        <input type="text" class="form-control" id="mk_sedang_diambil" name="mk_sedang_diambil" value="<?= $detailPengajuan['mk_sedang_diambil'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mk_akan_diambil">Matakuliah yang akan diambil</label>
                        <input type="text" class="form-control" id="mk_akan_diambil" name="mk_akan_diambil" value="<?= $detailPengajuan['mk_akan_diambil'] ?>" disabled>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_khs">File Kartu Hasil Studi</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_khs" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderKhs/".$detailPengajuan['file_khs']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_krs">File Kartu Rencana Studi</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_krs" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderKrs/".$detailPengajuan['file_krs']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="file_persetujuan_skripsi">File Persetujuan Penulisan Skripsi</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_persetujuan_skripsi" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderPersetujuanSkripsi/".$detailPengajuan['file_persetujuan_skripsi']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-end">
                    <a role="button" href="<?= base_url("TenagaKependidikan/pengajuanSkripsi") ?>" class="btn btn-secondary mr-2">Kembali</a>
                    <form action="<?= base_url("TenagaKependidikan/tolakPengajuanSkripsi/".$detailPengajuan['npm']) ?>" method="post" class="d-inline">
                        <button class="btn btn-danger mr-2" type="submit">Tolak Pengajuan</button>
                    </form>
                    <form action="<?= base_url("TenagaKependidikan/terimaPengajuanSkripsi/".$detailPengajuan['npm']) ?>" method="post" class="d-inline">
                        <button class="btn btn-success" type="submit">Setujui Pengajuan</button>
                    </form>
                </div>
           </div>
        </div>
    </div>

   

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/TenagaKependidikan/detailPengajuanSkripsi.js");?>"></script>
<?= $this->endSection(); ?>