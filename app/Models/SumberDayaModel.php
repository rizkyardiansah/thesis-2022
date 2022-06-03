<?php 
namespace App\Models;

use CodeIgniter\Model;

class SumberDayaModel extends Model 
{
    protected $table = "sumber_daya";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'nama_file'];
    protected $useTimestamps = false;

}