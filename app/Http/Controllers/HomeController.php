<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        $allAdmin = Admin::count();
        $allUser = User::count();
        $allDeposits = Deposit::count();
        return response()->view('cms.dashboard', [
            'allAdmin' => $allAdmin,
            'allUser' => $allUser,
            'allDeposits' => $allDeposits,
        ]);
    }
}
