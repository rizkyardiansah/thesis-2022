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
    }

    public function index()
    {
        
    }

    public function pengajuanSkripsi() {
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

        return view("TenagaKependidikan/detail_pengajuan_skripsi", $data);
    }

    public function terimaPengajuanSkripsi($npm) {
        $this->mahasiswaModel->update($npm, [
            'status_persetujuan_skripsi' => 'Disetujui',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan diterima", "text" => "Pengajuan Penyusunan skripsi $npm disetujui"]);
        return redirect()->to(base_url("tenagakependidikan/pengajuanSkripsi"));
    }

    public function tolakPengajuanSkripsi($npm) {
        $this->mahasiswaModel->update($npm, [
            'status_persetujuan_skripsi' => 'Ditolak',
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan ditolak", "text" => "Pengajuan Penyusunan skripsi $npm ditolak"]);
        return redirect()->to(base_url("tenagakependidikan/pengajuanSkripsi"));
    }

    public function pembimbing() {
        // $dosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $mahasiswaTanpaPembimbing = $this->mahasiswaModel->getMahasiswaTanpaPembimbing();
        // dd($mahasiswaTanpaPembimbing);
        $mahasiswaDenganPembimbing = $this->mahasiswaModel->getMahasiswaDenganPembimbing();
        // dd($mahasiswaDenganPembimbing);
        $dosen = $this->dosenModel->findAll();
        $data = [
            'title' => "Kelola Pembimbing",
            'mahasiswaTanpaPembimbing' => $mahasiswaTanpaPembimbing,
            'dosen' => $dosen,
            'mahasiswaDenganPembimbing' => $mahasiswaDenganPembimbing,
        ];

        return view("TenagaKependidikan/pembimbing", $data);
    }

    public function insertPembimbing() {
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
        redirect()->to(base_url("dosen/pembimbing"));
        return $this->response->download("folderResource/Format_Pembimbing_Skripsi_Mahasiswa.xlsx", null);
    }

    public function insertPembimbingBatch() {
        $validationRules = [
            'filePembimbing' => [
                'rules' => 'uploaded[filePembimbing]|mime_in[filePembimbing,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[filePembimbing,xls,xlsx]|max_size[filePembimbing,2048]',
                'errors' => [
                    'uploaded' => 'Pilih File Pembimbing Skripsi Mahasiswa terlebih dahulu',
                    'mime_in' => 'File Pembimbing Skripsi Mahasiswa harus berupa Excel',
                    'ext_in' => 'File Pembimbing Skripsi Mahasiswa harus berekstensi .xls atau .xlsx',
                    'max_size' => 'Ukuran File Pembimbing Skripsi Mahasiswa tidak boleh lebih dari 2MB'
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
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
            //cek apakah skripsinya ada
            if ($lastSkripsi == null) {
                continue;
            }
            if ( count( $this->pembimbingModel->getWhere(["id_skripsi" => $lastSkripsi['id']])->getResultArray() ) == 3 ) {
                continue;
            }
            $id_skripsi = $lastSkripsi['id'];
            if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("B$row")->getValue()) == null ) {
                continue;
            }
            $dosen_pembimbing1 = $this->dosenModel->getDosenByInisial($worksheet->getCell("B$row")->getValue())['id'];
            $dosen_pembimbing2 = null;
            if ($worksheet->getCell("C$row")->getValue() != "-") {
                if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("C$row")->getValue()) == null ) {
                    continue;
                }
                $dosen_pembimbing2 = $this->dosenModel->getDosenByInisial($worksheet->getCell("C$row")->getValue())['id'];
            }
            if ( $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue()) == null ) {
                continue;
            }
            $dosen_pembimbing_agama = $this->dosenModel->getDosenByInisial($worksheet->getCell("D$row")->getValue())['id'];

            array_push($arrayPembimbing, [
                'id_skripsi' => $id_skripsi,
                'id_dosen' => $dosen_pembimbing1,
                'role' => 'Pembimbing Ilmu 1'
            ]);
            
            array_push($arrayPembimbing, [
                'id_skripsi' => $id_skripsi,
                'id_dosen' => $dosen_pembimbing2,
                'role' => 'Pembimbing Ilmu 2'
            ]);
            
            array_push($arrayPembimbing, [
                'id_skripsi' => $id_skripsi,
                'id_dosen' => $dosen_pembimbing_agama,
                'role' => 'Pembimbing Agama'
            ]);
            $this->pembimbingModel->insertBatch($arrayPembimbing);
            $insertedData++;
        }

        session()->setFlashdata("message", ["icon" => "info", "title" => "Pembimbing Skripsi Berhasil Ditambahkan", "text" => "$insertedData dari $totalRow Data berhasil ditambahkan"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing"));
    }

    public function updatePembimbing() {
        $npm = $this->request->getPost("npm");
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        $id_skripsi = $lastSkripsi['id'];
        $id1 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 1')->first();
        $id2 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 2')->first();
        $id3 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Agama')->first();
        $idPembimbing1 = $this->request->getPost("pembimbing1");
        $idPembimbing2 = $this->request->getPost("pembimbing2");
        $idPembimbingAgama = $this->request->getPost("pembimbingAgama");

        $jumlahCatatan1 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id1])->getResultArray());
        $jumlahCatatan2 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id2])->getResultArray());
        $jumlahCatatan3 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id3])->getResultArray());

        if ($jumlahCatatan1 > 0 || $jumlahCatatan2 > 0 || $jumlahCatatan3 > 0) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Update Pembimbing Gagal", "text" => "Mahasiswa $npm telah melakukan bimbingan dengan beberapa dosen pembimbingnya sehingga dosen pembimbing tidak bisa diubah"]);
            return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
        } 

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
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        $id_skripsi = $lastSkripsi['id'];
        $id1 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 1')->first();
        $id2 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Ilmu 2')->first();
        $id3 = $this->pembimbingModel->select('id')->where("id_skripsi", $id_skripsi)->where("role", 'Pembimbing Agama')->first();

        $jumlahCatatan1 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id1])->getResultArray());
        $jumlahCatatan2 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id2])->getResultArray());
        $jumlahCatatan3 = count($this->catatanBimbinganModel->getWhere(["id_pembimbing" => $id3])->getResultArray());

        if ($jumlahCatatan1 > 0 || $jumlahCatatan2 > 0 || $jumlahCatatan3 > 0) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Delete Pembimbing Gagal", "text" => "Mahasiswa $npm telah melakukan bimbingan dengan beberapa dosen pembimbingnya sehingga dosen pembimbing tidak bisa dihapus"]);
            return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
        }

        $this->pembimbingModel->delete($id1);

        if ($id2 != null) {
            $this->pembimbingModel->delete($id2);
        }

        $this->pembimbingModel->delete($id3);
        
        session()->setFlashdata("message", ["icon" => "success", "title" => "Update Pembimbing Berhasil", "text" => "Pembimbing untuk Mahasiswa $npm telah berhasil diperbarui"]);
        return redirect()->to(base_url("TenagaKependidikan/pembimbing")); 
    }

    public function pengajuanPrasidang() {
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
        return view("TenagaKependidikan/pengajuan_pra_sidang", $data);
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

        return view("TenagaKependidikan/detail_pengajuan_pra_sidang", $data);
    }

    public function setujuiPengajuanPrasidang($idPengajuanPrasidang) {
        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DISETUJUI'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Diterima", "text" => "Pengajuan Seminar Prasidang berhasil diterima!"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuanPrasidang"));
    }

    public function tolakPengajuanPrasidang($idPengajuanPrasidang) {
        $this->pengajuanPrasidangModel->update($idPengajuanPrasidang, [
            'status' => 'DITOLAK'
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Seminar Prasidang Ditolak", "text" => "Pengajuan Seminar Prasidang telah ditolak!"]);
        return redirect()->to(base_url("TenagaKependidikan/pengajuanPrasidang"));
    }

    public function pengajuanSidangSkripsi() {
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

        return view("TenagaKependidikan/pengajuan_sidang_skripsi", $data);
    }

    public function detailPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        $detailPengajuan = $this->pengajuanSidangModel->getDetailPengajuanById($idPengajuanSidangSkripsi);

        //dd($detailPengajuan);
        if ($detailPengajuan == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Detail Pengajuan Sidang Skripsi',
            'detailPengajuan' => $detailPengajuan,
        ];

        return view("TenagaKependidikan/detail_pengajuan_sidang_skripsi", $data);
    }

    public function tolakPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        $pengajuanSidang = $this->pengajuanSidangModel->find($idPengajuanSidangSkripsi);
        if ($pengajuanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Pengajuan Sidang Skripsi Tidak Ditemukan", "text" => "Pengajuan Sidang Skripsi Tidak Ditemukan"]);
            return redirect()->to(base_url("tenagakependidikan/pengajuansidangskripsi"));
        }

        $this->pengajuanSidangModel->update($idPengajuanSidangSkripsi, [
            'status' => 'DITOLAK',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Ditolak", "text" => "Pengajuan Sidang Skripsi telah Ditolak"]);
        return redirect()->to(base_url("tenagakependidikan/pengajuansidangskripsi"));
    }

    public function setujuiPengajuanSidangSkripsi($idPengajuanSidangSkripsi) {
        $pengajuanSidang = $this->pengajuanSidangModel->find($idPengajuanSidangSkripsi);
        if ($pengajuanSidang == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Pengajuan Sidang Skripsi Tidak Ditemukan", "text" => "Pengajuan Sidang Skripsi Tidak Ditemukan"]);
            return redirect()->to(base_url("tenagakependidikan/pengajuansidangskripsi"));
        }

        $this->pengajuanSidangModel->update($idPengajuanSidangSkripsi, [
            'status' => 'DISETUJUI',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pengajuan Disetujui", "text" => "Pengajuan Sidang Skripsi telah Disetujui"]);
        return redirect()->to(base_url("tenagakependidikan/pengajuansidangskripsi"));
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