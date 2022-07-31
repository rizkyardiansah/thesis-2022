<?php

namespace App\Controllers;

class TenagaKependidikan extends BaseController 
{
    protected $mahasiswaModel;
    protected $dosenModel;
    protected $prodiModel;
    protected $proposalModel;
    protected $bidangModel;
    protected $pembimbingModel;
    protected $skripsiModel;
    protected $catatanBimbinganModel;
    protected $pengajuanPrasidangModel;
    protected $pengajuanSidangModel;
    protected $sidangSkripsiModel;
    protected $penilaianSidangModel;

    public function __construct() 
    {
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();    
        $this->dosenModel = new \App\Models\DosenModel();    
        $this->prodiModel = new \App\Models\ProgramStudiModel();    
        $this->proposalModel = new \App\Models\ProposalModel();    
        $this->bidangModel = new \App\Models\BidangModel();    
        $this->pembimbingModel = new \App\Models\PembimbingModel();    
        $this->skripsiModel = new \App\Models\SkripsiModel();    
        $this->catatanBimbinganModel = new \App\Models\CatatanBimbinganModel();
         $this->pengajuanPrasidangModel = new \App\Models\PengajuanPrasidangModel();    
        $this->pengajuanSidangModel = new \App\Models\PengajuanSidangModel();    
        $this->sidangSkripsiModel = new \App\Models\SidangSkripsiModel();    
        $this->penilaianSidangModel = new \App\Models\PenilaianSidangModel();    
    }

    public function index()
    {
        if (session()->get("user_session") == null) {
            return view("auth/login");
        } else {
            return redirect()->to(base_url("home"));
        }
    }

    public function pengajuanSkripsi() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $pengajuanPenulisanSkripsi = $this->mahasiswaModel->getAllPengajuanSkripsi();
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $pengajuanPenulisanSkripsi = $this->mahasiswaModel->getPengajuanSkripsiByDateRange($dari, $hingga);
        }
        $data = [
            'title' => "Pengajuan Penulisan Skripsi",
            'pengajuanPenulisanSkripsi' => $pengajuanPenulisanSkripsi,
        ];
        return view("tenagaKependidikan/pengajuan_skripsi", $data);
    }

    public function detailPengajuanSkripsi($npm) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $mahasiswa = $this->mahasiswaModel->find($npm);
        if ($mahasiswa == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $detailPengajuan = $this->mahasiswaModel->getPengajuanSkripsiByNpm($npm);
        if ($detailPengajuan == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Pengajuan Penulisan Skripsi',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("tenagaKependidikan/detail_pengajuan_skripsi", $data);
    }

    public function terimaPengajuanSkripsi($npm) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->mahasiswaModel->update($npm, [
            'status_persetujuan_skripsi' => 'Disetujui',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan diterima", "text" => "Pengajuan Penyusunan skripsi $npm disetujui"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuanSkripsi"));
    }

    public function tolakPengajuanSkripsi($npm) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->mahasiswaModel->update($npm, [
            'status_persetujuan_skripsi' => 'Ditolak',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan ditolak", "text" => "Pengajuan Penyusunan skripsi $npm ditolak"]);
        return redirect()->to(base_url("tenagaKependidikan/pengajuanSkripsi"));
    }

    public function pembimbing() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        // $dosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $mahasiswaTanpaPembimbing = $this->mahasiswaModel->getMahasiswaTanpaPembimbing();
        // dd($mahasiswaTanpaPembimbing);
        $mahasiswaDenganPembimbing = $this->mahasiswaModel->getMahasiswaDenganPembimbing();
        //dd($mahasiswaDenganPembimbing);
        $dosen = $this->dosenModel->findAll();
        $data = [
            'title' => "Kelola Pembimbing",
            'mahasiswaTanpaPembimbing' => $mahasiswaTanpaPembimbing,
            'dosen' => $dosen,
            'mahasiswaDenganPembimbing' => $mahasiswaDenganPembimbing,
        ];

        return view("tenagaKependidikan/pembimbing", $data);
    }

    public function insertPembimbing() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("mahasiswa");
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        $idPembimbing1 = $this->request->getPost("pembimbing1");
        $idPembimbing2 = $this->request->getPost("pembimbing2");
        $idPembimbingAgama = $this->request->getPost("pembimbingAgama");

        $arrayInsert = array();
        array_push($arrayInsert, [
            'id_skripsi' => $lastSkripsi['id'],
            'id_dosen' => $idPembimbing1,
            'role' => 'Pembimbing Ilmu 1'
        ]);

        array_push($arrayInsert, [
            'id_skripsi' => $lastSkripsi['id'],
            'id_dosen' => $idPembimbing2,
            'role' => 'Pembimbing Ilmu 2'
        ]);

        array_push($arrayInsert, [
            'id_skripsi' => $lastSkripsi['id'],
            'id_dosen' => $idPembimbingAgama,
            'role' => 'Pembimbing Agama'
        ]);

        $this->pembimbingModel->insertBatch($arrayInsert);

        
        session()->setFlashdata("message", ["icon" => "success", "title" => "Input Pembimbing Berhasil", "text" => "Pembimbing untuk Mahasiswa $npm telah berhasil ditambahkan"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
    }

    public function downloadFormatPembimbing() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        redirect()->to(base_url("dosen/pembimbing"));
        return $this->response->download("folderResource/Format_Pembimbing_Skripsi_Mahasiswa.xlsx", null);
    }

    public function insertPembimbingBatch() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $validationRules = [
            'filePembimbing' => [
                'rules' => 'uploaded[filePembimbing]|mime_in[filePembimbing,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[filePembimbing,xls,xlsx]|max_size[filePembimbing,10000]',
                'errors' => [
                    'uploaded' => 'Pilih File Pembimbing Skripsi Mahasiswa terlebih dahulu',
                    'mime_in' => 'File Pembimbing Skripsi Mahasiswa harus berupa Excel',
                    'ext_in' => 'File Pembimbing Skripsi Mahasiswa harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Pembimbing Skripsi Mahasiswa tidak boleh lebih dari 10MB'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            session()->setFlashdata("message", ["icon" => "error", "title" => "Upload File Pembimbing Skripsi Gagal", "text" => $validation->getError("filePembimbing")]);
            return redirect()->to(base_url("TenagaKependidikan/pembimbing"))->withInput();
        }

        $file = $this->request->getFile("filePembimbing");
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
        $totalRow = 0;
        $insertedData = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $totalRow++;
            $arrayPembimbing = [];
            $npm = $worksheet->getCell("A$row")->getValue();

            $mahasiswa = $this->mahasiswaModel->find($npm);
            if ($mahasiswa == null) { continue; }

            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
            //cek apakah skripsinya ada
            if ($lastSkripsi == null) {
                continue;
            }

            $idPembimbing1 = null;
            $idPembimbing2 = null;
            $idPembimbingAgama = null;

            $resultPembimbing1 = $this->pembimbingModel->getWhere(["id_skripsi" => $lastSkripsi['id'], "role" => "Pembimbing Ilmu 1"])->getResultArray();
            $resultPembimbing2 = $this->pembimbingModel->getWhere(["id_skripsi" => $lastSkripsi['id'], "role" => "Pembimbing Ilmu 2"])->getResultArray();
            $resultPembimbingAgama = $this->pembimbingModel->getWhere(["id_skripsi" => $lastSkripsi['id'], "role" => "Pembimbing Agama"])->getResultArray();

            $isPembimbing1Exist = count($resultPembimbing1) != 0;
            $isPembimbing2Exist = count($resultPembimbing2) != 0;
            $isPembimbingAgamaExist = count($resultPembimbingAgama) != 0;

            $isCatatanBimbingan1Exist = false;
            $isCatatanBimbingan2Exist = false;
            $isCatatanBimbinganAgamaExist = false;

            if ( $isPembimbing1Exist ) { 
                $idPembimbing1 = $resultPembimbing1[0]['id']; 
                $isCatatanBimbingan1Exist = count($this->catatanBimbinganModel->getWhere(['id_pembimbing' => $idPembimbing1])->getResultArray()) != 0;
            }

            if ( $isPembimbing2Exist ) { 
                $idPembimbing2 = $resultPembimbing2[0]['id']; 
                $isCatatanBimbingan2Exist = count($this->catatanBimbinganModel->getWhere(['id_pembimbing' => $idPembimbing2])->getResultArray()) != 0;
            }

            if ( $isPembimbingAgamaExist ) { 
                $idPembimbingAgama = $resultPembimbingAgama[0]['id']; 
                $isCatatanBimbinganAgamaExist = count($this->catatanBimbinganModel->getWhere(['id_pembimbing' => $idPembimbingAgama])->getResultArray()) != 0;
            }

            if ($isCatatanBimbingan1Exist || $isCatatanBimbingan2Exist || $isCatatanBimbinganAgamaExist) { continue; }
            
            $id_skripsi = $lastSkripsi['id'];
            if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("B$row")->getValue()) == null || $this->dosenModel->getDosenByInisial($worksheet->getCell("B$row")->getValue())['id_prodi'] != $mahasiswa['id_prodi'] ) {
                continue;
            }
            $dosen_pembimbing1 = $this->dosenModel->getDosenByInisial($worksheet->getCell("B$row")->getValue())['id'];
            $dosen_pembimbing2 = null;
            if ($worksheet->getCell("C$row")->getValue() != "-") {
                if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("C$row")->getValue()) == null || $this->dosenModel->getDosenByInisial($worksheet->getCell("C$row")->getValue())['id_prodi'] != $mahasiswa['id_prodi'] ) {
                    continue;
                }
                $dosen_pembimbing2 = $this->dosenModel->getDosenByInisial($worksheet->getCell("C$row")->getValue())['id'];
            }
            if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue()) == null ) {
                continue;
            }
            $dosen_pembimbing_agama = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue())['id'];

            if ($idPembimbing1 == null) {
                $this->pembimbingModel->insert([
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing1,
                    'role' => 'Pembimbing Ilmu 1'
                ]);
            } else {
                $this->pembimbingModel->update($idPembimbing1, [
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing1,
                    'role' => 'Pembimbing Ilmu 1'
                ]);
            }
            
            if ($idPembimbing2 == null) {
                $this->pembimbingModel->insert([
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing2,
                    'role' => 'Pembimbing Ilmu 2'
                ]);
            } else {
                $this->pembimbingModel->update($idPembimbing2, [
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing2,
                    'role' => 'Pembimbing Ilmu 2'
                ]);
            }
            
            if ($idPembimbingAgama == null) {
                $this->pembimbingModel->insert([
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing_agama,
                    'role' => 'Pembimbing Agama'
                ]);
            } else {
                $this->pembimbingModel->update($idPembimbingAgama, [
                    'id_skripsi' => $id_skripsi,
                    'id_dosen' => $dosen_pembimbing_agama,
                    'role' => 'Pembimbing Agama'
                ]);
            }
            // $this->pembimbingModel->insertBatch($arrayPembimbing);
            $insertedData++;
        }

        session()->setFlashdata("message", ["icon" => "info", "title" => "Pembimbing Skripsi Berhasil Ditambahkan", "text" => "$insertedData dari $totalRow Data berhasil ditambahkan"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing"));
    }

    public function updatePembimbing() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }
        
        $npm = $this->request->getPost("npm");
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        $id_skripsi = $lastSkripsi['id'];
        $id1 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 1')->first();
        $id2 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 2')->first();
        $id3 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Agama')->first();
        $idPembimbing1 = $this->request->getPost("pembimbing1");
        $idPembimbing2 = $this->request->getPost("pembimbing2");
        $idPembimbingAgama = $this->request->getPost("pembimbingAgama");

        $this->pembimbingModel->update($id1, [
            'id_dosen' => $idPembimbing1,
        ]);

        if ($id2 != null) {
            $this->pembimbingModel->update($id2, [
                'id_dosen' => $idPembimbing2,
            ]);
        } else {
            $this->pembimbingModel->insert([
                'npm' => $npm,
                'id_dosen' => $idPembimbing2,
                'role' => 'Pembimbing Ilmu 2'
            ]);
        }

        $this->pembimbingModel->update($id3, [
            'id_dosen' => $idPembimbingAgama,
        ]);
        
        session()->setFlashdata("message", ["icon" => "success", "title" => "Update Pembimbing Berhasil", "text" => "Pembimbing untuk Mahasiswa $npm telah berhasil diperbarui"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
    }

    public function deletePembimbing($npm) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        $id_skripsi = $lastSkripsi['id'];
        $id1 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 1')->first();
        $id2 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 2')->first();
        $id3 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Agama')->first();

        $this->pembimbingModel->delete($id1);

        if ($id2 != null) {
            $this->pembimbingModel->delete($id2);
        }

        $this->pembimbingModel->delete($id3);
        
        session()->setFlashdata("message", ["icon" => "success", "title" => "Update Pembimbing Berhasil", "text" => "Pembimbing untuk Mahasiswa $npm telah berhasil diperbarui"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
    }

    public function pengajuanPrasidang() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $daftarPengajuan = $this->pengajuanPrasidangModel->getAllPengajuanPrasidang();
        
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $daftarPengajuan = $this->pengajuanPrasidangModel->getPengajuanPrasidangByDateRange($dari, $hingga);
        }
        $data = [   
            'title' => 'Pengajuan Seminar Prasidang',
            'daftarPengajuan' => $daftarPengajuan,
        ];
        return view("tenagaKependidikan/pengajuan_pra_sidang", $data);
    }

    public function detailPengajuanPrasidang($idPengajuanPrasidang) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $detailPengajuan = $this->pengajuanPrasidangModel->getDetailPengajuanById($idPengajuanPrasidang);
        if ($detailPengajuan == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Pengajuan Prasidang',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("tenagaKependidikan/detail_pengajuan_pra_sidang", $data);
    }

    public function setujuiPengajuanPrasidang($idPengajuanPrasidang) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DISETUJUI'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Diterima", "text" => "Pengajuan Seminar Prasidang berhasil diterima!"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuanPrasidang"));
    }

    public function tolakPengajuanPrasidang($idPengajuanPrasidang) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("npm");
        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DITOLAK'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Ditolak", "text" => "Pengajuan Seminar Prasidang telah ditolak!"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuanPrasidang"));
    }

    public function pengajuanSidangSkripsi() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $pengajuanSidangSkripsi = $this->pengajuanSidangModel->getAllPengajuanSidang();

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ( $dari != null && $hingga != null ) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $pengajuanSidangSkripsi = $this->pengajuanSidangModel->getPengajuanSidangByDateRange($dari, $hingga);
        }
        $data = [
            "title" => "Pengajuan Sidang Skripsi",
            "pengajuanSidangSkripsi" => $pengajuanSidangSkripsi,
        ];

        return view("tenagaKependidikan/pengajuan_sidang_skripsi", $data);
    }

    public function detailPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        
        $detailPengajuan = $this->pengajuanSidangModel->getDetailPengajuanById($idPengajuanSidangSkripsi);

        //dd($detailPengajuan);
        if ($detailPengajuan == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Pengajuan Sidang Skripsi',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("tenagaKependidikan/detail_pengajuan_sidang_skripsi", $data);
    }

    public function tolakPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $npm = $this->request->getPost("npm");
        $pengajuanSidang = $this->pengajuanSidangModel->find($idPengajuanSidangSkripsi);
        if ($pengajuanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Pengajuan Sidang Skripsi Tidak Ditemukan", "text" => "Pengajuan Sidang Skripsi Tidak Ditemukan"]);
            return redirect()->to(base_url("TenagaKependidikan/pengajuansidangskripsi"));
        }

        $this->pengajuanSidangModel->update($idPengajuanSidangSkripsi, [
            'status' => 'DITOLAK',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Ditolak", "text" => "Pengajuan Sidang Skripsi telah Ditolak"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuansidangskripsi"));
    }

    public function setujuiPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $pengajuanSidang = $this->pengajuanSidangModel->find($idPengajuanSidangSkripsi);
        if ($pengajuanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Pengajuan Sidang Skripsi Tidak Ditemukan", "text" => "Pengajuan Sidang Skripsi Tidak Ditemukan"]);
            return redirect()->to(base_url("TenagaKependidikan/pengajuansidangskripsi"));
        }

        $this->pengajuanSidangModel->update($idPengajuanSidangSkripsi, [
            'status' => 'DISETUJUI',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Disetujui", "text" => "Pengajuan Sidang Skripsi telah Disetujui"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuansidangskripsi"));
    }





    public function penilaianSidang() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $prodi = $this->prodiModel->find(session()->get("user_session")['id']);
        $mahasiswa = $this->sidangSkripsiModel->getAllSidangSkripsi();
        $data = [
            'title' => 'Penilaian Sidang Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ];
        return view("tenagaKependidikan/penilaian_sidang", $data);
    }

    public function hasilSidangSkripsi($idSkripsi) 
    {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
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

        return view("tenagaKependidikan/hasil_sidang_skripsi", $data);
    }

    public function cetakBeritaAcara($id_skripsi) {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
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

        return view("tenagaKependidikan/berita_acara", $data);
    }

    public function cetakBeritaAcaraBulk() {
        //autentikasi
        if (!$this->authenticate(["tendik"])) 
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

        return view("tenagaKependidikan/berita_acara", $data);
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