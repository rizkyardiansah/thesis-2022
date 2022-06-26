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
    protected $allowedFields = ['judul', 'id_bidang', 'npm', 'sifat', 'sumber', 'file_proposal', 'tanggal_upload', 'dosen_usulan1', 'dosen_usulan2', 'status', 'komentar', 'pembuat_komentar'];
    protected $useTimestamps = false;

    public function getProposalMahasiswa($npm) {
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");

        return $builder->select()->orderBy("tanggal_upload", 'asc')->getWhere(['npm' => $npm])->getResultArray();
    }

    public function getAllProposalMahasiswa() {
        $db = \Config\Database::connect();
        $builder = $db->table("proposal");

        return $builder->
        select("proposal.*, mahasiswa.nama as nama_mahasiswa, program_studi.nama as nama_prodi, program_studi.inisial as inisial_prodi")->
        join("mahasiswa", "proposal.npm = mahasiswa.npm")->
        join("program_studi", "program_studi.id = mahasiswa.id_prodi")->
        orderBy("proposal.tanggal_upload", "DESC")->get()->
        getResultArray();
    }

    public function getAllProposalMahasiswaByDateRange($dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT p.*, m.nama as nama_mahasiswa, prodi.nama as nama_prodi, prodi.inisial as inisial_prodi
        from proposal as p 
        inner join mahasiswa as m on m.npm = p.npm
        inner join program_studi as prodi on prodi.id = m.id_prodi
        where 
        p.tanggal_upload between ? and ?
        order by p.tanggal_upload DESC";
        $result = $db->query($sql, [ $dari, $hingga]);
        return $result->getResultArray();
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

    public function getDetailProposalById($id_proposal) {
        $db = \Config\Database::connect();
        $sql = "SELECT p.*, mhs.nama as nama_mahasiswa
        from proposal as p
        join mahasiswa as mhs on mhs.npm = p.npm
        where p.id = ? 
        ";
        $result = $db->query($sql, [$id_proposal]);
        if (count($result->getResultArray()) == 0) {
            return null;
        }

        return $result->getResultArray()[0];
    }

}