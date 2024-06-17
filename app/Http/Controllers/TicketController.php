<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{

    public function handle(Request $request)
    {
        $hasToken = $request->query('token');

        if($hasToken){
            return $this->tokenShow($hasToken);
        }

        return $this->index();

    }

    public function validate(Request $request, Ticket $ticket)
    {
        if($ticket->status === 'invalid'){
            return back()
                ->with('alert-type','warning')
                ->with('alert-msg','Ticket inválido!');
        }

        $ticket->status = 'invalid';
        $ticket->save();

        return redirect()->route('tickets.show',['ticket'=>$ticket])
            ->with('alert-type','success')
            ->with('alert-msg','Ticket atualizado com sucesso!');


    }

    public function tokenShow(String $token)
    {
        $ticket = Ticket::where('qrcode_url', 'LIKE', "%{$token}")->where('status','valid')->first();
        
        if(!$ticket){
            return redirect()->route('home')
                ->with('alert-type','warning')
                ->with('alert-msg','Ticket não encontrado ou inválido!');
        }

        return view('tickets.validate')
            ->with('ticket',$ticket);

    }


    public function index(){
        
        return view('tickets.index');
    }

    public function show(Ticket $ticket): View
    {   
        
        $qrCode = $ticket->qrcode_url ? QrCode::size(300)->generate($ticket->qrcode_url) : "QrCode Indisponível";

        return view('tickets.show')
            ->with('ticket',$ticket)
            ->with('qrCode',$qrCode);
    }
}
