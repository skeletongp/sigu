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
            'id'=>20210001

        ]);
        $admin->email = $admin->id . @'ad'.config('services.vars.mail_domain');
        $admin->password = bcrypt($admin->id);
        $admin->slug = Str::slug($admin->name . ' ' . $admin->lastname);
        $admin->fullname = $admin->name . ' ' . $admin->lastname;
        $admin->photo = 'https://ui-avatars.com/api/?name=' . urlencode($admin->fullname) .
            '&color=7F9CF5&background=EBF4FF';

        $admin->save();
        $admin->assignRole('admin');
        \App\Models\Career::factory(5)->create();
        \App\Models\User::factory(12)->create()->each(function ($user) {
            $num=random_int(0,419);
            $path=DB::connection('mysql2')->table('photos')->where('num', $num)->first();
            $user->assignRole('teacher');
            $user->password = bcrypt($user->id);
            $user->fullname = $user->name . ' ' . $user->lastname;
            $user->email = $user->id . @'te'.config('services.vars.mail_domain');
            $user->photo = asset('x250/'.$path->path);
            $user->save();
            $num>420?$num==-1:'';
            $num++;
        });
        \App\Models\User::factory(5)->create()->each(function ($user) {
            $num=random_int(0,419);
            $path=DB::connection('mysql2')->table('photos')->where('num', $num)->first();
            $user->assignRole('support');
            $user->password = bcrypt($user->id);
            $user->fullname = $user->name . ' ' . $user->lastname;
            $user->email = $user->id . @'su'.config('services.vars.mail_domain');
            $user->photo = asset('x250/'.$path->path);
            $user->save();
            $num>420?$num==-1:'';
            $num++;
        });
        \App\Models\User::factory(250)->create()->each(function ($user) {
            $num=random_int(0,419);
            $path=DB::connection('mysql2')->table('photos')->where('num', $num)->first();
            $user->assignRole('student');
            $user->password = bcrypt($user->id);
            $user->fullname = $user->name . ' ' . $user->lastname;
            $user->email = $user->id . @'st'.config('services.vars.mail_domain');
            $user->career_id = random_int(1, 5);
            $user->photo = asset('x250/'.$path->path);
            $user->save();
            $num>420?$num==-1:'';
            $num++;
        });
    }
}
