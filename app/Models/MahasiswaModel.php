<?php 
namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model 
{
    protected $table = "mahasiswa";
    protected $primaryKey = "npm";
    protected $useAutoIncrement = false;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['npm', 'nama', 'email', 'angkatan', 'id_prodi', 'sks_lulus', 'pembimbing_akademik', 'mk_sedang_diambil', 'mk_akan_diambil', 'status_persetujuan_skripsi', 'file_khs', 'file_krs', 'file_persetujuan_skripsi', 'file_pengajuan_pra_sidang', 'file_lembar_pengesahan', 'file_form_bimbingan'];
    protected $useTimestamps = false;

    public function getAllPengajuanSkripsi() {
        $db = \Config\Database::connect();
        $builder = $db->table("mahasiswa");
        return $builder->
        select("npm, nama, id_prodi, sks_lulus, pembimbing_akademik, mk_sedang_diambil, mk_akan_diambil, file_khs, file_krs, file_persetujuan_skripsi, status_persetujuan_skripsi")->
        getWhere([
            'sks_lulus !=' => null,
            'pembimbing_akademik !=' => null,
            'mk_sedang_diambil !=' => null,
            'mk_akan_diambil !=' => null,
            'file_khs !=' => null,
            'file_krs !=' => null,
            'file_persetujuan_skripsi !=' => null,
        ])->getResultArray();
    }

    public function getMahasiswaBelumDapatSemproByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama, p1.judul as judul_proposal, b.nama as nama_bidang
                from mahasiswa as m
                inner join proposal as p1 on p1.npm = m.npm
                inner join bidang as b on b.id = p1.id_bidang
                left join seminar_proposal as sm on sm.id_proposal = p1.id
                where m.id_prodi = ? 
                and p1.tanggal_upload = (SELECT max(p2.tanggal_upload) from proposal as p2 where p2.npm = m.npm)
                and p1.status = 'TERTUNDA'
                and sm.id is null";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getMahasiswaBelumDapatSempraByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama, s.judul AS judul_proposal, b.nama AS nama_bidang
                FROM mahasiswa AS m
                INNER JOIN skripsi AS s ON s.npm = m.npm
                INNER JOIN pengajuan_prasidang AS pp ON pp.id_skripsi = s.id
                INNER JOIN bidang AS b ON b.id = s.id_bidang
                LEFT JOIN seminar_prasidang AS sp ON sp.id_skripsi = s.id
                WHERE m.id_prodi = ? 
                AND s.tanggal_skripsi = (SELECT max(s2.tanggal_skripsi) FROM skripsi AS s2 WHERE s2.npm = m.npm)
                AND s.status = 'Dalam Pengerjaan'
                AND pp.status = 'DISETUJUI'
                AND sp.id IS NULL";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getMahasiswaLolosSempro() {
        $db = \Config\Database::connect();
        $builder = $db->table("mahasiswa");

        return $builder->
        select("mahasiswa.npm as npm, mahasiswa.nama as nama_mahasiswa, mahasiswa.id_prodi as id_prodi, judul, d1.nama as dosen_usulan1, d2.nama as dosen_usulan2, status, bidang.nama as nama_bidang")->
        join("proposal", "proposal.npm = mahasiswa.npm")->
        join("bidang", "bidang.id = proposal.id_bidang")->
        join("dosen as d1", "d1.id = proposal.dosen_usulan1")->
        join("dosen as d2", "d2.id = proposal.dosen_usulan2")->
        getWhere([
            "proposal.status" => 'DITERIMA',
        ])->
        getResultArray();
    }

    public function getMahasiswaTanpaPembimbing() {
        $db = \Config\Database::connect();
        $sql = "select m.npm, m.nama as nama_mahasiswa, m.id_prodi, s.judul, b.nama as nama_bidang, 
        d1.nama as dosen_usulan1, d2.nama as dosen_usulan2
        from mahasiswa as m
        inner join skripsi as s on s.npm = m.npm
        inner join proposal as pro on pro.npm = m.npm
        inner join bidang as b on b.id = s.id_bidang
        left join pembimbing as pem on pem.id_skripsi = s.id
        inner join dosen as d1 on d1.id = pro.dosen_usulan1
        inner join dosen as d2 on d2.id = pro.dosen_usulan2
        where s.tanggal_skripsi = (select max(tanggal_skripsi) from skripsi as s2 where s2.npm = m.npm) and
        s.status = 'Dalam Pengerjaan' and
        pro.tanggal_upload = (select max(tanggal_upload) from proposal as pro2 where pro2.npm = m.npm) and
        pem.id is null";
        $result = $db->query($sql);
        return $result->getResultArray();
    }

    public function getMahasiswaDenganPembimbing() {
        $db = \Config\Database::connect();
        $sql = "select m.npm, m.nama as nama_mahasiswa, m.id_prodi, s.judul, b.nama as nama_bidang, b.inisial as inisial_bidang,
        prod.nama as nama_prodi, prod.inisial as inisial_prodi, d1.id as id_pembimbing1, d2.id as id_pembimbing2, 
        d3.id as id_pembimbing_agama, s.id as id_skripsi
        from mahasiswa as m
        inner join skripsi as s on s.npm = m.npm
        inner join bidang as b on b.id = s.id_bidang
        inner join program_studi as prod on prod.id = m.id_prodi
        inner join pembimbing as pem1 on pem1.id_skripsi = s.id
        inner join pembimbing as pem2 on pem2.id_skripsi = s.id
        inner join pembimbing as pem3 on pem3.id_skripsi = s.id
        inner join dosen as d1 on d1.id = pem1.id_dosen
        left join dosen as d2 on d2.id = pem2.id_dosen
        inner join dosen as d3 on d3.id = pem3.id_dosen
        where s.tanggal_skripsi = (select max(tanggal_skripsi) from skripsi as s2 where s2.npm = m.npm) and
        pem1.role = 'Pembimbing Ilmu 1' and
        (pem2.role = 'Pembimbing Ilmu 2' or pem2.role is null) and
        pem3.role = 'Pembimbing Agama'";
        $result = $db->query($sql);
        return $result->getResultArray();
    }
}