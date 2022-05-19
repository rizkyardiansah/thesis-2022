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

}