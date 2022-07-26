<?php 
namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model 
{
    protected $table = "dosen";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nama', 'email', 'inisial', 'id_prodi'];
    protected $useTimestamps = false;

    public function getDosenByProdi($idProdi) {
        $db = \Config\Database::connect();
        $builder = $db->table("dosen");
        return $builder->
        select()->
        getWhere([
            "id_prodi" => $idProdi,
        ])->
        getResultArray();
    }

    public function getDosenByInisial($inisial) {
        $db = \Config\Database::connect();
        $builder = $db->table("dosen");
        $arrayDosen = $builder->
        select()->
        getWhere([
            "inisial" => $inisial,
        ])->
        getResultArray();

        if (count($arrayDosen) == 0) {
            return null;
        }

        return $arrayDosen[0];
    }

    public function getDosenWithCountMahasiswaBimbinganByProdi($id_prodi) {
        $db = \Config\Database::connect();
        $sql = "SELECT d.inisial as inisial_dosen, count(pem.id) as jumlah_mahasiswa, d.nama as nama_dosen, d.id as id_dosen
        from dosen as d
        left join pembimbing as pem on pem.id_dosen = d.id
        where d.id_prodi = ?
        group by d.inisial
        order by d.id ASC";
        $result = $db->query($sql, [$id_prodi]);
        return $result->getResultArray();
    }

    public function getMahasiswaBimbinganByIdDosen($id_dosen) {
        $db = \Config\Database::connect();
        $sql = "SELECT mhs.npm as npm, mhs.nama as nama_mahasiswa, skri.judul as judul, bid.inisial as inisial_bidang, bid.nama as nama_bidang, pem.role as peran_pembimbing, (select count(hasil_bimbingan) from catatan_bimbingan where id_pembimbing = pem.id and status = 'DISETUJUI') as jumlah_bimbingan, skri.status as status_skripsi
        from dosen as d
        inner join pembimbing as pem on pem.id_dosen = d.id
        inner join skripsi as skri on skri.id = pem.id_skripsi
        inner join bidang as bid on bid.id = skri.id_bidang
        inner join mahasiswa as mhs on mhs.npm = skri.npm
        where d.id = ?
        order by (select max(tanggal_bimbingan) from catatan_bimbingan where id_pembimbing = pem.id) DESC";
        $result = $db->query($sql, [$id_dosen]);
        return $result->getResultArray();
    }
}