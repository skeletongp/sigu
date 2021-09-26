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
    public function careers()
    {
        return $this->belongsToMany(Career::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class);
    }
}
