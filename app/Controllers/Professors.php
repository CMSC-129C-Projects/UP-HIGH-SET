<?php
namespace App\Controllers;

use \App\Models\FacultyModel;
use \App\Entities\Admin;

class Professors extends BaseController
{
    public function _remap($method, $param1 = null)
    {
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url('login'));
        } elseif (!$_SESSION['logged_user']['emailVerified']) {
            return redirect()->to(base_url('verifyAccount'));
        }

        switch($method)
        {
            case 'index':
                return $this->$method();
                break;
            case 'profList':
                return $this->$method($param1);
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

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

    public function profList($search = null) {
        $this->hasSession(1);

        $faculModel = new FacultyModel();
        if (!isset($search)) {
            $data['profList'] = $faculModel->where('is_deleted', 0)->findAll();
        } else {
            if (strpos($search, ' ') !== false) {
                $fullName = explode(' ', $search);
                $data['profList'] = $faculModel->searchFaculty($fullName[0], $fullName[1]);
            } else {
                $data['profList'] = $faculModel->searchFaculty($search, $search);
            }
        }

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