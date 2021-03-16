<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
       $admins =User::all();
       return view('users',compact('admins'));
   }
}