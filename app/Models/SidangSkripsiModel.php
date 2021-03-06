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
    protected $allowedFields = ['id_skripsi', 'tanggal', 'ruangan', 'dosen_penguji', 'total_nilai', 'grade', 'status'];
    protected $useTimestamps = false;

    public function getSidangSkripsiByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, m.nama AS nama_mahasiswa, s.judul, b.nama AS nama_bidang, b.inisial AS inisial_bidang,
        ss.*, penguji.nama as nama_penguji, penguji.inisial as inisial_penguji, 
        d1.nama AS nama_pembimbing1, d2.nama AS nama_pembimbing2, d3.nama as nama_pembimbing_agama, 
        d1.inisial AS inisial_pembimbing1, d2.inisial AS inisial_pembimbing2, d3.inisial as inisial_pembimbing_agama, count(ps.grade) as jumlah_nilai_masuk
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s ON s.id = ss.id_skripsi
        INNER JOIN mahasiswa AS m ON m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen AS penguji ON penguji.id = ss.dosen_penguji
        INNER JOIN dosen AS d1 ON d1.id = p1.id_dosen
        LEFT JOIN dosen AS d2 ON d2.id = p2.id_dosen
        INNER JOIN dosen AS d3 ON d3.id = p3.id_dosen
        left join penilaian_sidang as ps on ps.id_sidang_skripsi = ss.id
        WHERE m.id_prodi = ? and
        p1.role = 'Pembimbing Ilmu 1' and
        p2.role = 'Pembimbing Ilmu 2' and
        p3.role = 'Pembimbing Agama'
        group by ss.id
        order by ss.tanggal DESC
        ";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getSidangSkripsiByDateRange($idProdi, $dari, $hingga) {
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
        INNER JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen AS penguji ON penguji.id = ss.dosen_penguji
        INNER JOIN dosen AS d1 ON d1.id = p1.id_dosen
        LEFT JOIN dosen AS d2 ON d2.id = p2.id_dosen
        INNER JOIN dosen AS d3 ON d3.id = p3.id_dosen
        WHERE m.id_prodi = ? and
        p1.role = 'Pembimbing Ilmu 1' and
        p2.role = 'Pembimbing Ilmu 2' and
        p3.role = 'Pembimbing Agama' and
        ss.tanggal between ? and ?
        order by ss.tanggal DESC";
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getSidangSkripsiByDosen($idDosen) {
        $db = \Config\Database::connect();
        $sql = "SELECT ss.*, 
        m.nama as nama_mahasiswa,
        s.judul, s.npm,
        b.nama AS nama_bidang, b.inisial AS inisial_bidang, 
        p1.id_dosen as id_pembimbing_1, 
        p2.id_dosen as id_pembimbing_2, 
        p3.id_dosen as id_pembimbing_agama,
        (select ps.status from penilaian_sidang as ps where ps.id_sidang_skripsi = ss.id and ps.id_dosen = ?) as status_nilai
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s ON s.id = ss.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        WHERE 
        (ss.dosen_penguji = ? or p1.id_dosen = ? or p2.id_dosen = ? or p3.id_dosen = ?) and
        p1.role = 'Pembimbing Ilmu 1' and
        p2.role = 'Pembimbing Ilmu 2' and
        p3.role = 'Pembimbing Agama'
        ORDER BY ss.tanggal DESC";
        $result = $db->query($sql, [$idDosen, $idDosen, $idDosen, $idDosen, $idDosen]);
        return $result->getResultArray();
    }

    public function getSidangSkripsiByDosenDateRange($idDosen, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT ss.*, 
        m.nama as nama_mahasiswa,
        s.judul, s.npm,
        b.nama AS nama_bidang, b.inisial AS inisial_bidang, 
        p1.id_dosen as id_pembimbing_1, 
        p2.id_dosen as id_pembimbing_2, 
        p3.id_dosen as id_pembimbing_agama,
        (select ps.status from penilaian_sidang as ps where ps.id_sidang_skripsi = ss.id and ps.id_dosen = ?) as status_nilai 
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s ON s.id = ss.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        WHERE 
        (ss.dosen_penguji = ? or p1.id_dosen = ? or p2.id_dosen = ? or p3.id_dosen = ?) and
        p1.role = 'Pembimbing Ilmu 1' and
        p2.role = 'Pembimbing Ilmu 2' and
        p3.role = 'Pembimbing Agama' and
        ss.tanggal between ? and ?
        ORDER BY ss.tanggal DESC";
        $result = $db->query($sql, [$idDosen, $idDosen, $idDosen, $idDosen, $idDosen, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getDetailSidangSkripsiById($idSidangSkripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT ss.*, 
        s.judul, 
        m.npm, m.nama as nama_mahasiswa, 
        b.nama AS nama_bidang, 
        d1.nama as pembimbing1, 
        d2.nama as pembimbing2, 
        d3.nama as pembimbing_agama, 
        ps.file_draft_final, ps.file_form_bimbingan, ps.file_persyaratan_sidang,
        reviewer.nama as nama_reviewer_sempra,
        sempra.komentar_reviewer as komentar_sempra, sempra.rekomendasi_nilai,
        reviewer_sempro.nama as nama_reviewer_sempro,
        prop.komentar as komentar_sempro,
        penguji.nama AS nama_penguji
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s ON s.id = ss.id_skripsi
        inner join seminar_prasidang as sempra on sempra.id_skripsi = s.id
        INNER JOIN pengajuan_sidang AS ps ON ps.id_skripsi = s.id
        INNER JOIN mahasiswa As m ON m.npm = s.npm
        inner join proposal as prop on prop.npm = m.npm
        INNER JOIN bidang AS b ON b.id = s.id_bidang
        INNER JOIN pembimbing AS p1 ON p1.id_skripsi = s.id
        INNER JOIN pembimbing AS p2 ON p2.id_skripsi = s.id
        INNER JOIN pembimbing AS p3 ON p3.id_skripsi = s.id
        INNER JOIN dosen AS penguji ON penguji.id = ss.dosen_penguji
        INNER JOIN dosen AS d1 ON d1.id = p1.id_dosen
        LEFT JOIN dosen AS d2 ON d2.id = p2.id_dosen
        INNER JOIN dosen AS d3 ON d3.id = p3.id_dosen
        inner join dosen as reviewer on reviewer.id = sempra.dosen_reviewer
        inner join dosen as reviewer_sempro on reviewer_sempro.id = prop.pembuat_komentar
        WHERE ss.id = ? AND 
        p1.role = 'Pembimbing Ilmu 1' AND
        p2.role = 'Pembimbing Ilmu 2' AND
        p3.role = 'Pembimbing Agama'";
        $result = $db->query($sql, [$idSidangSkripsi]);
        return $result->getResultArray();
    }

    public function getJadwalByNPM($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT ss.*, s.judul, penguji.nama as nama_penguji, penguji.inisial as inisial_penguji, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1,
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing_agama, d3.inisial as inisial_pembimbing_agama
        FROM sidang_skripsi AS ss
        INNER JOIN skripsi AS s on s.id = ss.id_skripsi
        INNER JOIN pembimbing as p1 on p1.id_skripsi = s.id
        INNER JOIN pembimbing as p2 on p2.id_skripsi = s.id
        INNER JOIN pembimbing as p3 on p3.id_skripsi = s.id
        INNER JOIN dosen as penguji on penguji.id = ss.dosen_penguji
        INNER JOIN dosen as d1 on d1.id = p1.id_dosen
        LEFT JOIN dosen as d2 on d2.id = p2.id_dosen
        INNER JOIN dosen as d3 on d3.id = p3.id_dosen
        WHERE s.npm = ? AND
        p1.role = 'Pembimbing Ilmu 1' AND
        p2.role = 'Pembimbing Ilmu 2' AND
        p3.role = 'Pembimbing Agama'
        ORDER BY ss.tanggal ASC";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getAllSidangSkripsiByProdi($id_prodi) {
        $db = \Config\Database::connect();
        $sql = "SELECT mhs.nama as nama_mahasiswa, mhs.npm as npm,
        skri.judul as judul, skri.id as id_skripsi,
        ss.tanggal, ss.ruangan, ss.total_nilai, ss.grade, ss.status,
        penguji.inisial as inisial_penguji, penguji.nama as nama_penguji 
        from sidang_skripsi as ss
        inner join skripsi as skri on skri.id = ss.id_skripsi
        inner join mahasiswa as mhs on mhs.npm = skri.npm
        inner join dosen as penguji on penguji.id = ss.dosen_penguji
        where mhs.id_prodi = ?
        order by ss.tanggal DESC";
        $result = $db->query($sql, [$id_prodi]);
        return $result->getResultArray();
    }

    public function getAllSidangSkripsi() {
        $db = \Config\Database::connect();
        $sql = "SELECT mhs.nama as nama_mahasiswa, mhs.npm as npm,
        prodi.inisial as inisial_prodi, prodi.nama as nama_prodi,
        skri.judul as judul, skri.id as id_skripsi,
        ss.tanggal, ss.ruangan, ss.total_nilai, ss.grade, ss.status,
        penguji.inisial as inisial_penguji, penguji.nama as nama_penguji 
        from sidang_skripsi as ss
        inner join skripsi as skri on skri.id = ss.id_skripsi
        inner join mahasiswa as mhs on mhs.npm = skri.npm
        inner join program_studi as prodi on prodi.id = mhs.id_prodi
        inner join dosen as penguji on penguji.id = ss.dosen_penguji
        order by ss.tanggal DESC";
        $result = $db->query($sql);
        return $result->getResultArray();
    }
}