<?php
namespace App\Models;

use CodeIgniter\Model;

class EvalSheetModel extends Model {
  protected $table = 'eval_sheet';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'evaluation_id',
      'student_id',
      'subject_id',
      'rating',
      'status',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;


  public function getUnfinishedStudents($subjectID)
  {
    if(!isset($subjectID)) {
      return false;
    }

    $db = \Config\Database::connect();
    $sql =<<<EOT
SELECT unfinished.id, unfinished.status, CONCAT(
  CONCAT(UCASE(LEFT(u.first_name, 1)), 
        SUBSTRING(u.first_name, 2)), ' ', 
        CONCAT(UCASE(LEFT(u.last_name, 1)), 
              SUBSTRING(u.last_name, 2))) as full_name
FROM (SELECT eval_sheet.id, status, eval_sheet.student_id
			FROM eval_sheet
			WHERE subject_id = $subjectID AND (status = 'Open' OR status = 'Inprogress')) AS unfinished
LEFT JOIN users as u
ON unfinished.student_id = u.id
WHERE u.is_active = 1 AND u.is_deleted = 0
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
    
  public function get_all_students_who_evaluated($id)
  {
    $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT count(eval_sheet.student_id) as students_evaluated
FROM eval_sheet
LEFT JOIN subjects
ON eval_sheet.subject_id = subjects.id
LEFT JOIN evaluation
ON eval_sheet.evaluation_id = evaluation.id
WHERE
eval_sheet.status = "Completed" AND eval_sheet.is_deleted = 0 AND
evaluation.status = "Open" AND evaluation.is_deleted = 0 AND
eval_sheet.subject_id = $id
EOT;

    $query = $db->query($sql);
    $result = $query->getResult();

    return $result[0]->students_evaluated;
  }

  public function get_eval_sheet_dets($eval_sheet_id)
  {
    $db = \Config\Database::connect();
    
    $sql = <<<EOT
SELECT s.name as 'subject', CONCAT(f.first_name, ' ', f.last_name) as prof
FROM eval_sheet as es
LEFT JOIN subjects as s
ON es.subject_id = s.id
LEFT JOIN faculty as f
ON f.id = s.faculty_id
WHERE es.id = $eval_sheet_id
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
