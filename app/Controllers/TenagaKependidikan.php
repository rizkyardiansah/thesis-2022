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
    }

    public function index()
    {
        
    }

    public function pengajuanSkripsi() {
        $data = [
            'title' => "Pengajuan Penyusunan Skripsi",
            'dosen' => $this->dosenModel->findAll(),
            'prodi' => $this->prodiModel->findAll(),
            'dataMahasiswa' => $this->mahasiswaModel->getAllPengajuanSkripsi(),
        ];
        return view("tenagaKependidikan/pengajuan_skripsi", $data);
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
        $insertedData = 0;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $arrayPembimbing = [];
            $npm = $worksheet->getCell("A$row")->getValue();
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
            if ($lastSkripsi == null) {
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

        session()->setFlashdata("message", ["icon" => "success", "title" => "Pembimbing Skripsi Berhasil Ditambahkan", "text" => "$insertedData Data berhasil ditambahkan"]);
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