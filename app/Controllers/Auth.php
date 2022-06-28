<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\AuthLdap;

class Auth extends BaseController 
{
    protected $mahasiswaModel;
    protected $akunModel;
    protected $aksesModel;
    protected $roleModel;
    protected $fakultasModel;
    protected $prodiModel;
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

    // public function register() 
    // {  
    //     $data = [
    //         "fakultas" => $this->fakultasModel->findAll(),
    //         "prodi" => $this->prodiModel->findAll(),
    //     ];
    //     return view("auth/register", $data);
    // }

    // public function createAccount() 
    // {
    //     $npm = $this->request->getPost("npm", FILTER_SANITIZE_SPECIAL_CHARS);
    //     $email = $this->request->getPost("emailMhs", FILTER_SANITIZE_SPECIAL_CHARS);
        
    //     $isNpmUsed = $this->mahasiswaModel->find($npm);
    //     if ($isNpmUsed) 
    //     {
    //         session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "NPM sudah terdaftar dalam sistem"]);
    //         return redirect()->to(base_url("auth/register"));
    //     }
        
    //     $isEmailUsed = $this->mahasiswaModel->where("email", $email)->first();
    //     if ($isEmailUsed) 
    //     {
    //         session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "Email sudah terdaftar dalam sistem"]);
    //         return redirect()->to(base_url("auth/register"));
    //     }

    //     $roleMahasiswa  = $this->roleModel->where("nama", "mahasiswa")->first();
    //     if ($roleMahasiswa == null) 
    //     {
    //         session()->setFlashdata("message", ["icon" => "error", "title" => "Register Gagal", "text" => "Database Error"]);
    //         return redirect()->to(base_url("auth/register"));
    //     }

    //     $this->mahasiswaModel->save([
    //         "npm" => $npm,
    //         'nama' => $this->request->getPost("namaLengkap", FILTER_SANITIZE_SPECIAL_CHARS),
    //         'email' => $email,
    //         'angkatan' => $this->request->getPost("angkatan", FILTER_SANITIZE_SPECIAL_CHARS),
    //         'id_prodi' => $this->request->getPost("prodi", FILTER_SANITIZE_SPECIAL_CHARS)
    //     ]);
        
    //     $this->akunModel->save([
    //         'email' => $email,
    //         'password' => password_hash($this->request->getPost("katasandi"), PASSWORD_DEFAULT),
    //     ]);
        
    //     $idRoleMahasiswa = $roleMahasiswa['id'];
    //     $idAkun = $this->akunModel->where("email", $email)->first()['id'];

    //     $this->aksesModel->save([
    //         'id_akun' => $idAkun,
    //         'id_role' => $idRoleMahasiswa
    //     ]);

    //     session()->setFlashdata("message", ["icon" => "success", "title" => "Register Berhasil", "text" => "Akun Berhasil dibuat"]);
    //     return redirect()->to(base_url("auth/register"));
    // }

    public function login() 
    {
        if (session()->get("user_session") == null) {
            return view("auth/login");
        } else {
            return redirect()->to(base_url("home"));
        }
    }

    public function signInAccount() 
    {   
        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $akunData = $this->akunModel->where("username", $username)->first();

        if ($akunData == null) 
        {
            $this->authLdap = new AuthLdap();
            if (is_object($this->authLdap) && method_exists($this->authLdap, 'authenticate'))
            {
                $authenticatedUserData = $this->authLdap->authenticate($username,$password);
                if (is_array($authenticatedUserData) && !empty($authenticatedUserData['dn']))
                {
                    session()->set("pendaftaran",[
                        "id_nik" => $authenticatedUserData['id_nik'],
                        "displayname" => $authenticatedUserData['displayname'],
                        "username" => $authenticatedUserData['username'],
                        "password" => $password,
                        "role" => $authenticatedUserData['role'],
                        "street" => $authenticatedUserData['street'],
                        "phone" => $authenticatedUserData['telephonenumber']
                    ]);
                    return redirect()->to(base_url("auth/pendaftaran"));
                }
                else 
                {
                    session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Akun tidak terdaftar"]);
                    return redirect()->to(base_url("auth/login"));
                }
            }
            else 
            {
                session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Server sedang bermasalah"]);
                return redirect()->to(base_url("auth/login"));
            }
        } 
        else 
        {
            if (password_verify($password, $akunData['password'])) 
            {
                $rolesResult = $this->aksesModel->getRoles($akunData['id']);
                $akunRoles = array();
                for ($i = 0; $i < count($rolesResult); $i++) 
                {
                    array_push($akunRoles, $rolesResult[$i]['nama']);
                }

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
                elseif (in_array("dosen", $akunRoles))
                {
                    $akunDosen = $this->dosenModel->where("email", $akunData['email'])->first();
                    session()->set("user_session", [
                        'id' => $akunDosen['id'],
                        'nama' => $akunDosen['nama'],
                        'email' => $akunDosen['email'],
                        'roles' => $akunRoles,
                    ]);
                }
                elseif (in_array("fakultas", $akunRoles))
                {
                    $akunFakultas = $this->fakultasModel->where("email", $akunData['email'])->first();
                    session()->set("user_session", [
                        'id' => $akunFakultas['id'],
                        'nama' => $akunFakultas['nama'],
                        'email' => $akunFakultas['email'],
                        'roles' => $akunRoles,
                    ]);
                }
                elseif (in_array("kaprodi", $akunRoles))
                {
                    $akunKaprodi = $this->prodiModel->where("email", $akunData['email'])->first();
                    session()->set("user_session", [
                        'id' => $akunKaprodi['id'],
                        'nama' => $akunKaprodi['nama'],
                        'email' => $akunKaprodi['email'],
                        'roles' => $akunRoles,
                    ]);
                }

                session()->setFlashdata("message", ["icon" => "success", "title" => "Login Berhasil", "text" => "Sesi berhasil dibuat!"]);
                return redirect()->to(base_url("home"));  
            } 
            else 
            {
                session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Password tidak sesuai"]);
                return redirect()->to(base_url("auth/login"));
            }
        }
    }

    public function pendaftaran() {
        if (session()->get("pendaftaran") == null) {
           return redirect()->to(base_url("auth/login"));
        }
        
        $dataPendaftaran = session()->get("pendaftaran");
        $userData = [
            'id_nik' => $dataPendaftaran['id_nik'],
            'displayname' => $dataPendaftaran['displayname'],
            'username' => $dataPendaftaran['username'],
            'password' => $dataPendaftaran['password'],
        ];

        switch($dataPendaftaran['role']) {
            case "Mahasiswa":
                $data = [
                    "userData" => $userData,
                    "prodi" => $this->prodiModel->findAll(),
                ];
                return view("auth/pendaftaranMahasiswa", $data);
                break;
            case "Dosen":
                $data = [
                    "userData" => $userData,
                    "prodi" => $this->prodiModel->findAll(),
                ];
                return view("auth/pendaftaranDosen", $data);
                break;
            case "Staff":
                $data = [
                    "userData" => $userData,
                ];
                return view("auth/pendaftaranTendik", $data);
                break;
        }
    }

    public function pendaftaranMahasiswa() 
    {
        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $email = $this->request->getPost("email", FILTER_SANITIZE_SPECIAL_CHARS);
        $isEmailUsed = $this->akunModel->where("email", $email)->first();
        if ($isEmailUsed) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Email sudah terdaftar dalam sistem"]);
            return redirect()->back();
        }

        $roleMahasiswa  = $this->roleModel->where("nama", "mahasiswa")->first();
        if ($roleMahasiswa == null) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Database Error"]);
            return redirect()->back();
        }

        $nama = $this->request->getPost("nama");
        $npm = $this->request->getPost("npm");
        $username = $this->request->getPost("username");
        $prodi = $this->request->getPost("prodi");
        $angkatan = $this->request->getPost("angkatan", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $this->request->getPost("password");

        $this->mahasiswaModel->insert([
            "npm" => $npm,
            'nama' => $nama,
            'email' => $email,
            'angkatan' => $angkatan,
            'id_prodi' => $prodi,
        ]);
        $dataMahasiswa = $this->mahasiswaModel->find($npm);

        $this->akunModel->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $idRoleMahasiswa = $roleMahasiswa['id'];
        $idAkun = $this->akunModel->where("email", $email)->first()['id'];

        $this->aksesModel->save([
            'id_akun' => $idAkun,
            'id_role' => $idRoleMahasiswa
        ]);
        session()->set("pendaftaran", null);
        session()->set("user_session", [
            'id' => $dataMahasiswa['npm'],
            'nama' => $dataMahasiswa['nama'],
            'email' => $dataMahasiswa['email'],
            'roles' => ['mahasiswa'],
        ]);
        
        return redirect()->to(base_url("home"));
    }

    public function pendaftaranDosen() 
    {
        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $email = $this->request->getPost("email", FILTER_SANITIZE_SPECIAL_CHARS);
        $isEmailUsed = $this->akunModel->where("email", $email)->first();
        if ($isEmailUsed) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Email sudah terdaftar dalam sistem"]);
            return redirect()->back();
        }

        $inisial = $this->request->getPost("inisial", FILTER_SANITIZE_SPECIAL_CHARS);
        $isInisialUsed = $this->dosenModel->where("inisial", $inisial)->first();
        if ($isInisialUsed) {
           session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Inisial sudah terdaftar dalam sistem"]);
            return redirect()->back(); 
        }

        $RoleDosen  = $this->roleModel->where("nama", "dosen")->first();
        if ($RoleDosen == null) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Database Error"]);
            return redirect()->back();
        }

        $nama = $this->request->getPost("nama");
        $username = $this->request->getPost("username");
        $prodi = $this->request->getPost("prodi");
        $password = $this->request->getPost("password");

        $this->dosenModel->insert([
            "nama" => $nama,
            'email' => $email,
            'inisial' => $inisial,
            'id_prodi' => $prodi,
        ]);
        $dataDosen = $this->dosenModel->where("inisial", $inisial)->first();

        $this->akunModel->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $idRoleDosen = $RoleDosen['id'];
        $idAkun = $this->akunModel->where("email", $email)->first()['id'];

        $this->aksesModel->save([
            'id_akun' => $idAkun,
            'id_role' => $idRoleDosen
        ]);
        session()->set("pendaftaran", null);
        session()->set("user_session", [
            'id' => $dataDosen['id'],
            'nama' => $dataDosen['nama'],
            'email' => $dataDosen['email'],
            'roles' => ['dosen'],
        ]);
        
        return redirect()->to(base_url("home"));
    }

    public function pendaftaranTendik() 
    {
        //buat mencegah access langsung dari link
        if ($this->request->getMethod() != 'post') {
            return redirect()->back();
        }

        $email = $this->request->getPost("email", FILTER_SANITIZE_SPECIAL_CHARS);
        $isEmailUsed = $this->akunModel->where("email", $email)->first();
        if ($isEmailUsed) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Email sudah terdaftar dalam sistem"]);
            return redirect()->back();
        }

        $RoleTendik  = $this->roleModel->where("nama", "tendik")->first();
        if ($RoleTendik == null) 
        {
            session()->setFlashdata("message", ["icon" => "error", "title" => "Login Gagal", "text" => "Database Error"]);
            return redirect()->back();
        }

        $nama = $this->request->getPost("nama");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $this->tendikModel->insert([
            "nama" => $nama,
            'email' => $email,
        ]);
        $dataTendik = $this->tendikModel->where("email", $email)->first();

        $this->akunModel->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $idRoleTendik = $RoleTendik['id'];
        $idAkun = $this->akunModel->where("email", $email)->first()['id'];

        $this->aksesModel->save([
            'id_akun' => $idAkun,
            'id_role' => $idRoleTendik
        ]);
        session()->set("pendaftaran", null);
        session()->set("user_session", [
            'id' => $dataTendik['id'],
            'nama' => $dataTendik['nama'],
            'email' => $dataTendik['email'],
            'roles' => ['tendik'],
        ]);
        
        return redirect()->to(base_url("home"));
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url("auth/login"));
    }
}