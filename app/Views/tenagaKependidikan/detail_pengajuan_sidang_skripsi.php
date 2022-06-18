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
                       <input type="text" class="form-control" id="nama" name="nama" value=<?= $detailPengajuan['nama_mahasiswa'] ?> disabled>
                   </div>
               </div>
               <div class="col-lg-6">
                   <div class="form-group">
                       <label for="npm">NPM</label>
                       <input type="text" class="form-control" id="npm" name="npm" value=<?= $detailPengajuan['npm'] ?> disabled>
                   </div>
               </div>
               <div class="col-lg-12">
                   <div class="form-group">
                       <label for="judul">Judul</label>
                       <textarea name="judul" id="judul" rows="2" class="form-control" disabled><?= $detailPengajuan['judul'] ?></textarea>
                   </div>
               </div>
               <div class="col-lg-4">
                   <div class="form-group">
                       <label for="pembimbing1">Pembimbing Ilmu 1</label>
                       <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $detailPengajuan['nama_pembimbing1'] ?>" disabled>
                   </div>
               </div>
               <div class="col-lg-4">
                   <div class="form-group">
                       <label for="pembimbing2">Pembimbing Ilmu 2</label>
                       <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $detailPengajuan['nama_pembimbing2'] == null ? "-" : $detailPengajuan['nama_pembimbing2'] ; ?>" disabled>
                   </div>
               </div>
               <div class="col-lg-4">
                   <div class="form-group">
                       <label for="pembimbing_agama">Pembimbing Agama</label>
                       <input type="text" class="form-control" id="pembimbing_agama" name="pembimbing_agama" value="<?= $detailPengajuan['nama_pembimbing_agama'] ?>" disabled>
                   </div>
               </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_draft_final">Draft Final</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_draft_final" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderDraftFinal/".$detailPengajuan['file_draft_final']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_form_bimbingan">Form Bimbingan Skripsi</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_form_bimbingan" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderFormBimbingan/".$detailPengajuan['file_form_bimbingan']) ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="file_persyaratan_sidang">Kelengkapan Persyaratan Sidang Skripsi</label>
                        <div class="embed-responsive embed-responsive-16by9 mx-auto" id="file_persyaratan_sidang" style="width: 90%">
                            <iframe class="embed-responsive-item" src="<?= base_url("folderPersyaratanSidang/".$detailPengajuan['file_persyaratan_sidang']) ?>"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 d-flex justify-content-end">
                    <a role="button" href="<?= base_url("TenagaKependidikan/pengajuanSidangSkripsi") ?>" class="btn btn-secondary mr-2">Kembali</a>
                    <?php if ($detailPengajuan['status'] == 'TERTUNDA'): ?>
                        <form action="<?= base_url("TenagaKependidikan/tolakPengajuanSidangSkripsi/".$detailPengajuan['id']) ?>" method="post">
                            <input type="hidden" class="form-control" id="npm" name="npm" value=<?= $detailPengajuan['npm'] ?>>
                            <button class="btn btn-danger mr-2" type="submit">Tolak Pengajuan</button>
                        </form>
                        <form action="<?= base_url("TenagaKependidikan/setujuiPengajuanSidangSkripsi/".$detailPengajuan['id']) ?>" method="post">
                            <button class="btn btn-success">Setujui Pengajuan</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/tenagakependidikan/detailPengajuanSidangSkripsi.js");?>"></script>
<?= $this->endSection(); ?>