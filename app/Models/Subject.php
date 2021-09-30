<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Subject extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;
    
    protected $guarded=[];
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'code' => 10,
           
            
        ],
        
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }
    /* Carreras que dan esta asignatura */
    public function careers()
    {
        return $this->belongsToMany(Career::class);
    }
    /* Todos los estudiantes que toman una asignatura */
    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    /* Los estudiantes que toman una asignatura según la carrera */
    public function studentsCareer($career)
    {
        return $this->belongsToMany(User::class)->withTrashed()->where('career_id','=',$career);
    }
    public function prerrequisite()
    {
        return $this->belongsTo(Subject::class, 'preq');
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_subject_user')->withPivot('start','end','quota');
    }
    public function teacher()
    {
        return $this->belongsToMany(User::class, 'section_subject_user','user_id')->withPivot('start','end','quota');
    }
}
