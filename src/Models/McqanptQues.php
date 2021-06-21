<?php
namespace Edgewizz\Mcqanpt\Models;

use Illuminate\Database\Eloquent\Model;

class McqanptQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mcqanpt\Models\McqanptAns', 'question_id');
    }
    protected $table = 'fmt_mcqanpt_ques';
}