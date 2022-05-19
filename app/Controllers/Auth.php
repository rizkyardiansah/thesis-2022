<?php

namespace App\Controllers;

class Auth extends BaseController 
{
    protected $mahasiswaModel;
    protected $akunModel;
    protected $aksesModel;
    protected $roleModel;
    protected $fakultasModel;
    protected $tendikModel;
    protected $dosenModel;

    public function __construct()
    {
        $this->mahasiswaModel = new \App\Models\MahasiswaModel();
        $this->akunModel = new \App\Models\AkunModel();
        $this->aksesModel = new \App\Models\AksesModel();
        $this->roleModel = new \App\Models\RoleModel();
        $this->fakultasModel = new \App\Models\FakultasModel();
        $this->prodiModel = new \App\Models\ProgramStudiModel();
        $this->tendikModel = new \App\Models\TenagaKependidikanModel();
        $this->dosenModel = new \App\Models\DosenModel();
    }

    public function index()
    {
        return redirect()->to(base_url("/auth/login"));
    }

    public function register() 
    {  
        $data = [
            "fakultas" => $this->fakultasModel->findAll(),
            "prodi" => $this->prodiModel->findAll(),
        ];
        return view("auth/register", $data);
    }

    public function createAccount() 
    {
        $npm = $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $this->request->getPost("emailMhs", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $isNpmUsed = $this->mahasiswaModel->find($npm);
        if ($isNpmUsed) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "NPM sudah terdaftar dalam sistem"]);
            return redirect()->to(base_url("auth/register"));
        }
        
        $isEmailUsed = $this->mahasiswaModel->where("email", $email)->first();
        if ($isEmailUsed) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "Email sudah terdaftar dalam sistem"]);
            return redirect()->to(base_url("auth/register"));
        }

        $roleMahasiswa  = $this->roleModel->where("nama", "mahasiswa")->first();
        if ($roleMahasiswa == null) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "Database Error"]);
            return redirect()->to(base_url("auth/register"));
        }

        $this->mahasiswaModel->save([
            "npm" => $npm,
            'nama' => $this->request->getPost("namaLengkap", FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => $email,
            'angkatan' => $this->request->getPost("angkatan", FILTER_SANITIZE_SPECIAL_CHARS),
            'id_prodi' => $this->request->getPost("prodi", FILTER_SANITIZE_SPECIAL_CHARS)
        ]);
        
        $this->akunModel->save([
            'email' => $email,
            'password' => password_hash($this->request->getPost("katasandi"), PASSWORD_DEFAULT),
        ]);
        
        $idRoleMahasiswa = $roleMahasiswa['id'];
        $idAkun = $this->akunModel->where("email", $email)->first()['id'];

        $this->aksesModel->save([
            'id_akun' => $idAkun,
            'id_role' => $idRoleMahasiswa
        ]);

        session()->setFlashdata("message", ["icon" => "success", "title" => "Register Berhasil", "text" => "Akun Berhasil dibuat"]);
        return redirect()->to(base_url("auth/register"));
    }

    public function login() 
    {
        return view("auth/login");
    }

    public function signInAccount() 
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        $akunData = $this->akunModel->where("email", $email)->first();
        if ($akunData == null) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Email tidak terdaftar"]);
            return redirect()->to(base_url("auth/login"));
        }

        if (password_verify($password, $akunData['password']) == false) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Password tidak sesuai"]);
            return redirect()->to(base_url("auth/login"));
        }

        $rolesResult = $this->aksesModel->getRoles($akunData['id']);
        $akunRoles = array();
        for ($i = 0; $i < count($rolesResult); $i++) 
        {
            array_push($akunRoles, $rolesResult[$i]['nama']);
        }

        //apakah akunnya merupakan mahasiswa
        if (in_array("mahasiswa", $akunRoles)) 
        {
            $akunMahasiswa = $this->mahasiswaModel->where("email", $akunData['email'])->first();
            session()->set("user_session",[
                "id" => $akunMahasiswa['npm'],
                "nama" => $akunMahasiswa['nama'],
                "email" => $akunMahasiswa['email'],
                "roles" => $akunRoles,
            ]);
        } 
        elseif (in_array("tendik", $akunRoles)) 
        {
            $akunTendik = $this->tendikModel->where("email", $akunData['email'])->first();
            session()->set("user_session", [
                'id' => $akunTendik['id'],
                'nama' => $akunTendik['nama'],
                'email' => $akunTendik['email'],
                'roles' => $akunRoles,
            ]);
        } 
        elseif (in_array("dosen", $akunRoles) || in_array("fakultas", $akunRoles) || in_array("kaprodi", $akunRoles))
        {
            $akunDosen = $this->dosenModel->where("email", $akunData['email'])->first();
            session()->set("user_session", [
                'id' => $akunDosen['id'],
                'nama' => $akunDosen['nama'],
                'email' => $akunDosen['email'],
                'roles' => $akunRoles,
            ]);
        }

        session()->setFlashdata("message", ["icon" => "success", "title" => "Login Berhasil", "text" => "Sesi berhasil dibuat!"]);
        return redirect()->to(base_url("home"));
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url("auth/login"));
    }
}