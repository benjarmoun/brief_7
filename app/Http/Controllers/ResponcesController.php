<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ResponcesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('responces.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $ticket = Ticket::find($request->ticket_id);
        if(auth()->user()->role){
            if($ticket->status=='new'){
                $ticket->status = 'Answerd';
                $ticket->save();
            }
        }

        $ticket->responces()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);

        return back();
    }
    

}
