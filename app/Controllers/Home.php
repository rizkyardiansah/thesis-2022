<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $makalahModel;
    protected $penelitianDosenModel;

    public function __construct() {
        $this->makalahModel = new \App\Models\MakalahModel();
        $this->penelitianDosenModel = new \App\Models\PenelitianDosenModel();
    }

    public function index()
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa", "tendik", "kaprodi", "fakultas", "dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        $makalah = $this->makalahModel->getAllMakalah();

        $data = [
            'title' => "Repository Skripsi",
            'makalah' => $makalah
        ];
        return view('home/repository_skripsi', $data);
    }

    public function kalender() {
        //autentikasi
        if (!$this->authenticate(["mahasiswa", "tendik", "kaprodi", "fakultas", "dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        
        $kalenderSkripsiModel = new \App\Models\KalenderSkripsiModel();
        $data = [
            'title' => "Kalender Skripsi",
            'kegiatanSkripsi' => $kalenderSkripsiModel->findAll()
        ];
        return view("home/kalender", $data);
    }
    
    public function penelitian() {
        
        //autentikasi
        if (!$this->authenticate(["mahasiswa", "tendik", "kaprodi", "fakultas", "dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $daftarPenelitian = $this->penelitianDosenModel->getAllPenelitian();
        $data = [
            'title' => "Penelitian Dosen",
            'daftarPenelitian' => $daftarPenelitian,
        ];
        return view("home/penelitian_dosen", $data);
    }

    public function downloadMakalah($idMakalah) {
        $makalah = $this->makalahModel->find($idMakalah);
        if ($makalah == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh File Makalah Gagal", "text" => "File Makalah tidak ditemukan"]);
            return redirect()->to(base_url("home/index"));
        }
        
        redirect()->to(base_url("home/index"));
        return $this->response->download("folderMakalah/".$makalah['file_makalah'], null);
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
