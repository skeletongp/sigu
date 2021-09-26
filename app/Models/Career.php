<?php

namespace App\Models;

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
        return $this->belongsToMany(Subject::class);
    }
}
