<?php 
namespace App\Models;

use CodeIgniter\Model;

class PembimbingModel extends Model 
{
    protected $table = "pembimbing";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_skripsi', 'id_dosen', 'role'];
    protected $useTimestamps = false;

    public function hasPembimbing($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("pembimbing");

        $arrayPembimbing = $builder->
        getWhere(["npm" => $npm])->
        getResultArray();

        return count($arrayPembimbing) >= 2 ;
    }

    public function getAllPembimbingByIdSkripsi($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT d.id as id_dosen, d.nama as nama_dosen, d.inisial as inisial_dosen, p.role, p.id as id_pembimbing
        from pembimbing as p
        inner join skripsi as s on s.id = p.id_skripsi
        inner join dosen as d on d.id = p.id_dosen
        where s.id = ? ";
        $result = $db->query($sql, [$idSkripsi]);
        return $result->getResultArray();

        // $arrayPembimbing = $builder->
        // select("dosen.id as id_dosen, dosen.nama as nama_dosen, dosen.inisial as inisial_dosen, pembimbing.role, pembimbing.id as id_pembimbing")->
        // join("skripsi", "skripsi.id = pembimbing.id_skripsi")->
        // join("dosen", "dosen.id = pembimbing.id_dosen")->
        // getWhere(["skripsi.id" => $idSkripsi])->
        // getResultArray();

        // return $arrayPembimbing;
    }

    public function getAllMahasiswaBimbingan($idDosen) {
        $db = \Config\Database::connect();
        $sql = 'SELECT p.*, m.npm, m.nama as nama_mahasiswa, s.judul, s.id_bidang, b.nama as nama_bidang,
        b.inisial as inisial_bidang
        from pembimbing as p
        inner join skripsi as s on s.id = p.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        inner join bidang as b on b.id = s.id_bidang
        where p.id_dosen = ?';
        $result = $db->query($sql, [$idDosen]);
        return $result->getResultArray();        
    }

    public function getPembimbingIlmu1ByIdSkripsi($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT p.*, d.nama as nama_dosen, d.inisial as inisial_dosen
        from pembimbing as p
        inner join dosen as d on p.id_dosen = d.id
        where p.role = "Pembimbing Ilmu 1" and p.id_skripsi = ? ';
        $result = $db->query($sql, [$idSkripsi]);
        return $result->getResultArray();
    }

    public function getPembimbingIlmu2ByIdSkripsi($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT p.*, d.nama as nama_dosen, d.inisial as inisial_dosen
        from pembimbing as p
        left join dosen as d on p.id_dosen = d.id
        where p.role = "Pembimbing Ilmu 2" and p.id_skripsi = ? ';
        $result = $db->query($sql, [$idSkripsi]);
        return $result->getResultArray();
    }

    public function getPembimbingAgamaByIdSkripsi($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = 'SELECT p.*, d.nama as nama_dosen, d.inisial as inisial_dosen
        from pembimbing as p
        inner join dosen as d on p.id_dosen = d.id
        where p.role = "Pembimbing Agama" and p.id_skripsi = ? ';
        $result = $db->query($sql, [$idSkripsi]);
        return $result->getResultArray();
    }

}