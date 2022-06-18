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

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert">
                <small>Silahkan tambahkan <strong>Jadwal Seminar Prasidang</strong> dengan cara mengklik tombol <strong>Tambahkan Jadwal</strong>.</small>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Kelola Jadwal Seminar Prasidang
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#tambahJadwal">Tambahkan Jadwal</button>
                </div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("kaprodi/seminarPrasidang") ?>" method="get">
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

            <!-- table seminar prasidang -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSeminarPrasidang" width="100%" cellspacing="0">
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
                            <td class="nama"><?= $sp['nama_mahasiswa'] ?></td>
                            <td><?= $sp['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $sp['nama_bidang'] ?>"><?= $sp['inisial_bidang'] ?></td>                        
                            <td class="tanggal" style="min-width: 8vw"><?= date_format(date_create($sp['tanggal']), 'd-m-Y H:i') ?> WIB</td>
                            <td class="ruangan"><?= $sp['ruangan'] ?></td>

                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $sp['dosen_reviewer']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_reviewer" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <td style="min-width: 7vw;">
                                <?php if ($sp['status'] == 'TERTUNDA'): ?>
                                    <button class="btn btn-primary ubah-jadwal" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $sp['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?= base_url("kaprodi/deleteJadwalSeminarPrasidang/" . $sp['id']) ?>" method="post" class="d-inline" id="formHapusJadwal">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php else: ?>
                                    <button type="button" class="btn btn-primary" disabled><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-danger" disabled><i class="fa fa-trash"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah jadwal prasidang -->
    <div class="modal fade" id="tambahJadwal" tabindex="-1" role="dialog" aria-labelledby="tambahJadwalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahJadwalLabel">Tambahkan Jadwal Seminar Prasidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-single-tab" data-toggle="tab" href="#nav-single" role="tab" aria-controls="nav-single" aria-selected="true">Single</a>
                        <a class="nav-item nav-link" id="nav-batch-tab" data-toggle="tab" href="#nav-batch" role="tab" aria-controls="nav-batch" aria-selected="false">Batch</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-single" role="tabpanel" aria-labelledby="nav-single-tab">
                        <form action="<?= base_url("kaprodi/insertJadwalSeminarPrasidang") ?>" method="post" id="formTambahJadwal">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="mahasiswa">Mahasiswa</label>
                                            <select class="form-control" id="mahasiswa" name="mahasiswa">
                                                <option value="none" selected disabled> - Pilih Mahasiswa - </option>
                                                <?php foreach($mahasiswa as $m) : ?>
                                                    <option value="<?= $m['npm'] ?>"><?= $m['npm'] ." | " . $m['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group judul">
                                            <label for="judul">Judul</label>
                                            <textarea rows="2" class="form-control" id="judul" name="judul" disabled></textarea>
                                            <?php foreach($mahasiswa as $m) : ?>
                                                <textarea class="form-control" id="judul" name="judul" row="2" data-npm="<?= $m['npm'] ?>" hidden disabled><?= $m['judul'] ?></textarea>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group bidang">
                                            <label for="bidang">Bidang</label>
                                            <input type="text" class="form-control" id="bidang" name="bidang" disabled>
                                            <?php foreach($mahasiswa as $m) : ?>
                                                <input type="text" class="form-control" id="bidang" name="bidang" value="<?= $m['nama_bidang'] ?>" data-npm="<?= $m['npm'] ?>" hidden disabled>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ruangan">Ruangan</label>
                                            <input type="text" class="form-control" id="ruangan" name="ruangan" placeholder="contoh: Ruangan MDI">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Seminar</label>
                                            <input type="text" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="jam">Waktu Seminar</label>
                                            <input type="text" class="form-control" id="jam" name="jam" placeholder="format: (hh:mm)">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="dosen_reviewer">Dosen Reviewer</label>
                                            <select name="dosen_reviewer" id="dosen_reviewer" class="form-control">
                                                <option value="none" selected disabled> - Pilih Dosen Reviewer - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                    <div class="tab-pane fade" id="nav-batch" role="tabpanel" aria-labelledby="nav-batch-tab">
                        <form action="<?= base_url("kaprodi/insertJadwalSeminarPrasidangBatch") ?>" method="post" id="formJadwalBatch" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label>File Jadwal Seminar Prasidang</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileJadwal" name="fileJadwal">
                                        <label class="custom-file-label" for="fileJadwal">Pilih Jadwal Seminar Prasidang</label>
                                    </div>
                                </div>

                                <a href="<?= base_url("kaprodi/downloadFormatJadwalSeminarPrasidang") ?>"><small>Download Format Jadwal Seminar Prasidang</small></a>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahJadwal" tabindex="-1" role="dialog" aria-labelledby="ubahJadwalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahJadwalLabel">Ubah Jadwal Seminar Prasidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formUbahJadwal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="mahasiswa">Mahasiswa</label>
                                    <input class="form-control" id="mahasiswa" name="mahasiswa" type="text" disabled>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="ruangan">Ruangan</label>
                                    <input type="text" class="form-control" id="ruangan" name="ruangan" placeholder="contoh: Ruangan MDI">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Seminar</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jam">Waktu Seminar</label>
                                    <input type="text" class="form-control" id="jam" name="jam" placeholder="format: (hh:mm)">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="dosen_reviewer">Dosen Reviewer</label>
                                    <select name="dosen_reviewer" id="dosen_reviewer" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Penguji - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
    <script src="<?= base_url("assets/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("assets/js/kaprodi/seminarPrasidang.js");?>" defer></script>
<?= $this->endSection(); ?>