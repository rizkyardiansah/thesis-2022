<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
        <img src="<?= base_url("assets/img/skripsi.png")?>" alt="Logo" style="height: 3.5rem">
    </div>
    <div class="sidebar-brand-text mx-3">THESIS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Beranda
</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("home/index")?>">
        <i class="fas fa-book"></i>
        <span>Repositori</span></a>
</li>
<li class="nav-item ">
    <a class="nav-link py-2" href="<?= base_url("home/kalender")?>">
        <i class="fas fa-calendar-alt"></i>
        <span>Kalender Skripsi</span></a>
</li>
<li class="nav-item ">
    <a class="nav-link py-2" href="<?= base_url("home/penelitian")?>">
        <i class="fas fa-flask"></i>
        <span>Penelitian Dosen</span></a>
</li>

<!-- Divider -->

<!-- Heading -->
<?php if (in_array("mahasiswa", session()->get("user_session")['roles'])) : ?>
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Mahasiswa
</div>

<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapsePengajuan"
        aria-expanded="true" aria-controls="collapsePengajuan">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pengajuan</span>
    </a>
    <div id="collapsePengajuan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("Mahasiswa/pengajuanPenulisanSkripsi") ?>">Penulisan Skripsi</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/pengajuanPraSidang") ?>">Seminar Prasidang</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/pengajuanSidangSkripsi") ?>">Sidang Skripsi</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapseBerkas"
        aria-expanded="true" aria-controls="collapseBerkas">
        <i class="fas fa-fw fa-folder"></i>
        <span>Berkas</span>
    </a>
    <div id="collapseBerkas" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("Mahasiswa/proposal") ?>">Proposal</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/skripsi") ?>">Skripsi</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/makalah") ?>">Makalah</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapseJadwal"
        aria-expanded="true" aria-controls="collapseJadwal">
        <i class="fas fa-fw fa-folder"></i>
        <span>Jadwal</span>
    </a>
    <div id="collapseJadwal" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("Mahasiswa/seminarProposal") ?>">Seminar Proposal</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/seminarPrasidang") ?>">Seminar Prasidang</a>
            <a class="collapse-item" href="<?= base_url("Mahasiswa/sidangSkripsi") ?>">Sidang Skripsi</a>
        </div>
    </div>
</li>

<li class="nav-item ">
    <a class="nav-link py-2" href="<?= base_url("Mahasiswa/pembimbing")?>">
        <i class="fas fa-file-medical"></i>
        <span>Catatan Bimbingan</span></a>
</li>
<?php endif; ?>


<?php if (in_array("fakultas", session()->get("user_session")['roles'])) : ?>
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Fakultas
</div>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("fakultas/proposal") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Proposal</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("fakultas/skripsi") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Skripsi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("fakultas/makalah") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Makalah</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("fakultas/pembimbing") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Pembimbing</span>
    </a>
</li>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("fakultas/kalender") ?>" >
        <i class="fas fa-calendar-plus"></i>
        <span>Kelola Kalender Skripsi</span>
    </a>
</li>
<?php endif; ?>

<?php if (in_array("kaprodi", session()->get("user_session")['roles'])) : ?>
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Kaprodi
</div>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("Kaprodi/proposal") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Proposal</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("Kaprodi/skripsi") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Skripsi</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("Kaprodi/makalah") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Makalah</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("Kaprodi/pembimbing") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Pembimbing</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapseJadwalKaprodi"
        aria-expanded="true" aria-controls="collapseJadwalKaprodi">
        <i class="fas fa-fw fa-folder"></i>
        <span>Kelola Jadwal</span>
    </a>
    <div id="collapseJadwalKaprodi" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("Kaprodi/seminarProposal") ?>">Seminar Proposal</a>
            <a class="collapse-item" href="<?= base_url("Kaprodi/seminarPrasidang") ?>">Seminar Prasidang</a>
            <a class="collapse-item" href="<?= base_url("Kaprodi/sidangSkripsi") ?>">Sidang Skripsi</a>
        </div>
    </div>
</li>
<?php endif; ?>

<?php if (in_array("dosen", session()->get("user_session")['roles'])) : ?>
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Dosen
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("dosen/penelitian") ?>" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelola Penelitian</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("dosen/bimbingan") ?>" >
        <i class="fas fa-archive"></i>
        <span>Bimbingan</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapsePenguji"
        aria-expanded="true" aria-controls="collapsePenguji">
        <i class="fas fa-fw fa-folder"></i>
        <span>Jadwal</span>
    </a>
    <div id="collapsePenguji" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("dosen/pengujiSeminarProposal") ?>">Seminar Proposal</a>
            <a class="collapse-item" href="<?= base_url("dosen/pengujiSeminarPrasidang") ?>">Seminar Prasidang</a>
            <a class="collapse-item" href="<?= base_url("dosen/pengujiSidangSkripsi") ?>">Sidang Skripsi</a>
        </div>
    </div>
</li>
<?php endif; ?>

<?php if (in_array("tendik", session()->get("user_session")['roles'])) : ?>
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Tenaga Kependidikan
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapsePenguji"
        aria-expanded="true" aria-controls="collapsePenguji">
        <i class="fas fa-fw fa-folder"></i>
        <span>Verifikasi Pengajuan</span>
    </a>
    <div id="collapsePenguji" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url("TenagaKependidikan/pengajuanSkripsi") ?>">Penulisan Skripsi</a>
            <a class="collapse-item" href="<?= base_url("TenagaKependidikan/pengajuanPrasidang") ?>">Seminar Prasidang</a>
            <a class="collapse-item" href="<?= base_url("TenagaKependidikan/pengajuanSidangSkripsi") ?>">Sidang Skripsi</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link py-2" href="<?= base_url("TenagaKependidikan/pembimbing") ?>">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelola Pembimbing</span>
    </a>
</li>
<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block my-0">

<li class="nav-item">
    <a class="nav-link" href="<?= base_url("home/resource") ?>">
        <i class="fas fa-fw fa-cog"></i>
        <span>Sumber Daya</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->