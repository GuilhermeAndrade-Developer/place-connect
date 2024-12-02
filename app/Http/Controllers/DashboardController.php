<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $data = [
                'section' => 'Admin Dashboard',
                'stats' => [
                    'users' => 120,
                    'revenue' => 7500,
                ],
            ];
        } else {
            $data = [
                'section' => 'User Dashboard',
                'suggestions' => ['Course A', 'Course B', 'Course C'],
            ];
        }

        return view('dashboard', compact('data'));
    }
}
