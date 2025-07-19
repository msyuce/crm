<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Admin dashboardu için gerekli dinamik veriler
        $userCount = User::count(); // Toplam kullanıcı sayısı
        $recentUsers = User::latest()->take(5)->get(); // Son 5 kullanıcı

        // Verileri admin dashboardu view'ına gönderiyoruz
        return view('admin.dashboard', compact('userCount', 'recentUsers'));
    }
}
