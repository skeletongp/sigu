<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="subject_user";
    protected $guarded=[];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function subject()
    {
        return $this->hasOne(Subject::class,'id');
    }
    public function section()
    {
        return $this->belongsto(SectionSubjectUser::class, 'course_id')->withTrashed();
    }
   
}
