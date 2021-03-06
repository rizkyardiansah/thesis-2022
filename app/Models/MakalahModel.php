<?php 
namespace App\Models;

use CodeIgniter\Model;

class MakalahModel extends Model 
{
    protected $table = "makalah";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['judul', 'deskripsi', 'kata_kunci', 'file_makalah', 'npm', 'tanggal_upload', 'id_bidang'];
    protected $useTimestamps = false;

    public function getAllMakalah() {
        $db = \Config\Database::connect();
        $sql = "SELECT mak.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang, ps.nama as nama_prodi, ps.inisial as inisial_prodi
        from makalah as mak
        inner join mahasiswa as m on m.npm = mak.npm
        inner join bidang as b on b.id = mak.id_bidang
        inner join program_studi as ps on ps.id = m.id_prodi
        order by mak.tanggal_upload DESC";
        $result = $db->query($sql);
        return $result->getResultArray();
    }

    public function getMakalahByDateRange($dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT mak.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang, ps.nama as nama_prodi, ps.inisial as inisial_prodi
        from makalah as mak
        inner join mahasiswa as m on m.npm = mak.npm
        inner join bidang as b on b.id = mak.id_bidang
        inner join program_studi as ps on ps.id = m.id_prodi
        where mak.tanggal_upload between ? and ?
        order by mak.tanggal_upload DESC";
        $result = $db->query($sql, [$dari, $hingga]);
        return $result->getResultArray();
    }

    public function getMakalahMahasiswaByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT mak.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang
        from makalah as mak
        inner join mahasiswa as m on m.npm = mak.npm
        inner join bidang as b on b.id = mak.id_bidang
        where  m.id_prodi = ?
        order by mak.tanggal_upload DESC';
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getMakalahMahasiswaByDateRange($idProdi, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = 'SELECT mak.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang
        from makalah as mak
        inner join mahasiswa as m on m.npm = mak.npm
        inner join bidang as b on b.id = mak.id_bidang
        where 
        m.id_prodi = ? and
        mak.tanggal_upload between ? and ?
        order by mak.tanggal_upload DESC';
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
    }



}