<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Test extends BaseController
{
    public function index() {
        $css = ['custom/evaluation/evalSubjects.css'];
        $js = ['custom/evaluation/evalSubjects.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            'js'  => addExternal($js, 'javascript')
        ];
        return view('evaluation/evaluationSubjects', $data);
    }
}