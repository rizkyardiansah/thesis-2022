<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa", "tendik", "kaprodi", "fakultas", "dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $data = [
            'title' => "Repository Skripsi",
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

        $data = [
            'title' => "Penelitian Dosen",
        ];
        return view("home/penelitian_dosen", $data);
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
