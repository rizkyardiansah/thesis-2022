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
    protected $allowedFields = ['id_dosen', 'id_sidang_skripsi', 'nilai_1', 'nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'nilai_7', 'nilai_8', 'nilai_9', 'nilai_10', 'nilai_11', 'nilai_12', 'nilai_akhir', 'grade', 'status'];
    protected $useTimestamps = false;

    // public function getNilaiSidangByIdSidang($idSidangSkripsi) {
    //     $db = \Config\Database::connect();
    //     $sql = "SELECT ps.* 
    //     FROM penilaian_sidang as ps
    //     inner join sidang_skripsi as ss on ss.id = ps.id_sidang_skripsi
    //     inner join skripsi as s on s.id = ss.id_skripsi
    //     inner join pembimbing as p1 on p1.id_skripsi = s.id
    //     inner join pembimbing as p2 on p2.id_skripsi = s.id
    //     inner join pembimbing as p3 on p3.id_skripsi = s.id
    //     inner join dosen as penguji on penguji.id = ss.dosen_penguji
    //     inner join dosen as d1 on d1.id = p1.id_dosen
    //     left join dosen as d2 on d2.id = p2.id_dosen
    //     inner join dosen as d3 on d3.id = p3.id_dosen
    //     where ss.id = ? and
    //     p1.role = 'Pembimbing Ilmu 1' and
    //     p2.role = 'Pembimbing Ilmu 2' and
    //     p3.role = 'Pembimbing Agama' and
    //     (";
    //     $result = $db->query($sql, [$idSidangSkripsi]);
    //     return $result->getResultArray();
    // }

}