<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $count, $order, $direction, $role;
    public function __construct($count = 10, $order = 'name', $direction = "asc")
    {
        $this->middleware(['role:admin'])->except('login', 'logout', 'log', 'index','show', 'api_users');
        $this->count ? '' : $this->count = $count;
        $this->order = $order;
        $this->direction = $direction;
    }
    public function index()
    {

        request('count') ? $this->count = request('count') : '';
        request('order') ? $this->order = request('order') : '';
        //Dir true=asc; dir false=desc
        request('dir') == true ? $this->direction = 'desc' : $this->direction = 'asc';
        request('r') ? $this->role = request('r') : '';
        $search = " ";
        request('q') ? $search = request('q') : '';
        Auth::user()->hasRole('admin') ? $this->role = request('r') : $this->role = 'student';
        $users =   User::isRole($this->role)->search($search)->orderBy($this->order, $this->direction)->paginate($this->count);
        return view('users.index')->with(['users' => $users, 'role' => $this->role]);
    }


    public function create()
    {
        
        return view('users.create');
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

        request()->request->add(['role' => $user->roles->pluck('name')[0]]);
        return view('users.show')->with(['user' => $user]);
    }


    public function edit($slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        request()->request->add($user->getOriginal());

        request()->request->add(['role' => $user->roles->pluck('name')[0]]);
        return view('users.edit')->with(['user' => $user]);
    }


    public function update(UserRequest $request, $slug)
    {
        $user = User::where('slug', '=', $slug)->first();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->birthday = $request->birthday;
        if (!str_contains($request->photo, '/')) {
            $user->photo = '/images/' . $request->photo;
        }
        $request->password ? $user->password = $request->password : '';
        $user->fullname = $request->name . ' ' . $request->lastname;
        $user->slug = Str::slug($user->fullname, '-');
        $user->email = $user->id . '@' . substr($request->role, 0, 2) . '.sigu.edu.do';
        $user->save();
        $user->syncRoles([$request->role]);
        return redirect()->route('users.show', $user);
    }

    public function destroy($id)
    {
        return $id;
    }

    public function delete($user)
    {
        $user = User::where('slug', $user)->first();
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->back();
    }

    public function api_users(Request $request)
    {
        $users=User::select("name")
        ->where("name","LIKE","%{$request->query}%")
        ->get();
       return response()->json($users);
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
