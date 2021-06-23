<?php
namespace App\Controllers;

use \App\Entities\Admin;


class Test extends BaseController
{
    public function index() {
        $css = ['custom/reporting/profreport.css'];
        // $js = ['custom/monitor/piechart.js', 'custom/monitor/monitor.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            // 'js'  => addExternal($js, 'javascript')
        ];
        return view('reporting/profreport', $data);
    }
}