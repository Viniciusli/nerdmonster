<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketService
{
    protected TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getByTicketCode($ticketCode): Ticket
    {
        return $this->ticketRepository->getByTicketCode($ticketCode);
    }

    public function create(array $ticketData): Ticket
    {
        $ticketData['ticket_code'] = md5($ticketData['name'].now());

        return $this->ticketRepository->create($ticketData);
    }

    public function update(int $ticketId, array $ticketData): Ticket
    {
        return $this->ticketRepository->update($ticketId, $ticketData);
    }

    public function isWinner(Ticket $ticket): bool
    {
        return $ticket->numbers == $ticket->result;
    }

    public function getMessage(Ticket $ticket): string
    {
        if (!$ticket->result) {
            return 'not yet';
        }

        if ($ticket->numbers == $ticket->result) {
            return 'you won!';
        }

        return 'you lost!';
    }
}
