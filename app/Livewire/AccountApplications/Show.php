<?php

namespace App\Livewire\AccountApplications;

use App\Jobs\VerifyNID;
use App\Livewire\Forms\AccountApplicationForm;
use App\Models\AccountApplication;
use App\Stats\Submitted;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Show extends Component
{
    public AccountApplication $accountApplication;

    public function mount(AccountApplication $accountApplication)
    {
        $this->accountApplication = $accountApplication;
    }

    public function render()
    {
        return view('livewire.account-application.show', ['accountApplication' => $this->accountApplication]);
    }

    public function startProcess()
    {        
        if ($this->accountApplication->state->is(Submitted::class)) {
            VerifyNID::dispatch($this->accountApplication);
            Toaster::success('Queued for NID Verification');
            $this->redirect(route('account-applications.index'));
        } else {
            Toaster::error('Application is not in Submitted state');
        }
    }
}
