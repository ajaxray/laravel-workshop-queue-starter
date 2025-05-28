<?php

namespace Tests\Unit\Jobs;

use App\Jobs\VerifyNID;
use App\Models\AccountApplication;
use App\Services\NIDVerificationService;
use App\Stats\NIDVerified;
use App\Stats\Rejected;
use App\Stats\Submitted;
use Mockery;
use PHPUnit\Framework\TestCase;

class VerifyNIDTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function mockApplication($stateMock)
    {
        $application = Mockery::mock(AccountApplication::class);
        $application->shouldReceive('getAttribute')->with('national_id')->andReturn('1234567890');
        $application->shouldReceive('getAttribute')->with('birth_date')->andReturn('2000-01-01');
        $application->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $application->shouldReceive('getAttribute')->with('state')->andReturn($stateMock);
        $application->shouldReceive('setAttribute')->andReturnUsing(function($key, $value) {});        

        return $application;
    }

    public function test_handle_successful_verification()
    {
        $stateMock = Mockery::mock(Submitted::class);
        $stateMock->shouldReceive('transitionTo')->once()->with(NIDVerified::class);
        $application = $this->mockApplication($stateMock);

        $verifier = Mockery::mock(NIDVerificationService::class);
        $verifier->shouldReceive('verifyNID')->once()->with('1234567890', '2000-01-01')->andReturn(true);

        $application->shouldReceive('addRemark')->once()->with('NID verification successful');

        $job = new VerifyNID($application);
        $job->handle($verifier);

        $this->addToAssertionCount(1);
    }

    public function test_handle_failed_verification()
    {
        $stateMock = Mockery::mock();
        $stateMock->shouldReceive('transitionTo')->once()->with(Rejected::class);
        $application = $this->mockApplication($stateMock);

        $verifier = Mockery::mock(NIDVerificationService::class);
        $verifier->shouldReceive('verifyNID')->once()->with('1234567890', '2000-01-01')->andReturn(false);

        $application->shouldReceive('addRemark')->once()->with('NID verification failed');

        $job = new VerifyNID($application);
        $job->handle($verifier);

        $this->addToAssertionCount(1);
    }

    public function test_handle_verification_exception()
    {
        $stateMock = Mockery::mock();
        $application = $this->mockApplication($stateMock);
        
        $application->shouldReceive('addRemark')->once()->with('NID verification error: Service error');        
        $stateMock->shouldNotReceive('transitionTo');

        $verifier = Mockery::mock(NIDVerificationService::class);
        $verifier->shouldReceive('verifyNID')->once()->andThrow(new \Exception('Service error'));

        $job = new class($application) extends VerifyNID {
            public $released = false;
            public $releaseDelay = null;
            public function release($delay = 0)
            {
                $this->released = true;
                $this->releaseDelay = $delay;
            }
        };
        $job->handle($verifier);
        $this->assertTrue($job->released);
        // $this->assertEquals(5, $job->releaseDelay);
    }
} 