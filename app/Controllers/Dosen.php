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

        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");
        if ($prodi['mode_sempro'] == 'Asinkronus' ) {
            if ($dari != null && $hingga != null) {
                $hingga = date_create($hingga);
                date_add($hingga, date_interval_create_from_date_string("1 days"));
                $hingga = date_format($hingga, 'Y-m-d');
                $seminarProposal = $this->semproModel->getSemproByDateRange($prodi['id'], $dari, $hingga);
            }else {
                $seminarProposal = $this->semproModel->getSemproByProdi($prodi['id']);
            }
        } else {
            if ($dari != null && $hingga != null) {
                $hingga = date_create($hingga);
                date_add($hingga, date_interval_create_from_date_string("1 days"));
                $hingga = date_format($hingga, 'Y-m-d');
                $seminarProposal = $this->semproModel->getSemproByDosenDateRange($dataDosen['id'], $dari, $hingga);
            } else {
                $seminarProposal = $this->semproModel->getSemproByDosen($dataDosen['id']);
            }
        }

        $data = [
            'title' => 'Review Seminar Proposal',
            'prodi' => $prodi,
            'dosen' => $dosen,
            'seminarProposal' => $seminarProposal
        ];

        return view("dosen/penguji_seminar_proposal", $data);
    }

    public function insertPenilaianSempro($idSempro) {
        //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $sempro = $this->semproModel->find($idSempro);
        $proposal = $this->proposalModel->find($sempro['id_proposal']);
        $komentar = $this->request->getPost("komentar", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->proposalModel->update($sempro['id_proposal'], [
            'komentar' => $komentar,
            'status' => $this->request->getPost("status"),
            'pembuat_komentar' => $dataAkun['id'],
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Penilaian Seminar Proposal Berhasil", "text" => "Seminar Proposal berhasil dinilai!"]);
        return redirect()->to(base_url("dosen/pengujiSeminarProposal"));
    }




    

    public function bimbingan() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

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
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dosen = $this->dosenModel->find(session()->get("user_session")['id']);
        $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
        if ($lastSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $mahasiswa = $this->mahasiswaModel->find($npm);
        if ($mahasiswa == null) {
           throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        }
        $dataPembimbing = $this->pembimbingModel->getWhere(['id_skripsi' => $lastSkripsi['id'], 'id_dosen' => $dosen['id'], 'role' => $role])->getResultArray();
        if (count($dataPembimbing) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $catatanBimbingan = $this->catatanBimbinganModel->getWhere(['id_pembimbing' => $dataPembimbing[0]['id']])->getResultArray();
        $data = [
            'title' => 'Detail Bimbingan',
            'mahasiswa' => $mahasiswa,
            'skripsi' => $lastSkripsi,
            'catatanBimbingan' => $catatanBimbingan,
        ];
        return view("dosen/detail_bimbingan", $data);
    }

    public function setujuiBimbingan($idCatatan) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->catatanBimbinganModel->update($idCatatan, [
            'status' => 'DISETUJUI',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Catatan Bimbingan Diterima", "text" => "Catatan Bimbingan berhasil diterima!"]);
        return redirect()->back();
    }

    public function tolakBimbingan($idCatatan) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->catatanBimbinganModel->update($idCatatan, [
            'status' => 'DITOLAK',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Catatan Bimbingan Ditolak", "text" => "Catatan Bimbingan berhasil ditolak!"]);
        return redirect()->back();
    }






    public function pengujiSeminarPrasidang() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $dosen = $this->dosenModel->getDosenByProdi($dataAkun['id_prodi']);

        $seminarPrasidang = $this->seminarPrasidangModel->getSeminarPrasidangByDosen($dataAkun['id']);
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $seminarPrasidang = $this->seminarPrasidangModel->getSeminarPrasidangByDosenDateRange($dataAkun['id'], $dari, $hingga);
        } 

        $data = [
            'title' => 'Jadwal Seminar Prasidang',
            'dosen' => $dosen,
            'seminarPrasidang' => $seminarPrasidang
        ];

        return view("dosen/penguji_seminar_prasidang", $data);
    }

    public function reviewSeminarPrasidang($idSeminarPrasidang) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $detailSeminarPrasidang = $this->seminarPrasidangModel->getDetailSeminarPrasidangById($idSeminarPrasidang);
        //dd($detailSeminarPrasidang);
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

    public function komentariSeminarPrasidang($idSeminarPrasidang) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $komentar = $this->request->getPost("komentar", FILTER_SANITIZE_SPECIAL_CHARS);
        $status = $this->request->getPost("status");
        $rekomendasi_nilai = $this->request->getPost("rekomendasi_nilai");
        if ($status == 'TIDAK LAYAK SIDANG') {
            $npm = $this->request->getPost("npm");
            $lastSkripsi = $this->skripsiModel->getMahasiswaLastSkripsi($npm);
            $this->skripsiModel->update($lastSkripsi['id'], [
                'status' => 'TIDAK LULUS'
            ]);
        }
        $this->seminarPrasidangModel->update($idSeminarPrasidang, [
            'komentar_reviewer' => $komentar,
            'status' => $status,
            'rekomendasi_nilai' => $rekomendasi_nilai,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Hasil Review Seminar Prasidang Terkirim", "text" => "Hasil Review telah terkirim kepada mahasiswa"]);
        return redirect()->to(base_url("dosen/pengujiSeminarPrasidang"));
    }






    public function pengujiSidangSkripsi() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);

        $sidangSkripsi = $this->sidangSkripsiModel->getSidangSkripsiByDosen($dataAkun['id']);
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $sidangSkripsi = $this->sidangSkripsiModel->getSidangSkripsiByDosenDateRange($dataAkun['id'], $dari, $hingga);
        } 
        
        $data = [
            'title' => 'Jadwal Sidang Skripsi',
            'sidangSkripsi' => $sidangSkripsi,
            'dataAkun' => $dataAkun,
        ];

        return view("dosen/penguji_sidang_skripsi", $data);
    }

    public function penilaianSidangSkripsi($idSidangSkripsi) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $detailSidangSkripsi = $this->sidangSkripsiModel->getDetailSidangSkripsiById($idSidangSkripsi);
        if (count($detailSidangSkripsi) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $nilaiSidang = $this->penilaianSidangModel->getWhere([
            'id_sidang_skripsi' => $idSidangSkripsi,
            'id_dosen' => $dataAkun['id'], 
        ])->getResultArray();

        $data = [
            'title' => 'Penilaian Sidang Skripsi',
            'dataAkun' => $dataAkun,
            'detailSidangSkripsi' => $detailSidangSkripsi[0],
            'nilaiSidang' => $nilaiSidang,
        ];

        return view("dosen/penilaian_sidang_skripsi", $data);
    }

    public function insertNilaiSidangSkripsi() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $idSidangSkripsi = $this->request->getPost("idSidangSkripsi");
        $idDosen = $this->request->getPost("idDosen");
        $nilai_1 = $this->request->getPost("nilai_1");
        $nilai_2 = $this->request->getPost("nilai_2");
        $nilai_3 = $this->request->getPost("nilai_3");
        $nilai_4 = $this->request->getPost("nilai_4");
        $nilai_5 = $this->request->getPost("nilai_5");
        $nilai_6 = $this->request->getPost("nilai_6");
        $nilai_7 = $this->request->getPost("nilai_7");
        $nilai_8 = $this->request->getPost("nilai_8");
        $nilai_9 = $this->request->getPost("nilai_9");
        $nilai_10 = $this->request->getPost("nilai_10");
        $nilai_11 = $this->request->getPost("nilai_11");
        $nilai_12 = $this->request->getPost("nilai_12");
        $nilai_akhir = $this->request->getPost("nilai_akhir");
        $grade = $this->request->getPost("grade");
        $status = $this->request->getPost("status");

        $this->penilaianSidangModel->insert([
            'id_dosen' => $idDosen,
            'id_sidang_skripsi' => $idSidangSkripsi,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'nilai_6' => $nilai_6,
            'nilai_7' => $nilai_7,
            'nilai_8' => $nilai_8,
            'nilai_9' => $nilai_9,
            'nilai_10' => $nilai_10,
            'nilai_11' => $nilai_11,
            'nilai_12' => $nilai_12,
            'nilai_akhir' => $nilai_akhir,
            'grade' => $grade,
            'status' => $status,
        ]);

        $this->perbaruiStatusKelulusan($idSidangSkripsi);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Beri Penilaian Sidang Berhasil", "text" => "Penilaian Sidang Skripsi telah berhasil disimpan"]);
        return redirect()->back();
    }

    public function perbaruiStatusKelulusan($idSidangSkripsi) 
    {
        $sidangSkripsi = $this->sidangSkripsiModel->find($idSidangSkripsi);
        if ($sidangSkripsi == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $lastSkripsi = $this->skripsiModel->find($sidangSkripsi['id_skripsi']);
        
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
    }





    public function penelitian() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $dataAkun = $this->dosenModel->find(session()->get("user_session")['id']);
        $daftarPenelitian = $this->penelitianDosenModel->getAllPenelitianByIdDosen($dataAkun['id']);
        $bidang = $this->bidangModel->getBidangByProdi($dataAkun['id_prodi']);

        $data = [
            'title' => 'Kelola Penelitian',
            'daftarPenelitian' => $daftarPenelitian,
            'bidang' => $bidang,
            'dataAkun' => $dataAkun,
        ];

        return view("dosen/penelitian", $data);
    }

    public function insertPenelitian() {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $id_dosen = $this->request->getPost("id_dosen");
        $id_bidang = $this->request->getPost("bidang");
        $judul = $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS);
        $deskripsi = $this->request->getPost("deskripsi", FILTER_SANITIZE_SPECIAL_CHARS);
        $jumlah_peneliti = $this->request->getPost("jumlah_peneliti", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $this->penelitianDosenModel->insert([
            'id_dosen' => $id_dosen,
            'id_bidang' => $id_bidang,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'jumlah_peneliti' => $jumlah_peneliti,
            'status' => 'TERSEDIA',
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Tambah Penelitian Berhasil", "text" => "Penelitian berhasil ditambahkan!"]);
        return redirect()->to(base_url("dosen/penelitian"));
    }

    public function updatePenelitian($idPenelitian) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $id_bidang = $this->request->getPost("bidang");
        $judul = $this->request->getPost("judul", FILTER_SANITIZE_SPECIAL_CHARS);
        $deskripsi = $this->request->getPost("deskripsi", FILTER_SANITIZE_SPECIAL_CHARS);
        $jumlah_peneliti = $this->request->getPost("jumlah_peneliti", FILTER_SANITIZE_SPECIAL_CHARS);
        $status = $this->request->getPost("status");
        
        $this->penelitianDosenModel->update($idPenelitian, [
            'id_bidang' => $id_bidang,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'jumlah_peneliti' => $jumlah_peneliti,
            'status' => $status,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Penelitian Berhasil", "text" => "Penelitian berhasil diubah!"]);
        return redirect()->to(base_url("dosen/penelitian"));
    }

    public function deletePenelitian($idPenelitian) {
         //autentikasi
        if (!$this->authenticate(["dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $this->penelitianDosenModel->delete($idPenelitian);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Penelitian Berhasil", "text" => "Penelitian berhasil dihapus!"]);
        return redirect()->to(base_url("dosen/penelitian"));
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