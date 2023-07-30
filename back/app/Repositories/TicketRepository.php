<?php

namespace App\Repositories;

use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository implements TicketInterface
{
    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getAll(): Collection
    {
        return $this->ticket->all();
    }

    public function getByTicketCode($ticketCode): Ticket
    {
        return $this->ticket->where('ticket_code', $ticketCode)->firstOrFail();
    }

    public function create(array $ticketData): Ticket
    {
        return $this->ticket->create($ticketData);
    }

    public function update($ticketId, array $ticketData): Ticket
    {
        return $this->ticket->findOrFail($ticketId)->update($ticketData);
    }

    public function delete($ticketId): void
    {
        $this->ticket->findOrFail($ticketId)->delete();
    }
}
