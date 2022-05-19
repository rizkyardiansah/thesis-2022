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

    public function getAllPembimbingByNpm($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("pembimbing");

        $arrayPembimbing = $builder->
        select("dosen.id as id_dosen, dosen.nama as nama_dosen, dosen.inisial as inisial_dosen, pembimbing.role, pembimbing.id as id_pembimbing")->
        join("skripsi", "skripsi.id = pembimbing.id_skripsi")->
        join("mahasiswa", "mahasiswa.npm = skripsi.npm")->
        join("dosen", "dosen.id = pembimbing.id_dosen")->
        getWhere(["skripsi.npm" => $npm])->
        getResultArray();

        return $arrayPembimbing;
    }

    public function getAllMahasiswaBimbingan($idDosen) {
        $db = \Config\Database::connect();
        $builder = $db->table("pembimbing");

        return $builder->
        select("mahasiswa.npm, mahasiswa.nama as nama_mahasiswa, proposal.judul, proposal.id_bidang, bidang.nama as nama_bidang, bidang.inisial as inisial_bidang, pembimbing.*")->
        join('skripsi', 'skripsi.id = pembimbing.id_skripsi')->
        join("mahasiswa", "mahasiswa.npm = skripsi.npm")->
        join("proposal", "proposal.npm = mahasiswa.npm")->
        join("bidang", "bidang.id = proposal.id_bidang")->
        where("pembimbing.id_dosen", $idDosen)->
        where("proposal.status", 'DITERIMA')->
        get()->getResultArray();

        
    }

}