<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Online_classe extends Model
{
    use HasFactory;


    //protected $guarded=[];
    public $fillable = ['formation_id', 'certification_id','event_id', 'user_id', 'meeting_id', 'topic', 'start_at', 'duration', 'password', 'start_url', 'join_url'];

    public function getStatusAttribute()
    {
        $timezone = config('app.timezone');

        $start = Carbon::parse($this->start_at)->setTimezone($timezone);
        $end = $start->copy()->addHours((int) $this->duration);
        $now = Carbon::now()->setTimezone($timezone);

        if ($now->lt($start)) {
            return 'pending'; // pas commencé
        } elseif ($now->gte($start) && $now->lt($end)) {
            return 'ongoing'; // en cours
        } else {
            return 'finished'; // terminé
        }
    }

    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function formations()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

      public function certifications()
    {
        return $this->belongsTo(Certification::class, 'certification_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
