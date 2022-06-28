<?php 
namespace App\Models;

use CodeIgniter\Model;

class SeminarPrasidangModel extends Model 
{
    protected $table = "seminar_prasidang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_skripsi', 'tanggal', 'ruangan', 'dosen_reviewer', 'komentar_reviewer', 'status', 'rekomendasi_nilai'];
    protected $useTimestamps = false;

    public function getPrasidangByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama AS nama_mahasiswa, s.judul, b.nama AS nama_bidang, b.inisial AS inisial_bidang,
        sp.* 
        -- d1.nama AS nama_penguji1, d2.nama AS nama_penguji2, d1.insial AS inisial_penguji1, d2.inisial AS inisial_penguji2 
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s ON s.id = sp.id_skripsi
        INNER JOIN mahasiswa AS m ON m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN dosen AS d1 ON d1.id = sp.dosen_reviewer
        WHERE m.id_prodi = ?
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getPrasidangByDateRange($idProdi, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama AS nama_mahasiswa, s.judul, b.nama AS nama_bidang, b.inisial AS inisial_bidang,
        sp.* 
        -- d1.nama AS nama_penguji1, d2.nama AS nama_penguji2, d1.insial AS inisial_penguji1, d2.inisial AS inisial_penguji2 
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s ON s.id = sp.id_skripsi
        INNER JOIN mahasiswa AS m ON m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN dosen AS d1 ON d1.id = sp.dosen_reviewer
        WHERE m.id_prodi = ? and
        sp.tanggal between ? and ?
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getJadwalByNPM($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, s.judul, d1.nama as nama_reviewer, d1.inisial as inisial_reviewer
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s on s.id = sp.id_skripsi
        INNER JOIN dosen as d1 on d1.id = sp.dosen_reviewer
        WHERE s.npm = ?
        ORDER BY sp.tanggal DESC";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getSeminarPrasidangByDosen($idDosen) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, s.judul, s.npm, d1.nama as nama_reviewer, d1.inisial as inisial_reviewer,
         b.nama AS nama_bidang, b.inisial AS inisial_bidang, m.nama as nama_mahasiswa
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s ON s.id = sp.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN dosen AS d1 ON d1.id = sp.dosen_reviewer
        WHERE sp.dosen_reviewer = ? 
        ORDER BY sp.tanggal DESC";
        $result = $db->query($sql, [$idDosen]);
        return $result->getResultArray();
    }

    public function getSeminarPrasidangByDosenDateRange($idDosen, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, s.judul, s.npm, d1.nama as nama_reviewer, d1.inisial as inisial_reviewer, 
        b.nama AS nama_bidang, b.inisial AS inisial_bidang, m.nama as nama_mahasiswa
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s ON s.id = sp.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN dosen AS d1 ON d1.id = sp.dosen_reviewer
        WHERE sp.dosen_reviewer = ? and
        sp.tanggal between ? and ?
        ORDER BY sp.tanggal DESC";
        $result = $db->query($sql, [$idDosen, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getDetailSeminarPrasidangById($idSeminarPrasidang) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, s.judul, m.npm, m.nama as nama_mahasiswa, b.nama AS nama_bidang, 
        d1.nama as pembimbing1, d2.nama as pembimbing2, d3.nama as pembimbing_agama, pp.file_draft, pp.lembar_persetujuan,
        r1.nama AS nama_reviewer
        FROM seminar_prasidang AS sp
        INNER JOIN skripsi AS s ON s.id = sp.id_skripsi
        INNER JOIN pengajuan_prasidang AS pp ON pp.id_skripsi = s.id
        INNER JOIN mahasiswa As m ON m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing AS p1 ON p1.id_skripsi = s.id
        LEFT JOIN pembimbing AS p2 ON p2.id_skripsi = s.id
        INNER JOIN pembimbing AS p3 ON p3.id_skripsi = s.id
        INNER JOIN dosen AS d1 ON d1.id = p1.id_dosen
        LEFT JOIN dosen AS d2 ON d2.id = p2.id_dosen
        INNER JOIN dosen AS d3 ON d3.id = p3.id_dosen
        INNER JOIN dosen AS r1 ON r1.id = sp.dosen_reviewer
        WHERE sp.id = ? AND 
        p1.role = 'Pembimbing Ilmu 1' AND
        p2.role = 'Pembimbing Ilmu 2' AND
        p3.role = 'Pembimbing Agama'";
        $result = $db->query($sql, [$idSeminarPrasidang]);
        return $result->getResultArray();
    }
}