<?php 
namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model 
{
    protected $table = "bidang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'inisial', "id_prodi"];
    protected $useTimestamps = false;

    public function getBidangByProdi($idProdi) {
        $db = \Config\Database::connect();
        $builder = $db->table("bidang");
        return $builder->
        select()->
        getWhere([
            "id_prodi" => $idProdi,
        ])->
        getResultArray();
    }

}