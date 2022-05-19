<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning" role="alert">
                <small>Mode Seminar Proposal untuk Program Studi <strong><?= $prodi['inisial'] ?></strong> belum ditentukan. Silahkan pilih menu lain.</small>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Seminar Proposal
        </div>
        <div class="card-body">

        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
    <script src="<?= base_url("assets/js/mahasiswa/seminarProposal.js");?>"></script>
<?= $this->endSection(); ?>