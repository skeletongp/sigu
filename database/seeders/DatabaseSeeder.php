<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'support']);
        $admin = User::create([
            'name' => 'Admin',
            'lastname' => 'User',
            'birthday' => date('Y-m-d'),

        ]);
        $admin->email = $admin->id . '@ad.sigu.edu.do';
        $admin->password = bcrypt($admin->id);
        $admin->slug = Str::slug($admin->name . ' ' . $admin->lastname);
        $admin->fullname = $admin->name . ' ' . $admin->lastname;
        $admin->photo = 'https://ui-avatars.com/api/?name=' . urlencode($admin->fullname) .
            '&color=7F9CF5&background=EBF4FF';

        $admin->save();
        $admin->assignRole('admin');
        \App\Models\Career::factory(5)->create();
        \App\Models\User::factory(2500)->create()->each(function ($user) {
            $num=random_int(0,419);
            $path=DB::connection('mysql2')->table('photos')->where('num', $num)->first();
            $roles = ['teacher', 'student', 'support'];
            $user->assignRole($roles[random_int(0, 2)]);
            $user->password = bcrypt($user->id);
            $user->fullname = $user->name . ' ' . $user->lastname;
            $role = $user->getRoleNames()[0];
            $user->email = $user->id . '@' . substr($role, 0, 2) . '.sigu.edu.do';
            $user->hasRole('student') ? $user->career_id = random_int(1, 5) : '';
            $user->photo = asset('x250/'.$path->path);
            $user->save();
            $num>420?$num==-1:'';
            $num++;
        });
    }
}
