<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Project;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['worker_count'] = User::where('role', RoleEnum::Worker)->count();
        $this->data['vendor_count'] = Vendor::all()->count();
        $this->data['project_ongoing_count'] = Project::whereDate('begin_date', '<', now())
            ->whereDate('finish_date', '>', now())
            ->count();
        $this->data['project_done_count'] = Project::whereDate('finish_date', '<', now())
            ->count();
        return view('home', $this->data);
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'national_identity_number' => $request->national_identity_number,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
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

        return to_route('profile')
            ->with('message', 'Berhasil mengubah profil.')
            ->with('status', 'success');
    }
}
