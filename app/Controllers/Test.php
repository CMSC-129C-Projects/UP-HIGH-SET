<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Test extends BaseController
{
    public function index() {
        // $css = ['custom/eval.css'];
        // $js = ['custom/evalbtn.js'];
        // $data = [
        //     'css' => addExternal($css, 'css'),
        //     'js'  => addExternal($js, 'javascript')
        // ];
        return view('professors/viewsubjects');
    }
}