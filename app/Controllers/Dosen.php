<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Dosen extends BaseController 
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
    protected $pengajuanPrasidangModel;
    protected $seminarPrasidangModel;

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
        $this->seminarPrasidangModel = new \App\Models\SeminarPrasidangModel();
    }

    public function index()
    {
        
    }

    public function kaprodiProposal() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $prodi = $this->prodiModel->getProdiByKaprodi(session()->get("user_session")['id']);
        $proposal = $this->proposalModel->getProposalMahasiswaByProdi($prodi['id']);
        $dosen = $this->dosenModel->findAll();
        $bidang = $this->bidangModel->findAll();
        $data = [
            "title" => "Proposal Mahasiswa ". $prodi['inisial'],
            "proposal" => $proposal,
            "bidang" => $bidang,
            "dosen" => $dosen,
        ];
        return view("dosen/kaprodi_proposal", $data);
    }

    public function seminarProposal() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $prodi = $this->prodiModel->getProdiByKaprodi(session()->get("user_session")['id']);
        $seminarProposal = $this->semproModel->getSemproByProdi($prodi['id']);
        $mahasiswa = $this->mahasiswaModel->getMahasiswaBelumDapatSemproByProdi($prodi['id']);
        $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
        $data = [
            "title" => "Seminar Proposal Mahasiswa ". $prodi['inisial'],
            "prodi" => $prodi,
            "seminarProposal" => $seminarProposal,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
        ];

        return view("dosen/seminar_proposal", $data);

    }

    public function updateModeSempro($idProdi) {
        $mode_sempro = $this->request->getPost("mode_sempro", FILTER_SANITIZE_SPECIAL_CHARS);
        $this->prodiModel->update($idProdi, [
            "mode_sempro" => $mode_sempro
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Atur Mode Seminar Proposal Berhasil", "text" => "Seminar Proposal diatur menjadi ".$mode_sempro]);
        return redirect()->to(base_url("dosen/seminarProposal"));
    }

    public function insertJadwalSempro() {
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
        return redirect()->to(base_url("dosen/seminarProposal"));
    }

    public function updateJadwalSempro($idSempro) {
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
        return redirect()->to(base_url("dosen/seminarProposal"));
    }

    public function deleteJadwalSempro($idSempro) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $this->semproModel->delete($idSempro);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Jadwal SemPro Berhasil", "text" => "Jadwal Seminar Proposal Berhasil dihapus"]);
        return redirect()->to(base_url("dosen/seminarProposal"));
    }

    public function insertJadwalSemproBatch() {
        $dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $validationRules = [
            'fileJadwal' => [
                'rules' => 'uploaded[fileJadwal]|mime_in[fileJadwal,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[fileJadwal,xls,xlsx]|max_size[fileJadwal,2048]',
                'errors' => [
                    'uploaded' => 'Pilih File Jadwal Seminar Proposal terlebih dahulu',
                    'mime_in' => 'File Jadwal Seminar Proposal harus berupa Excel',
                    'ext_in' => 'File Jadwal Seminar Proposal harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Jadwal Seminar Proposal tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Jadwal Seminar Proposal Gagal", "text" => $validation->getError("fileJadwal")]);
            return redirect()->to(base_url("dosen/seminarProposal"))->withInput();
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
        $arrayJadwal = [];
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
            if ($penguji1 != null && $penguji1['id_prodi'] != $dataAkun['id_prodi'] || $penguji2 != null && $penguji2['id_prodi'] != $dataAkun['id_prodi']) { continue; }
            if ($penguji2 == null && $worksheet->getCell("E$row")->getValue() != "-") { continue; }

            $dosen_penguji1 = $penguji1['id'];
            $dosen_penguji2 = null;
            if ($penguji2 != null) {
                $dosen_penguji2 = $penguji2['id'];
            }

            $arrayJadwal[$row-2] = [
                'id_proposal' => $id_proposal,
                'tanggal' => $tanggal,
                'dosen_penguji1' => $dosen_penguji1,
                'dosen_penguji2' => $dosen_penguji2,
            ];

            if ($mode_sempro == 'Sinkronus Daring') {
                $arrayJadwal[$row-2]['link_konferensi'] =  $link_konferensi;
            } elseif ($mode_sempro == 'Sinkronus Luring') {
                $arrayJadwal[$row-2]['ruangan'] = $ruangan;
            }
            $successCounter++;
        }

        if (count($arrayJadwal) > 0) {
            $this->semproModel->insertBatch($arrayJadwal);
        }
        session()->setFlashdata("message", ["icon" => "info", "title" => "Jadwal Seminar Proposal Berhasil dibuat", "text" => "$successCounter dari $totalCounter Jadwal telah berhasil ditambahkan!"]);
        return redirect()->to(base_url("dosen/seminarProposal"));
    }

    public function downloadFormatJadwalSempro($mode_sempro) {
        redirect()->to(base_url("dosen->seminarProposal"));
        if ($mode_sempro == 'Sinkronus Daring') {
            return $this->response->download("folderResource/Format_Jadwal_SemPro_Sinkronus_Daring.xlsx", null);
        } else if ($mode_sempro == 'Sinkronus Luring') {
            return $this->response->download("folderResource/Format_Jadwal_SemPro_Sinkronus_Luring.xlsx", null);
        }
    }

    public function pengujiSeminarProposal() {
        //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataDosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $prodi = $this->prodiModel->find($dataDosen['id_prodi']);
        $dosen = $this->dosenModel->getDosenByProdi($dataDosen['id_prodi']);
        if ($prodi['mode_sempro'] == 'Asinkronus') {
            $seminarProposal = $this->semproModel->getSemproByProdi($prodi['id']);
        } else {
            $seminarProposal = $this->semproModel->getSemproByDosen($dataDosen['id']);
        }

        $data = [
            'title' => 'Penguji Seminar Proposal',
            'prodi' => $prodi,
            'dosen' => $dosen,
            'seminarProposal' => $seminarProposal
        ];

        return view("dosen/penguji_seminar_proposal", $data);
    }

    public function insertPenilaianSempro($idSempro) {
        $sempro = $this->semproModel->find($idSempro);
        $proposal = $this->proposalModel->find($sempro['id_proposal']);
        $komentar = $proposal['komentar']. PHP_EOL . $this->request->getPost("komentar", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->proposalModel->update($sempro['id_proposal'], [
            'komentar' => $komentar,
            'status' => $this->request->getPost("status"),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Penilaian Seminar Proposal Berhasil", "text" => "Seminar Proposal berhasil dinilai!"]);
        return redirect()->to(base_url("dosen/pengujiSeminarProposal"));
    }

    public function downloadFormatPembimbing() {
        redirect()->to(base_url("dosen/pembimbing"));
        return $this->response->download("folderResource/Format_Pembimbing_Skripsi_Mahasiswa.xlsx", null);
    }

    public function bimbingan() {
        $dosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $mahasiswaBimbingan = $this->pembimbingModel->getAllMahasiswaBimbingan($dosen['id']);
        //dd($mahasiswaBimbingan);
        for ($i = 0; $i < count($mahasiswaBimbingan); $i++) {
            $idPembimbing = $mahasiswaBimbingan[$i]['id'];
            $hasilBimbingan = $this->catatanBimbinganModel->getWhere(['id_pembimbing' => $idPembimbing])->getResultArray();
            $mahasiswaBimbingan[$i]['jumlah_bimbingan'] = count($hasilBimbingan);
        }

        $data = [
            'title' => 'Mahasiswa Bimbingan',
            'mahasiswaBimbingan' => $mahasiswaBimbingan,
        ];

        return view('dosen/bimbingan', $data);
    }

    public function detailBimbingan($npm, $role) {
        $dosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        if ($lastSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $dataPembimbing = $this->pembimbingModel->getWhere(['id_skripsi' => $lastSkripsi['id'], 'id_dosen' => $dosen['id'], 'role' => $role])->getResultArray();
        if (count($dataPembimbing) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $catatanBimbingan = $this->catatanBimbinganModel->getWhere(['id_pembimbing' => $dataPembimbing[0]['id']])->getResultArray();
        $data = [
            'title' => 'Detail Bimbingan',
            'catatanBimbingan' => $catatanBimbingan,
        ];
        return view("dosen/detail_bimbingan", $data);
    }

    public function setujuiBimbingan($idCatatan) {
        $this->catatanBimbinganModel->update($idCatatan, [
            'status' => 'DISETUJUI',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Catatan Bimbingan Diterima", "text" => "Seminar Proposal berhasil diterima!"]);
        return redirect()->back();
    }

    public function tolakBimbingan($idCatatan) {
        $this->catatanBimbinganModel->update($idCatatan, [
            'status' => 'DITOLAK',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Catatan Bimbingan Ditolak", "text" => "Seminar Proposal berhasil ditolak!"]);
        return redirect()->back();
    }

    public function pengajuanPrasidang() {
        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $daftarPengajuan = $this->pengajuanPrasidangModel->getPengajuanPrasidangByProdi($dataAkun['id_prodi']);
        $data = [   
            'title' => 'Pengajuan Seminar Pra Sidang',
            'daftarPengajuan' => $daftarPengajuan,
        ];
        return view("dosen/pengajuan_pra_sidang", $data);
    }

    public function detailPengajuanPrasidang($idPengajuanPrasidang) {
        $detailPengajuan = $this->pengajuanPrasidangModel->getDetailPengajuanById($idPengajuanPrasidang);
        if ($detailPengajuan == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Pengajuan Prasidang',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("dosen/detail_pengajuan_pra_sidang", $data);
    }

    public function setujuiPengajuanPrasidang($idPengajuanPrasidang) {
        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DISETUJUI'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Diterima", "text" => "Pengajuan Seminar Prasidang berhasil diterima!"]);
        return redirect()->to(base_url("dosen/pengajuanPrasidang"));
    }

    public function tolakPengajuanPrasidang($idPengajuanPrasidang) {
        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DITOLAK'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Ditolak", "text" => "Pengajuan Seminar Prasidang telah ditolak!"]);
        return redirect()->to(base_url("dosen/pengajuanPrasidang"));
    }

    public function seminarPrasidang() {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $prodi = $this->prodiModel->find($dataAkun['id_prodi']);
        $mahasiswa = $this->mahasiswaModel->getMahasiswaBelumDapatSempraByProdi($prodi['id']);
        $seminarPrasidang = $this->seminarPrasidangModel->getPrasidangByProdi($prodi['id']);
        $dosen = $this->dosenModel->getDosenByProdi($prodi['id']);
        $data = [
            "title" => "Seminar Prasidang Mahasiswa ". $prodi['inisial'],
            "prodi" => $prodi,
            "seminarPrasidang" => $seminarPrasidang,
            "mahasiswa" => $mahasiswa,
            "dosen" => $dosen,
        ];

        return view("dosen/seminar_prasidang", $data);

    }

    public function insertJadwalSeminarPrasidang() {
        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

            $this->seminarPrasidangModel->insert([
                'id_skripsi' => $skripsi['id'],
                'tanggal' => $tanggal_seminar . " " . $jam_seminar,
                'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_URL),
                'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
                'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
            ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Prasidang Berhsil dibuat", "text" => "Jadwal seminar prasidang telah dibuat"]);
        return redirect()->to(base_url("dosen/seminarPrasidang"));
    }

    public function updateJadwalSeminarPrasidang($idSeminarPrasidang) {
        $npm = $this->request->getPost("mahasiswa", FILTER_SANITIZE_SPECIAL_CHARS);
        $skripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);

        $tanggal_seminar = date_format(date_create($this->request->getPost("tanggal")), 'Y-m-d');
        $jam_seminar = $this->request->getPost("jam", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->seminarPrasidangModel->update($idSeminarPrasidang, [
            'tanggal' => $tanggal_seminar . " " . $jam_seminar,
            'ruangan' => $this->request->getPost("ruangan", FILTER_SANITIZE_SPECIAL_CHARS),
            'dosen_penguji1' => $this->request->getPost("dosen_penguji1"),
            'dosen_penguji2' => $this->request->getPost("dosen_penguji2"),
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Jadwal Seminar Prasidang Berhasil diperbarui", "text" => "Jadwal seminar prasidang telah diperbarui"]);
        return redirect()->to(base_url("dosen/seminarPrasidang"));
    }

    public function deleteJadwalSeminarPrasidang($idSeminarPrasidang) {
        //autentikasi
        if (!$this->authenticate(["kaprodi"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $this->seminarPrasidangModel->delete($idSeminarPrasidang);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Jadwal Seminar Prasidang Berhasil", "text" => "Jadwal Seminar Prasidang Berhasil dihapus"]);
        return redirect()->to(base_url("dosen/seminarPrasidang"));
    }

    public function downloadFormatJadwalSeminarPrasidang() {
        redirect()->to(base_url("dosen->seminarPrasidang"));
        return $this->response->download("folderResource/Format_Jadwal_Seminar_Prasidang.xlsx", null);
    }

    public function insertJadwalSeminarPrasidangBatch() {
        $dataAkun = $this->dosenModel->find(session()->get('user_session')['id']);
        $validationRules = [
            'fileJadwal' => [
                'rules' => 'uploaded[fileJadwal]|mime_in[fileJadwal,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[fileJadwal,xls,xlsx]|max_size[fileJadwal,2048]',
                'errors' => [
                    'uploaded' => 'Pilih File Jadwal Seminar Prasidang terlebih dahulu',
                    'mime_in' => 'File Jadwal Seminar Prasidang harus berupa Excel',
                    'ext_in' => 'File Jadwal Seminar Prasidang harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Jadwal Seminar Prasidang tidak boleh lebih dari 2MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Jadwal Seminar Prasidang Gagal", "text" => $validation->getError("fileJadwal")]);
            return redirect()->to(base_url("dosen/seminarPrasidang"))->withInput();
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

        $arrayJadwal = [];
        $totalCounter = 0;
        $successCounter = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $totalCounter++;
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi(strval($worksheet->getCell("A$row")->getValue()));
            if ($lastSkripsi == null || 
                ($lastSkripsi != null && $lastSkripsi['status'] != 'Dalam Pengerjaan')
            ) {
                continue;
            }
            
            $id_skripsi = $lastSkripsi['id'];
            
            $pengajuan = $this->pengajuanPrasidangModel->getWhere(['id_skripsi' => $id_skripsi])->getResultArray();
            if (count($pengajuan) == 0 || (count($pengajuan) == 1 && $pengajuan[0]['status'] != 'DISETUJUI')) { continue; }

            $tanggal = date_format(date_create_from_format('d-m-Y H:i', $worksheet->getCell("B$row")->getValue()), 'Y-m-d H:i');
            
            $ruangan = $worksheet->getCell("C$row")->getValue();

            $penguji1 = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue());
            $penguji2 = $this->dosenModel->getDosenByInisial($worksheet->getCell("E$row")->getValue());
            if ($penguji1 == null) { continue; }
            if ($penguji1 != null && $penguji1['id_prodi'] != $dataAkun['id_prodi'] || $penguji2 != null && $penguji2['id_prodi'] != $dataAkun['id_prodi']) { continue; }
            if ($penguji2 == null && $worksheet->getCell("E$row")->getValue() != "-") { continue; }

            $dosen_penguji1 = $penguji1['id'];
            $dosen_penguji2 = null;
            if ($penguji2 != null) {
                $dosen_penguji2 = $penguji2['id'];
            }

            $arrayJadwal[$row-2] = [
                'id_skripsi' => $id_skripsi,
                'tanggal' => $tanggal,
                'ruangan' => $ruangan,
                'dosen_penguji1' => $dosen_penguji1,
                'dosen_penguji2' => $dosen_penguji2,
            ];
            $successCounter++;
        }

        if (count($arrayJadwal) > 0) {
            $this->seminarPrasidangModel->insertBatch($arrayJadwal);
        }
        session()->setFlashdata("message", ["icon" => "info", "title" => "Jadwal Seminar Prasidang Berhasil ditambahkan", "text" => "$successCounter dari $totalCounter Jadwal telah berhasil ditambahkan!"]);
        return redirect()->to(base_url("dosen/seminarPrasidang"));
    }

    public function pengujiSeminarPrasidang() {
        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $dosen = $this->dosenModel->getDosenByProdi($dataAkun['id_prodi']);
        $seminarPrasidang = $this->seminarPrasidangModel->getSeminarPrasidangByDosen($dataAkun['id']);

        $data = [
            'title' => 'Penguji Seminar Prasidang',
            'dosen' => $dosen,
            'seminarPrasidang' => $seminarPrasidang
        ];

        return view("dosen/penguji_seminar_prasidang", $data);
    }

    public function reviewSeminarPrasidang($idSeminarPrasidang) {
        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $detailSeminarPrasidang = $this->seminarPrasidangModel->getDetailSeminarPrasidangById($idSeminarPrasidang);
        // dd($detailSeminarPrasidang);
        if (count($detailSeminarPrasidang) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Review Seminar Prasidang',
            'dataAkun' => $dataAkun,
            'detailSeminarPrasidang' => $detailSeminarPrasidang[0]
        ];

        return view("dosen/review_seminar_prasidang", $data);
    }

    public function cetakBimbingan() {
        return view("cetakBimbingan");
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