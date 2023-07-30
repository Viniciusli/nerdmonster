<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function store(TicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->create($request->validated());

        return response()->json([
            'ticketCode' => $ticket->ticket_code,
        ], 201);
    }

    public function get($ticketCode): JsonResponse
    {
        $ticket = $this->ticketService->getByTicketCode($ticketCode);

        return response()->json([
            'name' => $ticket->name,
            'yourNumbers' => $ticket->numbers,
            'machineNumbers' => $ticket->result,
            'winner' => $this->ticketService->isWinner($ticket),
            'message' => $this->ticketService->getMessage($ticket),
        ]);
    }
}
