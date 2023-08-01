<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;

class CreateTicketService
{
    protected TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function create(array $ticketData): Ticket
    {
        $ticketData['ticket_code'] = md5($ticketData['name'].now());

        return $this->ticketRepository->create($ticketData);
    }
}
