<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return view('frontend.profile.index',[
            'user'=>auth()->user()
        ]);
    }


    public function update(Request $request)
    {
        $user = auth()->user();


        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);


        return back()
            ->with('success','Profile updated');
    }
}