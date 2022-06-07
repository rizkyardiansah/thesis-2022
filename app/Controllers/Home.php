<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $makalahModel;
    protected $penelitianDosenModel;
    protected $sumberDayaModel;

    public function __construct() {
        $this->makalahModel = new \App\Models\MakalahModel();
        $this->penelitianDosenModel = new \App\Models\PenelitianDosenModel();
        $this->sumberDayaModel = new \App\Models\SumberDayaModel();
    }

    public function index()
    {
        //autentikasi
        if (!$this->authenticate(["mahasiswa", "tendik", "kaprodi", "fakultas", "dosen"])) 
        {
            return redirect()->to(base_url("unauthorized.php"));
        }
        $makalah = $this->makalahModel->getAllMakalah();
        $dari = $this->request->getGet("dari");
        $hingga = $this->request->getGet("hingga");

        if ($dari != null && $hingga != null) {
            $hingga = date_create($hingga);
            date_add($hingga, date_interval_create_from_date_string("1 days"));
            $hingga = date_format($hingga, 'Y-m-d');
            $makalah = $this->makalahModel->getMakalahByDateRange($dari, $hingga);
        } 

        $data = [
            'title' => "Repositori",
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

    public function resources() {
        
    }

    public function resource() {
        $roles = session()->get("user_session")['roles'];
        $resources = $this->sumberDayaModel->findAll();
        $data = [
            'title' => "Sumber Daya",
            'roles' => $roles,
            'resources' => $resources,
        ];

        return view("home/resource", $data);
    }

    public function insertResource() {
        $allResource = $this->sumberDayaModel->findAll();
        $nama = $this->request->getPost("nama", FILTER_SANITIZE_SPECIAL_CHARS);

        foreach($allResource as $resource) {
            if ($resource['nama'] == $nama) {

                session()->setFlashdata("message", ["icon" => "error", "title" => "Unggah Sumber Daya Gagal", "text" => "Nama Sumber Daya sudah pernah digunakan!"]);
                return redirect()->to(base_url("home/resource"));
            }
        }

        $nama_file = str_replace(" ", "_", $nama);

        $file_sumber_daya = $this->request->getFile("file_resource");
        $file_sumber_daya_baru = $nama_file ."." .$file_sumber_daya->getClientExtension();
        $file_sumber_daya->move("folderResource", $file_sumber_daya_baru);

        $this->sumberDayaModel->insert([
            'nama' => $nama,
            'nama_file' => $file_sumber_daya_baru,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Unggah Sumber Daya Berhasil", "text" => "Sumber Daya berhasil ditambahkan!"]);
        return redirect()->to(base_url("home/resource"));
    }

    public function updateResource($idResource) {
        $sumber_daya_lama = $this->sumberDayaModel->find($idResource);
        if ($sumber_daya_lama == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Perbarui Sumber Daya Gagal", "text" => "Sumber Daya tidak ditemukan!"]);
            return redirect()->to(base_url("home/resource"));
        }

        $nama = $this->request->getPost("nama", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $allResource = $this->sumberDayaModel->findAll();
        foreach($allResource as $resource) {
            if ($resource['id'] != $idResource && $resource['nama'] == $nama) {

                session()->setFlashdata("message", ["icon" => "error", "title" => "Unggah Sumber Daya Gagal", "text" => "Nama Sumber Daya sudah pernah digunakan!"]);
                return redirect()->to(base_url("home/resource"));
            }
        }

        $nama_file = str_replace(" ", "_", $nama);

        
        if ($this->request->getFile("file_resource")->getName() != "") {
            $file_sumber_daya = $this->request->getFile("file_resource");
            if ($sumber_daya_lama != null) {
                unlink("folderResource/".$sumber_daya_lama['nama_file']);
            }
            $file_sumber_daya_baru = $nama_file ."." .$file_sumber_daya->getClientExtension();
            $file_sumber_daya->move("folderResource", $file_sumber_daya_baru);
        } else {
            $file_sumber_daya = new \CodeIgniter\Files\File(FCPATH."folderResource/".$sumber_daya_lama['nama_file']);
            $ekstensi = explode(".", $sumber_daya_lama['nama_file'])[1];
            $file_sumber_daya_baru = $nama_file ."." .$ekstensi;
            $file_sumber_daya->move("folderResource", $file_sumber_daya_baru);
        }
        

        $this->sumberDayaModel->update($idResource, [
            'nama' => $nama,
            'nama_file' => $file_sumber_daya_baru,
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Perbarui Sumber Daya Berhasil", "text" => "Sumber Daya berhasil diperbarui!"]);
        return redirect()->to(base_url("home/resource"));
    }

    public function downloadResource($idResource)
    {
        $namaFileResource = $this->sumberDayaModel->find($idResource);
        if ($namaFileResource == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Unduh File Sumber Daya Gagal", "text" => "File Sumber Daya tidak ditemukan"]);
            return redirect()->back();
        }
        
        redirect()->back();
        return $this->response->download("folderResource/".$namaFileResource['nama_file'], null);
    }

    public function deleteResource($idResource) {
        $namaFileResource = $this->sumberDayaModel->find($idResource);
        if ($namaFileResource == null) {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Hapus Sumber Daya Gagal", "text" => "Sumber Daya tidak ditemukan"]);
            return redirect()->to(base_url("home/resource"));
        }
        unlink("folderResource/".$namaFileResource['nama_file']);
        $this->sumberDayaModel->delete($idResource);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Hapus Sumber Daya Berhasil", "text" => "Sumber Daya berhasil dihapus"]);
        return redirect()->to(base_url("home/resource"));
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
