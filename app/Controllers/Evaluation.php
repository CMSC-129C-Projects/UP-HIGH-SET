<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\SecSheetModel;

class Evaluation extends BaseController
{
  public function index() {
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
      return redirect()->to(base_url('verifyAccount'));
    }

    return redirect()->to(base_url('category'));
  }

  public function choose_category($evalSheetId = null) {

    $css = ['custom/modalAddition.css', 'custom/alert.css'];
    $js = ['custom/alert.js'];

    $data = [];
    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');
    $data['validation'] = null;

    $rules = [
      'category' => 'required',
      'eval_sheet' => 'required' //not sure asa pa ko ni kwaon haha
    ];

    $eval_section = $this->request->getVar('category');
    $eval_sheet = $this->request->getVar('eval_sheet');

    if($this->request->getMethod == 'post') {

      if($this->validate($rules))
      {
        $secModel = new SectionModel();
        $secSheetModel = new SecSheetModel();

        $section = $secModel->where('name', $eval_section)->first();


        $q_data = [
          'eval_section_id' = $section['id'],
          'eval_sheet_id' = $eval_sheet
        ];

        $secSheetModel->insert($q_data);
      } else {
        $data = [
          'validation' => $this->validator
        ];
      }
    }

    return view('evaluation/category', $data);
  }
}
