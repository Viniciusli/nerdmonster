<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(TicketRequest $request): JsonResponse
    {
        $input = $request->validated();
        $input['ticket_code'] = md5($input['number']);
        $ticket = Ticket::create($input);

        return response()->json([
            'ticketCode' => $ticket->ticket_code,
        ], 201);
    }
}
