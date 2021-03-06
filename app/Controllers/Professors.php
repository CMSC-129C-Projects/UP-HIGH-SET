<?php
namespace App\Controllers;

use \App\Models\FacultyModel;
use \App\Models\SubjectModel;
use \App\Entities\Admin;

class Professors extends BaseController
{

    public function _remap($method, $param1 = null)
    {
        $this->hasSession();
        $this->role_checking(['2']);

        switch($method)
        {
            case 'index':
                return $this->$method();
                break;
            case 'add_professors':
                return $this->$method();
                    break;
            case 'delete_professor':
            case 'edit_professor':
                return $this->$method($param1);
            case 'profList':
                return $this->$method($param1);
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

	public function index()
    {
        $css = ['custom/profs/profs-style.css', 'custom/alert.css'];
        $js = ['custom/profs/profs.js', 'custom/alert.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];


        $data['status'] = null;

        $faculModel = new FacultyModel();
        $profs = $faculModel->where('is_deleted', 0)->findAll();
        if (count($profs) === 0) {
            $data['status'] = 'true';
        }

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
        $css = ['custom/alert.css'];
        $js = ['custom/alert.js'];

        $data['js'] = addExternal($js, 'javascript');
        $data['css'] = addExternal($css, 'css');
        
        $data['status'] = null;

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

                $values = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'details' => $this->request->getVar('details')
                ];

                if (!$facultyModel->insert($values)) {
                    $data['status'] = 'false';
                } else {
                    $data['status'] = 'true';
                }

            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('professors/add_faculty', $data);
    }

    /**
     * Edit professors
     */
    public function edit_professor($faculty_id)
    {
        $faculModel = new FacultyModel();

        $data['validation'] = null;
        $data['status'] = null;
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

                $values = [
                    'first_name' => $this->request->getVar('first_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'details' => $this->request->getVar('details')
                ];

                if (!$facultyModel->update($faculty_id, $values)) {
                    $data['status'] = 'false';
                } else {
                    $data['status'] = 'true';                    
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        
        $data['professor'] = $faculModel->where('is_deleted', 0)->find($faculty_id);
        return view('professors/edit_faculty', $data);
    }

    /*
    * Delete Faculty
    */
    public function delete_professor($faculty_id = null)
    {
        if(isset($faculty_id)) {
            $db = \Config\Database::connect();
            $db->transBegin();
            
            $facultyModel = new FacultyModel();
            $subjectModel = new SubjectModel();

            $value = ['is_deleted' => 1];

            $facultyModel->update($faculty_id, $value);
            $subjectModel->where('faculty_id', $faculty_id)->set(['is_deleted' => 1])->update();

            if ($db->transStatus() === FALSE) {
                $db->transRollback();
                return false;
            } else {
                $db->transCommit();
                return redirect()->to(base_url('professors'));
            }
        }
    }
}
