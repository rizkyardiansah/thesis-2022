<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Mahasiswa extends BaseController 
{
    protected $mahasiswaModel;
    protected $prodiModel;
    protected $fakultasModel;
    protected $proposalModel;
    protected $dosenModel;
    protected $bidangModel;
    protected $semproModel;
    protected $pembimbingModel;
    protected $catatanBimbinganModel;
    protected $skripsiModel;
    protected $pengajuanPrasidangModel;
    protected $pengajuanSidangModel;
    protected $seminarPrasidangModel;
    protected $sidangSkripsiModel;
    protected $penilaianSidangModel;
    protected $makalahModel;

    public function __construct() 
    {
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();
        $this->prodiModel = new \App\Models\ProgramStudiModel();
        $this->fakultasModel = new \App\Models\FakultasModel();
        $this->proposalModel = new \App\Models\ProposalModel();
        $this->dosenModel = new \App\Models\DosenModel();
        $this->bidangModel = new \App\Models\BidangModel();
        $this->semproModel = new \App\Models\SeminarProposalModel();
        $this->pembimbingModel = new \App\Models\PembimbingModel();
        $this->catatanBimbinganModel = new \App\Models\CatatanBimbinganModel();
        $this->skripsiModel = new \App\Models\SkripsiModel();
        $this->pengajuanPrasidangModel = new \App\Models\PengajuanPrasidangModel();
        $this->pengajuanSidangModel = new \App\Models\PengajuanSidangModel();
        $this->seminarPrasidangModel = new \App\Models\SeminarPrasidangModel();
        $this->sidangSkripsiModel = new \App\Models\SidangSkripsiModel();
        $this->penilaianSidangModel = new \App\Models\PenilaianSidangModel();
        $this->makalahModel = new \App\Models\MakalahModel();
    }

    public function index()
    {
       
    }

    public function profil() 
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataMahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $dataMahasiswa["id_fakultas"] = $this->prodiModel->find($dataMahasiswa['id_prodi'])['id_fakultas'];

        $data = [
            "title" => "Profil",
            "dataMahasiswa" => $dataMahasiswa,
            "dataProdi" => $this->prodiModel->findAll(),
            "dataFakultas" => $this->fakultasModel->findAll(),
            "dataDosen" => $this->dosenModel->getDosenByProdi($dataMahasiswa['id_prodi']),
        ];
        return view("mahasiswa/profil", $data);
    }

    public function updateDataDiri($npm) 
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $this->mahasiswaModel->update($npm,[
            'nama' => $this->request->getPost("namaLengkap", FILTER_SANITIZE_SPECIAL_CHARS), 
            'angkatan' => $this->request->getPost("angkatan", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_prodi' => $this->request->getPost("prodi", FILTER_SANITIZE_SPECIAL_CHARS)
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Perbaruan Sukses", "text" => "Data diri berhasil diperbarui"]);
        $_SESSION['user_session']['nama'] = $this->request->getPost("namaLengkap", FILTER_SANITIZE_SPECIAL_CHARS);
        return redirect()->to(base_url("mahasiswa/profil"));
    }

    public function pengajuanPenulisanSkripsi() 
    {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $dosen = $this->dosenModel->getDosenByProdi($mahasiswa['id_prodi']);

        $data = [
            'title' => 'Pengajuan Penulisan Skripsi',
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
        ];

        return view("mahasiswa/pengajuan_penulisan_skripsi", $data);
    }

    public function insertPengajuanPenulisanSkripsi($npm) 
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        $mahasiswa = $this->mahasiswaModel->find($npm);

        $fileKhsLama = $this->request->getFile("inputKhs");
        $fileKhsBaru = $mahasiswa['file_khs'];
        if ($fileKhsLama != null) {
            $fileKhsBaru = "KHS_". $npm . "." .$fileKhsLama->getClientExtension();
            $fileKhsLama->move("folderKHS", $fileKhsBaru);
        }

        $fileKrsLama = $this->request->getFile("inputKrs");
        $fileKrsBaru = $mahasiswa['file_krs'];
        if ($fileKrsLama != null) {
            $fileKrsBaru = "KRS_". $npm . "." .$fileKrsLama->getClientExtension();
            $fileKrsLama->move("folderKRS", $fileKrsBaru);
        }

        $filePengajuanSkripsiLama = $this->request->getFile("inputPersetujuanSkripsi");
        $filePengajuanSkripsiBaru = $mahasiswa['file_persetujuan_skripsi'];
        if ($filePengajuanSkripsiLama != null) {
            $filePengajuanSkripsiBaru = "PersetujuanSkripsi_". $npm . "." .$filePengajuanSkripsiLama->getClientExtension();
            $filePengajuanSkripsiLama->move("folderPersetujuanSkripsi", $filePengajuanSkripsiBaru);
        }

        $this->mahasiswaModel->update($npm, [
            "file_khs" => $fileKhsBaru,
            "file_krs" => $fileKrsBaru,
            "file_persetujuan_skripsi" => $filePengajuanSkripsiBaru,
            "sks_lulus" => $this->request->getPost("sks_lulus", FILTER_SANITIZE_SPECIAL_CHARS),
            "pembimbing_akademik" => $this->request->getPost("pembimbing_akademik"),
            "mk_sedang_diambil" => $this->request->getPost("mk_sedang_diambil", FILTER_SANITIZE_SPECIAL_CHARS),
            "mk_akan_diambil" => $this->request->getPost("mk_akan_diambil", FILTER_SANITIZE_SPECIAL_CHARS),
            "status_persetujuan_skripsi" => null,
            'tanggal_pengajuan_skripsi' => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Upload Data Berhasil", "text" => "Data Persetujuan Penyusunan Skripsi Berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function proposal()
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $proposal = $this->proposalModel->getProposalMahasiswa($mahasiswa['npm']);
        $lastProposal = $this->proposalModel->getMahasiswaLastProposal($mahasiswa['npm']);
        $dosen = $this->dosenModel->getDosenByProdi($mahasiswa['id_prodi']);
        $bidang = $this->bidangModel->getBidangByProdi($mahasiswa['id_prodi']);
        $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        for ($i = 0; $i < count($proposal); $i++) {
            $proposal[$i]['editable'] = $this->proposalModel->isEditable($proposal[$i]['id']);
        }

        $data = [
            'title' => "Kelola Proposal Skripsi",
            "mahasiswa" => $mahasiswa,
            "proposal" => $proposal,
            "dosen" => $dosen,
            "prodi" => $prodi,
            "bidang" => $bidang,
            "lastProposal" => $lastProposal,
            "lastSkripsi" => $lastSkripsi,
        ];
        // dd($bidang);
        return view('mahasiswa/proposal', $data);
    }

    public function insertProposal() {
        $validationRules = [
            'file_proposal' => [
                'rules' => 'uploaded[file_proposal]|mime_in[file_proposal,application/pdf]|ext_in[file_proposal,pdf]|max_size[file_proposal,2048]',
                'errors' => [
                    'uploaded' => 'Pilih File Proposal terlebih dahulu',
                    'mime_in' => 'File Proposal harus berupa PDF',
                    'ext_in' => 'File Proposal harus berekstensi .pdf',
                    'max_size' => 'Ukuran File Proposal tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Proposal Gagal", "text" => $validation->getError("file_proposal")]);
            return redirect()->to(base_url("mahasiswa/proposal"))->withInput();
        }

        $npm = $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS);
        $fileProposal = $this->request->getFile("file_proposal");
        $newName = "Proposal_". $npm ."_" . date("dmYHis") . "." .$fileProposal->getClientExtension();
        $fileProposal->move("folderProposal", $newName);

        $this->proposalModel->save([
            'judul' => $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_bidang' => $this->request->getPost("bidang", FILTER_SANITIZE_SPECIAL_CHARS),
            'sifat' => $this->request->getPost("sifat", FILTER_SANITIZE_SPECIAL_CHARS),
            'sumber' => $this->request->getPost("sumber", FILTER_SANITIZE_SPECIAL_CHARS),
            'file_proposal' => $newName,
            'npm' => $npm,
            'tanggal_upload' => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            'dosen_usulan1' => $this->request->getPost("dosen_usulan1", FILTER_SANITIZE_SPECIAL_CHARS),
            'dosen_usulan2' => $this->request->getPost("dosen_usulan2", FILTER_SANITIZE_SPECIAL_CHARS),
            'status' => 'TERTUNDA'
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Tambah Proposal Berhasil", "text" => "Proposal berhasil ditambahkan"]);
        return redirect()->to(base_url("mahasiswa/proposal"));
    }

    public function updateProposal($idProposal) {
        $validationRules = [
            'file_proposal' => [
                'rules' => 'mime_in[file_proposal,application/pdf]|ext_in[file_proposal,pdf]|max_size[file_proposal,2048]',
                'errors' => [
                    'mime_in' => 'File Proposal harus berupa PDF',
                    'ext_in' => 'File Proposal harus berekstensi .pdf',
                    'max_size' => 'Ukuran File Proposal tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Proposal Gagal", "text" => $validation->getError("file_proposal")]);
            return redirect()->to(base_url("mahasiswa/proposal"))->withInput();
        }

        
        $fileProposal = $this->request->getFile("file_proposal");
        if ($fileProposal->getName() != "") {
            $npm = $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS);
            $namaFileProposal = $this->proposalModel->find($idProposal)['file_proposal'];
            unlink("folderProposal/".$namaFileProposal);

            $newName = "Proposal_". $npm ."_" . date("dmYHis") . "." .$fileProposal->getClientExtension();
            $fileProposal->move("folderProposal", $newName);
            $this->proposalModel->update($idProposal, [ "file_proposal" => $newName]);
        }
        

        $this->proposalModel->update($idProposal, [
            'judul' => $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_bidang' => $this->request->getPost("bidang", FILTER_SANITIZE_SPECIAL_CHARS),
            'sifat' => $this->request->getPost("sifat", FILTER_SANITIZE_SPECIAL_CHARS),
            'sumber' => $this->request->getPost("sumber", FILTER_SANITIZE_SPECIAL_CHARS),
            'tanggal_upload' => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            'dosen_usulan1' => $this->request->getPost("dosen_usulan1", FILTER_SANITIZE_SPECIAL_CHARS),
            'dosen_usulan2' => $this->request->getPost("dosen_usulan2", FILTER_SANITIZE_SPECIAL_CHARS),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Proposal Berhasil", "text" => "Proposal berhasil diubah"]);
        return redirect()->to(base_url("mahasiswa/proposal"));
    }

    public function downloadProposal($idProposal)
    {
        $namaFileProposal = $this->proposalModel->find($idProposal)['file_proposal'];
        if ($namaFileProposal == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Proposal Gagal", "text" => "File Proposal tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/proposal"));
        }
        
        redirect()->to(base_url("mahasiswa/proposal"));
        return $this->response->download("folderProposal/".$namaFileProposal, null);
    }

    public function seminarProposal() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $proposal = $this->proposalModel->getMahasiswaLastProposal($mahasiswa['npm']);

        // if ($proposal == null) {
        //     session()->setFlashdata("message", ["icon" => "error", "title" => "Proposal Belum Ada", "text" => "Silahkan tambahkan Proposal terlebih dahulu untuk bisa membuka menu Seminar Proposal"]);
        //     return redirect()->to(base_url("mahasiswa/proposal")); 
        // }

        $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);
        $jadwalSempro = $this->semproModel->getJadwalByNPM($mahasiswa['npm']);

        if($prodi['mode_sempro'] == 'Asinkronus') {
            for ($i = 0; $i < count($jadwalSempro); $i++) {
                $jadwalSempro[$i]['editable'] = $this->semproModel->isEditable($jadwalSempro[$i]['id']);
            }
            $data = [
                'title' => "Seminar Proposal",
                'mahasiswa' => $mahasiswa,
                'proposal' => $proposal,
                'prodi' => $prodi,
                'jadwalSempro' => $jadwalSempro,
            ];

            return view("mahasiswa/seminar_proposal_asinkronus", $data);
        } elseif ($prodi['mode_sempro'] == 'Sinkronus Daring' || $prodi['mode_sempro'] == 'Sinkronus Luring') {
            $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
            $data = [
                'title' => "Seminar Proposal",
                'mahasiswa' => $mahasiswa,
                'proposal' => $proposal,
                'prodi' => $prodi,
                'jadwalSempro' => $jadwalSempro,
                'dosen' => $dosen,
            ];

            return view("mahasiswa/seminar_proposal_sinkronus", $data);
        } elseif ($prodi['mode_sempro'] == null) {
            $data = [
                'title' => 'Seminar Proposal',
                'prodi' => $prodi,
            ];
            return view("mahasiswa/seminar_proposal_default", $data);
        }
        
    }

    public function insertVideoSempro() {
        $id_proposal = $this->request->getPost("id_proposal", FILTER_SANITIZE_SPECIAL_CHARS);
        $link_video = $this->request->getPost("link_video", FILTER_SANITIZE_URL);

        $this->semproModel->insert([
            'id_proposal' => $id_proposal,
            'link_video' => $link_video,
            'tanggal' => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengumpulan Video Seminar Proposal Berhasil", "text" => "Link Video Seminar Proposal berhasil dikumpulkan"]);
        return redirect()->to(base_url("mahasiswa/seminarProposal")); 
    }

    public function updateVideoSempro($id){
        $id_proposal = $this->request->getPost("id_proposal", FILTER_SANITIZE_SPECIAL_CHARS);
        $link_video = $this->request->getPost("link_video", FILTER_SANITIZE_URL);

        $this->semproModel->update($id, [
            'id_proposal' => $id_proposal,
            'link_video' => $link_video,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengubahan Video Seminar Proposal Berhasil", "text" => "Link Video Seminar Proposal berhasil diubah"]);
        return redirect()->to(base_url("mahasiswa/seminarProposal"));
    }

    public function pembimbing() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        $dosenPembimbing = array();
        if ($lastSkripsi != null) {
            $dosenPembimbing = $this->pembimbingModel->getAllPembimbingByIdSkripsi($lastSkripsi['id']);
        }
        $hasilBimbingan = $this->catatanBimbinganModel->getAllCatatanByNpm($mahasiswa['npm']);
        $data = [
            'title' => "Pembimbing Skripsi",
            'mahasiswa' => $mahasiswa,
            'dosenPembimbing' => $dosenPembimbing,
            'hasilBimbingan' => $hasilBimbingan,
        ];
        
        return view("mahasiswa/pembimbing", $data);
    }

    public function insertHasilBimbingan() {
        $idPembimbing = $this->request->getPost("pembimbing");
        $materi = $this->request->getPost("materi", FILTER_SANITIZE_SPECIAL_CHARS);
        $tanggal = date_create($this->request->getPost("tanggalBimbingan"));
        $status = 'TERTUNDA';

        $this->catatanBimbinganModel->insert([
            'id_pembimbing' => $idPembimbing,
            'hasil_bimbingan' => $materi,
            'tanggal_bimbingan' => date_format($tanggal, 'Y-m-d'),
            'status' => $status,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pembuatan Catatan Hasil Bimbingan Berhasil", "text" => "Catatan Hasil Bimbingan telah berhasil disimpan"]);
        return redirect()->to(base_url("mahasiswa/pembimbing")); 
    }

    public function updateHasilBimbingan($idCatatan) {
        $idPembimbing = $this->request->getPost("pembimbing");
        $materi = $this->request->getPost("materi", FILTER_SANITIZE_SPECIAL_CHARS);
        $tanggal = date_create($this->request->getPost("tanggalBimbingan"));
        $status = 'TERTUNDA';

        $this->catatanBimbinganModel->update($idCatatan, [
            'id_pembimbing' => $idPembimbing,
            'hasil_bimbingan' => $materi,
            'tanggal_bimbingan' => date_format($tanggal, 'Y-m-d'),
            'status' => $status,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengubahan Catatan Hasil Bimbingan Berhasil", "text" => "Catatan Hasil Bimbingan telah berhasil diubah"]);
        return redirect()->to(base_url("mahasiswa/pembimbing")); 
    }

    public function deleteHasilBimbingan($idCatatan) {
        $this->catatanBimbinganModel->delete($idCatatan);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Penghapusan Catatan Hasil Bimbingan Berhasil", "text" => "Catatan Hasil Bimbingan telah berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pembimbing"));
    }

    public function cetakFormBimbingan($npm) {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        $hasilBimbingan = $this->catatanBimbinganModel->getAllCatatanByLastSkripsi($lastSkripsi['id']);
        $prodi = $this->prodiModel->find($mahasiswa['id_prodi']);
        $data = [
            'mahasiswa' => $mahasiswa,
            'lastSkripsi' => $lastSkripsi,
            'hasilBimbingan' => $hasilBimbingan,
            'prodi' => $prodi,
        ];

        return view("cetakBimbingan", $data);
    }

    public function skripsi() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastProposal = $this->proposalModel->getMahasiswaLastProposal($mahasiswa['npm']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        $bidang = $this->bidangModel->getBidangByProdi($mahasiswa['id_prodi']);
        $skripsi = $this->skripsiModel->getSkripsiByNpm($mahasiswa['npm']);
        $data = [
            'title' => 'Kelola Skripsi',
            'lastProposal' => $lastProposal,
            'lastSkripsi' => $lastSkripsi,
            'mahasiswa' => $mahasiswa,
            'bidang' => $bidang,
            'skripsi' => $skripsi
        ];

        return view("mahasiswa/skripsi", $data);
    }

    public function insertSkripsi() {
        $this->skripsiModel->insert([
            'judul' => $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS),
            'sifat' => $this->request->getPost("sifat", FILTER_SANITIZE_SPECIAL_CHARS),
            'sumber' => $this->request->getPost("sumber", FILTER_SANITIZE_SPECIAL_CHARS),
            'npm' => $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_bidang' => $this->request->getPost("bidang"),
            'tanggal_skripsi' => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            'status' => 'Dalam Pengerjaan',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Tambah Skripsi Berhasil", "text" => "Skripsi berhasil ditambahkan!"]);
        return redirect()->to(base_url("mahasiswa/skripsi"));
    }

    public function updateSkripsi($idSkripsi) {
        $this->skripsiModel->update($idSkripsi, [
            'judul' => $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS),
            'sifat' => $this->request->getPost("sifat", FILTER_SANITIZE_SPECIAL_CHARS),
            'sumber' => $this->request->getPost("sumber", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_bidang' => $this->request->getPost("bidang"),
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Skripsi Berhasil", "text" => "Skripsi berhasil diubah!"]);
        return redirect()->to(base_url("mahasiswa/skripsi"));
    }

    public function uploadFileSkripsi($idSkripsi) {
        $npm = $this->request->getPost("npm");

        $fileSkripsi = $this->request->getFile("file_skripsi");
        $fileSkripsiBaru = "Skripsi_". $npm ."_". $idSkripsi ."." .$fileSkripsi->getClientExtension();
        $fileSkripsi->move("folderSkripsi", $fileSkripsiBaru);

        $this->skripsiModel->update($idSkripsi, [
            "file_skripsi" => $fileSkripsiBaru,
            "tanggal_selesai_skripsi" => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Unggah File Skripsi Berhasil", "text" => "File Skripsi anda telah Berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/skripsi"));
    }

    public function pengajuanPraSidang() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        if ($lastSkripsi != null) {
            $lastSkripsi['nama_bidang'] = $this->bidangModel->find($lastSkripsi['id_bidang'])['nama'];
        }
        $pengajuanPrasidang = $this->pengajuanPrasidangModel->getPengajuanPrasidangByNpm($mahasiswa['npm']);
        $data = [
            'title' => 'Pengajuan Seminar Prasidang',
            'mahasiswa' => $mahasiswa,
            'lastSkripsi' => $lastSkripsi,
            'pengajuanPrasidang' => $pengajuanPrasidang,
        ];
        return view("mahasiswa/pengajuan_pra_sidang", $data);
    }

    public function detailPengajuanPraSidang($idPengajuanPrasidang) {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $detailPengajuan = $this->pengajuanPrasidangModel->getDetailPengajuanById($idPengajuanPrasidang);
        
        if ($detailPengajuan == null || $dataAkun == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $skripsi = $this->skripsiModel->find($detailPengajuan['id_skripsi']);
        if ($skripsi == null || $skripsi['npm'] != $dataAkun['npm']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = [
            'title' => 'Detail Pengajuan Seminar Prasidang',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("mahasiswa/detail_pengajuan_prasidang", $data);
    }

    public function insertPengajuanPraSidang() {
        $id_skripsi = $this->request->getPost("id_skripsi");
        $npm = $this->request->getPost("npm");

        $fileDraft = $this->request->getFile("file_draft");
        $fileDraftBaru = "Draft_". $npm ."_". $id_skripsi ."." .$fileDraft->getClientExtension();
        $fileDraft->move("folderDraft", $fileDraftBaru);

        $lembarPersetujuan = $this->request->getFile("lembar_persetujuan");
        $lembarPersetujuanBaru = "LembarPersetujuanPrasidang_". $npm ."_". $id_skripsi . "." .$lembarPersetujuan->getClientExtension();
        $lembarPersetujuan->move("folderLembarPersetujuanPrasidang", $lembarPersetujuanBaru);
       
        $this->pengajuanPrasidangModel->insert([
            "id_skripsi" => $id_skripsi,
            "file_draft" => $fileDraftBaru,
            "lembar_persetujuan" => $lembarPersetujuanBaru,
            "tanggal_pengajuan" => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            "status" => "TERTUNDA",
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Upload Pengajuan Prasidang Berhasil", "text" => "Pengajuan Seminar Prasidang Berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPraSidang"));
    }

    public function updatePengajuanPrasidang($idPengajuanPrasidang) {
        $pengajuanPrasidang = $this->pengajuanPrasidangModel->find($idPengajuanPrasidang);
        $npm = $this->request->getPost("npm");
        $id_skripsi = $this->request->getPost("id_skripsi");

        $fileDraft = $this->request->getFile("file_draft");
        $fileDraftBaru = $pengajuanPrasidang['file_draft'];
        if ($fileDraft != null) {
            $fileDraftBaru = "Draft_". $npm ."_". $id_skripsi ."." .$fileDraft->getClientExtension();
            $fileDraft->move("folderDraft", $fileDraftBaru);
        }

        $lembarPersetujuan = $this->request->getFile("lembar_persetujuan");
        $lembarPersetujuanBaru = $pengajuanPrasidang['lembar_persetujuan'];
        if ($lembarPersetujuan != null) {
            $lembarPersetujuanBaru = "LembarPersetujuanPrasidang_". $npm ."_". $id_skripsi . "." .$lembarPersetujuan->getClientExtension();
            $lembarPersetujuan->move("folderLembarPersetujuanPrasidang", $lembarPersetujuanBaru);
        }

        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            "file_draft" => $fileDraftBaru,
            "lembar_persetujuan" => $lembarPersetujuanBaru,
            "status" => 'TERTUNDA'
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Perbaruan Pengajuan Seminar Prasidang Berhasil", "text" => "Data Pengajuan Seminar Prasidang Berhasil diperbarui"]);
        return redirect()->back();
    }

    public function seminarPrasidang() {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($dataAkun['npm']);
        $pengajuan = null;
        if ($lastSkripsi != null) {
            $pengajuan = $this->pengajuanPrasidangModel->getWhere(['id_skripsi' => $lastSkripsi['id']])->getResultArray();
        }

        if ($pengajuan != null && count($pengajuan) == 1) {
            $pengajuan = $pengajuan[0];
        }

        $jadwalSeminarPrasidang = $this->seminarPrasidangModel->getJadwalByNPM($dataAkun['npm']);

        $data = [
            'title' => "Jadwal Seminar Prasidang",
            'jadwalSeminarPrasidang' => $jadwalSeminarPrasidang,
            'lastSkripsi' => $lastSkripsi,
            'pengajuan' => $pengajuan,
        ];

        return view("mahasiswa/seminar_prasidang", $data);
    }

    public function pengajuanSidangSkripsi() {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($dataAkun['npm']);
        if ($lastSkripsi != null) {
            $lastSkripsi['nama_bidang'] = $this->bidangModel->find($lastSkripsi['id_bidang'])['nama'];
        }

        $seminarPrasidang = null;
        if ($lastSkripsi != null) {
            $seminarPrasidang = $this->seminarPrasidangModel->getWhere(['id_skripsi' => $lastSkripsi['id']])->getResultArray();
            
            if (count($seminarPrasidang) == 0) {
                $seminarPrasidang = null;
            } else {
                $seminarPrasidang = $seminarPrasidang[0];
            }
        }

        $pengajuanSidangSkripsi = $this->pengajuanSidangModel->getPengajuanSidangByNpm($dataAkun['npm']);

        $data = [
            'title' => 'Pengajuan Sidang Skripsi',
            'dataAkun' => $dataAkun,
            'lastSkripsi' => $lastSkripsi,
            'seminarPrasidang' => $seminarPrasidang,
            'pengajuanSidangSkripsi' => $pengajuanSidangSkripsi,
        ];

        return view("mahasiswa/pengajuan_sidang_skripsi", $data);
    }

    public function detailPengajuanSidangSkripsi($idpengajuanSidangSkripsi) {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $detailPengajuan = $this->pengajuanSidangModel->getDetailPengajuanById($idpengajuanSidangSkripsi);
        if ($detailPengajuan == null || $dataAkun == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $skripsi = $this->skripsiModel->find($detailPengajuan['id_skripsi']);
        if ($skripsi == null || $skripsi['npm'] != $dataAkun['npm']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        

        $data = [
            'title' => 'Detail Pengajuan Sidang Skripsi',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("mahasiswa/detail_pengajuan_sidang_skripsi", $data);
    }

    public function insertPengajuanSidangSkripsi() {
        $id_skripsi = $this->request->getPost("id_skripsi");
        $npm = $this->request->getPost("npm");

        $fileDraftFinal = $this->request->getFile("file_draft_final");
        $fileDraftFinalBaru = "Draft_Final_". $npm ."_". $id_skripsi ."." .$fileDraftFinal->getClientExtension();
        $fileDraftFinal->move("folderDraftFinal", $fileDraftFinalBaru);

        $formBimbingan = $this->request->getFile("file_form_bimbingan");
        $formBimbinganBaru = "Form_Bimbingan_". $npm ."_". $id_skripsi . "." .$formBimbingan->getClientExtension();
        $formBimbingan->move("folderFormBimbingan", $formBimbinganBaru);

        $persyaratanSidang = $this->request->getFile("file_persyaratan_sidang");
        $persyaratanSidangBaru = "Persyaratan_Sidang_". $npm ."_". $id_skripsi . "." .$persyaratanSidang->getClientExtension();
        $persyaratanSidang->move("folderPersyaratanSidang", $persyaratanSidangBaru);
       
        $this->pengajuanSidangModel->insert([
            "id_skripsi" => $id_skripsi,
            "file_draft_final" => $fileDraftFinalBaru,
            "file_form_bimbingan" => $formBimbinganBaru,
            "file_persyaratan_sidang" => $persyaratanSidangBaru,
            "tanggal_pengajuan" => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            "status" => "TERTUNDA",
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Upload Pengajuan Sidang Berhasil", "text" => "Pengajuan Sidang Skripsi Berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/pengajuanSidangSkripsi"));
    }

    public function updatePengajuanSidangSkripsi($idpengajuanSidangSkripsi) {
        $pengajuanSidang = $this->pengajuanSidangModel->find($idpengajuanSidangSkripsi);
        $npm = $this->request->getPost("npm");
        $id_skripsi = $this->request->getPost("id_skripsi");

        $fileDraftFinal = $this->request->getFile("file_draft_final");
        $fileDraftFinalBaru = $pengajuanSidang['file_draft_final'];
        if ($fileDraftFinal != null) {
            // if ($fileDraftFinalBaru != null) {
            //     unlink("folderDraftFinal/".$fileDraftFinalBaru);
            // }
            $fileDraftFinalBaru = "Draft_Final_". $npm ."_". $id_skripsi ."." .$fileDraftFinal->getClientExtension();
            $fileDraftFinal->move("folderDraftFinal", $fileDraftFinalBaru);
        }

        $formBimbingan = $this->request->getFile("file_form_bimbingan");
        $formBimbinganBaru = $pengajuanSidang['file_form_bimbingan'];
        if ($formBimbingan != null) {
            // if ($formBimbinganBaru != null) {
            //     unlink("folderFormBimbingan/".$formBimbinganBaru);
            // }
            $formBimbinganBaru = "Form_Bimbingan_". $npm ."_". $id_skripsi . "." .$formBimbingan->getClientExtension();
            $formBimbingan->move("folderFormBimbingan", $formBimbinganBaru);
        }

        $persyaratanSidang = $this->request->getFile("file_persyaratan_sidang");
        $persyaratanSidangBaru = $pengajuanSidang['file_persyaratan_sidang'];
        if ($persyaratanSidang != null) {
            // if ($persyaratanSidangBaru != null) {
            //     unlink("folderFormBimbingan/".$persyaratanSidangBaru);
            // }
            $persyaratanSidangBaru = "Persyaratan_Sidang_". $npm ."_". $id_skripsi . "." .$persyaratanSidang->getClientExtension();
            $persyaratanSidang->move("folderPersyaratanSidang", $persyaratanSidangBaru);
        }

        $this->pengajuanSidangModel->update($idpengajuanSidangSkripsi, [
            "file_draft_final" => $fileDraftFinalBaru,
            "file_form_bimbingan" => $formBimbinganBaru,
            "file_persyaratan_sidang" => $persyaratanSidangBaru,
            "status" => 'TERTUNDA'
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Update Pengajuan Sidang Skripsi Berhasil", "text" => "Pengajuan Sidang Skripsi Berhasil diubah"]);
        return redirect()->back();
    }

    public function sidangSkripsi() {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($dataAkun['npm']);
        $pengajuan = null;
        if ($lastSkripsi != null) {
            $pengajuan = $this->pengajuanSidangModel->getWhere(['id_skripsi' => $lastSkripsi['id']])->getResultArray();
        }

        if ($pengajuan != null && count($pengajuan) == 1) {
            $pengajuan = $pengajuan[0];
        }

        $jadwalSidangSkripsi = $this->sidangSkripsiModel->getJadwalByNPM($dataAkun['npm']);

        $data = [
            'title' => "Jadwal Sidang Skripsi",
            'jadwalSidangSkripsi' => $jadwalSidangSkripsi,
            'lastSkripsi' => $lastSkripsi,
            'pengajuan' => $pengajuan,
        ];

        return view("mahasiswa/sidang_skripsi", $data);
    }

    public function hasilSidangSkripsi($idSidangSkripsi) {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $sidangSkripsi = $this->sidangSkripsiModel->find($idSidangSkripsi);
        if ($sidangSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $lastSkripsi = $this->skripsiModel->find($sidangSkripsi['id_skripsi']);
        if ($lastSkripsi == null || $lastSkripsi['npm'] != $dataAkun['npm']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $pembimbingIlmu1 = $this->pembimbingModel->getPembimbingIlmu1ByIdSkripsi($lastSkripsi['id']);
        $pembimbingIlmu2 = $this->pembimbingModel->getPembimbingIlmu2ByIdSkripsi($lastSkripsi['id']);
        $pembimbingAgama = $this->pembimbingModel->getPembimbingAgamaByIdSkripsi($lastSkripsi['id']);
        $penguji = $this->dosenModel->find($sidangSkripsi['dosen_penguji']);
        
        $nilaiPembimbing1 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu1[0]['id_dosen']])->getResultArray();
        $nilaiPembimbing2 = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingIlmu2[0]['id_dosen']])->getResultArray();
        $nilaiPembimbingAgama = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $pembimbingAgama[0]['id_dosen']])->getResultArray();
        $nilaiPenguji = $this->penilaianSidangModel->getWhere(['id_sidang_skripsi' => $idSidangSkripsi, 'id_dosen' => $sidangSkripsi['dosen_penguji']])->getResultArray();

        //set data kelulusan
        if (count($nilaiPembimbing1) == 1 && ($pembimbingIlmu2[0]['id_dosen'] == null || ($pembimbingIlmu2[0]['id_dosen'] != null && count($nilaiPembimbing2) == 1)) && count($nilaiPembimbingAgama) == 1 && count($nilaiPenguji) == 1)
        {
            $jumlah = 0.0;
            $total_nilai = 0.0;

            //jika punya pembimbing 2
            if ($pembimbingIlmu2[0]['id_dosen'] != null) {
                $jumlah = floatval($nilaiPembimbing1[0]['nilai_akhir']) + floatval($nilaiPembimbing2[0]['nilai_akhir']) + floatval($nilaiPembimbingAgama[0]['nilai_akhir']) + floatval($nilaiPenguji[0]['nilai_akhir']); 
                $total_nilai = (float)$jumlah / (float)4;
            }//jika gak punya pembimbing 2 
            else if ($pembimbingIlmu2[0]['id_dosen'] == null) {
                $jumlah = floatval($nilaiPembimbing1[0]['nilai_akhir']) + floatval($nilaiPembimbingAgama[0]['nilai_akhir']) + floatval($nilaiPenguji[0]['nilai_akhir']); 
                $total_nilai = (float)$jumlah / (float)3;
            }

            $grade = "";

            if ($total_nilai >= 3.76) {
                $grade = "A";
            } else if ($total_nilai >= 3.51) {
                $grade = "A-";
            } else if ($total_nilai >= 3.10) {
                $grade = "B+";
            } else if ($total_nilai >= 2.76) {
                $grade = "B";
            }
            
            $status = "";

            if ($total_nilai >= 2.76) {
                $status = 'LULUS';
            } else {
                $status = 'TIDAK LULUS';
            }

            //update sidang skripsi
            $this->sidangSkripsiModel->update($idSidangSkripsi, [
                'total_nilai' => $total_nilai,
                'grade' => $grade,
                'status' => $status,
            ]);
            $sidangSkripsi = $this->sidangSkripsiModel->find($idSidangSkripsi);

            //update skripsi
            $this->skripsiModel->update($lastSkripsi['id'], [
                'status' => $status,
            ]);
        } 
        

        $data = [
            'title' => 'Hasil Sidang Skripsi',
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

        return view("mahasiswa/hasil_sidang_skripsi", $data);
    }

    public function makalah() {
        $dataAkun = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($dataAkun['npm']);
        $bidang = $this->bidangModel->getBidangByProdi($dataAkun['id_prodi']);
        $makalah = $this->makalahModel->getWhere(['npm' => $dataAkun['npm']])->getResultArray();

        $data = [
            'title' => 'Unggah Makalah',
            'dataAkun' =>$dataAkun,
            'lastSkripsi' => $lastSkripsi,
            'bidang' => $bidang,
            'makalah' => $makalah,
        ];

        return view("mahasiswa/makalah", $data);
    }

    public function insertMakalah() {
        $validationRules = [
            'file_makalah' => [
                'rules' => 'uploaded[file_makalah]|mime_in[file_makalah,application/pdf]|ext_in[file_makalah,pdf]|max_size[file_makalah,2048]',
                'errors' => [
                    'uploaded' => 'Pilih File Makalah terlebih dahulu',
                    'mime_in' => 'File Makalah harus berupa PDF',
                    'ext_in' => 'File Makalah harus berekstensi .pdf',
                    'max_size' => 'Ukuran File Makalah tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unggah File Makalah Gagal", "text" => $validation->getError("file_makalah")]);
            return redirect()->to(base_url("mahasiswa/makalah"))->withInput();
        }

        $npm = $this->request->getPost("npm");
        $judul = $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS);
        $deskripsi = $this->request->getPost("deskripsi", FILTER_SANITIZE_SPECIAL_CHARS);
        $kata_kunci = $this->request->getPost("kata_kunci", FILTER_SANITIZE_SPECIAL_CHARS);
        $id_bidang = $this->request->getPost("bidang");

        $fileMakalah = $this->request->getFile("file_makalah");
        $fileMakalahBaru = "Makalah_". $npm . ".".$fileMakalah->getClientExtension();
        $fileMakalah->move("folderMakalah", $fileMakalahBaru);
       
        $this->makalahModel->insert([
            "judul" => $judul,
            "deskripsi" => $deskripsi,
            "kata_kunci" => $kata_kunci,
            "file_makalah" => $fileMakalahBaru,
            "npm" => $npm,
            "tanggal_upload" => date_format(Time::now('Asia/Jakarta', 'en_us'), 'Y-m-d H:i:s'),
            "id_bidang" => $id_bidang,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Unggah Makalah Berhasil", "text" => "Makalah Anda telah berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/makalah"));
    }

    public function updateMakalah($idMakalah) {
        $validationRules = [
            'file_makalah' => [
                'rules' => 'mime_in[file_makalah,application/pdf]|ext_in[file_makalah,pdf]|max_size[file_makalah,2048]',
                'errors' => [
                    'mime_in' => 'File Proposal harus berupa PDF',
                    'ext_in' => 'File Proposal harus berekstensi .pdf',
                    'max_size' => 'Ukuran File Proposal tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unggah File Makalah Gagal", "text" => $validation->getError("file_makalah")]);
            return redirect()->to(base_url("mahasiswa/makalah"))->withInput();
        }

        
        $fileMakalah = $this->request->getFile("file_makalah");
        if ($fileMakalah->getName() != "") {
            $npm = $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS);
            $namafileMakalah = $this->makalahModel->find($idMakalah)['file_makalah'];
            unlink("folderMakalah/".$namafileMakalah);

            $newName = "Makalah_". $npm . "." .$fileMakalah->getClientExtension();
            $fileMakalah->move("folderMakalah", $newName);
            $this->makalahModel->update($idMakalah, [ "file_makalah" => $newName]);
        }

        $judul = $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS);
        $deskripsi = $this->request->getPost("deskripsi", FILTER_SANITIZE_SPECIAL_CHARS);
        $kata_kunci = $this->request->getPost("kata_kunci", FILTER_SANITIZE_SPECIAL_CHARS);
        $id_bidang = $this->request->getPost("bidang");
       
        $this->makalahModel->update($idMakalah,[
            "judul" => $judul,
            "deskripsi" => $deskripsi,
            "kata_kunci" => $kata_kunci,
            "id_bidang" => $id_bidang,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Perbarui Makalah Berhasil", "text" => "Makalah Anda telah berhasil diperbarui"]);
        return redirect()->to(base_url("mahasiswa/makalah"));
    }

    public function downloadKhs($npm)
    {
        $namaFileKhs = $this->mahasiswaModel->find($npm);
        if ($namaFileKhs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KHS Gagal", "text" => "File KHS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderKHS/".$namaFileKhs['file_khs'], null);
    }

    public function downloadKrs($npm)
    {
        $namaFileKrs = $this->mahasiswaModel->find($npm);
        if ($namaFileKrs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KRS Gagal", "text" => "File KRS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderKRS/".$namaFileKrs['file_krs'], null);
    }

    public function downloadPersetujuanSkripsi($npm)
    {
        $namaFilePengajuan = $this->mahasiswaModel->find($npm);
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persetujuan Skripsi Gagal", "text" => "File Persetujuan Skripsi tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderPersetujuanSkripsi/".$namaFilePengajuan['file_persetujuan_skripsi'], null);
    }

    public function downloadDraft($id)
    {
        $namaFilePengajuan = $this->pengajuanPrasidangModel->find($id);
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh File Draft Skripsi Gagal", "text" => "File Draft Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderDraft/".$namaFilePengajuan['file_draft'], null);
    }
    
    public function downloadLembarPersetujuan($id)
    {
        $namaFilePengajuan = $this->pengajuanPrasidangModel->find($id);
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh Lembar Persetujuan Seminar Prasidang Gagal", "text" => "Lembar Persetujuan Seminar Prasidang tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderLembarPersetujuanPrasidang/".$namaFilePengajuan['lembar_persetujuan'], null);
    }

    public function downloadDraftFinal($id)
    {
        $namaFileDraftFinal = $this->pengajuanSidangModel->find($id);
        if ($namaFileDraftFinal == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Draft Final Skripsi Gagal", "text" => "File Draft Final Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderDraftFinal/".$namaFileDraftFinal['file_draft_final'], null);
    }

    public function downloadFormBimbingan($id)
    {
        $namaFormBimbingan = $this->pengajuanSidangModel->find($id);
        if ($namaFormBimbingan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Form Bimbingan Skripsi Gagal", "text" => "File Form Bimbingan Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderFormBimbingan/".$namaFormBimbingan['file_form_bimbingan'], null);
    }

    public function downloadPersyaratanSidang($id)
    {
        $namaFilePersyaratanSidang = $this->pengajuanSidangModel->find($id);
        if ($namaFilePersyaratanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persyaratan Sidang Skripsi Gagal", "text" => "File Persyaratan Sidang Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderPersyaratanSidang/".$namaFilePersyaratanSidang['file_persyaratan_sidang'], null);
    }

    public function downloadSkripsi($idSkripsi) {
        $skripsi = $this->skripsiModel->find($idSkripsi);
        if ($skripsi == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh File Skripsi Gagal", "text" => "File Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderSkripsi/".$skripsi['file_skripsi'], null);
    }

    public function deleteKhs($npm) 
    {
        $namaFileKhs = $this->mahasiswaModel->find($npm);
        if ($namaFileKhs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KHS Gagal", "text" => "File KHS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderKHS/".$namaFileKhs['file_khs']);
        $this->mahasiswaModel->update($npm, [
            "file_khs" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File KHS Berhasil", "text" => "File KHS berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function deleteKrs($npm) 
    {
        $namaFileKrs = $this->mahasiswaModel->find($npm);
        if ($namaFileKrs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KRS Gagal", "text" => "File KRS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderKRS/".$namaFileKrs['file_krs']);
        $this->mahasiswaModel->update($npm, [
            "file_krs" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File KRS Berhasil", "text" => "File KRS berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function deletePersetujuanSkripsi($npm) 
    {
        $namaFilePengajuan = $this->mahasiswaModel->find($npm);
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persetujuan Skripsi Gagal", "text" => "File Persetujuan Skripsi tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderPersetujuanSkripsi/".$namaFilePengajuan['file_persetujuan_skripsi']);
        $this->mahasiswaModel->update($npm, [
            "file_persetujuan_skripsi" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Persetujuan Skripsi Berhasil", "text" => "File Persetujuan Skripsi berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function deleteDraft($id) 
    {
        $namaFileDraft = $this->pengajuanPrasidangModel->find($id);
        if ($namaFileDraft == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Draft Skripsi Gagal", "text" => "File Draft Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        unlink("folderDraft/".$namaFileDraft['file_draft']);
        $this->pengajuanPrasidangModel->update($id, [
            "file_draft" => null,
            "status" => 'TERTUNDA',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Draft Skripsi Berhasil", "text" => "File Draft Skripsi berhasil dihapus"]);
        return redirect()->back();
    }

    public function deleteLembarPersetujuan($id) 
    {
        $namaFileDraft = $this->pengajuanPrasidangModel->find($id);
        if ($namaFileDraft == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh File Lembar Persetujuan Seminar Prasidang Gagal", "text" => "File Lembar Persetujuan Seminar Prasidang tidak ditemukan"]);
            return redirect()->back();
        }
        unlink("folderLembarPersetujuanPrasidang/".$namaFileDraft['lembar_persetujuan']);
        $this->pengajuanPrasidangModel->update($id, [
            "lembar_persetujuan" => null,
            "status" => 'TERTUNDA',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Lembar Persetujuan Seminar Prasidang Berhasil", "text" => "File Lembar Persetujuan Seminar Prasidang berhasil dihapus"]);
        return redirect()->back();
    }

    public function deleteDraftFinal($id) 
    {
        $namaFileDraftFinal = $this->pengajuanSidangModel->find($id);
        if ($namaFileDraftFinal == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Draft Final Skripsi Gagal", "text" => "File Draft Final Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        unlink("folderDraftFinal/".$namaFileDraftFinal['file_draft_final']);
        $this->pengajuanSidangModel->update($id, [
            "file_draft_final" => null,
            "status" => 'TERTUNDA',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Draft Final Skripsi Berhasil", "text" => "File Draft Final Skripsi berhasil dihapus"]);
        return redirect()->back();
    }

    public function deleteFormBimbingan($id) 
    {
        $namaFileFormBimbingan = $this->pengajuanSidangModel->find($id);
        if ($namaFileFormBimbingan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Form Bimbingan Skripsi Gagal", "text" => "File Form Bimbingan Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        unlink("folderFormBimbingan/".$namaFileFormBimbingan['file_form_bimbingan']);
        $this->pengajuanSidangModel->update($id, [
            "file_form_bimbingan" => null,
            "status" => 'TERTUNDA',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Form Bimbingan Skripsi Berhasil", "text" => "File Form Bimbingan Skripsi berhasil dihapus"]);
        return redirect()->back();
    }

    public function deletePersyaratanSidang($id) 
    {
        $namaFilePersyaratanSidang = $this->pengajuanSidangModel->find($id);
        if ($namaFilePersyaratanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persyaratan Sidang Skripsi Gagal", "text" => "File Persyaratan Sidang Skripsi tidak ditemukan"]);
            return redirect()->back();
        }
        unlink("folderPersyaratanSidang/".$namaFilePersyaratanSidang['file_persyaratan_sidang']);
        $this->pengajuanSidangModel->update($id, [
            "file_persyaratan_sidang" => null,
            "status" => 'TERTUNDA',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Persyaratan Sidang Skripsi Berhasil", "text" => "File Persyaratan Sidang Skripsi berhasil dihapus"]);
        return redirect()->back();
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