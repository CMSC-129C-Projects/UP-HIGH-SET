<?php
namespace App\Controllers;

use \App\Models\FacultyModel;
use \App\Entities\Admin;

class Professors extends BaseController
{
    // protected $admin;
    // protected $userModel;

    // function __construct() {
    //     $this->userModel = new \App\Models\UserModel();
    //     $this->admin = new Admin();
    // }

	public function index() {
        $this->hasSession(0);

        $css = ['custom/profs/profs-style.css'];
        $js = ['custom/profs/profs.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        return view('professors/professors', $data);
	}

    public function profList() {
        $this->hasSession(1);

        $faculModel = new FacultyModel();

        $data['profList'] = $faculModel->where('is_deleted', 0)->findAll();

        echo json_encode($data['profList']);
    }

    protected function hasSession($type) {
        if ($type === 0) {
            // redirect to login if no session found
            // redirect to verifyAccount page if session not yet verified
            if (!$this->session->has('logged_user')) {
                return redirect()->to(base_url('login'));
            } elseif (!$_SESSION['logged_user']['emailVerified']) {
                return redirect()->to(base_url('verifyAccount'));
            }
        } else {
            // redirect to login if no session found
            if (!$this->session->has('logged_user')) {
                return redirect()->to(base_url());
            } elseif ($_SESSION['logged_user']['role'] != '1') {
                return redirect()->to(base_url());
            } elseif (!$_SESSION['logged_user']['emailVerified']) {
                return redirect()->to(base_url('verifyAccount'));
            }
        }
    }
}