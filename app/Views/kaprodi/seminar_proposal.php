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
            <?php if ($prodi['mode_sempro'] == null): ?>
                <div class="alert alert-danger" role="alert">
                    <small><strong>Atur Mode Seminar Proposal</strong> terlebih dahulu agar bisa menambahkan jadwal proposal.</small>
                </div>
            <?php elseif ($prodi['mode_sempro'] == 'Asinkronus'): ?>
                <div class="alert alert-info" role="alert">
                    <small>Program Studi <strong><?= $prodi['inisial'] ?></strong> melakukan Seminar Proposal secara <strong><?= $prodi['mode_sempro'] ?></strong>.</small>
                </div>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    <small>Program Studi <strong><?= $prodi['inisial'] ?></strong> melakukan Seminar Proposal secara <strong><?= $prodi['mode_sempro'] ?></strong>.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if ($prodi['mode_sempro'] == null): ?>
                <?= $title ?>
            <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Daring' || $prodi['mode_sempro'] == 'Sinkronus Luring'): ?>
                Kelola Jadwal Seminar Proposal
            <?php elseif ($prodi['mode_sempro'] == 'Asinkronus'): ?>
                Kantong Pengumpulan Video Proposal
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    
                    <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring' || $prodi['mode_sempro'] == 'Sinkronus Luring'): ?>
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#tambahJadwal">Tambahkan Jadwal</button>
                    <?php elseif ($prodi['mode_sempro'] == 'Asinkronus'): ?>
                        <button class="btn btn-primary mr-2" disabled>Tambahkan Jadwal</button>
                    <?php endif; ?>
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#aturMode">Atur Mode SemPro</button>

                </div>
                <div class="col-lg-7 d-flex justify-content-end align-items-center">
                    <form class="form-inline" action="<?= base_url("Kaprodi/seminarProposal") ?>" method="get">
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
                <table class="table table-bordered" id="jadwalSempro" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                        <?php if ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <th>Tanggal Pengumpulan</th>
                        <?php else: ?>
                            <th>Tanggal Seminar</th>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <th>Link Konferensi</th>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <th>Ruangan</th>
                        <?php elseif ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <th>Link Video</th>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <th hidden>Reviewer 1</th>
                            <th hidden>Reviewer 2</th>
                        <?php else: ?>
                            <th>Reviewer 1</th>
                            <th>Reviewer 2</th>
                        <?php endif; ?>
                            
                            <th>Status</th>
                            <th>Komentar</th>
                            <th>Pembuat Komentar</th>
                        <?php if ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <th hidden>Aksi</th>
                        <?php else: ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($seminarProposal as $sm): ?>
                        <tr>
                            <td><?= $counter; ?></td>
                            <td class="npm"><?= $sm['npm'] ?></td>
                            <td class="nama"><?= $sm['nama_mahasiswa'] ?></td>
                            <td><?= $sm['judul'] ?></td>
                            <td data-toggle="tooltip" data-placement="top" title="<?= $sm['nama_bidang'] ?>"><?= $sm['inisial_bidang'] ?></td>
                        
                        
                            <td class="tanggal" style="min-width: 8vw"><?= date_format(date_create($sm['tanggal']), 'd-m-Y H:i') ?> WIB</td>

                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <?php if ($sm['link_konferensi'] == null): ?>
                                <td>-</td>
                            <?php else: ?>
                                <td class="link_konferensi"><a href="<?= $sm['link_konferensi'] ?>">Klik disini!</td>
                            <?php endif; ?>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <?php if ($sm['ruangan'] == null): ?>
                                <td>-</td>
                            <?php else: ?>
                                <td class="ruangan"><?= $sm['ruangan'] ?></td>
                            <?php endif; ?>
                        <?php elseif ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <?php if ($sm['link_video'] == null): ?>
                                <td>-</td>
                            <?php else: ?>
                                <td class="link_video"><a href="<?= $sm['link_video'] ?>">Klik disini!</td>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <td hidden>-</td>
                            <td hidden>-</td>
                        <?php else: ?>
                            <?php if ($sm['dosen_penguji1'] == null) : ?>
                                <td>-</td>
                            <?php else: ?>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $sm['dosen_penguji1']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji1" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            

                            <?php if ($sm['dosen_penguji2'] == null): ?>
                                <td>-</td>
                            <?php else: ?>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $sm['dosen_penguji2']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="dosen_penguji2" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif;?>
                        <?php endif; ?>
                        
                            <td><?= $sm['status'] != 'TERTUNDA' ? $sm['status'] : "-" ?></td>
                            <td><?= $sm['komentar'] != null ? $sm['komentar'] : "-" ?></td>

                        <?php if ($sm['pembuat_komentar'] != null) :?>
                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $sm['pembuat_komentar']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="pembuat_komentar" data-id="<?= $d['id'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else:?>
                            <td>-</td>
                        <?php endif; ?>

                        <?php if ($prodi['mode_sempro'] == 'Asinkronus') : ?>
                            <td hidden>-</td>
                        <?php else: ?>
                            <td style="min-width: 7vw">
                                <?php if ($sm['status'] != 'TERTUNDA'): ?>
                                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ubah" disabled><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" disabled><i class="fa fa-trash"></i></button>
                                <?php else: ?>
                                    <button class="btn btn-primary ubah-jadwal" data-toggle="tooltip" data-placement="top" title="Ubah" data-id="<?= $sm['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?= base_url("Kaprodi/deleteJadwalSempro/" . $sm['id']) ?>" method="post" class="d-inline" id="formHapusJadwal">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                        </tr>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah jadwal proposal -->
    <div class="modal fade" id="tambahJadwal" tabindex="-1" role="dialog" aria-labelledby="tambahJadwalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahJadwalLabel">Tambahkan Jadwal Seminar Proposal</h5>
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
                        <form action="<?= base_url("Kaprodi/insertJadwalSempro") ?>" method="post" id="formTambahJadwal">
                            <input type="hidden" name="mode_sempro" id="mode_sempro" value="<?= $prodi['mode_sempro'] ?>">
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
                                                <textarea class="form-control" id="judul" name="judul" row="2" data-npm="<?= $m['npm'] ?>" hidden disabled><?= $m['judul_proposal'] ?></textarea>
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
                                    
                                <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="link_konferensi">Link Konferensi</label>
                                            <input type="text" class="form-control" id="link_konferensi" name="link_konferensi">
                                        </div>
                                    </div>
                                <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ruangan">Ruangan</label>
                                            <input type="text" class="form-control" id="ruangan" name="ruangan" placeholder="contoh: Ruangan MDI">
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dosen_penguji1">Dosen Penguji 1</label>
                                            <select name="dosen_penguji1" id="dosen_penguji1" class="form-control">
                                                <option value="none" selected disabled> - Pilih Dosen Penguji - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dosen_penguji2">Dosen Penguji 2</label>
                                            <select name="dosen_penguji2" id="dosen_penguji2" class="form-control">
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
                    <div class="tab-pane fade" id="nav-batch" role="tabpanel" aria-labelledby="nav-batch-tab">
                        <form action="<?= base_url("Kaprodi/insertJadwalSemproBatch") ?>" method="post" id="formJadwalBatch" enctype="multipart/form-data">
                            <input type="hidden" name="mode_sempro" id="mode_sempro" value="<?= $prodi['mode_sempro'] ?>">
                            <div class="modal-body">
                                <label>File Jadwal Seminar Proposal</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileJadwal" name="fileJadwal">
                                        <label class="custom-file-label" for="fileJadwal">Pilih Jadwal Seminar Proposal</label>
                                    </div>
                                </div>

                                <a href="<?= base_url("Kaprodi/downloadFormatJadwalSempro/". $prodi['mode_sempro']) ?>"><small>Download Format Jadwal SemPro <?= $prodi['mode_sempro'] ?></small></a>
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
                    <h5 class="modal-title" id="ubahJadwalLabel">Ubah Jadwal Seminar Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formUbahJadwal">
                    <input type="hidden" name="mode_sempro" id="mode_sempro" value="<?= $prodi['mode_sempro'] ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="mahasiswa">Mahasiswa</label>
                                    <input class="form-control" id="mahasiswa" name="mahasiswa" type="text" disabled>
                                </div>
                            </div>
                            
                        <?php if ($prodi['mode_sempro'] == 'Sinkronus Daring') : ?>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="link_konferensi">Link Konferensi</label>
                                    <input type="text" class="form-control" id="link_konferensi" name="link_konferensi">
                                </div>
                            </div>
                        <?php elseif ($prodi['mode_sempro'] == 'Sinkronus Luring') : ?>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="ruangan">Ruangan</label>
                                    <input type="text" class="form-control" id="ruangan" name="ruangan" placeholder="contoh: Ruangan MDI">
                                </div>
                            </div>
                        <?php endif; ?>
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dosen_penguji1">Dosen Penguji 1</label>
                                    <select name="dosen_penguji1" id="dosen_penguji1" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Penguji - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dosen_penguji2">Dosen Penguji 2</label>
                                    <select name="dosen_penguji2" id="dosen_penguji2" class="form-control">
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

    <!-- modal tambah atur mode sempro -->
    <div class="modal fade" id="aturMode" tabindex="-1" role="dialog" aria-labelledby="aturModeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aturModeLabel">Atur Mode Seminar Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("Kaprodi/updateModeSempro/".$prodi['id']) ?>" method="post" id="formAturMode">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mode_sempro">Model Seminar Proposal</label>
                            <select class="form-control" id="mode_sempro" name="mode_sempro">
                                <option value="none" selected disabled> - Pilih Mode Seminar Proposal - </option>
                                <option value="Asinkronus"> Asinkronus </option>
                                <option value="Sinkronus Daring"> Sinkronus (Daring) </option>
                                <option value="Sinkronus Luring"> Sinkronus (Luring) </option>
                            </select>
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
    <script src="<?= base_url("assets/js/kaprodi/seminarProposal.js");?>" defer></script>
<?= $this->endSection(); ?>