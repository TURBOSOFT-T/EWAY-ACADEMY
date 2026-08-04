<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

 protected $table="examens";

    protected $primaryKey="id";

    protected $fillable=['title','category','exam_date','status','exam_duration','formation_id','user_id','question_limit','total_points'];

    public function formation()
{
    return $this->belongsTo(Formation::class, 'formation_id','id');
}


public function user()
{
    return $this->belongsTo(User::class , 'user_id', 'id');
}

public function questions()
{
    return $this->hasMany(Oex_question_master::class , 'exam_id' , 'id');
}

public function user_exams()
{
    return $this->hasMany(User_exam::class , 'exam_id' , 'id');
}

public function oex_results()
{
    return $this->hasMany(Oex_result::class , 'exam_id' , 'id');
}

}
