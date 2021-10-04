<?php

namespace App\Http\Methods;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class userMethods
{


    public function users($role)
    {
        $search = " ";
        request('q') ? $search = request('q') : '';
        $order=request('o');
        $career = request('c');
        $user=Auth::user();
        Auth::user()->hasAnyRole('admin|support') ? " " : $role = 'student';
        if (request('r')) {
            Auth::user()->hasAnyRole('admin|support') ? $role = request('r') : $role = 'student';
        }
        $users =   User::isRole($role)->career($career)->where('users.id', '!=', 20210001)->search($search)
            ->order($order)->paginate(9)->appends(request()->query());
        if ($user->rol()=='teacher') {
            $users=$user->teach_students()->search($search)
            ->order($order)->paginate(9)->appends(request()->query());
        }
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
        if ($request->role != "student") {
            $request->merge([
                'career_id' => null,
            ]);
        }


        return $request->all();
    }
    public function show(User $user)
    {
        request()->request->add($user->getOriginal());
        $trim = 1;
        request('\"trimester\""') ? $trim = request('\"trimester\""') : '1';
        $career_subjects = null;
        if ($user->career && $user->career->subjects->count()) {
            $career_subjects = $user->career->subjects->groupby('pivot.trimester');
            $career_subjects = $career_subjects[$trim];
        }
        if ($career_subjects) {
            foreach ($career_subjects as $key => $sub) {
                if ($user->subjects->contains($sub)) {
                    unset($career_subjects[$key]);
                }
            }
        }
        $hasActive = false;
        if ($user->subjects->count()) {
            foreach ($user->subjects as $usub) {
                if ($usub->pivot->status == 'coursing') {
                    $hasActive = true;
                }

            }
        }

        return [$career_subjects, $trim, $hasActive];
    }
}
