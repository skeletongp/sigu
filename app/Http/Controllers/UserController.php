<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Methods\userMethods;
use App\Models\Subject;

class UserController extends Controller
{
    public  $role, $methods;
    public function __construct()
    {
        $this->methods = new userMethods();
        $this->middleware(['role:admin'])->except('login', 'logout', 'log', 'index', 'show', 'api_users', 'darkmode');
    }
    public function index()
    {
        request('r') ? $this->role = request('r') : $this->role = [];
        $users = $this->methods->users($this->role);
        return view('users.index')->with(['users' => $users, 'role' => $this->role]);
    }
    public function create()
    {
        $careers = Career::get();
        return view('users.create')->with(['careers' => $careers]);
    }
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->password = bcrypt($user->id);
        $user->email = $user->id . '@' . substr($request->role, 0, 2) . '.sigu.edu.do';
        $user->photo = '/images/' . $user->photo;
        $user->save();
        $user->assignRole($request->role);
        return redirect()->route('users.show', $user);
    }
    public function show($slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        request()->request->add($user->getOriginal());
        $career_subjects=null;
       if ($user->career) {
        $career_subjects = $user->career->subjects;
        if ( $career_subjects->count()==$user->subjects()->count()) {
            $career_subjects=null;
        }
       }
       
        request()->request->add(['role' => $user->roles->pluck('name')[0]]);
        return view('users.show')->with(['user' => $user, 'career_subjects' => $career_subjects]);
    }
    public function edit($slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        $careers = Career::get();
        request()->request->add($user->getOriginal());
        request()->request->add(['role' => $user->roles->pluck('name')[0]]);
        return view('users.edit')->with(['user' => $user, 'careers' => $careers]);
    }
    public function update(UserRequest $request, $slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        $user->update($this->methods->update($request));
        if ($request->role) {
            $user->syncRoles([$request->role]);
            $user->email = $user->id . '@' . substr($user->getRoleNames()[0], 0, 2) . '.sigu.edu.do';
        }
        $user->save();
        if ($user->getRoleNames()[0]!='students') {
            $user->subjects()->detach();
        }
        return redirect()->route('users.show', $slug);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function select(Request $request,  $user)
    {
        $user = User::where('slug', '=', $user)->first();
        if (request('\"subjects')) {
            foreach (request('\"subjects') as $subject) {
                $user->subjects()->syncWithoutDetaching($subject);
            }
        }
        return redirect()->route('users.show', $user);
    }

    public function unselect($subject,  $user)
    {
        $user = User::where('slug', '=', $user)->first();
        $subject = Subject::where('slug', '=', $subject)->first();
        $user->subjects()->detach($subject);
        return redirect()->route('users.show', $user);
    }

    public function api_users(Request $request)
    {
        $users = User::select("name")
            ->where("name", "LIKE", "%{$request->query}%")
            ->get();
        return response()->json($users);
    }

    public function darkmode(Request $request)
    {
        $user=User::find($request->user);
        $user->darkmode=$request->mode;
        $user->save();
      return $request->all();
    }

    //Functions Auth
    public function log()
    {
        if (Auth::user()) {
            return redirect()->route('users.show', ['user' => Auth::user()]);
        }
        $type = request('u');
        return view('users.log')->with('type', $type);
    }

    public function login(Request $request)
    {
        $rol = $request->u;
        if ($this->attempLogin($request, $rol)) {
            return redirect()->route('users.index');
        }
        Auth::logout();
        return redirect()->route('users.log', ['u' => request('u'), 'e' => true]);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        return redirect()->route('welcome');
    }

    public function attempLogin(Request $request, $rol)
    {

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $user = Auth::user();
            return $user->hasRole($rol);
        }
        return false;
    }
}
