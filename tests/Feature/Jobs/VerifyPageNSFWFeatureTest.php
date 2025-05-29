<?php

namespace Tests\Feature\Jobs;

use App\Jobs\VerifyPageNSFW;
use App\Services\NSFWVerificationService;
use Illuminate\Bus\Batch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class VerifyPageNSFWFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_image_file_safe_does_not_cancel_batch()
    {
        Storage::fake('public');
        $filePath = Storage::disk('public')->path('test.jpg');
        file_put_contents($filePath, 'fake image content');

        $batch = Mockery::mock(Batch::class);
        $batch->shouldReceive('cancelled')->andReturn(false);
        $batch->shouldNotReceive('cancel');
        
        $job = Mockery::mock(VerifyPageNSFW::class, [$filePath, 'test.jpg'])
            ->makePartial()
            ->shouldAllowMockingProtectedMethods()
            ->shouldDeferMissing();
        $job->batchId = 'batch-id';
        $job->shouldReceive('batch')->andReturn($batch);

        $nsfw = Mockery::mock(NSFWVerificationService::class);
        $nsfw->shouldReceive('isSafe')->with($filePath)->andReturn(true);

        $job->handle($nsfw);

        $this->addToAssertionCount(1); // To avoid no assertion warning
    }

    public function test_image_file_unsafe_cancels_batch()
    {
        Storage::fake('public');
        $filePath = Storage::disk('public')->path('test.jpg');
        file_put_contents($filePath, 'fake image content');

        $batch = Mockery::mock(Batch::class);
        $batch->shouldReceive('cancelled')->andReturn(false);
        $batch->shouldReceive('cancel')->once();
        $job = Mockery::mock(VerifyPageNSFW::class, [$filePath, 'test.jpg'])
            ->makePartial()
            ->shouldAllowMockingProtectedMethods()
            ->shouldDeferMissing();
        $job->batchId = 'batch-id';
        $job->shouldReceive('batch')->andReturn($batch);

        $nsfw = Mockery::mock(NSFWVerificationService::class);
        $nsfw->shouldReceive('isSafe')->with($filePath)->andReturn(false);

        $job->handle($nsfw);

        $this->addToAssertionCount(1);
    }
} 