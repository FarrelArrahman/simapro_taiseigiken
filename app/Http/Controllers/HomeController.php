<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Project;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

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
}
