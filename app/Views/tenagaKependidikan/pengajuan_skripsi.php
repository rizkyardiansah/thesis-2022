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
                <table class="table table-bordered" id="pengajuanSkripsi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>SKS Lulus</th>
                            <th>Pembimbing Akademik</th>
                            <th>Matakuliah sedang diambil</th>
                            <th>Matakuliah akan diambil</th>
                            <th hidden>File KHS</th>
                            <th hidden>File KRS</th>
                            <th hidden>File Persetujuan Skripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($dataMahasiswa as $dm) :
                        ?>
                            <tr>
                                <td class="npm"><?= $dm['npm'] ?></td>
                                <td><?= $dm['nama'] ?></td>
                                <?php foreach($prodi as $p) : ?>
                                    <?php if ($p['id'] == $dm['id_prodi']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $p['nama'] ?>"><?= $p['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?= $dm['sks_lulus'] ?></td>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $dm['pembimbing_akademik']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                
                                <td><?= $dm['mk_sedang_diambil'] ?></td>
                                <td><?= $dm['mk_akan_diambil'] ?></td>
                                <td class="file-khs" hidden><?= $dm['file_khs'] ?></td>
                                <td class="file-krs" hidden><?= $dm['file_krs'] ?></td>
                                <td class="file-persetujuan" hidden><?= $dm['file_persetujuan_skripsi'] ?></td>
                                <td class="status"><?= ($dm['status_persetujuan_skripsi'] == null) ? "-" : $dm['status_persetujuan_skripsi'] ?></td>
                                <td class="aksi">
                                    <button class="btn btn-primary preview" data-toggle="modal" data-target="#preview">Preview</button>
                                <form action="<?= base_url("tenagakependidikan/terimaPengajuanSkripsi/".$dm['npm']) ?>" action="post">
                                    <button class="btn btn-success" type="submit">Terima</button>
                                </form>
                                <form action="<?= base_url("tenagakependidikan/tolakpengajuanskripsi/".$dm['npm']) ?>">
                                    <button class="btn btn-danger" type="submit">Tolak</button>
                                </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah proposal -->
    <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="previewLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto;height: 2000px" >
                    <div class="row" style="height: 100%">
                    
                        <div class="col-lg-12 mb-5">
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe class="embed-responsive-item file-khs" src=""></iframe>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe class="embed-responsive-item file-krs" src=""></iframe>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe class="embed-responsive-item file-persetujuan" src=""></iframe>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("assets/js/tenagakependidikan/pengajuanSkripsi.js");?>"></script>
<?= $this->endSection(); ?>