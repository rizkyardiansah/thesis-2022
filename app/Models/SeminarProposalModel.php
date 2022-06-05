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
        $sql = "SELECT sp.*, m.npm, m.nama as nama_mahasiswa, p.judul, p.status, p.komentar, 
        b.nama as nama_bidang, b.inisial as inisial_bidang
        from seminar_proposal as sp
        inner join proposal as p on p.id = sp.id_proposal
        inner join mahasiswa as m on m.npm = p.npm
        inner join bidang as b on b.id = p.id_bidang
        where m.id_prodi = ?
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idProdi]);
        return $result->getResultArray();
    }

     public function getSemproByDateRange($idProdi, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, m.npm, m.nama as nama_mahasiswa, p.judul, p.status, p.komentar, 
        b.nama as nama_bidang, b.inisial as inisial_bidang
        from seminar_proposal as sp
        inner join proposal as p on p.id = sp.id_proposal
        inner join mahasiswa as m on m.npm = p.npm
        inner join bidang as b on b.id = p.id_bidang
        where m.id_prodi = ? and
        sp.tanggal between ? and ?
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idProdi, $dari, $hingga]);
        return $result->getResultArray();
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
        $sql = "SELECT sp.*, m.npm, m.nama as nama_mahasiswa, p.judul, p.status, p.komentar, 
        b.nama as nama_bidang, b.inisial as inisial_bidang
        from seminar_proposal as sp
        inner join proposal as p on p.id = sp.id_proposal
        inner join mahasiswa as m on m.npm = p.npm
        inner join bidang as b on b.id = p.id_bidang
        where (sp.dosen_penguji1 = ? or sp.dosen_penguji2 = ?)
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idDosen, $idDosen]);
        return $result->getResultArray();
    }

    public function getSemproByDosenDateRange($idDosen, $dari, $hingga) {
        $db = \Config\Database::connect();
        $sql = "SELECT sp.*, m.npm, m.nama as nama_mahasiswa, p.judul, p.status, p.komentar, 
        b.nama as nama_bidang, b.inisial as inisial_bidang
        from seminar_proposal as sp
        inner join proposal as p on p.id = sp.id_proposal
        inner join mahasiswa as m on m.npm = p.npm
        inner join bidang as b on b.id = p.id_bidang
        where (sp.dosen_penguji1 = ? or sp.dosen_penguji2 = ?) and
        sp.tanggal between ? and ?
        order by sp.tanggal DESC";
        $result = $db->query($sql, [$idDosen, $idDosen, $dari, $hingga]);
        return $result->getResultArray();
    }

}