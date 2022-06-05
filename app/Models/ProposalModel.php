<?php 
namespace App\Models;

use CodeIgniter\Model;

class ProposalModel extends Model 
{
    protected $table = "proposal";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ['judul', 'id_bidang', 'npm', 'sifat', 'sumber', 'file_proposal', 'tanggal_upload', 'dosen_usulan1', 'dosen_usulan2', 'status', 'komentar'];
    protected $useTimestamps = false;

    public function getProposalMahasiswa($npm) {
        // return $this->builder->
        // select("proposal.*, dosen.nama AS 'nama_dosen', dosen.inisial as 'inisial_dosen', bidang.nama AS 'nama_bidang', bidang.inisial as 'inisial_bidang'")->
        // join("dosen", "dosen.id = proposal.dosen_usulan1 or dosen.id = proposal.dosen_usulan2")->
        // join("bidang", "bidang.id = proposal.id_bidang")->
        // getWhere(["proposal.npm" => $npm])->getResultArray();
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");

        return $builder->select()->orderBy("tanggal_upload", 'asc')->getWhere(['npm' => $npm])->getResultArray();
    }

    public function getProposalMahasiswaByProdi($idProdi) {
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");

        return $builder->
        select("proposal.*, mahasiswa.nama as nama_mahasiswa")->
        join("mahasiswa", "proposal.npm = mahasiswa.npm")->
        orderBy("proposal.tanggal_upload", "DESC")->
        getWhere(["mahasiswa.id_prodi" => $idProdi])->
        getResultArray();
    }

    public function getProposalMahasiswaByDateRange($idProdi, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT p.*, m.nama as nama_mahasiswa
        from proposal as p 
        inner join mahasiswa as m on m.npm = p.npm
        where 
        m.id_prodi = ? and
        p.tanggal_upload between ? and ?
        order by p.tanggal_upload DESC";
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
    }

    public function getMahasiswaLastProposal($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");
        $arrayProposal = $builder->
        select()->
        orderBy("tanggal_upload", "DESC")->
        getWhere(["npm" => $npm])->
        getResultArray();

        if (count($arrayProposal) == 0) {
            return null;
        }

        return $arrayProposal[0];
    }

    public function isEditable($idProposal) {
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");
        $arraySempro = $builder->select()->join("seminar_proposal", "seminar_proposal.id_proposal = proposal.id")->getWhere(["id_proposal" => $idProposal])->getResultArray();

        return count($arraySempro) == 0;
    }

}