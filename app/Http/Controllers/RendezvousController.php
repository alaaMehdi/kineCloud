<?php

namespace App\Http\Controllers;

use App\Rendezvous;
use App\User;
use Illuminate\Http\Request;


class RendezvousController extends Controller
{
    public function create()
    {
        return view('rendezvous.create');
    }

    public function edit($rendezvous)
    {
        $rendezvous = Rendezvous::findOrFail($rendezvous);
        $rendezvous= $rendezvous['id'];
        return view('rendezvous.edit', /*autre methode pour retourner des val à la view*/compact('rendezvous'));
    }

    public function update(Rendezvous $rendezvous)
    {
        //$this->authorize('update',$user->profile);



        $data = request()->validate([
            'reservation' => 'required|unique:rendezvouses|after_or_equal:today',
            'lieu' => 'required',
        ]);
        $d=$data['reservation'];
        $reservation=date('Y-m-d h:i', strtotime($d));
        $data['reservation']=$reservation;

        auth()->user()->rendezvous1->update($data);

        return redirect('/profile/' .auth()->user()->id);
    }

    public function store()
    {


        $data = request()->validate([
            'reservation' => 'required|unique:rendezvouses|after_or_equal:today',
            'lieu' => 'required',
        ]);
        $d=$data['reservation'];
        $reservation=date('Y-m-d h:i', strtotime($d));
        $data['reservation']=$reservation;
        auth()->user()->rendezvous()->create($data);

        return redirect('/profile/' .auth()->user()->id);
    }

    public function show()
    {
        return view('rendezvous.show');
    }

    public function destroy(Rendezvous $rdv)
    {

        $rdv->delete();
        return redirect("/rendezvous/show");
    }
}
