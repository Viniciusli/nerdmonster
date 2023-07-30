<?php

namespace App\Interfaces;

interface TicketInterface
{
    public function getAll();
    public function getByTicketCode($ticketCode);
    public function create(array $ticketData);
    public function update($ticketId, array $ticketData);
    public function delete($ticketId);
}
