<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Profile extends BaseController
{
    public function index() {

        $css = ['custom/profileUpdate/pUpdate.css'];
        $js = ['custom/profileUpdate/pUpdate.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        $data['role'] = null;
        return view("account_updates/profileUpdate", $data);
    }
}
