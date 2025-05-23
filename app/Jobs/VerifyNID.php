<?php

namespace App\Jobs;

use App\Models\AccountApplication;
use App\Services\NIDVerificationService;
use App\Stats\NIDVerified;
use App\Stats\Rejected;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Attributes\WithoutRelations;

class VerifyNID implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public $tries = 3;
    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        #[WithoutRelations]
        public AccountApplication $application,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NIDVerificationService $verifier): void
    {
        try {   
            $verified = $verifier->verifyNID($this->application->national_id, $this->application->birth_date);

            if ($verified) {
                $this->application->state->transitionTo(NIDVerified::class);
                $this->application->addRemark('NID verification successful');
            } else {
                $this->application->addRemark('NID verification failed');
                $this->application->state->transitionTo(Rejected::class);
            }
        } catch (\Exception $e) {
            $this->application->addRemark('NID verification error: ' . $e->getMessage());
            $this->release(30);
        }
    }

    public function uniqueId(): string
    {
        return $this->application->id;
    }
}
