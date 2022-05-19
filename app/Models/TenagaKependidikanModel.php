<?php 
namespace App\Models;

use CodeIgniter\Model;

class TenagaKependidikanModel extends Model 
{
    protected $table = "tenaga_kependidikan";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'email'];
    protected $useTimestamps = false;

}