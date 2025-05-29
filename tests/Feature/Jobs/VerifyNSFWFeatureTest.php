<?php

namespace Tests\Feature\Jobs;

use App\Jobs\VerifyNSFW;
use App\Jobs\VerifyPageNSFW;
use App\Models\AccountApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VerifyNSFWFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_nsfw_job_dispatches_batch_for_documents_and_photo()
    {
        Bus::fake();

        // Arrange: create application and attach media
        Storage::fake('public');
        $application = AccountApplication::factory()->create();

        // Attach two documents
        $application->addMediaFromString('doc1')->usingName('doc1.pdf')->toMediaCollection('documents');
        $application->addMediaFromString('doc2')->usingName('doc2.pdf')->toMediaCollection('documents');
        // Attach a photo
        $application->addMediaFromString('photo')->usingName('photo.jpg')->toMediaCollection('photo');

        // Act: Dispatch the job
        (new VerifyNSFW($application->id))->handle();

        // Assert: A batch was dispatched with 3 VerifyPageNSFW jobs
        Bus::assertBatchCount(1);
        Bus::assertCount(3, VerifyPageNSFW::class);

        // Assert: The application has a remark about NSFW verification started
        $application->refresh();
        $this->assertStringContainsString('NSFW verification started', $application->remarks[0]);
    }
} 