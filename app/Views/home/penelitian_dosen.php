<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $title ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 pr-0 overflow-auto" style="max-height: 500px">
                    <div class="card" >
                        <ul class="nav" id="penelitian-tab" role="tablist" aria-orientation="vertical" >
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link active d-inline-blcok w-100 h-100" id="penelitian-1-tab" data-toggle="pill" href="#penelitian-1" role="tab" aria-controls="penelitian-1" aria-selected="true">Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</a>
                                
                            </li>
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link d-inline-blcok w-100 h-100" id="penelitian-2-tab" data-toggle="pill" href="#penelitian-2" role="tab" aria-controls="penelitian-2" aria-selected="false">Pengembangan Sistem Si Centing untuk Mendeteksi Stuntinng</a>
                                
                            </li>
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link d-inline-blcok w-100 h-100" id="penelitian-3-tab" data-toggle="pill" href="#penelitian-3" role="tab" aria-controls="penelitian-3" aria-selected="false">Analisis Sentimen Kelangkaan Minyak Goreng</a>
                                
                            </li>
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link d-inline-blcok w-100 h-100" id="penelitian-4-tab" data-toggle="pill" href="#penelitian-4" role="tab" aria-controls="penelitian-4" aria-selected="false">Sistem Pembelajaran untuk Siswa SD 14 Pagi Berbasis Android</a>
                                
                            </li>    
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link d-inline-blcok w-100 h-100" id="penelitian-5-tab" data-toggle="pill" href="#penelitian-5" role="tab" aria-controls="penelitian-5" aria-selected="false">Robot Kendali Jarak Jauh Robot Kendali Jarak Jauh Robot Kendali Jarak Jauh</a>
                                
                            </li>    
                            <li class="border-bottom border-dark w-100 d-flex align-items-center" style="min-height: 6rem">
                                <a class="nav-link d-inline-blcok w-100 h-100" id="penelitian-6-tab" data-toggle="pill" href="#penelitian-6" role="tab" aria-controls="penelitian-6" aria-selected="false">Pintu Otomatis</a>
                                
                            </li>    
                        </ul>                        
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card overflow-auto" style="height: 500px">   
                        <div class="tab-content p-2" id="penelitian-tabContent">
                            <div class="tab-pane fade show active" id="penelitian-1" role="tabpanel" aria-labelledby="penelitian-1-tab">
                                <h5 class="text-center">Pengembangan Sistem Informasi Skripsi Fakultas Teknologi Informasi</h5>
                                
                                <p class="text-center mb-4">Elan Suherlan, S.Si., M.Si.</p>
                                <br>
                                <h6>Bidang</h6>
                                <p>Multimedia</p>
                                <br>
                                <h6>Peneliti yang dibutuhkan</h6>
                                <p>1 Orang</p>
                                <br>
                                <h6>Deskripsi</h6>
                                <p class="text-muted text-justify">Tujuan dari penelitian ini adalah untuk membangun ulang sistem informasi skripsi bernama TheSIS yang mana akan digunakan pada lingkup Fakultas Teknologi Informasi</p>
                                <br>
                                <h6>Kontak</h6>
                                <p>Hubungin nomor ini jika anda berminat : 081234567890</p>
                            </div>
                            <div class="tab-pane fade" id="penelitian-2" role="tabpanel" aria-labelledby="penelitian-2-tab">Penelitian 2</div>
                            <div class="tab-pane fade" id="penelitian-3" role="tabpanel" aria-labelledby="penelitian-3-tab">Penelitian 3</div>
                            <div class="tab-pane fade" id="penelitian-4" role="tabpanel" aria-labelledby="penelitian-4-tab">Penelitian 4</div>
                            <div class="tab-pane fade" id="penelitian-5" role="tabpanel" aria-labelledby="penelitian-5-tab">Penelitian 5</div>
                            <div class="tab-pane fade" id="penelitian-6" role="tabpanel" aria-labelledby="penelitian-6-tab">Penelitian 6</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>