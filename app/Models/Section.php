<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subject_user')->withPivot('start','end','quota');
    }
    public function teacher()
    {
        return $this->belongsToMany(User::class,'section_subject_user','id','user_id')->withPivot('start','end','quota','subject_id');
    }
}
