<?php
namespace App\Controllers;

use \App\Models\FacultyModel;
use \App\Entities\Admin;

class Professors extends BaseController
{
    public function _remap($method, $param1 = null)
    {
        switch($method)
        {
            case 'index':
                if ($_SESSION['logged_user']['role'] === '2') {
                    return redirect()->to(base_url('dashboard'));    
                }
                $this->hasSession(0);
                return $this->$method();
                break;
            case 'get_all_professors':
                if ($_SESSION['logged_user']['role'] === '2') {
                    return redirect()->to(base_url('dashboard'));    
                }
                $this->hasSession(1);
                return $this->$method();
                break;
            case 'profList':
                $this->hasSession(1);
                return $this->$method($param1);
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

	public function index() {
        $css = ['custom/profs/profs-style.css'];
        $js = ['custom/profs/profs.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        return view('professors/professors', $data);
	}

    public function profList($search = null) {
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

    /**
     * Get all professors
     * in the database
     */
    public function get_all_professors()
    {
        $facultyModel = new FacultyModel();
        if (!$professors = $facultyModel->where('is_deleted', 0)->findAll()) {
            $response = [
                'is_available' => 0,
                'message' => 'No subjects found.'
            ];
        } else {
            $response = [
                'is_available' => 1,
                'professors' => $professors
            ];
        }
        echo json_encode($response);
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