<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

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
            'users.name' => 10,
            'users.lastname' => 10,
            'users.fullname' => 10,
            'users.birthday' => 2,
            'users.email' => 5,
            'careers.name' => 10,
            'careers.code' => 5,
        ],
        'joins' => [
            'careers' => ['users.career_id', 'careers.id']
        ]
    ];
    protected $roleable = ['admin', 'support', 'teacher', 'student'];

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
        return $this->belongsTo(Career::class);
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
    public function age()
    {
        return date_diff(now(), date_create($this->birthday))->y;
    }
}
