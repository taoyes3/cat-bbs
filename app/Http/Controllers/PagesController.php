<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    public function root(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('users.show', compact('user'));
        }
        $topics = Topic::withOrder($request->order)->paginate(20);
        return view('topics.index', compact('topics'));
    }
}
