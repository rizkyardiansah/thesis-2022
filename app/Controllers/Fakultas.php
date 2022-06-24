<?php

namespace App\Controllers;

class Fakultas extends BaseController 
{
    protected $kalenderSkripsiModel;
    protected $skripsiModel;
    protected $proposalModel;
    protected $dosenModel;
    protected $bidangModel;
    protected $makalahModel;
    protected $mahasiswaModel;
    protected $prodiModel;
    protected $sidangSkripsiModel;
    protected $pembimbingModel;
    protected $penilaianSidangModel;

    public function __construct() 
    {
        $this->kalenderSkripsiModel = new \App\Models\KalenderSkripsiModel();
        $this->skripsiModel = new \App\Models\SkripsiModel();
        $this->proposalModel = new \App\Models\ProposalModel();
        $this->dosenModel = new \App\Models\DosenModel();
        $this->bidangModel = new \App\Models\BidangModel();
        $this->makalahModel = new \App\Models\MakalahModel();
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();
        $this->prodiModel = new \App\Models\ProgramStudiModel();
        $this->sidangSkripsiModel = new \App\Models\SidangSkripsiModel();
        $this->pembimbingModel = new \App\Models\PembimbingModel();
        $this->penilaianSidangModel = new \App\Models\PenilaianSidangModel();
    }

    public function index()
    {
        
    }

    public function proposal() {
        $proposal = $this->proposalModel->getAllProposalMahasiswa();

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $proposal = $this->proposalModel->getAllProposalMahasiswaByDateRange( $dari, $hingga);
        }

        $dosen = $this->dosenModel->findAll();
        $bidang = $this->bidangModel->findAll();
        $data = [
            "title" => "Proposal Mahasiswa FTI",
            "proposal" => $proposal,
            "bidang" => $bidang,
            "dosen" => $dosen,
        ];
        return view("fakultas/proposal", $data);
    }

    public function skripsi() {
        $skripsi = $this->skripsiModel->getAllSkripsiMahasiswa();

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $skripsi = $this->skripsiModel->getAllSkripsiMahasiswaByDateRange($dari, $hingga);
        }

        $data = [
            "title" => "Skripsi Mahasiswa FTI",
            "skripsi" => $skripsi,
        ];
        return view("fakultas/skripsi", $data);
    }

    public function makalah() {
        $makalah = $this->makalahModel->getAllMakalah();

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $makalah = $this->makalahModel->getMakalahByDateRange( $dari, $hingga);
        }

        $data = [
            "title" => "Makalah Mahasiswa FTI",
            "makalah" => $makalah,
        ];
        return view("fakultas/makalah", $data);
    }

    public function pembimbing() {
        $pembimbing = $this->mahasiswaModel->getAllPembimbingMahasiswa();

        $data = [
            "title" => "Pembimbing Mahasiswa FTI",
            "pembimbing" => $pembimbing,
        ];
        return view("fakultas/pembimbing", $data);
    }

    public function hasilSidangSkripsi($idSkripsi) 
    {
        $lastSkripsi = $this->skripsiModel->find($idSkripsi);
        if ($lastSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mahasiswa = $this->mahasiswaModel->find($lastSkripsi['npm']);
        $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);

        $sidangSkripsi = $this->sidangSkripsiModel->getWhere(['id_skripsi' => $idSkripsi])->getResultArray();
        if (count($sidangSkripsi) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $sidangSkripsi = $this->sidangSkripsiModel->getWhere(['id_skripsi' => $idSkripsi])->getResultArray()[0];
        $idSidangSkripsi = $sidangSkripsi['id'];

        $pembimbingIlmu1 = $this->pembimbingModel->getPembimbingIlmu1ByIdSkripsi($lastSkripsi['id']);
        $pembimbingIlmu2 = $this->pembimbingModel->getPembimbingIlmu2ByIdSkripsi($lastSkripsi['id']);
        $pembimbingAgama = $this->pembimbingModel->getPembimbingAgamaByIdSkripsi($lastSkripsi['id']);
        $penguji = $this->dosenModel->find($sidangSkripsi['dosen_penguji']);
        
        $nilaiPembimbing1 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu1[0]['id_dosen']])->getResultArray();
        $nilaiPembimbing2 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu2[0]['id_dosen']])->getResultArray();
        $nilaiPembimbingAgama = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingAgama[0]['id_dosen']])->getResultArray();
        $nilaiPenguji = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $sidangSkripsi['dosen_penguji']])->getResultArray();

        $data = [
            'title' => 'Hasil Sidang Skripsi',
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'lastSkripsi' => $lastSkripsi,
            'sidangSkripsi' => $sidangSkripsi,
            'pembimbingIlmu1' => $pembimbingIlmu1,
            'pembimbingIlmu2' => $pembimbingIlmu2,
            'pembimbingAgama' => $pembimbingAgama,
            'penguji' => $penguji,
            'nilaiPembimbing1' => $nilaiPembimbing1,
            'nilaiPembimbing2' => $nilaiPembimbing2,
            'nilaiPembimbingAgama' => $nilaiPembimbingAgama,
            'nilaiPenguji' => $nilaiPenguji,
        ];

        return view("fakultas/hasil_sidang_skripsi", $data);
    }

    public function kalender()
    {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $kegiatanSkripsi = $this->kalenderSkripsiModel->findAll();
        $data = [
            "title" => "Kelola Kalender Skripsi",
            "kegiatanSkripsi" => $kegiatanSkripsi,
        ];
        return view("fakultas/kalender", $data);
    }

    public function insertKalender() {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $tanggalMulai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[0]);
        $tanggalSelesai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[1]);
        $this->kalenderSkripsiModel->save([
            'nama_kegiatan' => $this->request->getPost("namaKegiatan", FILTER_SANITIZE_SPECIAL_CHARS),
            "tanggal_mulai" => date_format($tanggalMulai, 'Y-m-d'),
            "tanggal_selesai" => date_format($tanggalSelesai, 'Y-m-d')
       ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Tambah Kegiatan Berhasil", "text" => "Kegiatan Berhasil ditambahkan"]);
        return redirect()->to(base_url("fakultas/kalender"));
    }

    public function updateKalender($id) {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $tanggalMulai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[0]);
        $tanggalSelesai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[1]);
        $this->kalenderSkripsiModel->update($id,[
            'nama_kegiatan' => $this->request->getPost("namaKegiatan", FILTER_SANITIZE_SPECIAL_CHARS),
            "tanggal_mulai" => date_format($tanggalMulai, 'Y-m-d'),
            "tanggal_selesai" => date_format($tanggalSelesai, 'Y-m-d')
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Kegiatan Berhasil", "text" => "Kegiatan Berhasil diubah"]);
        return redirect()->to(base_url("fakultas/kalender"));
    }

    public function deleteKalender($id) {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $this->kalenderSkripsiModel->delete($id);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Kegiatan Berhasil", "text" => "Kegiatan Berhasil dihapus"]);
        return redirect()->to(base_url("fakultas/kalender"));
    }

    private function authenticate($roles) {
        $userSession = session("user_session");
        if ($userSession == null) {
            return false;
        }

        $userRoles = $userSession['roles'];
        for ($i = 0; $i < count($roles); $i++){
            if (in_array($roles[$i], $userRoles)) {
                return true;
            }
        }

        return false;
    }
}