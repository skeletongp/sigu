<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subject_user')->withPivot('start','end','quota');
    }
    public function courses()
    {
        return $this->hasMany(SectionSubjectUser::class);
    }
}
