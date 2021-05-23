<?php
namespace App\Models;

use CodeIgniter\Model;

class QuestionchoiceModel extends Model {
    protected $table = 'question_choice';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'q_type_id',
        'choice_order',
        'weight',
        'choice'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;
}
