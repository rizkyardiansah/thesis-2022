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
    protected $seminarPrasidangModel;

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
        $this->seminarPrasidangModel = new \App\Models\SeminarPrasidangModel();
    }

    public function index()
    {

    }

    public function profil() {
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

    public function pengajuanPenulisanSkripsi() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $dosen = $this->dosenModel->getDosenByProdi($mahasiswa['id_prodi']);

        $data = [
            'title' => 'Pengajuan Penulisan Skripsi',
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
        ];

        return view("mahasiswa/pengajuan_penulisan_skripsi", $data);
    }

    public function insertPengajuanPenulisanSkripsi($npm) {
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
            "status_persetujuan_skripsi" => null
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Upload Data Berhasil", "text" => "Data Persetujuan Penyusunan Skripsi Berhasil diunggah"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function downloadKhs($npm)
    {
        $namaFileKhs = $this->mahasiswaModel->find($npm)['file_khs'];
        if ($namaFileKhs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KHS Gagal", "text" => "File KHS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderKHS/".$namaFileKhs, null);
    }

    public function deleteKhs($npm) 
    {
        $namaFileKhs = $this->mahasiswaModel->find($npm)['file_khs'];
        if ($namaFileKhs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KHS Gagal", "text" => "File KHS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderKHS/".$namaFileKhs);
        $this->mahasiswaModel->update($npm, [
            "file_khs" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File KHS Berhasil", "text" => "File KHS berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function downloadKrs($npm)
    {
        $namaFileKrs = $this->mahasiswaModel->find($npm)['file_krs'];
        if ($namaFileKrs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KRS Gagal", "text" => "File KRS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderKRS/".$namaFileKrs, null);
    }

    public function deleteKrs($npm) 
    {
        $namaFileKrs = $this->mahasiswaModel->find($npm)['file_krs'];
        if ($namaFileKrs == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File KRS Gagal", "text" => "File KRS tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderKRS/".$namaFileKrs);
        $this->mahasiswaModel->update($npm, [
            "file_krs" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File KRS Berhasil", "text" => "File KRS berhasil dihapus"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
    }

    public function downloadPersetujuanSkripsi($npm)
    {
        $namaFilePengajuan = $this->mahasiswaModel->find($npm)['file_persetujuan_skripsi'];
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persetujuan Skripsi Gagal", "text" => "File Persetujuan Skripsi tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        
        redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        return $this->response->download("folderPersetujuanSkripsi/".$namaFilePengajuan, null);
    }

    public function deletePersetujuanSkripsi($npm) 
    {
        $namaFilePengajuan = $this->mahasiswaModel->find($npm)['file_persetujuan_skripsi'];
        if ($namaFilePengajuan == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Download File Persetujuan Skripsi Gagal", "text" => "File Persetujuan Skripsi tidak ditemukan"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPenulisanSkripsi"));
        }
        unlink("folderPersetujuanSkripsi/".$namaFilePengajuan);
        $this->mahasiswaModel->update($npm, [
            "file_persetujuan_skripsi" => null,
            "status_persetujuan_skripsi" => null,
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus File Persetujuan Skripsi Berhasil", "text" => "File Persetujuan Skripsi berhasil dihapus"]);
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

        $this->semproModel->save([
            'id_proposal' => $id_proposal,
            'link_video' => $link_video,
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
        $dosenPembimbing = $this->pembimbingModel->getAllPembimbingByNpm($mahasiswa['npm']);
        //dd($dosenPembimbing);
        $hasilBimbingan = $this->catatanBimbinganModel->getAllCatatanByNpm($mahasiswa['npm']);
        //dd($hasilBimbingan);
        $data = [
            'title' => "Pembimbing Skripsi",
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

    public function pengajuanPraSidang() {
        $mahasiswa = $this->mahasiswaModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($mahasiswa['npm']);
        if ($lastSkripsi != null) {
            $lastSkripsi['nama_bidang'] = $this->bidangModel->find($lastSkripsi['id_bidang'])['nama'];
        }
        $pengajuanPrasidang = $this->pengajuanPrasidangModel->getPengajuanPrasidangByNpm($mahasiswa['npm']);
        $data = [
            'title' => 'Pengajuan Seminar Pra Sidang',
            'mahasiswa' => $mahasiswa,
            'lastSkripsi' => $lastSkripsi,
            'pengajuanPrasidang' => $pengajuanPrasidang,
        ];
        return view("mahasiswa/pengajuan_pra_sidang", $data);
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
        if ($pengajuanPrasidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Ubah Pengajuan Seminar Prasidang Gagal", "text" => "Data Pengajuan tidak ditemukan!"]);
            return redirect()->to(base_url("mahasiswa/pengajuanPraSidang"));
        }
        
        unlink("folderDraft/".$pengajuanPrasidang['file_draft']);
        unlink("folderLembarPersetujuanPrasidang/".$pengajuanPrasidang['lembar_persetujuan']);

        $fileDraft = $this->request->getFile("file_draft");
        $fileDraft->move("folderDraft", $pengajuanPrasidang['file_draft']);

        $lembarPersetujuan = $this->request->getFile("lembar_persetujuan");
        $lembarPersetujuan->move("folderLembarPersetujuanPrasidang", $pengajuanPrasidang['lembar_persetujuan']);

        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'TERTUNDA',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Pengajuan Seminar Prasidang Berhasil", "text" => "Data Pengajuan telah berhasil diubah!"]);
        return redirect()->to(base_url("mahasiswa/pengajuanPraSidang"));
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