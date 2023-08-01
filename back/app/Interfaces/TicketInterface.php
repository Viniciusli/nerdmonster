<?php

namespace App\Interfaces;

interface TicketInterface
{
    public function getByTicketCode($ticketCode);
    public function create(array $ticketData);
}
