<?php
namespace App\Controllers;

use \App\Models\SubjectModel;

class Subjects extends BaseController
{
    // protected $admin;
    // protected $userModel;

    // function __construct() {
    //     $this->userModel = new \App\Models\UserModel();
    //     $this->admin = new Admin();
    // }

	public function index($role) {
        
        $subjectModel = new SubjectModel();

        $subjectsHandled = $subjectModel->where('faculty_id', $role)->findAll();
        // $css = ['custom/profs/profs-style.css'];
        // $js = ['custom/profs/profs.js'];
        // $data = [
        //     'js'    => addExternal($js, 'javascript'),
        //     'css'   => addExternal($css, 'css')
        // ];
        $data = [
            'subjects' => $subjectsHandled
        ];

        return view('subjects/subjects', $data);
	}
}