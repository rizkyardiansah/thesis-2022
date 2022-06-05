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
                <small>Silahkan tambahkan <strong>Jadwal Sidang Skripsi</strong> dengan cara mengklik tombol <strong>Tambahkan Jadwal</strong>.</small>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Kelola Jadwal Sidang Skripsi
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#tambahJadwal">Tambahkan Jadwal</button>
                </div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("dosen/sidangSkripsi") ?>" method="get">
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

            <!-- table sidang skripsi -->
            <div class="table-responsive">
                <table class="table table-bordered" id="jadwalSidangSkripsi" width="100%" cellspacing="0">
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
                    <?php foreach ($sidangSkripsi as $ss) :?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td class="npm"><?= $ss['npm'] ?></td>
                            <td class="nama"><?= $ss['nama_mahasiswa'] ?></td>
                            <td class="judul"><?= $ss['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_bidang'] ?>" class="bidang"><?= $ss['inisial_bidang'] ?></td>                        
                            <td class="tanggal" style="min-width: 8vw"><?= date_format(date_create($ss['tanggal']), 'd-m-Y H:i') ?> WIB</td>
                            <td class="ruangan"><?= $ss['ruangan'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_penguji'] ?>" class="penguji" data-id="<?= $ss['dosen_penguji'] ?>"><?= $ss['inisial_penguji'] ?></td>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing1'] ?>" class="pembimbing1"><?= $ss['inisial_pembimbing1'] ?></td>

                            <?php if ($ss['nama_pembimbing2'] == null): ?>
                                <td>-</td>
                            <?php else: ?>
                                <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing2'] ?>" class="pembimbing2"><?= $ss['inisial_pembimbing2'] ?></td>
                            <?php endif;?>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $ss['nama_pembimbing_agama'] ?>" class="pembimbing_agama"><?= $ss['inisial_pembimbing_agama'] ?></td>
                        
                            <td style="min-width: 7vw">
                                <button class="btn btn-primary ubah-jadwal" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $ss['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                <form action="<?= base_url("dosen/deleteJadwalSidangSkripsi/" . $ss['id']) ?>" method="post" class="d-inline" id="formHapusJadwal">
                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                </form>
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
                        <form action="<?= base_url("dosen/insertJadwalSidangSkripsi") ?>" method="post" id="formTambahJadwal">
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

                                    <div class="col-lg-6">
                                        <div class="form-group bidang">
                                            <label for="pembimbing1">Pembimbing Ilmu 1</label>
                                            <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" disabled>
                                            <?php foreach($mahasiswa as $m) : ?>
                                                <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" value="<?= $m['nama_pembimbing1'] ?>" data-npm="<?= $m['npm'] ?>" hidden disabled>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group bidang">
                                            <label for="pembimbing2">Pembimbing Ilmu 2</label>
                                            <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" disabled>
                                            <?php foreach($mahasiswa as $m) : ?>
                                                <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" value="<?= $m['nama_pembimbing2'] == null ? "-": $m['nama_pembimbing2'] ?>" data-npm="<?= $m['npm'] ?>" hidden disabled>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group bidang">
                                            <label for="pembimbing_agama">Pembimbing Agama</label>
                                            <input type="text" class="form-control" id="pembimbing_agama" name="pembimbing_agama" disabled>
                                            <?php foreach($mahasiswa as $m) : ?>
                                                <input type="text" class="form-control" id="pembimbing_agama" name="pembimbing_agama" value="<?= $m['nama_pembimbing_agama'] ?>" data-npm="<?= $m['npm'] ?>" hidden disabled>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dosen_penguji">Dosen Penguji</label>
                                            <select name="dosen_penguji" id="dosen_penguji" class="form-control">
                                                <option value="none" selected disabled> - Pilih Dosen Penguji - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                                            <label for="tanggal">Tanggal Sidang</label>
                                            <input type="text" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="jam">Waktu Sidang</label>
                                            <input type="text" class="form-control" id="jam" name="jam" placeholder="format: (hh:mm)">
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
                        <form action="<?= base_url("dosen/insertJadwalSidangSkripsiBatch") ?>" method="post" id="formJadwalBatch" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label>File Jadwal Sidang Skripsi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileJadwal" name="fileJadwal">
                                        <label class="custom-file-label" for="fileJadwal">Pilih Jadwal Sidang Skripsi</label>
                                    </div>
                                </div>

                                <a href="<?= base_url("dosen/downloadFormatJadwalSidangSkripsi") ?>"><small>Download Format Jadwal Sidang Skripsi</small></a>
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
                                    <label for="judul">Judul</label>
                                    <textarea rows="2" class="form-control" id="judul" name="judul" disabled></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <input type="text" class="form-control" id="bidang" name="bidang" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pembimbing1">Pembimbing Ilmu 1</label>
                                    <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pembimbing2">Pembimbing Ilmu 2</label>
                                    <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pembimbing_agama">Pembimbing Agama</label>
                                    <input type="text" class="form-control" id="pembimbing_agama" name="pembimbing_agama" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dosen_penguji">Dosen Penguji</label>
                                    <select name="dosen_penguji" id="dosen_penguji" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Penguji - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
    <script src="<?= base_url("assets/js/dosen/sidangSkripsi.js");?>" defer></script>
<?= $this->endSection(); ?>