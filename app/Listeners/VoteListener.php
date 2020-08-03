<?php

namespace App\Listeners;

use App\Events\AdminVoteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VoteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminVoteEvent  $event
     * @return void
     */
    public function handle(AdminVoteEvent $event)
    {
        //
    }
}
