<?php 
namespace App\Models;

use CodeIgniter\Model;

class SidangSkripsiModel extends Model 
{
    protected $table = "sidang_skripsi";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_skripsi', 'tanggal', 'ruangan', 'dosen_penguji'];
    protected $useTimestamps = false;

    public function getSidangSkripsiByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama AS nama_mahasiswa, s.judul, b.nama AS nama_bidang, b.inisial AS inisial_bidang,
        ss.*, penguji.nama as nama_penguji, penguji.inisial as inisial_penguji, 
        d1.nama AS nama_pembimbing1, d2.nama AS nama_pembimbing2, d3.nama as nama_pembimbing_agama, 
        d1.inisial AS inisial_pembimbing1, d2.inisial AS inisial_pembimbing2, d3.inisial as inisial_pembimbing_agama
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s ON s.id = ss.id_skripsi
        INNER JOIN mahasiswa AS m ON m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        LEFT JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen AS penguji ON penguji.id = ss.dosen_penguji
        INNER JOIN dosen AS d1 ON d1.id = p1.id_dosen
        LEFT JOIN dosen AS d2 ON d2.id = p2.id_dosen
        INNER JOIN dosen AS d3 ON d3.id = p3.id_dosen
        WHERE m.id_prodi = ? and
        p1.role = 'Pembimbing Ilmu 1' and
        p2.role in ('Pembimbing Ilmu 2', null) and
        p3.role = 'Pembimbing Agama'
        ";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

}