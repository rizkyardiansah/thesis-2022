<?php 
namespace App\Models;

use CodeIgniter\Model;

class PengajuanSidangModel extends Model 
{
    protected $table = "pengajuan_sidang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_skripsi', 'file_draft_final', 'file_form_bimbingan','file_persyaratan_sidang', 'status', 'tanggal_pengajuan'];
    protected $useTimestamps = false;

    public function getPengajuanSidangByNpm($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT s.judul, b.nama as nama_bidang, s.sifat, s.sumber, ps.* 
        FROM pengajuan_sidang as ps
        INNER JOIN skripsi as s on s.id = ps.id_skripsi
        INNER JOIN bidang as b on b.id = s.id_bidang
        INNER JOIN mahasiswa as m on m.npm = s.npm
        WHERE m.npm = ?
        ORDER BY ps.tanggal_pengajuan ASC";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getAllPengajuanSidang() {
        $db = \Config\Database::connect();
        $sql = "SELECT s.judul, m.nama as nama_mahasiswa, m.npm, ps.*, 
        d1.nama as nama_pembimbing1, d2.nama as nama_pembimbing2, d3.nama as nama_pembimbing_agama, 
        d1.inisial as inisial_pembimbing1, d2.inisial as inisial_pembimbing2, d3.inisial as inisial_pembimbing_agama, 
        prodi.nama as nama_prodi, prodi.inisial as inisial_prodi 
        FROM pengajuan_sidang as ps
        INNER JOIN skripsi as s on s.id = ps.id_skripsi
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        LEFT JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        LEFT JOIN dosen as d2 on d2.id = p2.id_dosen
        INNER JOIN dosen as d3 on d3.id = p3.id_dosen
        INNER JOIN mahasiswa as m on m.npm = s.npm
        INNER JOIN program_studi as prodi on prodi.id = m.id_prodi
        WHERE p1.role = 'Pembimbing Ilmu 1' and
        p2.role IN ('Pembimbing Ilmu 2', null) and 
        p3.role = 'Pembimbing Agama' AND
        s.tanggal_skripsi = (select max(tanggal_skripsi) from skripsi as s2 where s2.npm = m.npm)
        order by ps.tanggal_pengajuan DESC";
        $result = $db->query($sql);
        return $result->getResultArray();
    }

    public function getPengajuanSidangByDateRange($dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT s.judul, m.nama as nama_mahasiswa, m.npm, ps.*, 
        d1.nama as nama_pembimbing1, d2.nama as nama_pembimbing2, d3.nama as nama_pembimbing_agama, 
        d1.inisial as inisial_pembimbing1, d2.inisial as inisial_pembimbing2, d3.inisial as inisial_pembimbing_agama, 
        prodi.nama as nama_prodi, prodi.inisial as inisial_prodi 
        FROM pengajuan_sidang as ps
        INNER JOIN skripsi as s on s.id = ps.id_skripsi
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        LEFT JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        LEFT JOIN dosen as d2 on d2.id = p2.id_dosen
        INNER JOIN dosen as d3 on d3.id = p3.id_dosen
        INNER JOIN mahasiswa as m on m.npm = s.npm
        INNER JOIN program_studi as prodi on prodi.id = m.id_prodi
        WHERE p1.role = 'Pembimbing Ilmu 1' and
        p2.role IN ('Pembimbing Ilmu 2', null) and 
        p3.role = 'Pembimbing Agama' AND
        s.tanggal_skripsi = (select max(tanggal_skripsi) from skripsi as s2 where s2.npm = m.npm) and
        ps.tanggal_pengajuan between ? and ?
        order by ps.tanggal_pengajuan DESC";
        $result = $db->query($sql, [$dari, $hingga]);
        return $result->getResultArray();
    }

    public function getDetailPengajuanById($idPengajuanSidangSkripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT s.judul, m.nama as nama_mahasiswa, m.npm, ps.*, b.nama as nama_bidang,
        d1.nama as nama_pembimbing1, d2.nama as nama_pembimbing2, d3.nama as nama_pembimbing_agama,
        prodi.nama as nama_prodi, s.id as id_skripsi
        FROM pengajuan_sidang as ps
        INNER JOIN skripsi as s on s.id = ps.id_skripsi
        INNER JOIN bidang as b on b.id = s.id_bidang
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        LEFT JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        LEFT JOIN dosen as d2 on d2.id = p2.id_dosen
        INNER JOIN dosen as d3 on d3.id = p3.id_dosen
        INNER JOIN mahasiswa as m on m.npm = s.npm
        INNER JOIN program_studi as prodi on prodi.id = m.id_prodi
        WHERE p1.role = 'Pembimbing Ilmu 1' and
        p2.role IN ('Pembimbing Ilmu 2', null) and 
        p3.role = 'Pembimbing Agama' and
        ps.id = ?";
        $result = $db->query($sql, [$idPengajuanSidangSkripsi]);

        if (count($result->getResultArray()) == 0) {
            return null;
        }

        return $result->getResultArray()[0];
    }   
}