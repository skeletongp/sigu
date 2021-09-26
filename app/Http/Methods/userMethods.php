<?php

namespace App\Http\Methods;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class userMethods{


    public function users($role)
    {
        $search = " ";
        request('q') ? $search = request('q') : '';
        $career=request('c');
        if (request('r')) {
            Auth::user()->hasRole('admin') ? $role = request('r') : $role = 'student';
        }
        $users =   User::isRole($role)->career($career)->where('users.id','!=',20210001)->search($search)
            ->paginate(12)->appends(request()->query());
            return $users;
    }

    public function update(UserRequest $request)
    {
        
        if (!str_contains($request->photo, '/')) {
            $request->merge([
                'photo' => '/images/' . $request->photo,
            ]);
        }
        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
        }
        if ($request->role!="student") {
            $request->merge([
                'career_id' => null,
            ]);
        }
        

        return $request->all();
    }
}