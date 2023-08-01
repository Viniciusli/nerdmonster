<?php

namespace App\Helpers;

use App\Models\Ticket;

class TicketHelper
{
    public static function isWinner(Ticket $ticket): bool
    {
        return $ticket->numbers == $ticket->result;
    }

    public static function getMessage(Ticket $ticket): string
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
