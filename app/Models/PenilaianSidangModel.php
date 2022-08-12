<?php 
namespace App\Models;

use CodeIgniter\Model;

class PenilaianSidangModel extends Model 
{
    protected $table = "penilaian_sidang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_dosen', 'id_sidang_skripsi', 'nilai_1', 'nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nilai_7', 'nilai_8', 'nilai_9', 'nilai_10', 'nilai_11', 'nilai_12', 'nilai_akhir', 'grade', 'status', 'tunda_nilai'];
    protected $useTimestamps = false;

    public function getStatusPenampilanNilai($id_sidang_skripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT ps.tunda_nilai, d.nama as nama_dosen, d.id as id_dosen
        from penilaian_sidang as ps
        inner join dosen as d on d.id = ps.id_dosen
        where ps.id_sidang_skripsi = ?
        ";
        $result = $db->query($sql, [$id_sidang_skripsi]);
        return $result->getResultArray();
    }
}