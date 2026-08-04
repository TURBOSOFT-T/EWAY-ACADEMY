<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oex_result extends Model
{
    use HasFactory;

     protected $table="oex_results";
    protected $primaryKey="id";

    protected $fillable=['exam','question_id','yes_ans','no_ans','result_json','total_points'];


    public function user()
{
    return $this->belongsTo(User::class , 'user_id', 'id');


}

public function oex_result()
{
    return $this->belongsTo(Examen::class , 'exam_id', 'id');
}
}
