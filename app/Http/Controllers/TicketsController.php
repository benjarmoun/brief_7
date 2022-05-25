<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Ticket;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

    }

    public function index()
    {
        $services = Service::all();
        $tickets = Ticket::latest()->with('user', 'service')->get();
        // if($this->authorize('view', $tickets))
            // return view('tickets.index', compact('services', 'tickets'));

        return view('welcome', array(
            'services' => $services,
            'tickets' => $tickets
        ));
    }
    


    public function store(Request $request)
    {   
        $this->validate($request, [
            'service_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'status' => 'required',

        ]);
        $ticket = new Ticket();
        $ticket->service_id = $request->service_id;
        $ticket->user_id = auth()->user()->id;
        $ticket->title = $request->title;
        $ticket->body = $request->body;
        $ticket->status = 'new';
        $ticket->save();
        return back();
    }

    public function show($id)
    {
        $ticket = Ticket::With(["responces", "user"])->find($id);
        
        return view('details', array(
            'ticket' => $ticket
        ));
    }

    public function update(Request $request, $id)
    {
        
        $ticket = Ticket::find($id);
        $ticket->status = 'Resolved';
        $ticket->save();
        


        return back();
    }
}
