<?php 
namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model 
{
    protected $table = "akses";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_akun', 'id_role'];
    protected $useTimestamps = false;

    public function getRoles($akunId) {
        $db = \Config\Database::connect();
        $builder = $db->table("akses");
        // return $builder->get()->getResultArray();
        return $builder->select("role.nama")->join("role", "role.id = akses.id_role")->getWhere(["id_akun" => $akunId])->getResultArray();
    }
}