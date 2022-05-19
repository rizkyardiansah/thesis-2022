<?php 
namespace App\Models;

use CodeIgniter\Model;

class SeminarProposalModel extends Model 
{
    protected $table = "seminar_proposal";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_proposal', 'tanggal', 'ruangan', 'link_video', 'link_konferensi', 'dosen_penguji1', 'dosen_penguji2'];
    protected $useTimestamps = false;

    public function getSemproByProdi($idProdi) {
        $db = \Config\Database::connect();
        $builder = $db->table("seminar_proposal");

        return $builder->
        select("seminar_proposal.*, mahasiswa.npm, mahasiswa.nama as nama_mahasiswa, proposal.judul, proposal.status, proposal.komentar, bidang.nama as nama_bidang, bidang.inisial as inisial_bidang")->
        join("proposal" , "proposal.id = seminar_proposal.id_proposal")->
        join("bidang", "bidang.id = proposal.id_bidang")->
        join("mahasiswa", "mahasiswa.npm = proposal.npm")->
        getWhere(["mahasiswa.id_prodi" => $idProdi])->
        getResultArray();
    }

    public function getJadwalByNPM($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("seminar_proposal");

        return $builder->
        select("seminar_proposal.*, mahasiswa.npm, proposal.judul")->
        join("proposal" , "proposal.id = seminar_proposal.id_proposal")->
        join("mahasiswa", "mahasiswa.npm = proposal.npm")->
        orderBy("tanggal", "ASC")->
        getWhere(["mahasiswa.npm" => $npm])->
        getResultArray();
    }

    public function isEditable($idSempro) {
        $db = \Config\Database::connect();
        $builder = $db->table("seminar_proposal");

        $sempro = $builder->
        select("seminar_proposal.*, proposal.status")->
        join("proposal", "proposal.id = seminar_proposal.id_proposal")->
        getWhere(['seminar_proposal.id' => $idSempro])->getResultArray()[0];

        return $sempro['status'] == 'TERTUNDA';
    }

    public function getSemproByDosen($idDosen) {
        $db = \Config\Database::connect();
        $builder = $db->table("seminar_proposal");

        return $builder->
        select("seminar_proposal.*, mahasiswa.npm, proposal.judul, proposal.status, proposal.komentar, bidang.nama as nama_bidang, bidang.inisial as inisial_bidang")->
        join("proposal", "proposal.id = seminar_proposal.id_proposal")->
        join("bidang", "proposal.id_bidang = bidang.id")->
        join("mahasiswa", "mahasiswa.npm = proposal.npm")->
        orderBy("proposal.status ASC", "seminar_proposal.tanggal ASC")->
        where('dosen_penguji1', $idDosen)->
        orWhere('dosen_penguji2', $idDosen)->get()->getResultArray();
    }

}