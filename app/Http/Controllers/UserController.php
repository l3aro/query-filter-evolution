<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        // /users?name=john&email=desmond&gender=female&is_active=1&is_admin=0&birthday=2015-04-11

        return User::query()
            ->filter()
            ->paginate()
            ->appends($request->query()); // append all current queries into pagination links

        // select * from `users` where `name` like '%john%' and `email` like '%desmond%' and `gender` = 'female' and `is_active` = 1 and `is_admin` = 0 and `birthday` = '2015-04-11' limit 15 offset 0
    }
}
