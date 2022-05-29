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
        $sql = "SELECT m.nama as nama_mahasiswa, m.npm, m.sks_lulus, m.mk_sedang_diambil, m.mk_akan_diambil,
        m.file_khs, m.file_krs, m.file_persetujuan_skripsi, m.status_persetujuan_skripsi, prodi.inisial as inisial_prodi, prodi.nama as nama_prodi,
        d.inisial as inisial_pembimbing_akademik, d.nama as nama_pembimbing_akademik
        FROM mahasiswa as m
        INNER JOIN dosen as d on d.id = m.pembimbing_akademik
        INNER JOIN program_studi as prodi on prodi.id = m.id_prodi
        WHERE m.sks_lulus is not null and
        m.pembimbing_akademik is not null and
        m.mk_sedang_diambil is not null and
        m.mk_akan_diambil is not null and
        m.file_khs is not null and
        m.file_krs is not null and
        m.file_persetujuan_skripsi is not null and
        m.status_persetujuan_skripsi is null";
        $result = $db->query($sql);
        return $result->getResultArray();
    }

    public function getPengajuanSkripsiByNpm($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.nama as nama_mahasiswa, m.npm, m.sks_lulus, m.mk_sedang_diambil, m.mk_akan_diambil,
        m.file_khs, m.file_krs, m.file_persetujuan_skripsi, m.status_persetujuan_skripsi, 
        prodi.nama as nama_prodi, d.nama as nama_pembimbing_akademik
        FROM mahasiswa as m
        INNER JOIN dosen as d on d.id = m.pembimbing_akademik
        INNER JOIN program_studi as prodi on prodi.id = m.id_prodi
        WHERE m.sks_lulus is not null and
        m.pembimbing_akademik is not null and
        m.mk_sedang_diambil is not null and
        m.mk_akan_diambil is not null and
        m.file_khs is not null and
        m.file_krs is not null and
        m.file_persetujuan_skripsi is not null and
        m.status_persetujuan_skripsi is null and
        m.npm = ?";

        $result = $db->query($sql, [$npm]);

        if (count($result->getResultArray()) == 0) {
            return null;
        }

        return $result->getResultArray()[0];
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
        $sql = "SELECT m.npm, m.nama, s.judul AS judul, b.nama AS nama_bidang
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

    public function getMahasiswaBelumDapatSidangByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama, s.judul AS judul, b.nama AS nama_bidang, 
                d1.nama as nama_pembimbing1, d2.nama as nama_pembimbing2, d3.nama as nama_pembimbing_agama
                FROM mahasiswa AS m
                INNER JOIN skripsi AS s ON s.npm = m.npm
                INNER JOIN pengajuan_sidang AS ps ON ps.id_skripsi = s.id
                INNER JOIN bidang AS b ON b.id = s.id_bidang
                LEFT JOIN sidang_skripsi AS ss ON ss.id_skripsi = s.id
                INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
                LEFT JOIN pembimbing as p2 on p2.id_skripsi = s.id
                INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
                INNER JOIN dosen as d1 on d1.id = p1.id_dosen
                LEFT JOIN dosen as d2 on d2.id = p2.id_dosen
                INNER JOIN dosen as d3 on d3.id = p3.id_dosen
                WHERE m.id_prodi = ? 
                AND s.tanggal_skripsi = (SELECT max(s2.tanggal_skripsi) FROM skripsi AS s2 WHERE s2.npm = m.npm)
                AND s.status = 'Dalam Pengerjaan'
                AND ps.status = 'DISETUJUI'
                AND p1.role = 'Pembimbing Ilmu 1'
                AND p2.role in ('Pembimbing Ilmu 2', null)
                AND p3.role = 'Pembimbing Agama'
                AND ss.id IS NULL";
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