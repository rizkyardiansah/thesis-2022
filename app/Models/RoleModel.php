<?php 
namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model 
{
    protected $table = "role";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama'];
    protected $useTimestamps = false;

}