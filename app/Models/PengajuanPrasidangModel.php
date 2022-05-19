<?php 
namespace App\Models;

use CodeIgniter\Model;

class PengajuanPrasidangModel extends Model 
{
    protected $table = "pengajuan_prasidang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_skripsi', 'file_draft', 'lembar_persetujuan', 'status', 'tanggal_pengajuan'];
    protected $useTimestamps = false;

    public function getPengajuanPrasidangByNpm($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT pps.*, s.judul, s.sifat, s.sumber, b.nama as nama_bidang
        FROM pengajuan_prasidang as pps
        INNER JOIN skripsi as s on s.id = pps.id_skripsi
        INNER JOIN bidang as b on b.id = s.id_bidang
        INNER JOIN mahasiswa as m on m.npm = s.npm
        WHERE m.npm = ?
        ORDER BY pps.tanggal_pengajuan DESC";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getPengajuanPrasidangByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT m.npm, m.nama as nama_mahasiswa, s.judul, pps.*, d1.nama as nama_pembimbing1, dagama.nama as nama_pembimbing_agama 
        FROM pengajuan_prasidang as pps
        INNER JOIN skripsi as s on s.id = pps.id_skripsi
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as pagama on pagama.id_skripsi = s.id
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        INNER JOIN dosen as dagama on dagama.id = pagama.id_dosen
        INNER JOIN mahasiswa as m on m.npm = s.npm
        WHERE m.id_prodi = ? and
        s.tanggal_skripsi = (select max(tanggal_skripsi) from skripsi as s2 where s2.npm = m.npm) and
        pps.status = "TERTUNDA" and
        p1.role = "Pembimbing Ilmu 1" and
        pagama.role = "Pembimbing Agama"';
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getDetailPengajuanById($idPengajuanPrasidang) {
        $db = \Config\Database::connect();
        $sql = 'SELECT m.npm, m.nama as nama_mahasiswa, s.judul, pps.*, d1.nama as nama_pembimbing1, dagama.nama as nama_pembimbing_agama, s.sifat, s.sumber 
        FROM pengajuan_prasidang as pps
        INNER JOIN skripsi as s on s.id = pps.id_skripsi
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as pagama on pagama.id_skripsi = s.id
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        INNER JOIN dosen as dagama on dagama.id = pagama.id_dosen
        INNER JOIN mahasiswa as m on m.npm = s.npm
        WHERE pps.id = ? and
        p1.role = "Pembimbing Ilmu 1" and
        pagama.role = "Pembimbing Agama"';
        $result = $db->query($sql, [$idPengajuanPrasidang]);
        if (count($result->getResultArray()) == 0) {
            return null;
        }

        return $result->getResultArray()[0];
    }

}