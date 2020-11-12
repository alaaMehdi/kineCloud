<?php

namespace App\Http\Controllers;

use App\Rendezvous;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{


    public function index($user)
    {
        $user = User::findOrFail($user);
        return view('profile.index', compact('user'));
    }

    public function edit(\App\User $user /* ce methode remplace la fonction findOrFail*/)
    {
       // $this->authorize('update',$user->profile);
        return view('profile.edit', /*autre methode pour retourner des val à la view*/compact('user'));
    }

    public function update(User $user)
    {
        //$this->authorize('update',$user->profile);
        $data = request()->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'adress'=>'',
            'numtel'=>'',

        ]);


        $user->profile->update($data);

        return redirect("/profile/{$user->id}");
    }

}
