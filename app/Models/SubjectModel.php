<?php
namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model {
    protected $table      = 'subjects';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = 'App\Entities\Userlog';
    protected $returnType = 'array';

    protected $allowedFields = [
        'faculty_id',
        'grade_level',
        'name',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;

    public function get_subjects_taken($studentID, $glevel)
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT *, eval_sheet.id as eval_sheet_id
FROM subjects
LEFT JOIN eval_sheet
ON subjects.id = eval_sheet.subject_id AND eval_sheet.student_id = $studentID AND eval_sheet.is_deleted = 0
LEFT JOIN faculty
ON subjects.faculty_id = faculty.id
WHERE grade_level = $glevel
    AND subjects.is_deleted = 0
EOT;

        $query = $db->query($sql);
        return $query->getResult();
    }
}
