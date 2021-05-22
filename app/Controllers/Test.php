<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Test extends BaseController
{
    public function index() {
        $js = ['custom/evalbtn.js'];
        $data = [
            'js'    => addExternal($js, 'javascript')
        ];
        return view('searchviewprof', $data);
    }
}