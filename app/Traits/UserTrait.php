<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

trait UserTrait
{
    public function scopeIsRole(Builder $query, $role)
    {
        $roleable = collect($this->roleable);
        if (empty($role) || !$roleable->contains($role)) {

            return;
        }
        if ($role == 'student' && Auth::user()  && Auth::user()->hasRole('student')) {
            return Role::where('name', $role)->first()->users()
                ->where('career_id', Auth::user()->career_id);
        }
        return Role::where('name', $role)->first()->users();
    }
    public function scopeCareer(Builder $query, $career)
    {

        if (!$career || !intval($career) > 0) {
            return;
        }
        return $query->where('career_id', '=', $career);
    }
    public function scopeOrder(Builder $query, $field)
    {
        $orderable=collect($this->orderable);
        if (empty($field) || !$orderable->contains($field)) {
           return;
        }
        return $query->orderby($field);
    }
}
