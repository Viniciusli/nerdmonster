<?php

namespace App\Http\Controllers\Api;

use App\Helpers\TicketHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use App\Services\CreateTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected CreateTicketService $ticketService;
    protected TicketRepository $ticketRepository;

    public function __construct(CreateTicketService $ticketService, TicketRepository $ticketRepository)
    {
        $this->ticketService = $ticketService;
        $this->ticketRepository = $ticketRepository;
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
        $ticket = $this->ticketRepository->getByTicketCode($ticketCode);

        return response()->json([
            'name' => $ticket->name,
            'yourNumbers' => $ticket->numbers,
            'machineNumbers' => $ticket->result,
            'winner' => TicketHelper::isWinner($ticket),
            'message' => TicketHelper::getMessage($ticket),
        ]);
    }
}