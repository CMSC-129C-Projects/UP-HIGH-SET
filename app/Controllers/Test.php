<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Test extends BaseController
{
    public function index() {
        $css = ['custom/monitor/monitor.css'];
        $js = ['custom/monitor/piechart.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            'js'  => addExternal($js, 'javascript')
        ];
        return view('monitor/monitor', $data);
    }
}