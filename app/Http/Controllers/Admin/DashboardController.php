<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    protected $beauticianModelObj;
    protected $userModelObj;

    public function __construct()
    {
        $this->userModelObj = new User();
    }

    /**
     * dashboard page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $dataArr = [
            "page_title" => "Dashboard",
        ];

        return view('admin.dashboard.index')->with('dataArr', $dataArr);
    }
}
