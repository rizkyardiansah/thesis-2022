<?php

namespace App\Controllers;

class Fakultas extends BaseController 
{
    protected $kalenderSkripsiModel;

    public function __construct() 
    {
        $this->kalenderSkripsiModel = new \App\Models\KalenderSkripsiModel();
    }

    public function index()
    {
        
    }

    public function kalender()
    {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $kegiatanSkripsi = $this->kalenderSkripsiModel->findAll();
        $data = [
            "title" => "Kelola Kalender Skripsi",
            "kegiatanSkripsi" => $kegiatanSkripsi,
        ];
        return view("fakultas/kalender", $data);
    }

    public function insertKalender() {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $tanggalMulai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[0]);
        $tanggalSelesai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[1]);
        $this->kalenderSkripsiModel->save([
            'nama_kegiatan' => $this->request->getPost("namaKegiatan", FILTER_SANITIZE_SPECIAL_CHARS),
            "tanggal_mulai" => date_format($tanggalMulai, 'Y-m-d'),
            "tanggal_selesai" => date_format($tanggalSelesai, 'Y-m-d')
       ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Tambah Kegiatan Berhasil", "text" => "Kegiatan Berhasil ditambahkan"]);
        return redirect()->to(base_url("fakultas/kalender"));
    }

    public function updateKalender($id) {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $tanggalMulai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[0]);
        $tanggalSelesai = date_create(explode(" - ", $this->request->getPost("durasiKegiatan"))[1]);
        $this->kalenderSkripsiModel->update($id,[
            'nama_kegiatan' => $this->request->getPost("namaKegiatan", FILTER_SANITIZE_SPECIAL_CHARS),
            "tanggal_mulai" => date_format($tanggalMulai, 'Y-m-d'),
            "tanggal_selesai" => date_format($tanggalSelesai, 'Y-m-d')
        ]);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Ubah Kegiatan Berhasil", "text" => "Kegiatan Berhasil diubah"]);
        return redirect()->to(base_url("fakultas/kalender"));
    }

    public function deleteKalender($id) {
        //autentikasi
        if (!$this->authenticate(["fakultas"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }

        $this->kalenderSkripsiModel->delete($id);
        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Kegiatan Berhasil", "text" => "Kegiatan Berhasil dihapus"]);
        return redirect()->to(base_url("fakultas/kalender"));
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