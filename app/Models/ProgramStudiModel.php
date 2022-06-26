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
    protected $allowedFields = ['nama', 'inisial', 'id_fakultas', 'mode_sempro', 'email'];
    protected $useTimestamps = false;
}