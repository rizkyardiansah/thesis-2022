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
            Data Diri
        </div>
        <div class="card-body">
            <form id="formDataDiri" action="<?= base_url("mahasiswa/updateDataDiri/". $dataMahasiswa['npm']) ?>" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" >
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $dataMahasiswa["email"] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" value="<?= $dataMahasiswa["nama"] ?>" autofocus>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="npm">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value="<?= $dataMahasiswa["npm"] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="angkatan">Tahun Angkatan</label>
                            <select class="form-control" name="angkatan" id="angkatan">
                        <?php 
                            $startYear = (int)date("Y", strtotime("-3 years"));
                            $endYear =  (int)date("Y", strtotime("-7 years"));
                            for($startYear; $startYear >= $endYear; $startYear -= 1) : 
                        ?>
                            <?php if ($startYear == $dataMahasiswa["angkatan"]) : ?>
                                <option value="<?= $startYear ?>" selected><?= $startYear ?></option>
                            <?php else: ?>
                                <option value="<?= $startYear ?>"><?= $startYear ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="fakultas">Fakultas</label>
                            <select class="form-control" name="fakultas" id="fakultas" value="<?= $dataMahasiswa["id_fakultas"] ?>">
                            <?php foreach($dataFakultas as $f) : ?>
                                <?php if ($dataMahasiswa['id_fakultas'] == $f['id']) : ?>
                                    <option value="<?= $f['id'] ?>"><?= $f['inisial'] . " | " . $f['nama'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $f['id'] ?>"><?= $f['inisial'] . " | " . $f['nama'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <select class="form-control" name="prodi" id="prodi" value="<?= $dataMahasiswa["id_prodi"] ?>">
                            <?php foreach($dataProdi as $p) : ?>
                                <?php if ($dataMahasiswa['id_prodi'] == $p['id']) : ?>
                                    <option value="<?= $p['id'] ?>" selected><?= $p['inisial'] . " | " . $p['nama'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['inisial'] . " | " . $p['nama'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/profil.js");?>"></script>
<?= $this->endSection(); ?>