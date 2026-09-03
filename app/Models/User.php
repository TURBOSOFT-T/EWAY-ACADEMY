<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'avatar',
        'password',
        'phone',
        'avatar',
        'user_id',
        'two_factor_code',
        'two_factor_expires_at',
        'active',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        if (is_null($this->avatar)) {
            return "/icons/default-no-profile-pic.webp";
        } else {
            return Storage::url($this->avatar);
        }
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function commandes()
    {
        return $this->hasMany(commandes::class);
    }
  public function commercial()
    {
        return $this->hasMany(commandes::class, 'commercial_id');
    }
    public function seller()
    {
        return $this->hasMany(commandes::class, 'seller_id');
    }

    public function contenus()
    {
        return $this->hasMany(contenu_commande::class, 'commercial_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'commercial_id');
    }

    public function favoris()
    {
        return $this->hasMany(favoris::class, 'id_user');
    }


    public function getIsAdminAttribute()
    {
        $admins = User::where('role', 'admin')
            ->get();

        // return $this->role()->where('id', 1)->exists();
        return $this->$admins;
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function collection()
    {
        return User::all();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'user_id', 'id');
    }


    public function formations()
    {
        return $this->hasMany(Formation::class, 'user_id', 'id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class, 'user_id', 'id');
    }

    public function user_exams()
    {
        return $this->hasMany(User_exam::class, 'user_id', 'id');
    }

    public function oex_results()
    {
        return $this->hasMany(Oex_result::class, 'user_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // ou selon ton système (ex: 'is_admin' == true)
    }
    public function resetTwoFactor()
    {
        $this->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ]);
    }

    // Les avis reçus par l'enseignant
public function receivedEvaluations()
{
    return $this->hasMany(TeacherEvaluation::class, 'teacher_id');
}

// Les avis donnés par l'étudiant
public function givenEvaluations()
{
    return $this->hasMany(TeacherEvaluation::class, 'student_id');
}

public function profile()
    {
        return $this->hasOne(TeacherProfile::class, 'user_id');
    }
}
