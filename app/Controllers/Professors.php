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
          case 'add_professors':
              // if ($_SESSION['logged_user']['role'] === '2') {
              //     return redirect()->to(base_url('dashboard'));
              // }
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

	public function index()
  {
        $css = ['custom/profs/profs-style.css'];
        $js = ['custom/profs/profs.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        return view('professors/professors', $data);
	}

  public function profList($search = null)
  {
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

  /*
  * Add Professors / Faculty
  */
  public function add_professors()
  {

    $data['validation'] = null;
    $css = ['custom/login/login.css']; // change with the correct css please
		$data['css'] = addExternal($css, 'css');

    if($this->request->getMethod() == 'post')
    {
      $rules = [ // the fields listed in here should be the name and class of the frontend when integrated
        'first_name' => 'required|alpha_space',
        'last_name' => 'required|alpha',
        'details' => 'required|alpha_numeric_punct|max_length[300]'  // faculty or professor details that should only be at most 300 words
      ];

      $errors = [
          'details' => [
            'alpha_numeric_punct' => "Faculty details should only contain alpha numeric characters with limited punctuations",
            'max_length[300]' => "Details exceeded the maximum character count of 300"
          ],
          'first_name' => [
            'alpha_space' => "First name should only be consist of alphabetical characters and a space"
          ],
      ];

      if($this->validate($rules, $errors))
      {
        $facultyModel = new FacultyModel();

        // $result = $facultyModel->add_faculty($data_entry);
        $facultyModel->insert([
          'first_name' => $this->request->getVar('first_name'),
          'last_name' => $this->request->getVar('last_name'),
          'details' => $this->request->getVar('details')
        ]);
      } else {

        $data['validation'] = $this->validator;
        return view('professors/add_faculty', $data);
      }
    }
    return view('professors/add_faculty', $data);
  }

  /*
  * Delete Faculty
  */
  public function delete_professor($faculty_id) {

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

  protected function hasSession($type)
  {
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
