<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->with('user', 'service')->get();
        return view('admin.index', array(
            'tickets' => $tickets
        ));

    }
}
