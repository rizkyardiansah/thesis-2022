<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProgramStudiModel extends Model 
{
    protected $table = "program_studi";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'inisial', 'kaprodi', 'id_fakultas', 'mode_sempro'];
    protected $useTimestamps = false;


    public function getProdiByKaprodi($idKaprodi) {
        $db = \Config\Database::connect();
        $builder = $db->table("program_studi");

        return $builder->select()->getWhere(["kaprodi" => $idKaprodi])->getResultArray()[0];
    }
}