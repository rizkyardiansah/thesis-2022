<?php 
namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model 
{
    protected $table = "skripsi";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['judul', 'sumber', 'sifat', 'npm', 'id_bidang', 'tanggal_skripsi', 'status', 'file_draft', 'file_final', 'file_pengajuan_pra_sidang'];
    protected $useTimestamps = false;

    public function getSkripsiByNpm($npm) {
        $db = \Config\Database::connect();
        $sql = "select s.id, s.judul, s.sumber, s.sifat, s.npm, s.id_bidang, b.inisial as inisial_bidang, b.nama as nama_bidang, 
        s.status, d1.nama as nama_p1, d2.nama as nama_p2, dagama.nama as nama_pagama, 
        d1.inisial as inisial_p1, d2.inisial as inisial_p2, dagama.inisial as inisial_pagama
        from skripsi as s
        inner join bidang as b on b.id = s.id_bidang
        left join pembimbing as p1 on p1.id_skripsi = s.id
        left join pembimbing as p2 on p2.id_skripsi = s.id
        left join pembimbing as pagama on pagama.id_skripsi = s.id
        left join dosen as d1 on d1.id = p1.id_dosen
        left join dosen as d2 on d2.id = p2.id_dosen
        left join dosen as dagama on dagama.id = pagama.id_dosen
        where s.npm = ? and
        (p1.role = 'Pembimbing Ilmu 1' or p1.role is null) and
        (p2.role = 'Pembimbing Ilmu 2' or p2.role is null) and
        (pagama.role = 'Pembimbing Agama' or pagama.role is null)";
        $result = $db->query($sql, [$npm]);
        return $result->getResultArray();
    }

    public function getMahasiswaLastSkripsi($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("skripsi");
        $arraySkripsi = $builder->
        select()->
        orderBy("tanggal_skripsi", "DESC")->
        getWhere(["npm" => $npm])->
        getResultArray();
        if (count($arraySkripsi) == 0) {
            return null;
        }

        return $arraySkripsi[0];
    }

}