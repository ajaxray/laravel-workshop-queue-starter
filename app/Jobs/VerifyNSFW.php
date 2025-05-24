<?php

namespace App\Jobs;

use App\Models\AccountApplication;
use App\Services\NSFWVerificationService;
use App\Stats\Approved;
use App\Stats\ManualReview;
use App\Stats\NSFWChecked;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Support\Facades\Bus;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VerifyNSFW implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(        
        public int $applicationId
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $application = AccountApplication::find($this->applicationId);
        $application->addRemark('NSFW verification started');

        $filePaths = [];
        
        $documents = $application->getMedia('documents');
        foreach ($documents as $document) {
            $filePaths[] = new VerifyPageNSFW(
                $document->getPath(),
                $document->name
            );
        }

        $photo = $application->getFirstMedia('photo');
        if ($photo) {
            $filePaths[] = new VerifyPageNSFW(
                $photo->getPath(),
                $photo->name
            );
        }

        Bus::batch($filePaths)
            ->name('Verify NSFW for ' . $application->tracking_id)
            ->onQueue('nsfw')
            ->finally(function (Batch $batch) use ($application) {
                if ($batch->cancelled()) {
                    $application->addRemark('NSFW verification batch finished with observations');                
                    $application->state->transitionTo(ManualReview::class);
                } else {
                    $application->addRemark('NSFW verification batch completed');
                    $application->state->transitionTo(NSFWChecked::class);
                }
            })
            ->allowFailures()
            ->dispatch();
    }
}
