<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::all();
        return view('users.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'national_identity_number' => $request->national_identity_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => RoleEnum::from($request->role),
            'status' => StatusEnum::Active,
        ];

        if($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('public/profile_pictures');
        }

        User::create($data);

        return to_route('users.index')
            ->with('message', 'Berhasil menambahkan user baru.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        
        $this->data['users'] = $user;
        return view('users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'national_identity_number' => $request->national_identity_number,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => RoleEnum::from($request->role),
            'status' => StatusEnum::from($request->status),
        ];

        if($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if($request->hasFile('profile_picture')) {
            if($user->profile_picture != "") {
                Storage::delete($user->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('public/profile_pictures');
        }

        $user->update($data);

        return to_route('users.index')
            ->with('message', 'Berhasil mengubah data user.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
