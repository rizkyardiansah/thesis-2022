<?php 
namespace App\Models;

use CodeIgniter\Model;

class CatatanBimbinganModel extends Model 
{
    protected $table = "catatan_bimbingan";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_pembimbing', 'hasil_bimbingan', 'tanggal_bimbingan', 'status'];
    protected $useTimestamps = false;

    public function getAllCatatanByNpm($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("catatan_bimbingan");

        return $builder->
        select("mahasiswa.npm, dosen.nama as nama_dosen, pembimbing.role, pembimbing.id as id_pembimbing, catatan_bimbingan.*")->
        join("pembimbing", "pembimbing.id = catatan_bimbingan.id_pembimbing")->
        join("skripsi" , 'skripsi.id = pembimbing.id_skripsi')->
        join('mahasiswa', 'mahasiswa.npm = skripsi.npm')->
        join("dosen", "dosen.id = pembimbing.id_dosen")->
        orderBy("catatan_bimbingan.tanggal_bimbingan", "ASC")->
        getWhere(["skripsi.npm" => $npm])->
        getResultArray();
    }

    public function getAllCatatanByLastSkripsi($idSkripsi) {
        $db = \Config\Database::connect();
        $sql = "SELECT m.npm, d.nama as nama_dosen, p.role, p.id as id_pembimbing, cb.*
        from catatan_bimbingan as cb
        inner join pembimbing as p on p.id = cb.id_pembimbing
        inner join skripsi as s on s.id = p.id_skripsi
        inner join mahasiswa as m on m.npm = s.npm
        inner join dosen as d on d.id = p.id_dosen
        where s.id = ? 
        order by cb.tanggal_bimbingan asc";
        $result = $db->query($sql, [$idSkripsi]);
        return $result->getResultArray();
    }

}