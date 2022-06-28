<?php 
namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model 
{
    protected $table = "dosen";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'email', 'inisial', 'id_prodi'];
    protected $useTimestamps = false;

    public function getDosenByProdi($idProdi) {
        $db = \Config\Database::connect();
        $builder = $db->table("dosen");
        return $builder->
        select()->
        getWhere([
            "id_prodi" => $idProdi,
        ])->
        getResultArray();
    }

    public function getDosenByInisial($inisial) {
        $db = \Config\Database::connect();
        $builder = $db->table("dosen");
        $arrayDosen = $builder->
        select()->
        getWhere([
            "inisial" => $inisial,
        ])->
        getResultArray();

        if (count($arrayDosen) == 0) {
            return null;
        }

        return $arrayDosen[0];
    }
}