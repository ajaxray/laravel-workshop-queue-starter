<?php

namespace App\Listeners;

use App\Jobs\VerifyNSFW;
use App\Models\AccountApplication;
use App\Stats\Approved;
use App\Stats\NIDVerified;
use App\Stats\Rejected;
use Spatie\ModelStates\Events\StateChanged;
use Illuminate\Support\Facades\Log;

class TrackApplicationTransitions
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StateChanged $event): void
    {        
        if ($event->model instanceof AccountApplication) {
            Log::info('Account Application transitioned: ' . $event->model->id . ' to ' . $event->finalState::class);
            
            if ($event->finalState::class == NIDVerified::class) {
                VerifyNSFW::dispatch($event->model->id);
            } else if ($event->finalState::class == Approved::class) {
                // Send email to user
            } else if ($event->finalState::class == Rejected::class) {
                // Send email to user
            }
        }
    }
}
