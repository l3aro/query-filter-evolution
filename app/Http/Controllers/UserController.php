<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        // /users?name=john&email=desmond&gender=female&is_active=1&is_admin=0&birthday=2015-04-11

        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->input('name')}%");
        }

        if ($request->has('email')) {
            $query->where('email', 'like', "%{$request->input('email')}%");
        }

        if ($request->has('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->input('is_active') ? 1 : 0);
        }

        if ($request->has('is_admin')) {
            $query->where('is_admin', $request->input('is_admin') ? 1 : 0);
        }

        if ($request->has('birthday')) {
            $query->where('birthday', $request->input('birthday'));
        }

        return $query->paginate();

        // select * from `users` where `name` like '%john%' and `email` like '%desmond%' and `gender` = 'female' and `is_active` = 1 and `is_admin` = 0 and `birthday` = '2015-04-11' limit 15 offset 0
    }
}
