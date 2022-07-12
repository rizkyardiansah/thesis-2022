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
            <div class="row mb-3">
                <div class="col-lg-3 d-flex align-items-center">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPembimbing">Atur Pembimbing Skripsi</button>
                    </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePembimbing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            <th>Bidang</th>
                            <th>Pemb. Ilmu 1</th>
                            <th>Pemb. Ilmu 2</th>
                            <th>Pemb. Agama</th>
                            <th>Total Bimbingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($mahasiswaDenganPembimbing as $mpp): ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td class="npm"><?= $mpp['npm'] ?></td>
                            <td class="nama_mahasiswa"><?= $mpp['nama_mahasiswa'] ?></td>
                            <td data-id="<?= $mpp['id_prodi'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_prodi'] ?>" class="prodi"><?= $mpp['inisial_prodi'] ?></td>
                            <td class="judul"><?= $mpp['judul'] ?></td>
                            <td data-nama="<?= $mpp['nama_bidang'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $mpp['nama_bidang'] ?>" class="bidang"><?= $mpp['inisial_bidang'] ?></td>

                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $mpp['id_pembimbing1']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="pembimbing1" data-id="<?= $mpp['id_pembimbing1'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($mpp['id_pembimbing2']) : ?>
                                <?php foreach($dosen as $d) : ?>
                                    <?php if ($d['id'] == $mpp['id_pembimbing2']) : ?>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="pembimbing2" data-id="<?= $mpp['id_pembimbing2'] ?>"><?= $d['inisial'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <td class="pembimbing2" data-id="null">-</td>
                            <?php endif; ?>

                            <?php foreach($dosen as $d) : ?>
                                <?php if ($d['id'] == $mpp['id_pembimbing_agama']) : ?>
                                    <td data-toggle="tooltip" data-placement="top" title="<?= $d['nama'] ?>" class="pembimbingAgama" data-id="<?= $mpp['id_pembimbing_agama'] ?>"><?= $d['inisial'] ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <td data-toggle="tooltip" data-placement="top" title="<?= $mpp['total_bimbingan'] ?> kali bimbingan" class="totalBimbingan"><?= $mpp['total_bimbingan'] ?></td>

                            <td style="min-width: 7vw">
                                <?php if ($mpp['total_bimbingan'] == 0) : ?>
                                    <button class="btn btn-primary ubah-pembimbing" data-toggle="tooltip" data-placement="top" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                                    <form action="<?= base_url("TenagaKependidikan/deletePembimbing/" . $mpp['npm']) ?>" method="post" class="d-inline" id="formHapusPembimbing">
                                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-primary" disabled><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
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

    <div class="modal fade" id="tambahPembimbing" tabindex="-1" role="dialog" aria-labelledby="tambahPembimbingLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPembimbingLabel">Atur Pembimbing Skripsi</h5>
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
                        <form action="<?= base_url("TenagaKependidikan/insertPembimbing") ?>" method="post" id="formTambahPembimbing">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="mahasiswa">Mahasiswa</label>
                                            <select name="mahasiswa" id="mahasiswa" class="form-control">
                                                <option value="none" selected disabled> - Pilih Mahasiswa - </option>
                                                <?php foreach($mahasiswaTanpaPembimbing as $mtp) : ?>
                                                    <option value="<?= $mtp['npm'] ?>" data-prodi="<?= $mtp['id_prodi']?>"><?= $mtp['npm'] . " | " . $mtp['nama_mahasiswa'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <textarea name="judul" id="judul" rows="2" class="form-control" readonly></textarea>
                                            <?php foreach ($mahasiswaTanpaPembimbing as $mtp): ?>
                                                <textarea name="judul" id="judul" data-npm="<?= $mtp['npm'] ?>" rows="2" class="form-control" hidden readonly><?= $mtp['judul'] ?></textarea>
                                            <?php endforeach; ?>
                                            <?php ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="bidang">Bidang</label>
                                            <input name="bidang" id="bidang" type="text" class="form-control" readonly>
                                            <?php foreach ($mahasiswaTanpaPembimbing as $mtp): ?>
                                                <input name="bidang" id="bidang" data-npm="<?= $mtp['npm'] ?>" type="text" class="form-control" hidden readonly value="<?= $mtp['nama_bidang'] ?>">
                                            <?php endforeach; ?>
                                            <?php ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dosen_usulan1">Dosen Usulan 1</label>
                                            <input name="dosen_usulan1" id="dosen_usulan1" type="text" class="form-control" readonly>
                                            <?php foreach ($mahasiswaTanpaPembimbing as $mtp): ?>
                                                <input name="dosen_usulan1" id="dosen_usulan1" data-npm="<?= $mtp['npm'] ?>" type="text" class="form-control" hidden readonly value="<?= $mtp['dosen_usulan1'] ?>">
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dosen_usulan2">Dosen Usulan 2</label>
                                            <input name="dosen_usulan2" id="dosen_usulan2" type="text" class="form-control" readonly>
                                            <?php foreach ($mahasiswaTanpaPembimbing as $mtp): ?>
                                                <input name="dosen_usulan2" id="dosen_usulan2" data-npm="<?= $mtp['npm'] ?>" type="text" class="form-control" hidden readonly value="<?= $mtp['dosen_usulan2'] ?>">
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pembimbing1">Dosen Pembimbing Ilmu 1</label>
                                            <select name="pembimbing1" id="pembimbing1" class="form-control" disabled>
                                                <option value="none" selected disabled> - Pilih Dosen Pembimbing Ilmu 1 - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div><div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pembimbing2">Dosen Pembimbing Ilmu 2</label>
                                            <select name="pembimbing2" id="pembimbing2" class="form-control" disabled>
                                                <option value="none" selected disabled> - Pilih Dosen Pembimbing Ilmu 2 - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div><div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="pembimbingAgama">Dosen Pembimbing Agama</label>
                                            <select name="pembimbingAgama" id="pembimbingAgama" class="form-control" disabled>
                                                <option value="none" selected disabled> - Pilih Dosen Pembimbing Agama - </option>
                                                <?php foreach($dosen as $d) : ?>
                                                    <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
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
                        <form action="<?= base_url("TenagaKependidikan/insertPembimbingBatch") ?>" method="post" id="formPembimbingBatch" enctype="multipart/form-data">
                            <div class="modal-body">
                                <label>File Pembimbing Skripsi Mahasiswa</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="filePembimbing" name="filePembimbing">
                                        <label class="custom-file-label" for="filePembimbing">Pilih File Pembimbing Skripsi</label>
                                    </div>
                                </div>

                                <a href="<?= base_url("TenagaKependidikan/downloadFormatPembimbing") ?>"><small>Download Format Pembimbing Skripsi</small></a>
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
    
    <div class="modal fade" id="ubahPembimbing" tabindex="-1" role="dialog" aria-labelledby="ubahPembimbingLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPembimbingLabel">Ubah Pembimbing Skripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url("TenagaKependidikan/updatePembimbing") ?>" method="post" id="formUbahPembimbing">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="npm">NPM</label>
                                    <input name="npm" id="npm" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                    <input name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea name="judul" id="judul" rows="2" class="form-control" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <input name="bidang" id="bidang" type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pembimbing1">Dosen Pembimbing Ilmu 1</label>
                                    <select name="pembimbing1" id="pembimbing1" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Pembimbing Ilmu 1 - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div><div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pembimbing2">Dosen Pembimbing Ilmu 2</label>
                                    <select name="pembimbing2" id="pembimbing2" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Pembimbing Ilmu 2 - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div><div class="col-lg-12">
                                <div class="form-group">
                                    <label for="pembimbingAgama">Dosen Pembimbing Agama</label>
                                    <select name="pembimbingAgama" id="pembimbingAgama" class="form-control">
                                        <option value="none" selected disabled> - Pilih Dosen Pembimbing Agama - </option>
                                        <?php foreach($dosen as $d) : ?>
                                            <option value="<?= $d['id'] ?>" data-prodi="<?= $d['id_prodi'] ?>"><?= $d['inisial'] . " | " . $d['nama'] ?></option>
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
    <script src="<?= base_url("assets/js/tenagakependidikan/pembimbing.js");?>"></script>
<?= $this->endSection(); ?>