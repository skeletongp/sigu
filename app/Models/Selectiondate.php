<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Selectiondate extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
