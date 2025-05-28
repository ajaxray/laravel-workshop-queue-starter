<?php

namespace Tests\Feature\Jobs;

use App\Jobs\VerifyNID;
use App\Models\AccountApplication;
use App\Services\NIDVerificationService;
use App\Stats\NIDVerified;
use App\Stats\NSFWChecked;
use App\Stats\Rejected;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class FakeNIDVerificationService extends NIDVerificationService
{
    public function __construct(private bool $shouldVerify) {}
    public function verifyNID(string $nid, string $dob): bool
    {
        return $this->shouldVerify;
    }
}

class VerifyNIDFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_processes_successful_verification()
    {
        // Arrange: create a real AccountApplication
        $application = AccountApplication::factory()->create([
            'national_id' => '1234567890',
            'birth_date' => '2000-01-01',
        ]);

        // Bind a fake NIDVerificationService that always returns true
        App::bind(NIDVerificationService::class, function () {
            return new FakeNIDVerificationService(true);
        });

        // Act: Dispatch the job
        Bus::dispatch(new VerifyNID($application));

        // Assert: Refresh the model and check state/remarks
        $application->refresh();
        $this->assertStringEndsWith('NID verification successful', $application->remarks[0]);
        // Event listener will dispatch Job to transition the state to NSFWChecked
        // $this->assertInstanceOf(NSFWChecked::class, $application->state);
    }

    public function test_job_processes_failed_verification()
    {
        // Arrange: create a real AccountApplication
        $application = AccountApplication::factory()->create([
            'national_id' => '1234567890',
            'birth_date' => '2000-01-01',
        ]);

        // Bind a fake NIDVerificationService that always returns false
        App::bind(NIDVerificationService::class, function () {
            return new FakeNIDVerificationService(false);
        });

        // Act: Dispatch the job
        Bus::dispatch(new VerifyNID($application));

        // Assert: Refresh the model and check state/remarks
        $application->refresh();
        $this->assertStringEndsWith('NID verification failed', $application->remarks[0]);
        $this->assertInstanceOf(Rejected::class, $application->state);
    }
} 