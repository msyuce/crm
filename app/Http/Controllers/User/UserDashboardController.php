<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    /**
     * User dashboard sayfasını gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // resources/views/user/dashboard.blade.php dosyasını döndürür
        return view('user.dashboard');
    }
}
