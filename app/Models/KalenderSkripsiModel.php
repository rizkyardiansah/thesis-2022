<?php 
namespace App\Models;

use CodeIgniter\Model;

class KalenderSkripsiModel extends Model 
{
    protected $table = "kalender_skripsi";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai'];
    protected $useTimestamps = false;

}