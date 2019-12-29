<?php

namespace App\Http\Controllers;

use App\Country;
use App\Role;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['profile','roles'])->get();
        return view('Dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $roles = Role::all();
        return view('Dashboard.users.create',compact('countries','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $user = [
            'username' =>$request->username,
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
        ];
        $user = User::create($user);
        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if ($request->hasFile('photo'))
            $filename = $request->file('photo')->storeAs('profile', $filename,'public');

        else
            $filename = null;
        if ($user){
            $profile = new UserProfile([
               'user_id' => $user->id,
                'city' => $request->city,
                'country_id' => $request->country,
                'address' => $request->address,
                'photo' => $filename,
                'phone' => $request->phone,
            ]);
            $user->profile()->save($profile);
            $user->roles()->attach($request->roles);
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['roles','profile'])->where('id',$id)->first();
        return view('Dashboard.users.edit',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['roles','profile'])->where('id',$id)->first();
        $countries = Country::all();
        $roles = Role::all();
        return view('Dashboard.users.edit',compact('user','countries','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);


            $user->name = $request->name;
            $user->email = $request->email;


        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if ($request->hasFile('photo'))
            $filename = $request->file('photo')->storeAs('profile', $filename,'public');

        else
            $filename = $user->profile->photo;
        if ($user->save()){
            $profile = [
                'city' => $request->city,
                'country_id' => $request->country,
                'address' => $request->address,
                'photo' => $filename,
                'phone' => $request->phone,
            ];
            $user->profile()->update($profile);
            $user->roles()->sync($request->roles);
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile()->delete();
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }
}
