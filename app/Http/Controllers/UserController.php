<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Function: Index
     * Description: Returns the dashboard view with Users
     * @return \Illuminate\Contracts\View\View
     */
    public function index() : View {
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('dashboard',compact('users'));

    }


    /**
     * Function: userChat
     * Description: Display the chat view with the user
     * @return \Illuminate\Contracts\View\View;
     */
    public function userChat($userId) : View {
        return view('user-chat', compact('userId'));

    }
}
