<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Career extends Model
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
    public function students()
    {
       return $this->hasMany(User::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('trimester');
    }
    public function trimesterSubjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('trimester')->orderby('trimester');
    }
    public function selectiondate()
    {
        $date = date('Y-m-d H:i:s');
       return $this->hasMany(Selectiondate::class)
       ->where('start','<=', $date)
       ->where('end','>=', $date)
       ;
    }
}
