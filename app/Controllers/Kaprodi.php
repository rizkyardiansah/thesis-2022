<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Kaprodi extends BaseController 
{
    protected $proposalModel;
    protected $dosenModel;
    protected $mahasiswaModel;
    protected $bidangModel;
    protected $prodiModel;
    protected $semproModel;
    protected $pembimbingModel;
    protected $catatanBimbinganModel;
    protected $skripsiModel;
    protected $seminarPrasidangModel;
    protected $pengajuanPrasidangModel;
    protected $pengajuanSidangModel;
    protected $sidangSkripsiModel;
    protected $penilaianSidangModel;
    protected $penelitianDosenModel;
    protected $makalahModel;

    public function __construct() {
        $this->proposalModel = new \App\Models\ProposalModel();
        $this->dosenModel = new \App\Models\DosenModel();
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();
        $this->bidangModel = new \App\Models\BidangModel();
        $this->prodiModel = new \App\Models\ProgramStudiModel();
        $this->semproModel = new \App\Models\SeminarProposalModel();
        $this->pembimbingModel = new \App\Models\PembimbingModel();
        $this->catatanBimbinganModel = new \App\Models\CatatanBimbinganModel();
        $this->skripsiModel = new \App\Models\SkripsiModel();
        $this->pengajuanPrasidangModel = new \App\Models\PengajuanPrasidangModel();
        $this->pengajuanSidangModel = new \App\Models\PengajuanSidangModel();
        $this->seminarPrasidangModel = new \App\Models\SeminarPrasidangModel();
        $this->sidangSkripsiModel = new \App\Models\SidangSkripsiModel();
        $this->penilaianSidangModel = new \App\Models\PenilaianSidangModel();
        $this->penelitianDosenModel = new \App\Models\PenelitianDosenModel();
        $this->makalahModel = new \App\Models\MakalahModel();
    }

    public function index()
    {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        return redirect()->to(base_url("home"));
    }

    public function proposal() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $proposal = $this->proposalModel->getProposalMahasiswaByProdi($prodi['id']);

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {   
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $proposal = $this->proposalModel->getProposalMahasiswaByDateRange($prodi['id'], $dari, $hingga);
        }

        $dosen = $this->dosenModel->findAll();
        $bidang = $this->bidangModel->findAll();
        $data = [
            "title" => "Proposal Mahasiswa ". $prodi['inisial'],
            "proposal" => $proposal,
            "bidang" => $bidang,
            "dosen" => $dosen,
        ];
        return view("kaprodi/proposal", $data);
    }

    public function skripsi() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $skripsi = $this->skripsiModel->getSkripsiMahasiswaByProdi($prodi['id']);

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $skripsi = $this->skripsiModel->getSkripsiMahasiswaByDateRange($prodi['id'], $dari, $hingga);
        }

        $data = [
            "title" => "Skripsi Mahasiswa ". $prodi['inisial'],
            "skripsi" => $skripsi,
        ];
        return view("kaprodi/skripsi", $data);
    }

    public function makalah() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $makalah = $this->makalahModel->getMakalahMahasiswaByProdi($prodi['id']);

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $makalah = $this->makalahModel->getMakalahMahasiswaByDateRange($prodi['id'], $dari, $hingga);
        }

        $data = [
            "title" => "Makalah Mahasiswa ". $prodi['inisial'],
            "makalah" => $makalah,
        ];
        return view("kaprodi/makalah", $data);
    }


    public function pembimbing() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        // $pembimbing = $this->mahasiswaModel->getPembimbingMahasiswaByProdi($prodi['id']);
        $pembimbing = $this->dosenModel->getDosenWithCountMahasiswaBimbinganByProdi($prodi['id']);

        $data = [
            "title" => "Pembimbing Mahasiswa ". $prodi['inisial'],
            "pembimbing" => $pembimbing,
        ];
        return view("kaprodi/pembimbing", $data);
    }

    public function detailPembimbing($id_dosen) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        
        $dosen = $this->dosenModel->find($id_dosen);
        if ($dosen == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $mahasiswaBimbingan = $this->dosenModel->getMahasiswaBimbinganByIdDosen($dosen['id']);
        
        $data = [
            "title" => "Mahasiswa Bimbingan ". $prodi['inisial'],
            "mahasiswaBimbingan" => $mahasiswaBimbingan,
        ];
        return view("kaprodi/detail_pembimbing", $data);
    }

    public function penilaianSidang() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $mahasiswa = $this->sidangSkripsiModel->getAllSidangSkripsiByProdi($prodi['id']);
        $data = [
            'title' => 'Penilaian Sidang Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ];
        return view("kaprodi/penilaian_sidang", $data);
    }

    public function hasilSidangSkripsi($idSkripsi) 
    {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $lastSkripsi = $this->skripsiModel->find($idSkripsi);
        if ($lastSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mahasiswa = $this->mahasiswaModel->find($lastSkripsi['npm']);

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

        return view("kaprodi/hasil_sidang_skripsi", $data);
    }

    public function cetakBeritaAcara($id_skripsi) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $lastSkripsi = $this->skripsiModel->find($id_skripsi);
        if ($lastSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mahasiswa = $this->mahasiswaModel->find($lastSkripsi['npm']);

        $sidangSkripsi = $this->sidangSkripsiModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
        if (count($sidangSkripsi) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);
        $sidangSkripsi = $this->sidangSkripsiModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray()[0];
        $idSidangSkripsi = $sidangSkripsi['id'];

        $pembimbingIlmu1 = $this->pembimbingModel->getPembimbingIlmu1ByIdSkripsi($lastSkripsi['id']);
        $pembimbingIlmu2 = $this->pembimbingModel->getPembimbingIlmu2ByIdSkripsi($lastSkripsi['id']);
        $pembimbingAgama = $this->pembimbingModel->getPembimbingAgamaByIdSkripsi($lastSkripsi['id']);
        $penguji = $this->dosenModel->find($sidangSkripsi['dosen_penguji']);
        
        $nilaiPembimbing1 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu1[0]['id_dosen']])->getResultArray();
        $nilaiPembimbing2 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu2[0]['id_dosen']])->getResultArray();
        $nilaiPembimbingAgama = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingAgama[0]['id_dosen']])->getResultArray();
        $nilaiPenguji = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $sidangSkripsi['dosen_penguji']])->getResultArray();
        
        $arrBeritaAcara = [];
        array_push($arrBeritaAcara, [
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
        ]);

        $data = [
            'title' => 'Hasil Sidang Skripsi',
            'arrBeritaAcara' => $arrBeritaAcara,
        ];

        return view("kaprodi/berita_acara", $data);
    } 

    public function cetakBeritaAcaraBulk() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        $arrBeritaAcara = [];

        $jadwalSidang = $this->sidangSkripsiModel->orderBy('tanggal', 'ASC')->getWhere(['status' => 'LULUS',  'tanggal >=' => $dari, 'tanggal <=' => $hingga])->getResultArray();
        foreach($jadwalSidang as $js) {
            $lastSkripsi = $this->skripsiModel->find($js['id_skripsi']);
    
            $mahasiswa = $this->mahasiswaModel->find($lastSkripsi['npm']);
            if ($mahasiswa['id_prodi'] != session()->get("user_session")['id']) { continue; }
            $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);
            
            $idSidangSkripsi = $js['id'];
    
            $pembimbingIlmu1 = $this->pembimbingModel->getPembimbingIlmu1ByIdSkripsi($lastSkripsi['id']);
            $pembimbingIlmu2 = $this->pembimbingModel->getPembimbingIlmu2ByIdSkripsi($lastSkripsi['id']);
            $pembimbingAgama = $this->pembimbingModel->getPembimbingAgamaByIdSkripsi($lastSkripsi['id']);
            $penguji = $this->dosenModel->find($js['dosen_penguji']);
            
            $nilaiPembimbing1 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu1[0]['id_dosen']])->getResultArray();
            $nilaiPembimbing2 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu2[0]['id_dosen']])->getResultArray();
            $nilaiPembimbingAgama = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingAgama[0]['id_dosen']])->getResultArray();
            $nilaiPenguji = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $js['dosen_penguji']])->getResultArray();
            
            array_push($arrBeritaAcara, ['mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'lastSkripsi' => $lastSkripsi,
            'sidangSkripsi' => $js,
            'pembimbingIlmu1' => $pembimbingIlmu1,
            'pembimbingIlmu2' => $pembimbingIlmu2,
            'pembimbingAgama' => $pembimbingAgama,
            'penguji' => $penguji,
            'nilaiPembimbing1' => $nilaiPembimbing1,
            'nilaiPembimbing2' => $nilaiPembimbing2,
            'nilaiPembimbingAgama' => $nilaiPembimbingAgama,
            'nilaiPenguji' => $nilaiPenguji]);
        }

        $data = [
            'title' => 'Hasil Sidang Skripsi',
            'arrBeritaAcara' => $arrBeritaAcara,
        ];

        return view("kaprodi/berita_acara", $data);
    }






    public function seminarProposal() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        
        $seminarProposal = $this->semproModel->getSemproByProdi($prodi['id']);
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $seminarProposal = $this->semproModel->getSemproByDateRange($prodi['id'],$dari, $hingga);
        } 

        $mahasiswa = $this->mahasiswaModel->getMahasiswaBelumDapatSemproByProdi($prodi['id']);
        $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
        $data = [
            "title" => "Seminar Proposal Mahasiswa ". $prodi['inisial'],
            "prodi" => $prodi,
            "seminarProposal" => $seminarProposal,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
        ];

        return view("kaprodi/seminar_proposal", $data);

    }

    public function updateModeSempro($idProdi) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $mode_sempro = $this->request->getPost("mode_sempro", FILTER_SANITIZE_SPECIAL_CHARS);
        $this->prodiModel->update($idProdi, [
            "mode_sempro" => $mode_sempro
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Atur Mode Seminar Proposal Berhasil", "text" => "Seminar Proposal diatur menjadi ".$mode_sempro]);
        return redirect()->to(base_url("Kaprodi/seminarProposal"));
    }

    public function insertJadwalSempro() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $proposal = $this->proposalModel->getMahasiswaLastProposal($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

        $mode_sempro = $this->request->getPost("mode_sempro", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($mode_sempro == 'Sinkronus Daring') {
            $this->semproModel->save([
                'id_proposal' => $proposal['id'],
                'tanggal' => $tanggal_seminar . " " . $jam_seminar,
                'link_konferensi' => $this->request->getPost("link_konferensi", FILTER_SANITIZE_URL),
                'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
                'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
            ]);
        } elseif ($mode_sempro == 'Sinkronus Luring') {
            $this->semproModel->save([
                'id_proposal' => $proposal['id'],
                'tanggal' => $tanggal_seminar . " " . $jam_seminar,
                'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS),
                'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
                'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
            ]);
        }

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Proposal Berhsil dibuat", "text" => "Jadwal seminar telah dibuat"]);
        return redirect()->to(base_url("Kaprodi/seminarProposal"));
    }

    public function updateJadwalSempro($idSempro) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $proposal = $this->proposalModel->getMahasiswaLastProposal($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

        $mode_sempro = $this->request->getPost("mode_sempro", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($mode_sempro == 'Sinkronus Daring') {
            $this->semproModel->update($idSempro, [
                'tanggal' => $tanggal_seminar . " " . $jam_seminar,
                'link_konferensi' => $this->request->getPost("link_konferensi", FILTER_SANITIZE_URL),
                'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
                'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
            ]);
        } elseif ($mode_sempro == 'Sinkronus Luring') {
            $this->semproModel->update($idSempro, [
                'tanggal' => $tanggal_seminar . " " . $jam_seminar,
                'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS),
                'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
                'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
            ]);
        }

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Proposal Berhasil diperbarui", "text" => "Jadwal seminar telah diperbarui"]);
        return redirect()->to(base_url("Kaprodi/seminarProposal"));
    }

    public function deleteJadwalSempro($idSempro) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->semproModel->delete($idSempro);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Jadwal SemPro Berhasil", "text" => "Jadwal Seminar Proposal Berhasil dihapus"]);
        return redirect()->to(base_url("Kaprodi/seminarProposal"));
    }

    public function insertJadwalSemproBatch() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        //$dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $dataAkun = $this->prodiModel->find(session()->get("user_session")['id']);
        $validationRules = [
            'fileJadwal' => [
                'rules' => 'uploaded[fileJadwal]|mime_in[fileJadwal,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[fileJadwal,xls,xlsx]|max_size[fileJadwal,10000]',
                'errors' => [
                    'uploaded' => 'Pilih File Jadwal Seminar Proposal terlebih dahulu',
                    'mime_in' => 'File Jadwal Seminar Proposal harus berupa Excel',
                    'ext_in' => 'File Jadwal Seminar Proposal harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Jadwal Seminar Proposal tidak boleh lebih dari 10MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Jadwal Seminar Proposal Gagal", "text" => $validation->getError("fileJadwal")]);
            return redirect()->to(base_url("Kaprodi/seminarProposal"))->withInput();
        }

        $file = $this->request->getFile("fileJadwal");
        $reader = '';
        if ($file->getExtension() == 'xls') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        } else if ($file->getExtension() == 'xlsx') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        }

        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getTempName());

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $mode_sempro = $this->request->getPost("mode_sempro", FILTER_SANITIZE_SPECIAL_CHARS);
        $totalCounter = 0;
        $successCounter = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $totalCounter++;
            $lastProposal = $this->proposalModel->getMahasiswaLastProposal(strval($worksheet->getCell("A$row")->getValue()));
            if ($lastProposal == null || 
                ($lastProposal != null && $lastProposal['status'] != 'TERTUNDA')
            ) {
                continue;
            }

            $id_proposal = $lastProposal['id'];
            $id_sempro = null;
            $jadwalSemproByIdProposal = $this->semproModel->getWhere(['id_proposal' => $id_proposal])->getResultArray();
            $isJadwalExist = count($jadwalSemproByIdProposal) != 0;
            if ($isJadwalExist) {
                $id_sempro = $jadwalSemproByIdProposal[0]['id'];
            }
            
            $tanggal = date_format(date_create_from_format('d-m-Y H:i', $worksheet->getCell("B$row")->getValue()), 'Y-m-d H:i');
            
            $ruangan = "";
            $link_konferensi = "";

            if ($mode_sempro == 'Sinkronus Daring') {
                $link_konferensi = $worksheet->getCell("C$row")->getValue();
            } elseif ($mode_sempro == 'Sinkronus Luring') {
                $ruangan = $worksheet->getCell("C$row")->getValue();
            }

            $penguji1 = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue());
            $penguji2 = $this->dosenModel->getDosenByInisial($worksheet->getCell("E$row")->getValue());
            if ($penguji1 == null) { continue; }
            if ($penguji1 != null && $penguji1['id_prodi'] != $dataAkun['id'] || $penguji2 != null && $penguji2['id_prodi'] != $dataAkun['id']) { continue; }
            if ($penguji2 == null && $worksheet->getCell("E$row")->getValue() != "-") { continue; }

            $dosen_penguji1 = $penguji1['id'];
            $dosen_penguji2 = null;
            if ($penguji2 != null) {
                $dosen_penguji2 = $penguji2['id'];
            }

            $jadwal = [
                'id_proposal' => $id_proposal,
                'tanggal' => $tanggal,
                'dosen_penguji1' => $dosen_penguji1,
                'dosen_penguji2' => $dosen_penguji2,
            ];

            if ($mode_sempro == 'Sinkronus Daring') {
                $jadwal['link_konferensi'] =  $link_konferensi;
            } elseif ($mode_sempro == 'Sinkronus Luring') {
                $jadwal['ruangan'] = $ruangan;
            }

            if ($id_sempro == null) {
                $this->semproModel->insert($jadwal);
            } else {
                $this->semproModel->update($id_sempro, $jadwal);
            }
            $successCounter++;
        }

        session()->setFlashdata("message", ["icon" => "info", "title" => "Jadwal Seminar Proposal Berhasil dibuat", "text" => "$successCounter dari $totalCounter Jadwal telah berhasil ditambahkan!"]);
        return redirect()->to(base_url("Kaprodi/seminarProposal"));
    }

    public function downloadFormatJadwalSempro($mode_sempro) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        redirect()->to(base_url("Kaprodi/seminarProposal"));
        if ($mode_sempro == 'Sinkronus Daring') {
            return $this->response->download("folderResource/Format_Jadwal_SemPro_Sinkronus_Daring.xlsx", null);
        } else if ($mode_sempro == 'Sinkronus Luring') {
            return $this->response->download("folderResource/Format_Jadwal_SemPro_Sinkronus_Luring.xlsx", null);
        }
    }

    





    public function seminarPrasidang() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $mahasiswa = $this->mahasiswaModel->getMahasiswaBelumDapatSempraByProdi($prodi['id']);

        $seminarPrasidang = $this->seminarPrasidangModel->getPrasidangByProdi($prodi['id']);
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $seminarPrasidang = $this->seminarPrasidangModel->getPrasidangByDateRange($prodi['id'], $dari, $hingga);
        } 

        $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
        $data = [
            "title" => "Seminar Prasidang Mahasiswa ". $prodi['inisial'],
            "prodi" => $prodi,
            "seminarPrasidang" => $seminarPrasidang,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
        ];

        return view("kaprodi/seminar_prasidang", $data);
    }

    public function insertJadwalSeminarPrasidang() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);
        $ruangan = $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS);

        $reviewer = $this->dosenModel->find($this->request->getPost("dosen_reviewer"));

        $undangan = [
            'title' => 'Undangan Review Seminar Prasidang',
            'nama_dosen' => $reviewer['nama'],
            'nama_prodi' => $prodi['nama'],
            'inisial_prodi' => $prodi['inisial'],
            'nama_kegiatan' => 'Seminar Prasidang',
            'selaku' => 'Reviewer Seminar Prasidang',
            'tanggal' => $tanggal_seminar,
            'jam' => $jam_seminar,
            'ruangan' => $ruangan,
        ];
        $this->sendEmail("", $reviewer['email'], "Undangan Review Seminar Prasidang", view("undangan", $undangan));

        $this->seminarPrasidangModel->insert([
            'id_skripsi' => $skripsi['id'],
            'tanggal' => $tanggal_seminar . " " . $jam_seminar,
            'ruangan' => $ruangan,
            'dosen_reviewer' => $this->request->getPost("dosen_reviewer"),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Prasidang Berhasil dibuat", "text" => "Jadwal seminar prasidang telah dibuat"]);
        return redirect()->to(base_url("Kaprodi/seminarPrasidang"));
    }

    public function updateJadwalSeminarPrasidang($idSeminarPrasidang) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }
        
        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->seminarPrasidangModel->update($idSeminarPrasidang, [
            'tanggal' => $tanggal_seminar . " " . $jam_seminar,
            'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS),
            'dosen_reviewer' => $this->request->getPost("dosen_reviewer")
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Prasidang Berhasil diperbarui", "text" => "Jadwal seminar prasidang telah diperbarui"]);
        return redirect()->to(base_url("Kaprodi/seminarPrasidang"));
    }

    public function deleteJadwalSeminarPrasidang($idSeminarPrasidang) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->seminarPrasidangModel->delete($idSeminarPrasidang);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Jadwal Seminar Prasidang Berhasil", "text" => "Jadwal Seminar Prasidang Berhasil dihapus"]);
        return redirect()->to(base_url("Kaprodi/seminarPrasidang"));
    }

    public function downloadFormatJadwalSeminarPrasidang() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        redirect()->to(base_url("Kaprodi/seminarPrasidang"));
        return $this->response->download("folderResource/Format_Jadwal_Seminar_Prasidang.xlsx", null);
    }

    public function insertJadwalSeminarPrasidangBatch() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        //$dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $dataAkun = $this->prodiModel->find(session()->get("user_session")['id']);
        $validationRules = [
            'fileJadwal' => [
                'rules' => 'uploaded[fileJadwal]|mime_in[fileJadwal,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[fileJadwal,xls,xlsx]|max_size[fileJadwal,10000]',
                'errors' => [
                    'uploaded' => 'Pilih File Jadwal Seminar Prasidang terlebih dahulu',
                    'mime_in' => 'File Jadwal Seminar Prasidang harus berupa Excel',
                    'ext_in' => 'File Jadwal Seminar Prasidang harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Jadwal Seminar Prasidang tidak boleh lebih dari 10MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Jadwal Seminar Prasidang Gagal", "text" => $validation->getError("fileJadwal")]);
            return redirect()->to(base_url("Kaprodi/seminarPrasidang"))->withInput();
        }

        $file = $this->request->getFile("fileJadwal");
        $reader = '';
        if ($file->getExtension() == 'xls') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        } else if ($file->getExtension() == 'xlsx') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        }

        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getTempName());

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $totalCounter = 0;
        $successCounter = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $totalCounter++;
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi(strval($worksheet->getCell("A$row")->getValue()));
            if ( $lastSkripsi == null || ($lastSkripsi != null && $lastSkripsi['status'] != 'Dalam Pengerjaan') ) {
                continue;
            }
            
            $id_skripsi = $lastSkripsi['id'];
            $id_sempra = null;
            $jadwalSempraByIdSkripsi = $this->seminarPrasidangModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
            $isJadwalExist = count($jadwalSempraByIdSkripsi) != 0;
            if ($isJadwalExist) {
                if ($jadwalSempraByIdSkripsi[0]['status'] != 'TERTUNDA') { continue; }
                $id_sempra = $jadwalSempraByIdSkripsi[0]['id'];
            }
            
            $pengajuan = $this->pengajuanPrasidangModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
            if (count($pengajuan) == 0 || (count($pengajuan) == 1 && $pengajuan[0]['status'] != 'DISETUJUI')) { continue; }

            $tanggal = date_format(date_create_from_format('d-m-Y H:i', trim($worksheet->getCell("B$row")->getValue(), " ")), 'Y-m-d H:i');
            
            $ruangan = $worksheet->getCell("C$row")->getValue();

            $reviewer = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue());
            if ($reviewer == null) { continue; }
            if ($reviewer != null && $reviewer['id_prodi'] != $dataAkun['id']) { continue; }

            $dosen_reviewer = $reviewer['id'];

            $jadwal = [
                'id_skripsi' => $id_skripsi,
                'tanggal' => $tanggal,
                'ruangan' => $ruangan,
                'dosen_reviewer' => $dosen_reviewer,
            ];

            if ($id_sempra == null) {
                $this->seminarPrasidangModel->insert($jadwal);
            } else {
                $this->seminarPrasidangModel->update($id_sempra, $jadwal);
            }
            $successCounter++;
        }
        session()->setFlashdata("message", ["icon" => "info", "title" => "Jadwal Seminar Prasidang Berhasil ditambahkan", "text" => "$successCounter dari $totalCounter Jadwal telah berhasil ditambahkan!"]);
        return redirect()->to(base_url("Kaprodi/seminarPrasidang"));
    }

    





    public function sidangSkripsi() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //$dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $mahasiswa = $this->mahasiswaModel->getMahasiswaBelumDapatSidangByProdi($prodi['id']);

        $sidangSkripsi = $this->sidangSkripsiModel->getSidangSkripsiByProdi($prodi['id']);
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $sidangSkripsi = $this->sidangSkripsiModel->getSidangSkripsiByDateRange($prodi['id'], $dari, $hingga);
        } 
        $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
        $data = [
            "title" => "Sidang Skripsi",
            "prodi" => $prodi,
            "sidangSkripsi" => $sidangSkripsi,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
        ];

        return view("kaprodi/sidang_skripsi", $data);
    }

    public function insertJadwalSidangSkripsi() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        //$dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);

        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_sidang = date_format(date_create($this->request->getPost("tanggal", FILTER_SANITIZE_SPECIAL_CHARS)), 'Y-m-d');
        $jam_sidang = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);
        $ruangan = $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS);

        $penguji = $this->dosenModel->find($this->request->getPost("dosen_penguji"));

        $undangan = [
            'title' => 'Undangan Sidang Skripsi',
            'nama_dosen' => $penguji['nama'],
            'nama_prodi' => $prodi['nama'],
            'inisial_prodi' => $prodi['inisial'],
            'nama_kegiatan' => 'Sidang Skripsi',
            'selaku' => 'Penguji Sidang Skripsi',
            'tanggal' => $tanggal_sidang,
            'jam' => $jam_sidang,
            'ruangan' => $ruangan,
        ];
        $this->sendEmail("", $penguji['email'], "Undangan Sidang Skripsi", view("undangan", $undangan));

        $this->sidangSkripsiModel->insert([
            'id_skripsi' => $skripsi['id'],
            'tanggal' => $tanggal_sidang . " " . $jam_sidang,
            'ruangan' => $ruangan,
            'dosen_penguji' => $this->request->getPost("dosen_penguji"),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Sidang Skripsi Berhasil dibuat", "text" => "Jadwal sidang skripsi telah dibuat"]);
        return redirect()->to(base_url("Kaprodi/sidangSkripsi"));
    }

    public function updateJadwalSidangSkripsi($idSidangSkripsi) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_sidang = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_sidang = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->sidangSkripsiModel->update($idSidangSkripsi, [
            'tanggal' => $tanggal_sidang . " " . $jam_sidang,
            'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS),
            'dosen_penguji' => $this->request->getPost("dosen_penguji"),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Sidang Skripsi Berhasil diperbarui", "text" => "Jadwal Sidang Skripsi telah diperbarui"]);
        return redirect()->to(base_url("Kaprodi/sidangSkripsi"));
    }

    public function deleteJadwalSidangSkripsi($idSidangSkripsi) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->sidangSkripsiModel->delete($idSidangSkripsi);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Jadwal Sidang Skripsi Berhasil", "text" => "Jadwal Sidang Skripsi Berhasil dihapus"]);
        return redirect()->to(base_url("Kaprodi/sidangSkripsi"));
    }

    public function downloadFormatJadwalSidangSkripsi() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        redirect()->to(base_url("Kaprodi/sidangSkripsi"));
        return $this->response->download("folderResource/Format_Jadwal_Sidang_Skripsi.xlsx", null);
    }

    public function insertJadwalSidangSkripsiBatch() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        // $dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $dataAkun = $this->prodiModel->find(session()->get("user_session")['id']);
        $validationRules = [
            'fileJadwal' => [
                'rules' => 'uploaded[fileJadwal]|mime_in[fileJadwal,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[fileJadwal,xls,xlsx]|max_size[fileJadwal,10000]',
                'errors' => [
                    'uploaded' => 'Pilih File Jadwal Sidang Skripsi terlebih dahulu',
                    'mime_in' => 'File Jadwal Sidang Skripsi harus berupa Excel',
                    'ext_in' => 'File Jadwal Sidang Skripsi harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Jadwal Sidang Skripsi tidak boleh lebih dari 10MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Jadwal Sidang Skripsi Gagal", "text" => $validation->getError("fileJadwal")]);
            return redirect()->to(base_url("Kaprodi/sidangSkripsi"))->withInput();
        }

        $file = $this->request->getFile("fileJadwal");
        $reader = '';
        if ($file->getExtension() == 'xls') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        } else if ($file->getExtension() == 'xlsx') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        }

        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getTempName());

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $totalCounter = 0;
        $successCounter = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $totalCounter++;
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi(strval($worksheet->getCell("A$row")->getValue()));
            if ( $lastSkripsi == null || ($lastSkripsi != null && $lastSkripsi['status'] != 'Dalam Pengerjaan') ) {
                continue;
            }
            
            $id_skripsi = $lastSkripsi['id'];
            $id_sidang = null;
            $jadwalSidangByIdSkripsi = $this->sidangSkripsiModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
            $isJadwalExist = count($jadwalSidangByIdSkripsi) != 0;
            if ($isJadwalExist) {
                $isReviewed = count($this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $jadwalSidangByIdSkripsi[0]['id']])->getResultArray()) > 0; 
                if ($isReviewed) { continue; }
                $id_sidang = $jadwalSidangByIdSkripsi[0]['id'];
            }

            $pengajuan = $this->pengajuanSidangModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
            if (count($pengajuan) == 0 || (count($pengajuan) == 1 && $pengajuan[0]['status'] != 'DISETUJUI')) { continue; }

            $tanggal = date_format(date_create_from_format('d-m-Y H:i', trim($worksheet->getCell("B$row")->getValue(), " ")), 'Y-m-d H:i');
            
            $ruangan = $worksheet->getCell("C$row")->getValue();

            $penguji1 = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue());
            if ($penguji1 == null) { continue; }
            if ($penguji1 != null && $penguji1['id_prodi'] != $dataAkun['id']) { continue; }

            $dosen_penguji1 = $penguji1['id'];

            $jadwal = [
                'id_skripsi' => $id_skripsi,
                'tanggal' => $tanggal,
                'ruangan' => $ruangan,
                'dosen_penguji' => $dosen_penguji1,
            ];

            if ($id_sidang == null) {
                $this->sidangSkripsiModel->insert($jadwal);
            } else {
                $this->sidangSkripsiModel->update($id_sidang, $jadwal);
            }
            $successCounter++;
        }

        session()->setFlashdata("message", ["icon" => "info", "title" => "Jadwal Sidang Skripsi Berhasil ditambahkan", "text" => "$successCounter dari $totalCounter Jadwal telah berhasil ditambahkan!"]);
        return redirect()->to(base_url("Kaprodi/sidangSkripsi"));
    }

    





    private function sendEmail($attachment, $to, $title, $message){
        $email = \Config\Services::email();
        $config = [
            'protocol' => 'smtp',
            'SMTPHost' => 'smtp-relay.sendinblue.com',
            'SMTPUser' => 'muhammadrizkyardiansah93@gmail.com',
            'SMTPPass' => 'CHqZbI5J04BrNELc',
            'SMTPPort' => 587,
            'SMTPCrypto' => 'tls',
            'mailType' => 'html',
        ];
        $email->initialize($config);

        $email->setFrom('muhammadrizkyardiansah93@gmail.com', 'Muhammad Rizky Ardiansah');
		$email->setTo($to);

		$email->attach($attachment);

		$email->setSubject($title);
		$email->setMessage($message);

		if(! $email->send()){
			return false;
		}else{
			return true;
		}
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