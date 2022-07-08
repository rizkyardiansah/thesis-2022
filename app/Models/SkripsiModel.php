<?php 
namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model 
{
    protected $table = "skripsi";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['judul', 'sumber', 'sifat', 'npm', 'id_bidang', 'tanggal_skripsi', 'status', 'file_skripsi', 'tanggal_selesai_skripsi'];
    protected $useTimestamps = false;

    public function getSkripsiByNpm($npm) {
        $db = \Config\Database::connect();
        $sql = "SELECT s.id, s.judul, s.sumber, s.sifat, s.npm, s.id_bidang, s.file_skripsi, b.inisial as inisial_bidang, b.nama as nama_bidang, 
        s.status, d1.nama as nama_p1, d2.nama as nama_p2, dagama.nama as nama_pagama, 
        d1.inisial as inisial_p1, d2.inisial as inisial_p2, dagama.inisial as inisial_pagama
        from skripsi as s
        inner join bidang as b on b.id = s.id_bidang
        left join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        left join pembimbing as pagama on pagama.id_skripsi = s.id
        left join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        left join dosen as dagama on dagama.id = pagama.id_dosen
        where s.npm = ? and
        (p1.role = 'Pembimbing Ilmu 1' or p1.role is null) and
        (p2.role = 'Pembimbing Ilmu 2' or p2.role is null) and
        (pagama.role = 'Pembimbing Agama' or pagama.role is null)";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getAllSkripsiMahasiswa() {
        $db = \Config\Database::connect();
        $sql = 'SELECT s.*, m.nama as nama_mahasiswa, prodi.nama as nama_prodi, prodi.inisial as inisial_prodi,
        b.nama as nama_bidang, b.inisial as inisial_bidang, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1,
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing_agama, d3.inisial as inisial_pembimbing_agama, mak.id as id_makalah, mak.file_makalah
        from skripsi as s
        left join makalah as mak on mak.npm = s.npm
        inner join bidang as b on b.id = s.id_bidang
        inner join mahasiswa as m on m.npm = s.npm
        inner join program_studi as prodi on prodi.id = m.id_prodi
        inner join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        inner join pembimbing as p3 on p3.id_skripsi = s.id
        inner join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        inner join dosen as d3 on d3.id = p3.id_dosen
        where 
        p1.role = "Pembimbing Ilmu 1" and
        p2.role = "Pembimbing Ilmu 2" and
        p3.role = "Pembimbing Agama" 
        order by s.tanggal_skripsi DESC';
        $result = $db->query($sql);
        return $result->getResultArray();
    }

    public function getAllSkripsiMahasiswaByDateRange($dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = 'SELECT s.*, m.nama as nama_mahasiswa, prodi.nama as nama_prodi, prodi.inisial as inisial_prodi,
        b.nama as nama_bidang, b.inisial as inisial_bidang, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1,
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing_agama, d3.inisial as inisial_pembimbing_agama, mak.id as id_makalah, mak.file_makalah
        from skripsi as s
        left join makalah as mak on mak.npm = s.npm
        inner join bidang as b on b.id = s.id_bidang
        inner join mahasiswa as m on m.npm = s.npm
        inner join program_studi as prodi on prodi.id = m.id_prodi
        inner join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        inner join pembimbing as p3 on p3.id_skripsi = s.id
        inner join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        inner join dosen as d3 on d3.id = p3.id_dosen
        where 
        p1.role = "Pembimbing Ilmu 1" and
        p2.role = "Pembimbing Ilmu 2" and
        p3.role = "Pembimbing Agama" and
        s.tanggal_skripsi between ? and ?
        order by s.tanggal_skripsi DESC';
        $result = $db->query($sql, [$dari, $hingga]);
        return $result->getResultArray();
    }

    public function getSkripsiMahasiswaByProdi($idProdi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT s.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1,
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing_agama, d3.inisial as inisial_pembimbing_agama, mak.id as id_makalah, mak.file_makalah
        from skripsi as s
        left join makalah as mak on mak.npm = s.npm
        inner join bidang as b on b.id = s.id_bidang
        inner join mahasiswa as m on m.npm = s.npm
        inner join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        inner join pembimbing as p3 on p3.id_skripsi = s.id
        inner join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        inner join dosen as d3 on d3.id = p3.id_dosen
        where 
        m.id_prodi = ? and
        p1.role = "Pembimbing Ilmu 1" and
        p2.role = "Pembimbing Ilmu 2" and
        p3.role = "Pembimbing Agama" 
        order by s.tanggal_skripsi DESC';
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

    public function getSkripsiMahasiswaByDateRange($idProdi, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = 'SELECT s.*, m.nama as nama_mahasiswa, b.nama as nama_bidang, b.inisial as inisial_bidang, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1,
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing_agama, d3.inisial as inisial_pembimbing_agama, mak.id as id_makalah, mak.file_makalah
        from skripsi as s
        left join makalah as mak on mak.npm = s.npm
        inner join bidang as b on b.id = s.id_bidang
        inner join mahasiswa as m on m.npm = s.npm
        inner join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        inner join pembimbing as p3 on p3.id_skripsi = s.id
        inner join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        inner join dosen as d3 on d3.id = p3.id_dosen
        where 
        m.id_prodi = ? and
        p1.role = "Pembimbing Ilmu 1" and
        p2.role = "Pembimbing Ilmu 2" and
        p3.role = "Pembimbing Agama" and
        s.tanggal_skripsi between ? and ?
        order by s.tanggal_skripsi DESC
        ';
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getMahasiswaLastSkripsi($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("skripsi");
        $arraySkripsi = $builder->
        select()->
        orderBy("tanggal_skripsi", "DESC")->
        getWhere(["npm" => $npm])->
        getResultArray();
        if (count($arraySkripsi) == 0) {
            return null;
        }

        return $arraySkripsi[0];
    }

    public function getDetailSkripsiById($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT s.*, 
        d1.nama as nama_pembimbing1, d1.inisial as inisial_pembimbing1, 
        d2.nama as nama_pembimbing2, d2.inisial as inisial_pembimbing2,
        d3.nama as nama_pembimbing3, d3.inisial as inisial_pembimbing3,
        (select count(cb.id) from catatan_bimbingan as cb where cb.id_pembimbing = p1.id and cb.status = 'DISETUJUI') as total_bimbingan1,
        (select count(cb.id) from catatan_bimbingan as cb where cb.id_pembimbing = p2.id and cb.status = 'DISETUJUI') as total_bimbingan2,
        (select count(cb.id) from catatan_bimbingan as cb where cb.id_pembimbing = p3.id and cb.status = 'DISETUJUI') as total_bimbingan3
        from skripsi as s
        left join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        left join pembimbing as p3 on p3.id_skripsi = s.id
        left join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        left join dosen as d3 on d3.id = p3.id_dosen
        where s.id = ? and
        (p1.role = 'Pembimbing Ilmu 1' or p1.role is NULL) and
        (p2.role = 'Pembimbing Ilmu 2'or p2.role is NULL) and
        (p3.role = 'Pembimbing Agama' or p3.role is NULL)
        ";
        $result = $db->query($sql, [$idSkripsi]);
        if (count($result->getResultArray()) == 0) {
            return null;
        }

        return $result->getResultArray()[0];
    }

}