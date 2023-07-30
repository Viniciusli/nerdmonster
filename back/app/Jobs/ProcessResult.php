<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Ticket $ticket,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $result = [];
        foreach (range(1, 6) as $i) {
            $result[] = rand(1, 50);
        }

        $this->ticket->update(['result' => $result]);
    }
}
