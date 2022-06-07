<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-4 pr-0 overflow-auto tablist" role="tablist" style="max-height: 500px">
            <?php $counter = 1; ?>
            <?php foreach($daftarPenelitian as $dp):  ?>

                <div class="card mb-3 <?= $counter == 1 ? "active" : "" ?>" 
                    id="penelitian-<?= $counter ?>-tab" 
                    data-toggle="pill" 
                    href="#penelitian-<?= $counter ?>" 
                    role="tab" 
                    aria-controls="penelitian-<?= $counter ?>" 
                    aria-selected="true"
                >
                    <div class="card-header d-flex justify-content-between">
                        <span class="p-2 badge badge-<?= $dp['inisial_prodi'] == 'TI' ? "warning" : "primary"; ?>"><?= $dp['inisial_prodi'] ?></span>
                        <span class="p-2 badge badge-<?= $dp['status'] == 'TERSEDIA' ? "success" : "danger"; ?>"><?= $dp['status'] ?></span>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><?= $dp['judul'] ?></h6>
                    </div>
                </div>
                
                <?php $counter++; ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-8">
            <div class="card overflow-auto" style="height: 600px">   
                <div class="tab-content p-2" id="penelitian-tabContent">
                    <?php $counter = 1; ?>
                    <?php foreach($daftarPenelitian as $dp): ?>
                        <div class="card tab-pane fade <?= $counter == 1 ? "show active": "" ?>" id="penelitian-<?= $counter ?>" role="tabpanel" aria-labelledby="penelitian-<?= $counter ?>-tab">
                            <div class="card-header d-flex justify-content-between">
                                <span>Detail Penelitian</span>        
                                <span class="badge badge-<?= $dp['status'] == 'TERSEDIA' ? "success" : "danger"; ?> p-2"><?= $dp['status'] ?></span>    
                            </div>
                            <div class="card-body">
                                <h5 class="text-center"><?= $dp['judul'] ?></h5>
                                <p class="text-center mb-4"><?= $dp['nama_dosen'] ?></p>
                                <br>
                                <h6>Bidang</h6>
                                <p><?= $dp['nama_bidang'] ?></p>
                                <br>
                                <h6>Peneliti yang dibutuhkan</h6>
                                <p><?= $dp['jumlah_peneliti'] ?> Orang</p>
                                <br>
                                <h6>Deskripsi</h6>
                                <p class="text-muted text-justify"><?= $dp['deskripsi'] ?></p>
                                <br>
                                <h6>Kontak</h6>
                                <p class="mb-0">Email: <strong><?= $dp['email_dosen'] ?></strong></p>
                                <p>No. HP: <strong><?= $dp['telp_dosen'] ?></strong></p>
                            </div>
                        </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/home/penelitian_dosen.js");?>"></script>
<?= $this->endSection(); ?>