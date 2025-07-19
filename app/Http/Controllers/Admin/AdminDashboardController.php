<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Admin dashboard sayfasını gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // resources/views/admin/dashboard.blade.php dosyasını döndürür
        return view('admin.dashboard');
    }
}
