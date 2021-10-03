<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class SectionSubjectUser extends Model
{
    use HasFactory, SearchableTrait, SoftDeletes;
    protected $table="section_subject_user";
    protected $guarded=[];

    protected $searchable = [
        'columns' => [
            'sections.name' => 10,
            'subjects.name' => 10,
            'subjects.preq' => 10,
            'users.fullname' => 10,
            'section_subject_user.day' => 10,
           
            
        ],
        'joins' => [
            'sections' => ['section_subject_user.section_id', 'sections.id'],
            'subjects' => ['section_subject_user.subject_id', 'subjects.id'],
            'subjects' => ['subjects.id', 'subjects.preq'],
            'users' => ['section_subject_user.user_id', 'users.id'],
        ]
        
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function getFromAttribute() {
        return Carbon::parse(substr($this->start, 0, 5))->format('g:i A');
    }
    public function getFinishAttribute() {
        return Carbon::parse(substr($this->end, 0, 5))->format('g:i A');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'course_id', 'user_id');
    }
}
