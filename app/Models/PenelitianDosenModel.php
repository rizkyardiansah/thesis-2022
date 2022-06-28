<?php 
namespace App\Models;

use CodeIgniter\Model;

class PenelitianDosenModel extends Model 
{
    protected $table = "penelitian_dosen";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['judul', 'deskripsi', 'id_dosen', 'id_bidang', 'status', 'jumlah_peneliti'];
    protected $useTimestamps = false;

    public function getAllPenelitianByIdDosen($idDosen) {
        $db = \Config\Database::connect();
        $sql = "SELECT pd.*, b.nama as nama_bidang, b.inisial as inisial_bidang
        FROM penelitian_dosen as pd
        inner join bidang as b on b.id = pd.id_bidang
        where pd.id_dosen = ?";
        $result = $db->query($sql, [$idDosen]);
        return $result->getResultArray();
    }

    public function getAllPenelitian() {
        $db = \Config\Database::connect();
        $sql = "SELECT pd.*, b.nama as nama_bidang, d.nama as nama_dosen, d.email as email_dosen, prodi.inisial as inisial_prodi
        FROM penelitian_dosen as pd
        inner join bidang as b on b.id = pd.id_bidang
        inner join dosen as d on d.id = pd.id_dosen
        inner join program_studi as prodi on prodi.id = d.id_prodi";
        $result = $db->query($sql);
        return $result->getResultArray();
    }

}