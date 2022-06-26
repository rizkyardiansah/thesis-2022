<?php 
namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model 
{
    protected $table = "fakultas";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'inisial', 'email'];
    protected $useTimestamps = false;

}