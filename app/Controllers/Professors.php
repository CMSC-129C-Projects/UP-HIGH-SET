<?php
namespace App\Controllers;

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
        $css = ['custom/profs/profs-style.css'];
        $js = ['custom/profs/profs.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        return view('professors/professors', $data);
	}
}