<?php 
namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model 
{
    protected $table = "akun";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['username', 'email', 'password'];
    protected $useTimestamps = false;

}