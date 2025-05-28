<?php

namespace Tests\Feature\Listeners;

use App\Listeners\TrackApplicationTransitions;
use App\Jobs\VerifyNSFW;
use App\Models\AccountApplication;
use App\Stats\Approved;
use App\Stats\NIDVerified;
use App\Stats\Rejected;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Spatie\ModelStates\Events\StateChanged;
use Tests\TestCase;

class TrackApplicationTransitionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_logs_transition_for_account_application(): void
    {
        Log::spy();
        $application = AccountApplication::factory()->create();
        $event = new StateChanged(null, new NIDVerified($application), $this->mockTransition(), $application);

        (new TrackApplicationTransitions())->handle($event);

        Log::shouldHaveReceived('info')
            ->withArgs(function ($message) use ($application) {
                return str_contains($message, 'Account Application transitioned: ' . $application->id);
            })
            ->once();
    }

    public function test_dispatches_verify_nsfw_job_on_nid_verified_transition(): void
    {
        Queue::fake();
        $application = AccountApplication::factory()->create();
        $event = new StateChanged(null, new NIDVerified($application), $this->mockTransition(), $application);

        (new TrackApplicationTransitions())->handle($event);

        Queue::assertPushed(VerifyNSFW::class, function ($job) use ($application) {
            return $job->applicationId === $application->id;
        });
    }

    public function test_does_not_dispatch_verify_nsfw_job_on_other_transitions(): void
    {
        Queue::fake();
        $application = AccountApplication::factory()->create();
        $event = new StateChanged(null, new Approved($application), $this->mockTransition(), $application);

        (new TrackApplicationTransitions())->handle($event);

        Queue::assertNotPushed(VerifyNSFW::class);
    }

    public function test_handles_only_account_application_models(): void
    {
        Log::spy();
        Queue::fake();
        $otherModel = new class {
            public $id = 123;
        };
        $event = new StateChanged(null, new NIDVerified($otherModel), $this->mockTransition(), $otherModel);

        (new TrackApplicationTransitions())->handle($event);

        Log::shouldNotHaveReceived('info');
        Queue::assertNotPushed(VerifyNSFW::class);
    }

    private function mockTransition(): object
    {
        return $this->getMockBuilder(\Spatie\ModelStates\Transition::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
} 