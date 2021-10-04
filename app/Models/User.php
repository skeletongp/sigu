<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UserTrait, SearchableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'fullname',
        'slug',
        'career_id',
        'lastname',
        'birthday',
        'photo',
        'email',
        'password',

    ];
    protected $searchable = [
        'columns' => [
            'users.id' => 10,
            'users.name' => 10,
            'users.lastname' => 10,
            'users.fullname' => 10,
            'users.birthday' => 2,
            'users.email' => 5,
            'careers.name' => 10,
            'careers.code' => 5,
        ],
        'joins' => [
            'careers' => ['users.career_id', 'careers.id'],
        ]
    ];
    protected $roleable = ['admin', 'support', 'teacher', 'student'];
    protected $orderable=['name','lastname', 'id', 'birthday'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function career()
    {
        return $this->belongsTo(Career::class)->withTrashed();
    }
    public function role()
    {
        $roles = [
            'admin' => 'Administrador',
            'support' => 'Soporte',
            'teacher' => 'Docente',
            'student' => 'Estudiante'
        ];
        return $roles[$this->getRoleNames()[0]];
    }
    public function rol()
    {
        return $this->getRoleNames()[0];
    }
    public function age()
    {
        return date_diff(now(), date_create($this->birthday))->y;
    }
    public function total($rol="")
    {
        if ($rol=="") {
            return User::get()->count();
        }
        return Role::findByName($rol)->users->count();
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_user','user_id','subject_id')->withPivot('trimester', 'status','course_id');
    }
    public function teach_subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subject_user');
    }
    
    public function teach_sections()
    {
        return $this->hasMany(SectionSubjectUser::class);
    }

    public function teach_students()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'teacher_id','user_id')->where('status','=','coursing');
    }
    public function courses()
    {
        return $this->hasMany(SubjectUser::class, 'user_id');
    }
}
