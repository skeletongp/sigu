<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
trait UserTrait
{
    public function scopeIsRole(Builder $query, $role)
    {
        $roleable=collect($this->roleable);
        if(empty($role) || !$roleable->contains($role)){

            return;
        }
        if ($role=='student' && Auth::user()->hasRole('student')) {
            return Role::where('name',$role)->first()->users()
            ->where('career_id',Auth::user()->career_id);
        }
       return Role::where('name',$role)->first()->users();

    }  
}

?>